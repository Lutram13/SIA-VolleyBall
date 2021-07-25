<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login', 301);
// Auth::routes();
// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN ROUTE
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // route anggota
    Route::get('/anggota/{usia}', [AdminController::class, 'anggota'])->name('anggota');

    // route pelatih
    Route::get('/pelatih', [AdminController::class, 'pelatih'])->name('pelatih');
    Route::get('/pelatih/tambah', [AdminController::class, 'pelatihTambah'])->name('pelatih.tambah');
    Route::post('/pelatih/store', [AdminController::class, 'pelatihStore'])->name('pelatih.store');
    Route::get('/pelatih/edit/{usia}', [AdminController::class, 'pelatihEdit'])->name('pelatih.edit');  
    Route::put('/pelatih/edit/{usia}', [AdminController::class, 'pelatihUpdate'])->name('pelatih.update');  
    Route::delete('/pelatih/delete/{usia}', [AdminController::class, 'pelatihDestroy'])->name('pelatih.destroy');  

    // route jadwal
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    Route::get('/jadwal/tambah', [AdminController::class, 'jadwalTambah'])->name('jadwal.tambah');
    Route::post('/jadwal/store', [AdminController::class, 'jadwalStore'])->name('jadwal.store');
    Route::get('/jadwal/edit/{usia}', [AdminController::class, 'jadwalEdit'])->name('jadwal.edit');  
    Route::put('/jadwal/edit/{usia}', [AdminController::class, 'jadwalUpdate'])->name('jadwal.update');  
    Route::delete('/jadwal/delete/{usia}', [AdminController::class, 'jadwalDestroy'])->name('jadwal.destroy');  
    
    // route nilai
    Route::get('/nilai', [AdminController::class, 'nilai'])->name('nilai');
    Route::get('/nilai/tambah/{usia}', [AdminController::class, 'nilaiTambah'])->name('nilai.tambah');
    Route::post('/nilai/store', [AdminController::class, 'nilaiStore'])->name('nilai.store');
    Route::get('/nilai/edit/{usia}', [AdminController::class, 'nilaiEdit'])->name('nilai.edit');  
    Route::put('/nilai/edit/{usia}', [AdminController::class, 'nilaiUpdate'])->name('nilai.update');  
    Route::delete('/nilai/delete/{usia}', [AdminController::class, 'nilaiDestroy'])->name('nilai.destroy'); 
    
    //datatable
    Route::get('/nilai/datatable', [AdminController::class, 'dataTableNilai'])->name('nilai.datatable');  

});


// USER ROUTE
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {    
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/formulir', [UserController::class, 'formulir'])->name('formulir');
    Route::post('/formulir/store', [UserController::class, 'formulirStore'])->name('formulir.store');

    Route::get('/anggota/{usia}', [UserController::class, 'anggota'])->name('anggota');
    Route::get('/anggota/edit/{usia}', [UserController::class, 'anggotaEdit'])->name('anggota.edit');  
    Route::put('/anggota/edit/{usia}', [UserController::class, 'anggotaUpdate'])->name('anggota.update');  
    Route::delete('/anggota/delete/{usia}', [UserController::class, 'anggotaDestroy'])->name('anggota.destroy'); 

    Route::get('/jadwal/{usia}', [UserController::class, 'jadwal'])->name('jadwal');

    Route::get('/pelatih', [UserController::class, 'pelatih'])->name('pelatih');

    Route::get('/nilai/{usia}', [UserController::class, 'nilai'])->name('nilai');

});
