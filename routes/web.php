<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Coba;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {  
//     return view('templateBaru');
// });

Route::get('/', [WelcomeController::class, 'index']);

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// Route::get('/level', [LevelController::class, 'index']);
// Route::post('/level', [LevelController::class, 'create']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);


// // Route::get('/kategori', [KategoriController::class, 'index']);


// Route::post('/kategori/ganti_simpan/{id}', [KategoriController::class, 'ganti']);
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'ubah']);
// Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus']);


// Route::get('/level/create', function () {  
//     return view('level/level_create');
// });
// Route::get('/user/create', function () {  
//     return view('user/user_create');
// });

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::resource('m_user',UserController::class);
// Route::resource('user',UserController::class);