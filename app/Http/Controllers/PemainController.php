<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemainController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.pemain.index');
    }

    public function profile()
    {
        return view('dashboard.pemain.profile');
    }

    public function pemain($namaKlub)
    {
        //$namaKlub = $request->input('namaKlub');
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
}
