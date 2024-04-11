<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\dd;
use App\Models\m_user;
use Yajra\DataTables\Facades\DataTables;

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

    // public function index()
    // {
    //     //fungsi eloquent menampilkan data menggunakan pagination
    //     $useri = m_user::all(); // Mengambil semua isi tabel
    //     return view('user.user_index', compact('useri'))->with('i');

    // }
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     return view('user.user_create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //melakukan validasi data
    //     $request->validate([
    //         'user_id' => 'max 20',
    //         'username' => 'required',
    //         'nama' => 'required',
    //     ]);
        
    //     m_user::create($request->all());
    //     return redirect()->route('user.user_index')
    //     ->with('success', 'user Berhasil Ditambahkan');

    
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id, m_user $useri)
    // {
    //     $useri = m_user::findOrFail($id);
    //     return view('user.user_show', compact('useri'));

    // }
    // /**
    //  * Show the form for editing the specified resource.
    //  */
   
    //  public function edit(string $id)
    //  {
    //      $useri = m_user::findOrFail($id);
    //      return view( 'user.user_edit', compact('useri'));
 
    //  }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'nama' => 'required',
    //         'password' => 'required',
    //         ]);
    //         //fungsi eloquent untuk mengupdate data inputan kita
    //         m_user::find($id)->update($request->all());
    //         //jika data berhasil diupdate, akan kembali ke halaman utama
    //         return redirect()->route('user.user_index')
    //         ->with('success', 'Data Berhasil Diupdate');
            
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $useri= m_user::findOrFail($id)->delete();
    //     return \redirect()->route('user.user_index')
    //     -> with('success', 'data Berhasil Dihapus');
    // }

    public function index()
    {
        $breadcrumb =(object) [
            'title' => 'Daftar User',
            'list' => ['Home','User']
        
        ];
        $page = (object)[
            'title' => 'Daftar User',
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb,'page'=>$page,'level' => $level , 'activeMenu' => $activeMenu]);
    }

    // Mengambil data user dalam bentuk JSON untuk Datatables
    public function list(Request $request)
    {
      $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
        ->with('level');

    if ($request->level_id) {
        $users->where('level_id', $request->level_id);
    }
    
      return DataTables::of($users)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
          $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
          $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
          $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">';
          $btn .= csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
          return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    
    

public function create(){
    $breadcrumb =(object) [
        'title' => 'Tambah User',
        'list' => ['Home','User','Tambah']
    
    ];
    $page = (object)[
        'title' => 'Tambah User',
    ];
    $level = LevelModel::all();
    $activeMenu = 'user';
    return view('user.create', ['breadcrumb' => $breadcrumb,'page'=>$page, 'level' => $level, 'activeMenu' => $activeMenu]);
}

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success', 'Data berhasil ditambahkan');
    
    }
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user';

        return view('user.user_show', compact('breadcrumb', 'page', 'user', 'activeMenu'));
    }
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.user_edit', compact('breadcrumb', 'page', 'user', 'level', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        $user = UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }


}

