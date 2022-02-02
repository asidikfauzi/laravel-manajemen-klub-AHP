<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\KlubController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('klub', [KlubController::class, 'index'])->name('klub');
Route::get('klub/detailklub/{id}', [KlubController::class, 'show'])->name('detailklub');

Route::get('pemain/{namaKlub}', [PemainController::class, 'index'])->name('pemain');
Route::get('pemain/detailpemain/{id}', [PemainController::class, 'show'])->name('detailpemain');

Route::get('profile', function () {
    return view('dashboard.public.profile');
})->name('profile'); 

Route::get('peraturan', function () {
    return view('dashboard.public.peraturan');
})->name('peraturan'); 

Route::get('strukturafkab', function () {
    return view('dashboard.public.strukturafkab');
})->name('strukturafkab'); 

Route::get('layanan', function () {
    return view('dashboard.public.layanan');
})->name('layanan');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class, 'profile'])->name('admin.profile');
   
    //register admin
    Route::get('admin', [AdminController::class, 'showAdmin'])->name('showAdmin');
    Route::get('registerAdmin', [RegisterController::class, 'createAdmin'])->name('registerAdmin');
    Route::post('registerAdmin', [RegisterController::class, 'registerAdmin'])->name('registerAdmin');

    //klub
    Route::get('klub', [AdminController::class, 'showKlub'])->name('showKlub');
    Route::get('registerKlub', [RegisterController::class, 'createKlub'])->name('registerKlub'); 
    Route::post('registerKlub', [RegisterController::class, 'registerKlub'])->name('registerKlub');
    Route::get('klub/edit/{id}', [AdminController::class, 'showEditKlub'])->name('editKlub');
    Route::post('klub/edit/{id}', [AdminController::class, 'editKlub'])->name('editKlub');
    Route::get('struktur/klub/{id}', [AdminController::class, 'showTambahStrukturKlub'])->name('strukturKlub');
    Route::post('struktur/klub/{id}', [AdminController::class, 'tambahStrukturKlub'])->name('strukturKlub');
    
    //pemain
    Route::get('pemain', [AdminController::class, 'showPemain'])->name('showPemain');
    Route::get('registerPemain', [RegisterController::class, 'createPemain'])->name('registerPemain');
    Route::post('registerPemain', [RegisterController::class, 'registerPemain'])->name('registerPemain');
    Route::get('pemain/edit/{id}', [AdminController::class, 'showEditPemain'])->name('editPemain');
    Route::post('pemain/edit/{id}', [AdminController::class, 'editPemain'])->name('editPemain');
    Route::delete('pemain/{id}', [AdminController::class, 'deletePemain'])->name('deletePemain');
    
    Route::get('tambahpoin', [AdminController::class, 'showTambahPoin'])->name('tambahpoin');
    
    Route::get('tambahBerita', [AdminController::class, 'showTambahBerita'])->name('tambahBerita');
    Route::post('tambahBerita', [AdminController::class, 'tambahBerita'])->name('tambahBerita');
});

Route::group(['prefix'=>'klub', 'middleware'=>['isKlub','auth']], function(){
    Route::get('dashboard',[KlubController::class, 'index'])->name('klub.dashboard');
    Route::get('profile',[KlubController::class, 'profile'])->name('klub.profile');
});

Route::group(['prefix'=>'pemain', 'middleware'=>['isPemain','auth']], function(){
    Route::get('dashboard',[PemainController::class, 'index'])->name('pemain.dashboard');
    Route::get('profile',[PemainController::class, 'profile'])->name('pemain.profile');
});


