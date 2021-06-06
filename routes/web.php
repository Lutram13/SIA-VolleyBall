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
    Route::get('/anggota/{usia}', [AdminController::class, 'daftarAnggota'])->name('anggota');
    Route::get('/pelatih', [AdminController::class, 'pelatih'])->name('pelatih');

});


// USER ROUTE
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {    
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/formulir', [UserController::class, 'formulir'])->name('formulir');
    Route::post('/formulir/store', [UserController::class, 'formulirStore'])->name('formulir.store');
    Route::get('/anggota/{usia}', [UserController::class, 'daftarAnggota'])->name('anggota');

});
