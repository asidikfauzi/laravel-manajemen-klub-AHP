<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Helper\Uuid;
use App\Models\Klub;
use App\Models\StrukturKlub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KlubController extends Controller
{
    //
    public function index()
    {
        $data = Klub::where('users_username', Auth()->user()->username)->get()->toArray();
        return view('dashboard.klub.index', compact('data'));
    }

    public function editKlub(Request $request)
    {
        $tglBeridiri = $request->input('tglBerdiri'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $jadwalLatihan = $request->input('jadwalLatihan');
        $sejarahKlub = $request->input('sejarahKlub');
        $image = $request->file('image');
        

        $data = Klub::where('users_username', Auth()->user()->username)->first();
    
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
    
    public function profile()
    {
        return view('dashboard.klub.profile');
    }

    public function show($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.public.detailklub', compact('data','id'));
    }

    public function indexPublic()
    {
        $data = Klub::select('*')->get()->toArray();
        return view('dashboard.public.klub', compact('data'));
    }

    public function showStruktur($id)
    {
        $data = StrukturKlub::where('klub_id', $id)->get()->toArray();
        if(empty($data))
        {
            return back()->with('failed', 'Struktur data dari klub ini masih belum ada, silahkan tambahkan terlebih dahulu');
        }
        return view('dashboard.klub.dataStruktur', compact('data', 'id'));
    }


    public function showStrukturKlub($id)
    {
        
        $ketua = StrukturKlub::where('klub_id', $id)->where('jabatan', 'ketua')->get()->toArray();
        $sekretaris1 = StrukturKlub::where('klub_id', $id)->where('jabatan', 'sekretaris1')->get()->toArray();
        $sekretaris2 = StrukturKlub::where('klub_id', $id)->where('jabatan', 'sekretaris2')->get()->toArray();
        $bendahara1 = StrukturKlub::where('klub_id', $id)->where('jabatan', 'bendahara1')->get()->toArray();
        $bendahara2 = StrukturKlub::where('klub_id', $id)->where('jabatan', 'bendahara2')->get()->toArray();
       
        

        if(empty($ketua))
        {
            $ketua[0]['nama_sk'] = '-';
            $ketua[0]['img'] = '-';
        }

        if(empty($sekretaris1))
        {
            $sekretaris1[0]['nama_sk'] = '-';
            $sekretaris1[0]['img'] = '-';
        }

        if(empty($sekretaris2))
        {
            $sekretaris2[0]['nama_sk'] = '-';
            $sekretaris2[0]['img'] = '-';
        }

        if(empty($bendahara1))
        {
            $bendahara1[0]['nama_sk'] = '-';
            $bendahara1[0]['img'] = '-';
        }
        
        if(empty($bendahara2))
        {
            $bendahara2[0]['nama_sk'] = '-';
            $bendahara2[0]['img'] = '-';
        }
        
        return view('dashboard.klub.strukturKlub', compact('ketua', 'sekretaris1', 'sekretaris2', 'bendahara1', 'bendahara2', 'id'));
    }

    public function showTambahStrukturKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.klub.tambahStrukturKlub', compact('data', 'id'));
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
            return back()->with('failed', 'Jabatan Untuk Klub anda sudah ada');
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

    public function showChangePassword()
    {
        return view('dashboard.klub.changePassword');
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
}
