<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\dd;
use App\Models\m_user;
class UserController extends Controller
{
    // public function index(){
    //     // $user = UserModel::all();
    //     // return view('user',['data'=>$user]);

    //     // $data = [
    //     //     'username' => 'customer-1',
    //     //     'nama' => 'Pelanggan',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => 3
    //     // ];

    //     // UserModel::insert($data);

    //     // $user = UserModel::all();
    //     // return view('user',['data'=>$user]);

    //     // $data = [
    //     //     'nama' => 'Pelanggan Pertama'
    //     // ];
    //     // UserModel::where('username','customer-1')->update($data);
    //     // $user = UserModel::all();
    //     // return view('user',['data'=>$user]);

    //     // $data = [
    //     //     'username' => 'manager_tiga',
    //     //     'nama' => 'Manager 3',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => 2
    //     // ];
    //     // UserModel::create($data);

    //     // $user = UserModel::find(1);
    //     // return view('user',['data'=> $user]);
        
    //     // $user = UserModel::where('level_id',1)->first();

    //     // $user = UserModel::firstWhere('level_id',1);

    //     // $user = UserModel::findOr(20, ['username','nama'], function() {
    //     //         abort(404);
    //     //     });

    //     // $user = UserModel::findOrFail(10);
    //     // $user = UserModel::where('username','manager9')->firstOrFail();

    //     // $user = UserModel::where('level_id', 2)->count();

    //     // $user = UserModel::create(
    //     //     [
    //     //         'username' => 'manager11',
    //     //         'nama' => 'Manager11',
    //     //         'password' => Hash::make('12345'),
    //     //         'level_id'=> 2
    //     //     ],
    //     // );
    //     // $user -> username='manager12';
    //     // $user -> save();
    //     // $user->wasChanged();
    //     // $user->wasChanged('username');
    //     // $user->wasChanged(['username','level_id']);
    //     // $user->wasChanged('nama');
    //     // dd($user->wasChanged(['nama','username']));

    //     $user =UserModel::all();
    //     return view('user',['data'=> $user]);

    // }
    
    // public function ubah($id) {
    //     $user = UserModel::find($id);
    //     return view('user_ubah',['data'=> $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }
    // public function tambah() {
    //     return view('user_tambah');
    //   }

    // public function tambah_simpan(){
        

    //         request()->validate([
    //             'username' => 'required',
    //             'nama' => 'required',
    //             'password' => 'required',
    //             'level_id' => 'required',
    //         ]);
    
    //         $data = [
    //             'username' => request()->username,
    //             'nama' => request()->nama,
    //             'password' => Hash::make(request()->password),
    //             'level_id' => request()->level_id,
    //         ];
    //         UserModel::create($data);
    
    //         return redirect('/user');
    // }
    // public function hapus($id){
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    // public function index() {
    //     $user = UserModel::with('level')->get();
    //     return view('user', ['data' => $user]);
    // }

    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $useri = m_user::all(); // Mengambil semua isi tabel
        return view('user.user_index', compact('useri'))->with('i');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'user_id' => 'max 20',
            'username' => 'required',
            'nama' => 'required',
        ]);
        m_user::create($request->all());
        return redirect()->route('user.user_index')
        ->with('success', 'user Berhasil Ditambahkan');

    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, m_user $useri)
    {
        $useri = m_user::findOrFail($id);
        return view('user.user_show', compact('useri'));

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $useri = m_user::findOrFail($id);
        return view('user.user_edit', compact('useri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            ]);
            //fungsi eloquent untuk mengupdate data inputan kita
            m_user::find($id)->update($request->all());
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('user.user_index')
            ->with('success', 'Data Berhasil Diupdate');
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $useri= m_user::findOrFail($id)->delete();
        return \redirect()->route('user.user_index')
        -> with('success', 'data Berhasil Dihapus');
    }

}



