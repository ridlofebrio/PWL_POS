<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(){
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
    public function create(){
        request()->validate([
            'kodeLevel' => 'required',
            'namaLevel' => 'required',
        ]);

        $data = [
            'level_kode' => request()->kodeLevel,
            'level_nama' => request()->kodeNama,
        ];
        
        LevelModel::create($data);
        return redirect('/user');
    }
}
