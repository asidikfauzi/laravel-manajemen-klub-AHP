<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\Klub;
use App\Models\StrukturKlub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $nama = $request->input('namaKlub');
        $tglBeridiri = $request->input('tglBerdiri'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $jadwalLatihan = $request->input('jadwalLatihan');
        $sejarahKlub = $request->input('sejarahKlub');
        $image = $request->file('image');
        

        $data = Klub::where('users_username', Auth()->user()->username)->first();
    
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
        
        return view('dashboard.public.strukturKlub', compact('ketua', 'sekretaris1', 'sekretaris2', 'bendahara1', 'bendahara2', 'id'));
    }
}
