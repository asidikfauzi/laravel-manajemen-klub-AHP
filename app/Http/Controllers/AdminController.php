<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\Klub;
use App\Models\Pemain;
use Illuminate\Http\Request;

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

    public function showKlub()
    {
        $data = Klub::select('*')->get()->toArray();
        return view('dashboard.admin.klub', compact('data'));
    }
    public function showEditKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editKlub', compact('data'));
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
    public function showPemain()
    {
        $data = Pemain::select('*')->get()->toArray();
        return view('dashboard.admin.pemain', compact('data'));
    }
    public function showEditPemain($id)
    {
        $data = Pemain::where('id', $id)->get()->toArray();
        $dataKlub = Klub::get()->toArray();
        return view('dashboard.admin.editPemain', compact('data', 'dataKlub'));
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
        
        $data = Pemain::find($id);
        if(!$data)
        {
            return back()->with('failed', 'Image klub belum tidak ditemukan');
        }
    
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

        return back()->with('success', 'Data succesfully update!');
    }
}
