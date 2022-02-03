<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use Illuminate\Http\Request;

class PemainController extends Controller
{
    //
    public function index()
    {
        $data = Pemain::select('*')->get()->toArray();
        return view('dashboard.pemain.index', compact('data'));
    }

    public function profile()
    {
        return view('dashboard.pemain.profile');
    }

    public function indexPublic($namaKlub)
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
