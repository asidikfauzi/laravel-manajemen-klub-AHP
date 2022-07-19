<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\KlubController;
use App\Http\Controllers\RekomendasiController;
use App\Models\User;
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

    
    //message
    Route::get('message',[AdminController::class, 'showMessage'])->name('messageAdmin');
    Route::post('message',[AdminController::class, 'sendMessageAdmin'])->name('messageAdmin');
    Route::get('message/sent',[AdminController::class, 'showSentMessage'])->name('sentMessageAdmin');
    Route::get('message/{id}', [AdminController::class, 'showOpenMessage'])->name('showOpenMessage');
    Route::post('message', [AdminController::class, 'sentMessage'])->name('sentMessage');
    Route::get('sentmessage/{id}', [AdminController::class, 'showOpenSentMessage'])->name('showOpenSentMessage');
   

    //register admin
    Route::get('admin', [AdminController::class, 'showAdmin'])->name('showAdmin');
    Route::get('registerAdmin', [RegisterController::class, 'createAdmin'])->name('registerAdmin');
    Route::post('registerAdmin', [RegisterController::class, 'registerAdmin'])->name('registerAdmin');
    Route::get('resetPasswordAdmin/{id}', [AdminController::class, 'resetPasswordAdmin'])->name('resetPasswordAdmin');

    //klub
    Route::get('klub', [AdminController::class, 'showKlub'])->name('showKlub');
    Route::get('registerKlub', [RegisterController::class, 'createKlub'])->name('registerKlub'); 
    Route::post('registerKlub', [RegisterController::class, 'registerKlub'])->name('registerKlub');
    Route::get('klub/edit/{id}', [AdminController::class, 'showEditKlub'])->name('editKlub');
    Route::post('klub/edit/{id}', [AdminController::class, 'editKlub'])->name('editKlub');
    Route::get('resetPasswordKlub/{id}', [AdminController::class, 'resetPasswordKlub'])->name('resetPasswordKlub');
    Route::get ('delete/klub/{id}', [AdminController::class, 'deleteKlub'])->name('deleteKlub');
    
    Route::get('struktur/klub/{id}', [AdminController::class, 'showStruktur'])->name('strukturKlub');
    Route::get('struktur/klub/add/{id}', [AdminController::class, 'showTambahStrukturKlub'])->name('addStrukturKlub');
    Route::get('strukturklub/edit/{id}', [AdminController::class, 'showEditStrukturKlub'])->name('showEditStrukturKlub');
    Route::post('strukturklub/edit/{id}', [AdminController::class, 'editStrukturKlub'])->name('showEditStrukturKlub');
    Route::post('struktur/klub/add/{id}', [AdminController::class, 'tambahStrukturKlub'])->name('addStrukturKlub');
    Route::delete('struktur/{id}', [AdminController::class, 'deleteStruktur'])->name('deleteStruktur');
    
    //pemain
    Route::get('pemain', [AdminController::class, 'showPemain'])->name('showPemain');
    Route::get('registerPemain', [RegisterController::class, 'createPemain'])->name('registerPemain');
    Route::post('registerPemain', [RegisterController::class, 'registerPemain'])->name('registerPemain');
    Route::get('pemain/edit/{id}', [AdminController::class, 'showEditPemain'])->name('adminEditPemain');
    Route::post('pemain/edit/{id}', [AdminController::class, 'editPemain'])->name('adminEditPemain');
    Route::get('resetPasswordPemain/{id}', [AdminController::class, 'resetPasswordPemain'])->name('resetPasswordPemain');
    Route::get('delete/pemain/{id}', [AdminController::class, 'deletePemain'])->name('deletePemain');

    //kontrak
    Route::get('kontrak', [AdminController::class, 'showKontrak'])->name('showKontrak');
    Route::get('delete/kontrak/{id}', [AdminController::class, 'deleteKontrak'])->name('deleteKontrak');
    
    //pont pemain/kiper
    Route::get('tambahpoin', [AdminController::class, 'showTambahPoin'])->name('tambahpoin');
    Route::post('tambahpoin', [AdminController::class, 'tambahPoinPemain'])->name('tambahpoin');
    Route::get('/kiper/tambahpoin', [AdminController::class, 'showTambahPoinKiper'])->name('tambahpoin-kiper');
    Route::post('/kiper/tambahpoin', [AdminController::class, 'tambahPoinKiper'])->name('tambahpoin-kiper');

    Route::get('poinpemain', [AdminController::class, 'showPoinPemain'])->name('poinpemain');
    
    //berita dan aktivitas
    Route::get('beritadanaktivitas', [AdminController::class, 'showBerita'])->name('beritaDanAktivitas');
    Route::get('tambahBerita', [AdminController::class, 'showTambahBerita'])->name('tambahBerita');
    Route::post('tambahBerita', [AdminController::class, 'tambahBerita'])->name('tambahBerita');
    Route::get('editBerita/{id}', [AdminController::class, 'showEditBerita'])->name('editBerita');
    Route::post('editBerita/{id}', [AdminController::class, 'editBerita'])->name('editBerita'); 
    Route::get('delete/berita/{id}', [AdminController::class, 'deleteBerita'])->name('deleteBerita');

    //kriteria dan sub kriteria
    Route::get('kriteria-dan-subkriteria', [AdminController::class, 'showKriteriaSubKriteria'])->name('kriteriasubkriteria');
    Route::post('kriteria-dan-subkriteria', [AdminController::class, 'editKriteriaSubKriteria'])->name('kriteriasubkriteria');


    //REkomendasi
    Route::get('goal', [RekomendasiController::class, 'goal'])->name('goal');
    Route::get('assist', [RekomendasiController::class, 'assist'])->name('assist');
    Route::get('kuning', [RekomendasiController::class, 'kuning'])->name('kuning');
    Route::get('merah', [RekomendasiController::class, 'merah'])->name('merah');
    Route::get('attitude', [RekomendasiController::class, 'attitude'])->name('attitude');

    Route::get('kebobolan', [RekomendasiController::class, 'kebobolan'])->name('kebobolan');
    Route::get('penyelamatan', [RekomendasiController::class, 'penyelamatan'])->name('penyelamatan');
    Route::get('kuningKiper', [RekomendasiController::class, 'kuningKiper'])->name('kuningKiper');
    Route::get('merahKiper', [RekomendasiController::class, 'merahKiper'])->name('merahKiper');
    Route::get('attitudeKiper', [RekomendasiController::class, 'attitudeKiper'])->name('attitudeKiper');

});

Route::group(['prefix'=>'pemain', 'middleware'=>['isPemain','auth']], function(){
    Route::get('dashboard', [PemainController::class, 'index'])->name('isPemain.dashboard');
    Route::post('dashboard', [PemainController::class, 'editPemain'])->name('editPemain');

    //message
    Route::get('message',[PemainController::class, 'showMessage'])->name('pemain.messageAdmin');
    Route::post('message',[PemainController::class, 'sendMessageAdmin'])->name('pemain.messageAdmin');
    Route::get('message/sent',[PemainController::class, 'showSentMessage'])->name('pemain.sentMessageAdmin');
    Route::get('message/{id}', [PemainController::class, 'showOpenMessage'])->name('pemain.showOpenMessage');
    Route::post('message', [PemainController::class, 'sentMessage'])->name('pemain.sentMessage');
    Route::get('sentmessage/{id}', [PemainController::class, 'showOpenSentMessage'])->name('pemain.showOpenSentMessage');
    
    Route::get('changePassword', [PemainController::class, 'showChangePassword'])->name('changePasswordPemain');
    Route::post('changePassword', [PemainController::class, 'changePassword'])->name('changePasswordPemain');

});


Route::group(['prefix'=>'klub', 'middleware'=>['isKlub','auth']], function(){
    Route::get('dashboard', [KlubController::class, 'index'])->name('klub.dashboard');
    Route::post('dashboard', [KlubController::class, 'editKlub'])->name('klub.dashboard');
    Route::get('struktur/klub/{id}', [KlubController::class, 'showStrukturKlub'])->name('klub.showStrukturKlub');
    Route::get('datastruktur/klub/{id}', [KlubController::class, 'showStruktur'])->name('klub.showStrukturAll');
    Route::get('struktur/klub/add/{id}', [KlubController::class, 'showTambahStrukturKlub'])->name('klub.addStrukturKlub');
    Route::post('struktur/klub/add/{id}', [KlubController::class, 'tambahStrukturKlub'])->name('klub.addStrukturKlub');
    Route::get('strukturklub/edit/{id}', [KlubController::class, 'showEditStrukturKlub'])->name('klub.showEditStrukturKlub');
    Route::post('strukturklub/edit/{id}', [KlubController::class, 'editStrukturKlub'])->name('klub.showEditStrukturKlub');

    //message
    Route::get('message',[KlubController::class, 'showMessage'])->name('klub.messageAdmin');
    Route::post('message',[KlubController::class, 'sendMessageAdmin'])->name('klub.messageAdmin');
    Route::get('message/sent',[KlubController::class, 'showSentMessage'])->name('klub.sentMessageAdmin');
    Route::get('message/{id}', [KlubController::class, 'showOpenMessage'])->name('klub.showOpenMessage');
    Route::post('message', [KlubController::class, 'sentMessage'])->name('klub.sentMessage');
    Route::get('sentmessage/{id}', [KlubController::class, 'showOpenSentMessage'])->name('klub.showOpenSentMessage');

    Route::get('changePassword',[KlubController::class, 'showChangePassword'])->name('changePasswordKlub');
    Route::post('changePassword',[KlubController::class, 'changePassword'])->name('changePasswordKlub');

    Route::delete('struktur/{id}', [KlubController::class, 'deleteStruktur'])->name('klub.deleteStruktur');
    
    Route::get('rekomendasi/global/rekomendasi', [KlubController::class, 'showRekom'])->name('klub.showRekom');

    Route::get('rekomendasi/pemain', [KlubController::class, 'showRekomendasi'])->name('klub.showRekomendasi');
    Route::post('rekomendasi/pemain', [KlubController::class, 'rekomendasi'])->name('klub.rekomendasi');

    Route::get('rekomendasi/kiper', [KlubController::class, 'showRekomendasiKiper'])->name('klub.showRekomendasi.kiper');
    Route::post('rekomendasi/kiper', [KlubController::class, 'rekomendasiKiper'])->name('klub.rekomendasi.kiper');

});




Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('klub', [KlubController::class, 'indexPublic'])->name('klub');
Route::get('klub/detailklub/{id}', [KlubController::class, 'show'])->name('detailklub');
Route::get('struktur/klub/{id}', [HomeController::class, 'showStrukturKlub'])->name('showStrukturKlub');

Route::get('pemain/{namaKlub}', [PemainController::class, 'dataPemain'])->name('pemain');
Route::get('pemain/detailpemain/{id}', [PemainController::class, 'show'])->name('detailpemain');

Route::get('pemain/rekomendasi/terbaik', [HomeController::class, 'showPoinPemain'])->name('pemain.rekomendasi.terbaik');

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




