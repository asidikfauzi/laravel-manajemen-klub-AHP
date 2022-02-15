<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Helper\Uuid;
use App\Models\BeritaDanAktivitas;
use App\Models\Klub;
use App\Models\Kontrak;
use App\Models\Pemain;
use App\Models\Pesan;
use App\Models\StrukturKlub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.admin.index');
    }
    
    public function profile()
    {
        return view('dashboard.admin.profile');
    }

    public function showAdmin()
    {
        $data = User::select('*')->where('role_id', 'admin')->get()->toArray();
        return view('dashboard.admin.admin', compact('data'));
    }

    public function showBerita()
    {
        $data = BeritaDanAktivitas::orderBy('created_at', 'desc')->get()->toArray();
        return view('dashboard.admin.beritadanaktivitas', compact('data'));
    }

    public function showEditBerita($id)
    {
        $data = BeritaDanAktivitas::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editBerita', compact('data'));
    }

    public function showKlub()
    {
        $data = Klub::join('users', 'username', '=', 'users_username')->get()->toArray();
        return view('dashboard.admin.klub', compact('data'));
    }

    public function showEditKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editKlub', compact('data'));
    }

    public function showPemain()
    {
        $data = Pemain::select('*')->get()->toArray();
        return view('dashboard.admin.pemain', compact('data'));
    }

    public function showMessage()
    {
        $message = Pesan::where('kepada_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['dari_username'=>$item['dari_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
        return view('dashboard.admin.message', compact('data'));
    }

    public function showSentMessage()
    {
        $message = Pesan::where('dari_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['kepada_username'=>$item['kepada_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
        return view('dashboard.admin.sentMessage', compact('data'));
    }

    public function showKontrak()
    {
        $kontrak = Kontrak::join('pemain', 'pemain.id', '=', 'kontrak.pemain_id')
                        ->join('klub', 'klub.id', '=', 'kontrak.klub_id')
                        ->get()->toArray();
        $data = [];
       
        foreach($kontrak as $item)
        {
            array_push($data, ['id'=>$item['pemain_id'],'nama_pemain'=>$item['nama_pemain'], 'nama_klub'=>$item['nama_klub'], 'foto_kontrak'=>$item['foto_kontrak'], 'awal_kontrak'=>$item['awal_kontrak'], 'akhir_kontrak'=>$item['akhir_kontrak']]);
        }
        
        return view('dashboard.admin.kontrak', compact('data'));
    }

    public function showStruktur($id)
    {
        $data = StrukturKlub::where('klub_id', $id)->get()->toArray();
        return view('dashboard.admin.strukturKlub', compact('data'));
    }

    public function showEditPemain($id)
    {
        $data = Pemain::join('kontrak', 'pemain.id', 'pemain_id')->where('pemain.id', $id)->get()->toArray();
        $dataKlub = Klub::get()->toArray();
        return view('dashboard.admin.editPemain', compact('data', 'dataKlub'));
    }

    public function showTambahPoin()
    {
        $data = Pemain::select('*')->get()->toArray();
        return view('dashboard.admin.tambahpoin', compact('data'));
    }

    public function showTambahBerita()
    {
        return view('dashboard.admin.tambahBerita');
    }
    public function showTambahStrukturKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.tambahStrukturKlub', compact('data', 'id'));
    }

    public function showChangePassword()
    {
        return view('dashboard.admin.changePassword');
    }

    public function editKlub(Request $request, $id)
    {
        $nama = $request->input('namaKlub');
        $tglBeridiri = $request->input('tglBerdiri'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $jadwalLatihan = $request->input('jadwalLatihan');
        $sejarahKlub = $request->input('sejarahKlub');
        $image = $request->file('image');
        

        $data = Klub::find($id);
        if(!$data)
        {
            return back()->with('failed', 'Image klub belum tidak ditemukan');
        }
    
        $data->nama_klub = $nama;
        $data->tgl_berdiri = $tglBeridiri;
        $data->alamat = $alamat;
        $data->notelp = $notelp;
        $data->jadwal_latihan = urlencode($jadwalLatihan);
        $data->sejarah_klub = urlencode($sejarahKlub);

        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImageKlub($image);
            $data->img = $uploadImage;
        }
        
        $data->save();

        return back()->with('success', 'Data succesfully update!');
    }
    
    public function editPemain(Request $request, $id)
    {
        $nama = $request->input('namaPemain');
        $tempat = $request->input('tempat'); 
        $tglLahir = $request->input('tglLahir'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat'); 
        $status = $request->input('status');
        $klub = $request->input('klub');
        $posisi = $request->input('posisi');   
        $image = $request->file('image');

        $gaji = $request->input('gaji');
        $awalKontrak = $request->input('awal_kontrak');
        $akhirKontrak = $request->input('akhir_kontrak');
        $fotoKontrak = $request->file('foto_kontrak');
        
        $data = Pemain::where('id',$id)->first();
        if(!$data)
        {
            return back()->with('failed', 'pemain tidak ditemukan');
        }
        
        $kontrak = Kontrak::where('pemain_id', $id)->first();

        DB::transaction(function() use ($request, $data, $kontrak, $nama, $tempat, $tglLahir, $alamat, $notelp, $tinggi, $berat, $status, $klub, $posisi, $image, $id, $awalKontrak, $akhirKontrak, $gaji, $fotoKontrak){
            
            $data->nama_pemain = $nama;
            $data->tempat = $tempat;
            $data->tgl_lahir = $tglLahir;
            $data->alamat = $alamat;
            $data->notelp = $notelp;
            $data->tinggi = $tinggi;
            $data->berat = $berat;
            $data->status = $status;
            $data->nama_klub = $klub;
            $data->posisi = $posisi;
            if($request->hasFile('image'))   
            {
                $uploadImage = Storage::uploadImagePemain($image);
                $data->img = $uploadImage;
            }
            $data->save();

            $kontrak->awal_kontrak = $awalKontrak;
            $kontrak->akhir_kontrak = $akhirKontrak;
            $kontrak->gaji = $gaji;
            if($request->hasFile('foto_kontrak'))   
            {
                $uploadImageKontrak = Storage::uploadImageKontrak($fotoKontrak);
                $kontrak->foto_kontrak = $uploadImageKontrak;
            }
            $kontrak->save();
        });

        return back()->with('success', 'Data succesfully update!');
    }

    public function editBerita(Request $request, $id)
    {
        $judul = $request->input('judul');
        $isiBerita = $request->input('isi_berita');
        $image = $request->file('image');
        
        $data = BeritaDanAktivitas::where('id', $id)->first();
        $data->judul_berita = $judul;
        $data->isi_berita = urlencode($isiBerita);
        $data->users_username = Auth::user()->username;
        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImageBerita($image);
            $data->img = $uploadImage;
        }
        $data->save();

        return back()->with('success', 'Data Changed Successfully');
    }

    public function tambahBerita(Request $request)
    {
        $uuid = Uuid::getId();
        $judul = $request->input('judul_berita');
        $isiBerita = $request->input('isi_berita');
        $image = $request->file('image');

        $uploadImage = Storage::uploadImageBerita($image);

        $berita = new BeritaDanAktivitas();
        $berita->id = $uuid;
        $berita->judul_berita = $judul;
        $berita->isi_berita = urlencode($isiBerita);
        $berita->img = $uploadImage;
        $berita->users_username = Auth::user()->username;
        $berita->save();

        return back()->with('success', 'Data succesfully saved');
    }

    public function tambahStrukturKlub(Request $request, $id)
    {
        $uuid = Uuid::getId();
        $nama = $request->input('nama');
        $notelp = $request->input('notelp');
        $jabatan = $request->input('jabatan');
        $image = $request->file('image');
        
        

        $dataStruktur = StrukturKlub::where('klub_id', $id)->where('jabatan', $jabatan)->get()->toArray();

        if($dataStruktur)
        {
            return back()->with('failed', 'Jabatan Untuk Klub ini sudah ada');
        }

        $uploadImage = Storage::uploadImageStruktur($image);

        $struktur = new StrukturKlub();
        $struktur->id = $uuid;
        $struktur->nama_sk = $nama;
        $struktur->notelp = $notelp;
        $struktur->jabatan = $jabatan;
        $struktur->img = $uploadImage;
        $struktur->klub_id = $id;
        $struktur->save();

        return back()->with('success', 'Data succesfully saved');
    }

    public function changePassword(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $reNewPassword = $request->input('reNewPassword');

        if($newPassword !== $reNewPassword)
        {
            return back()->with('failed', 'Password tidak sama');
        }
        $data = User::where('username', Auth()->user()->username)->first();

        if(!Hash::check($oldPassword, $data->password ))
        {
            return back()->with('failed', 'Password lama salah');
        }
        if(empty($newPassword) && empty($reNewPassword))
        {
            return back()->with('failed', 'Password baru tidak boleh kosong');
        }
        else if(strlen($newPassword) < 8) 
        {
            return back()->with('failed', 'Password minimal 8 Karakter');
        }
        $hashPassword = Hash::make($newPassword);

        $data->password = $hashPassword;
        $data->save();
        return back()->with('success', 'Password changes succesfully ');

    }

    public function showEditStrukturKlub($id)
    {
        $data = StrukturKlub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editStrukturKlub', compact('data'));
    }

    public function resetPasswordAdmin($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::where('role_id', 'admin')->where('username', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
    }

    public function resetPasswordKlub($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::join('klub', 'username', '=', 'users_username')->where('klub.id', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
           
    }

    public function editStrukturKlub(Request $request, $id)
    {
        $namaSk = $request->input('nama_sk');
        $notelp = $request->input('notelp');
        $jabatan = $request->input('jabatan');
        $image = $request->file('image');

        $data = StrukturKlub::where('id', $id)->first();
        
        $data->nama_sk = $namaSk;
        $data->notelp = $notelp;
        $data->jabatan = $jabatan;
        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImageStruktur($image);
            $data->img = $uploadImage;
        }
        $data->save();

        return back()->with('success', 'Data Changed Successfully');
    }

    public function resetPasswordPemain($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::join('pemain', 'username', '=', 'users_username')->where('pemain.id', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
           
    }

    public function deleteKlub($namaKlub)
    {
        DB::transaction(function() use ($namaKlub){
            $kontrak = Kontrak::join('klub', 'klub_id', '=', 'klub.id')->where('klub.nama_klub', $namaKlub)->delete();
            $pemain = Pemain::join('users', 'users_username', 'username')->where('nama_klub', $namaKlub)->delete();
            $klub = Klub::join('users', 'users_username', 'username')->where('nama_klub', $namaKlub)->delete();
            $usersKlub = User::where('users.role_id', 'klub')->leftJoin('klub', function($join){
                $join->on('username', '=', 'klub.users_username');
            })->whereNull('klub.users_username')->delete();
            $usersKlub = User::where('users.role_id', 'pemain')->leftJoin('pemain', function($join){
                $join->on('username', '=', 'pemain.users_username');
            })->whereNull('pemain.users_username')->delete();
            
        });

        return back()->with('success', 'Klub, Pemain, dan Kontrak yang terkait berhasil di delete');
    }

    public function deleteBerita($id)
    {
        $berita = BeritaDanAktivitas::where('id', $id)->delete();
    
        return back()->with('failed', 'Pemain berhasil di delete');
    }

    public function deletePemain($id)
    {
        DB::transaction(function() use ($id){
            $pemain = Pemain::where('id', $id)->first();
            $users = User::where('username', $pemain->users_username)->first();
            $kontrak = Kontrak::where('pemain_id', $id)->first();           
            $kontrak->delete();
            $pemain->delete();
            $users->delete();
        });

        return back()->with('failed', 'Pemain berhasil di delete');
    }
}
