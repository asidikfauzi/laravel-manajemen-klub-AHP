<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\BeritaDanAktivitas;
use App\Models\Klub;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataBerita = BeritaDanAktivitas::select('*')->orderBy('created_at', 'desc')->get()->toArray();
        $klub = Klub::select('*')->orderBy('created_at', 'desc')->take(5)->get()->toArray();
        
        $dataKlub = [];
        foreach($klub as $data)
        {
            array_push($dataKlub, ['id'=>$data['id'],'nama_klub'=> $data['nama_klub'], "img" => Storage::getLinkImageKlub($data['img'])]);
        }

        return view('dashboard.public.home', compact('dataBerita', 'dataKlub'));
    }
}
