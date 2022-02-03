<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\StrukturKlub;
use Illuminate\Http\Request;

class KlubController extends Controller
{
    //
    public function index()
    {
        $data = Klub::select('*')->get()->toArray();
        return view('dashboard.public.klub', compact('data'));
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
        }

        if(empty($sekretaris1))
        {
            $sekretaris1[0]['nama_sk'] = '-';
        }

        if(empty($sekretaris2))
        {
            $sekretaris2[0]['nama_sk'] = '-';
        }

        if(empty($bendahara1))
        {
            $bendahara1[0]['nama_sk'] = '-';
        }
        
        if(empty($bendahara2))
        {
            $bendahara2[0]['nama_sk'] = '-';
        }
        
        return view('dashboard.public.strukturKlub', compact('ketua', 'sekretaris1', 'sekretaris2', 'bendahara1', 'bendahara2', 'id'));
    }
}
