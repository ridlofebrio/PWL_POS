<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }
    public function create()
    {
        return view('kategori.create');
    }
    public function store(Request $request) {
        KategoriModel::create(
            [
                'kategori_nama' => $request->namakategori,
                'kategori_kode'=> $request->kodekategori,
            ]
        );
        return redirect('/kategori');
    }
    public function ubah($id) {
        $kategori = KategoriModel::findOrFail($id);
        return view('kategori.edit',['kategori'=> $kategori]);
    }
    public function ganti($id, Request $request) {
        $kategori = KategoriModel::findOrFail($id);

        $kategori->kategori_kode = $request->kodekategori;
        $kategori->kategori_nama = $request->namakategori;
       
        $kategori->save();
        return redirect('/kategori');
    }

        public function hapus($id) {
            $kategori = KategoriModel::findOrFail($id);
            $kategori->delete();
            return redirect('/kategori');
        }
}
