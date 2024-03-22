<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
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
}
