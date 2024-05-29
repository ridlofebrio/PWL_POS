<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb =(object) [
            'title' => 'Daftar barang',
            'list' => ['Home','barang']
        
        ];
        $page = (object)[
            'title' => 'Daftar barang',
        ];

        $activeMenu = 'barang';

        $kategori = BarangModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb,'page'=>$page , 'activeMenu' => $activeMenu , 'kategori' => $kategori]); 
    }

    // Mengambil data barang dalam bentuk JSON untuk Datatables
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id','kategori_id','barang_kode', 'barang_nama','harga_beli','harga_jual');
    
      return DataTables::of($barangs)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
          $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
          $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
          $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">';
          $btn .= csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
          return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    
    

public function create(){
    $breadcrumb =(object) [
        'title' => 'Tambah barang',
        'list' => ['Home','barang','Tambah']
    ];
    $page = (object)[
        'title' => 'Tambah barang',
    ];
    $kategori = KategoriModel::all();
    $activeMenu = 'barang';

    return view('barang.create', ['breadcrumb' => $breadcrumb,'page'=>$page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);

}

public function store(Request $request)
{
    $request->validate([
        'barang_kode' => 'required|string',
        'barang_nama' => 'required|string',
        'harga_beli' => 'required|integer',
        'harga_jual' => 'required|integer',
        'kategori_id' => 'required|integer',
        'berkas' => 'required|max:500' 
    ]);

    $existingBarang = BarangModel::where('barang_nama', $request->barang_nama)->first();
    if ($existingBarang) {
        return redirect('/barang')->with('error', 'Barang Telah Ada Tolong Lakukan Edit');
    }

    
        $extfile = $request->berkas->extension();
        $namaFile = $request->barang_nama . "." . $extfile;
        $path = $request->berkas->move(public_path('gambar'), $namaFile);
        $path = str_replace("\\", "/", $path);

    BarangModel::create([
        'barang_kode' => $request->barang_kode,
        'barang_nama' => $request->barang_nama,
        'harga_beli' => $request->harga_beli,
        'harga_jual' => $request->harga_jual,
        'kategori_id' => $request->kategori_id,
        'image' => $namaFile
    ]);

    return redirect('/barang')->with('success', 'Data berhasil ditambahkan');
}

    public function show(string $id)
    {
        $barang = barangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail barang',
            'list' => ['Home', 'barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }
    public function edit(string $id)
    {
        $barang = barangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit barang',
            'list' => ['Home', 'barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.edit', compact('breadcrumb', 'page', 'barang', 'activeMenu','kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string',
            'barang_nama' => 'required|string',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        $barang = barangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = barangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            barangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }


}
