<?php

namespace App\Http\Controllers;

use App\Models\Klub;
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
}
