<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\dd;

class UserController extends Controller
{
    public function index(){
        // $user = UserModel::all();
        // return view('user',['data'=>$user]);

        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 3
        // ];

        // UserModel::insert($data);

        // $user = UserModel::all();
        // return view('user',['data'=>$user]);

        // $data = [
        //     'nama' => 'Pelanggan Pertama'
        // ];
        // UserModel::where('username','customer-1')->update($data);
        // $user = UserModel::all();
        // return view('user',['data'=>$user]);

        // $data = [
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ];
        // UserModel::create($data);

        // $user = UserModel::find(1);
        // return view('user',['data'=> $user]);
        
        // $user = UserModel::where('level_id',1)->first();

        // $user = UserModel::firstWhere('level_id',1);

        // $user = UserModel::findOr(20, ['username','nama'], function() {
        //         abort(404);
        //     });

        // $user = UserModel::findOrFail(10);
        // $user = UserModel::where('username','manager9')->firstOrFail();

        $user = UserModel::where('level_id', 2)->count();
        return view('user', ['data' => $user]);
    }
}
