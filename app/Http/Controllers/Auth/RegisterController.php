<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Storage;
use App\Helper\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Klub;
use App\Models\Kontrak;
use App\Models\Pemain;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'string', 'max:10'],
        ]);
    }

    public function createAdmin()
    {
        return view('dashboard.admin.registerAdmin');
    }

    public function createKlub()
    {
        return view('dashboard.admin.registerKlub');
    }

    public function createPemain()
    {
        $dataKlub = Klub::select('nama_klub')->orderBy('nama_klub', 'ASC')->get()->toArray();
        return view('dashboard.admin.registerPemain', compact('dataKlub'));
    }

    public function registerAdmin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $confirmpas = $request->input('password_confirm');
        $role_id = $request->input('role_id');

        if(empty($username) || empty($password))
        {
            return back()->with('failed', 'please fill your data')->withInput();
        }
        else if(strlen($password) < 8)
        {
            return back()->with('failed', 'username minimum 8 char')->withInput();
        }
        else if($password !== $confirmpas)
        {
            return back()->with('failed', 'passwords are not the same')->withInput();
        }

        $klubUser = User::where('username', $username)->get()->toArray();

        if(count($klubUser) > 0)
        {
            return back()->with('failed', 'Username already exists')->withInput();
        }
        if(empty($role_id))
        {
            $role_id = 'admin';
        }
        $hashPassword = Hash::make($password);

        $users = new User();
        $users->username = $username;
        $users->password = $hashPassword;
        $users->role_id = $role_id;
        $users->save();

        return back()->with('success', 'Data succesfully saved');

        
    }

    public function registerKlub(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $role_id = $request->input('role_id');
        
        $uuid = Uuid::getId();
        $nama = $request->input('nama');
        $tglBeridiri = $request->input('tglBerdiri'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $jadwalLatihan = $request->input('jadwalLatihan');
        $sejarahKlub = $request->input('sejarahKlub');
        $image = $request->file('image');

        if(empty($username) || empty($password) || empty($nama) || empty($tglBeridiri) || empty($alamat) ||
        empty($notelp) || empty($jadwalLatihan) || empty($sejarahKlub))
        {
            return back()->with('failed', 'please fill your data')->withInput();
        }
        else if(strlen($password) < 8)
        {
            return back()->with('failed', 'password minimum 8 char')->withInput();
        }

        $klubUser = User::where('username', $username)->get()->toArray();

        if(count($klubUser) > 0)
        {
            return back()->with('failed', 'Username already exists')->withInput();
        }

        if(empty($role_id))
        {
            $role_id = 'klub';
        }

        $result = DB::transaction(function() use ($username, $password, $role_id, $nama, $tglBeridiri, $alamat,
                                                    $notelp, $jadwalLatihan, $sejarahKlub, $image, $uuid){
            $uploadImage = Storage::uploadImageKlub($image);            
            $hashPassword = Hash::make($password);

            $users = new User();
            $users->username = $username;
            $users->password = $hashPassword;
            $users->role_id = $role_id;
            $users->save();

            $klub = new Klub();
            $klub->id = $uuid;
            $klub->nama_klub = $nama;
            $klub->tgl_berdiri = $tglBeridiri;
            $klub->alamat = $alamat;
            $klub->notelp = $notelp;
            $klub->jadwal_latihan = urlencode($jadwalLatihan);
            $klub->sejarah_klub = urlencode($sejarahKlub);
            $klub->img = $uploadImage;
            $klub->users_username = $username;
            $klub->save();
            return $klub;   
        });
        return back()->with('success', 'Data succesfully saved');
    }

    public function registerPemain(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $role_id = $request->input('role_id');
        $uuid = Uuid::getId();
        $nama = $request->input('nama');
        $tempat = $request->input('tempat');
        $tglLahir = $request->input('tglLahir'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat');
        $namaKlub = $request->input('nama_klub');
        $posisi = $request->input('posisi');
        $image = $request->file('image');
        $gaji = $request->input('gaji');
        $awalKontrak = $request->input('awal_kontrak');
        $akhirKontrak = $request->input('akhir_kontrak');
        $uploadKontrak = $request->file('img_kontrak');

        if(empty($username) || empty($password) || empty($nama) || empty($tinggi) || empty($berat) || empty($alamat) ||
            empty($notelp) || empty($tempat) || empty($tglLahir) || empty($posisi) || empty($namaKlub) || empty($gaji) || 
            empty($awalKontrak) || empty($akhirKontrak))
        {
            return back()->with('failed', 'please fill your data')->withInput();
        }
        else if(strlen($password) < 8)
        {
            return back()->with('failed', 'username minimum 8 char')->withInput();
        }

        $pemainUser = User::where('username', $username)->get()->toArray();

        if(count($pemainUser) > 0)
        {
            return back()->with('failed', 'Username already exists')->withInput();
        }
        if(empty($role_id))
        {
            $role_id = 'pemain';
        }

        $result = DB::transaction(function() use ($username, $password, $role_id, $nama, $tglLahir, $alamat,
                                                    $notelp, $tempat, $tinggi, $berat, $namaKlub, $posisi, $image, 
                                                    $gaji, $awalKontrak, $akhirKontrak, $uploadKontrak, $uuid)
        {
            $hashPassword = Hash::make($password);
            $dataKlub = Klub::where('nama_klub', $namaKlub)->get()->toArray();
        
            $users = new User();
            $users->username = $username;
            $users->password = $hashPassword;
            $users->role_id = $role_id;
            $users->save();

            $uploadImage = Storage::uploadImagePemain($image);
            $uploadImageKontrak = Storage::uploadImageKontrak($uploadKontrak);

            $pemain = new Pemain();
            $pemain->id = $uuid;
            $pemain->nama_pemain = $nama;
            $pemain->tempat = $tempat;
            $pemain->tgl_lahir = $tglLahir;
            $pemain->alamat = $alamat;
            $pemain->notelp = $notelp;
            $pemain->tinggi = $tinggi;
            $pemain->berat = $berat;
            $pemain->status = 'aktif';
            $pemain->nama_klub = $namaKlub;
            $pemain->posisi = $posisi;
            $pemain->img = $uploadImage;
            $pemain->users_username = $username;
            $pemain->save();

            $kontrak = new Kontrak();
            $kontrak->gaji = $gaji;
            $kontrak->awal_kontrak = $awalKontrak;
            $kontrak->akhir_kontrak = $akhirKontrak;
            $kontrak->foto_kontrak = $uploadImageKontrak;
            $kontrak->klub_id = $dataKlub[0]['id'];
            $kontrak->pemain_id = $uuid;
            $kontrak->save();

            return $pemain;   
        });

        return back()->with('success', 'Data succesfully saved');
    }

}
