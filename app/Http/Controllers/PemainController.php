<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use Illuminate\Http\Request;

class PemainController extends Controller
{
    //
    public function index($namaKlub)
    {
        //$namaKlub = $request->input('namaKlub');
        $data = Pemain::where('nama_klub', $namaKlub)->get()->toArray();
        if(!$data)
        {
            return back()->with('failed', 'klub ini masih tidak memiliki pemain');
        }
        return view('dashboard.public.pemain', compact('data'));
    }

    public function profile()
    {
        return view('dashboard.pemain.profile');
    }
    public function show($id)
    {
        $data = Pemain::where('id', $id)->get()->toArray();
        return view('dashboard.public.detailpemain', compact('data','id'));
    }
}
