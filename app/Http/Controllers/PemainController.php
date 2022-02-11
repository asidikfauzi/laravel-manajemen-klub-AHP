<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\Pemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PemainController extends Controller
{
    //
    public function index()
    {
        $data = Pemain::join('kontrak', 'pemain.id', '=', 'pemain_id')->where('users_username', Auth::user()->username)->get()->toArray();
        return view('dashboard.pemain.index', compact('data'));
    }

    public function profile()
    {
        return view('dashboard.pemain.profile');
    }

    public function dataPemain($namaKlub)
    {
        $data = Pemain::where('nama_klub', $namaKlub)->get()->toArray();
       
        if(!$data)
        {
            return back()->with('failed', 'klub ini masih tidak memiliki pemain');
        }
        return view('dashboard.public.pemain', compact('data'));
    }
    
    public function show($id)
    {
        $data = Pemain::join('kontrak', 'pemain.id', '=', 'kontrak.pemain_id')->where('pemain.id', $id)->get()->toArray();
        return view('dashboard.public.detailpemain', compact('data','id'));
    }
    public function editPemain(Request $request)
    {
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $tinggi = $request->input('tinggi');
        $berat = $request->input('berat');
        $image = $request->file('image');

        $data = Pemain::where('users_username', Auth::user()->username)->first();

        $data->alamat = $alamat;
        $data->notelp = $notelp;
        $data->tinggi = $tinggi;
        $data->berat = $berat;

        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImagePemain($image) ;
            $data->img = $uploadImage;
        }
        $data->save();

        return back()->with('success', 'Data changed Succesfully');

    }

}
