<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok'
        ];

        $activeMenu = 'stok';

        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.index', compact('breadcrumb', 'page', 'barang', 'user', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->with('barang', 'user');

        if ($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }

        if ($request->user_id) {
            $stoks->where('user_id', $request->user_id);
        }

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">';
                $btn .= csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
              })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
public function create(){
    $breadcrumb =(object) [
        'title' => 'Tambah Stok',
        'list' => ['Home','Stok','Tambah']
    ];
    $page = (object)[
        'title' => 'Tambah Stok',
    ];
    $barang = barangModel::all();
    $user = UserModel::all();
    $activeMenu = 'Stok';

    return view('stok.create', ['breadcrumb' => $breadcrumb,'page'=> $page, 'barang' => $barang, 'activeMenu'=> $activeMenu,'user'=> $user]);
}

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'stok_jumlah' => 'required|integer',
            'user_id' => 'required|integer',
            'barang_id' => 'required|integer'
        ]);

        $existingStok = StokModel::where('barang_id', $request->barang_id)->first();
        if ($existingStok) {
            return redirect('/stok')->with('error', 'Barang sudah memiliki stok. Silakan lakukan edit jika diperlukan.');
        }
        
        StokModel::create([
            'stok_jumlah' => $request->stok_jumlah,
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'stok_tanggal' => now()
        ]);

        return redirect('/stok')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $stok = StokModel::with('barang', 'user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $stok = StokModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok'
        ];

        $activeMenu = 'stok';

        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'activeMenu', 'barang', 'user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'stok_jumlah' => 'required|integer',
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        StokModel::find($id)->update([
            'stok_tanggal' => now(),
            'stok_jumlah' => $request->stok_jumlah,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            barangModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }
}