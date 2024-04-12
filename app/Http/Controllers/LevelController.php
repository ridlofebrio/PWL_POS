<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb =(object) [
            'title' => 'Daftar level',
            'list' => ['Home','level']
        
        ];
        $page = (object)[
            'title' => 'Daftar level',
        ];

        $activeMenu = 'level';

        return view('level.index', ['breadcrumb' => $breadcrumb,'page'=>$page , 'activeMenu' => $activeMenu]);
    }

    // Mengambil data level dalam bentuk JSON untuk Datatables
    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_name');
    
      return DataTables::of($levels)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
          $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
          $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
          $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">';
          $btn .= csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
          return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    
    

public function create(){
    $breadcrumb =(object) [
        'title' => 'Tambah Level',
        'list' => ['Home','Level','Tambah']
    ];
    $page = (object)[
        'title' => 'Tambah Level',
    ];
    $level = LevelModel::all();
    $activeMenu = 'level';
    return view('level.create', ['breadcrumb' => $breadcrumb,'page'=>$page, 'level' => $level, 'activeMenu' => $activeMenu]);
}

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'level_kode' => 'required|string',
            'level_name' => 'required|string',
            'level_id' => 'required|integer'
        ]);

        levelModel::create([
            'level_id' => $request->level_id,
            'level_name' => $request->level_name,
            'level_kode' => $request->level_kode
        ]);
        return redirect('/level')->with('success', 'Data berhasil ditambahkan');
    
    }
    public function show(string $id)
    {
        $level = levelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail level',
            'list' => ['Home', 'level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }
    public function edit(string $id)
    {
        $level = levelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit level',
            'list' => ['Home', 'level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string',
            'level_name' => 'required|string',
            'level_id' => 'required|integer'
        ]);

        $level = levelModel::find($id)->update([
            'level_id' => $request->level_id,
            'level_name' => $request->level_name,
            'level_kode' => $request->level_kode
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = levelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            levelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }


}
