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
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('changePassword',[AdminController::class, 'showChangePassword'])->name('changePassword');
    Route::post('changePassword',[AdminController::class, 'changePassword'])->name('changePassword');

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
    
    Route::get('struktur/klub/{id}', [AdminController::class, 'showStruktur'])->name('strukturKlub');
    Route::get('struktur/klub/add/{id}', [AdminController::class, 'showTambahStrukturKlub'])->name('addStrukturKlub');
    Route::get('strukturklub/edit/{id}', [AdminController::class, 'showEditStrukturKlub'])->name('showEditStrukturKlub');
    Route::post('strukturklub/edit/{id}', [AdminController::class, 'editStrukturKlub'])->name('showEditStrukturKlub');
    Route::post('struktur/klub/add/{id}', [AdminController::class, 'tambahStrukturKlub'])->name('addStrukturKlub');
    
    Route::get('resetPasswordKlub/{id}', [AdminController::class, 'resetPasswordKlub'])->name('resetPasswordKlub');
    Route::delete('klub/{namaKlub}', [AdminController::class, 'deleteKlub'])->name('deleteKlub');
    
    //pemain
    Route::get('pemain', [AdminController::class, 'showPemain'])->name('showPemain');
    Route::get('registerPemain', [RegisterController::class, 'createPemain'])->name('registerPemain');
    Route::post('registerPemain', [RegisterController::class, 'registerPemain'])->name('registerPemain');
    Route::get('pemain/edit/{id}', [AdminController::class, 'showEditPemain'])->name('editPemain');
    Route::post('pemain/edit/{id}', [AdminController::class, 'editPemain'])->name('editPemain');
    Route::get('resetPasswordPemain/{id}', [AdminController::class, 'resetPasswordPemain'])->name('resetPasswordPemain');
    Route::delete('pemain/{id}', [AdminController::class, 'deletePemain'])->name('deletePemain');

    
    Route::get('tambahpoin', [AdminController::class, 'showTambahPoin'])->name('tambahpoin');
    
    //berita dan aktivitas
    Route::get('beritadanaktivitas', [AdminController::class, 'showBerita'])->name('beritaDanAktivitas');
    Route::get('tambahBerita', [AdminController::class, 'showTambahBerita'])->name('tambahBerita');
    Route::post('tambahBerita', [AdminController::class, 'tambahBerita'])->name('tambahBerita');
    Route::get('editBerita/{id}', [AdminController::class, 'showEditBerita'])->name('editBerita');
    Route::post('editBerita/{id}', [AdminController::class, 'editBerita'])->name('editBerita'); 
    Route::delete('berita/{id}', [AdminController::class, 'deleteBerita'])->name('deleteBerita');

});

Route::group(['prefix'=>'pemain', 'middleware'=>['isPemain','auth']], function(){
    Route::get('dashboard', [PemainController::class, 'index'])->name('isPemain.dashboard');
    Route::post('dashboard', [PemainController::class, 'editPemain'])->name('pemain.dashboard');
    
    Route::get('changePassword', [PemainController::class, 'showChangePassword'])->name('changePasswordPemain');
    Route::post('changePassword', [PemainController::class, 'changePassword'])->name('changePasswordPemain');

});


Route::group(['prefix'=>'klub', 'middleware'=>['isKlub','auth']], function(){
    Route::get('dashboard', [KlubController::class, 'index'])->name('klub.dashboard');
    Route::post('dashboard', [KlubController::class, 'editKlub'])->name('klub.dashboard');
    
    Route::get('changePassword',[KlubController::class, 'showChangePassword'])->name('changePasswordKlub');
    Route::post('changePassword',[KlubController::class, 'changePassword'])->name('changePasswordKlub');
    
});




Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('klub', [KlubController::class, 'indexPublic'])->name('klub');
Route::get('klub/detailklub/{id}', [KlubController::class, 'show'])->name('detailklub');
Route::get('struktur/klub/{id}', [KlubController::class, 'showStrukturKlub'])->name('showStrukturKlub');

Route::get('pemain/{namaKlub}', [PemainController::class, 'dataPemain'])->name('pemain');
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




