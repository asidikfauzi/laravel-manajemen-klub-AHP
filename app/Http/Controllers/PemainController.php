<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Helper\Uuid;
use App\Models\Pemain;
use App\Models\Pesan;
use App\Models\User;
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

    public function showMessage()
    {
        $message = Pesan::where('kepada_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'dari_username'=>$item['dari_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
        return view('dashboard.pemain.message', compact('data'));
    }

    public function showOpenMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.pemain.openmessage', compact('data'));
    }

    public function showOpenSentMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.pemain.opensentmessage', compact('data'));
    }

    public function showSentMessage()
    {
        $message = Pesan::where('dari_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'kepada_username'=>$item['kepada_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
       
        return view('dashboard.pemain.sentMessage', compact('data'));
    }

    public function sentMessage(Request $request)
    {
        $uuid = Uuid::getId();;
        $to = $request->input('to');
        $isiPesan = $request->input('isi_pesan');

        $data = User::where('username', $to)->get()->toArray();
        if(empty($data))
        {
            return back()->with('failed', 'username yang anda kirimkan tidak tersedia');
        }
        
        $pesan = new Pesan();
        $pesan->id = $uuid;
        $pesan->isi_pesan = $isiPesan;
        $pesan->dari_username = Auth::user()->username;
        $pesan->kepada_username = $to;
        $pesan->save();

        return back()->with('success', 'Pesan berhasil terkirim');
    }

}
