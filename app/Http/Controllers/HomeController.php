<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\BeritaDanAktivitas;
use App\Models\Klub;
use App\Models\StrukturKlub;
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
