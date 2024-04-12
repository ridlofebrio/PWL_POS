<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb =(object) [
            'title' => 'Daftar kategori',
            'list' => ['Home','kategori']
        
        ];
        $page = (object)[
            'title' => 'Daftar kategori',
        ];

        $activeMenu = 'kategori';

        return view('kategori.index', ['breadcrumb' => $breadcrumb,'page'=>$page , 'activeMenu' => $activeMenu]);
    }

    // Mengambil data kategori dalam bentuk JSON untuk Datatables
    public function list(Request $request)
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
    
      return DataTables::of($kategoris)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
          $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
          $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
          $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">';
          $btn .= csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
          return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    
    

public function create(){
    $breadcrumb =(object) [
        'title' => 'Tambah kategori',
        'list' => ['Home','kategori','Tambah']
    ];
    $page = (object)[
        'title' => 'Tambah kategori',
    ];
    $kategori = kategoriModel::all();

    $activeMenu = 'kategori';
    return view('kategori.create', ['breadcrumb' => $breadcrumb,'page'=>$page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'kategori_kode' => 'required|string',
            'kategori_nama' => 'required|string',
            'kategori_id' => 'required|integer'
        ]);

        kategoriModel::create([
            'kategori_id' => $request->kategori_id,
            'kategori_nama' => $request->kategori_nama,
            'kategori_kode' => $request->kategori_kode
        ]);
        return redirect('/kategori')->with('success', 'Data berhasil ditambahkan');
    
    }
    public function show(string $id)
    {
        $kategori = kategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail kategori',
            'list' => ['Home', 'kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }
    public function edit(string $id)
    {
        $kategori = kategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit kategori',
            'list' => ['Home', 'kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string',
            'kategori_nama' => 'required|string',
            'kategori_id' => 'required|integer'
        ]);

        $kategori = kategoriModel::find($id)->update([
            'kategori_id' => $request->kategori_id,
            'kategori_nama' => $request->kategori_nama,
            'kategori_kode' => $request->kategori_kode
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = kategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            kategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }


}