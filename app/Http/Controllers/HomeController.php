<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Models\BeritaDanAktivitas;
use App\Models\HasilSubKriteria;
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

    public function showPoinPemain()
    {
        $dataHasil = HasilSubKriteria::select('pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'pemain')
                    ->groupBy('pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'musim')->get()->toArray();

        $dataHasilKiper = HasilSubKriteria::select('pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'kiper')
                    ->groupBy('pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'musim')->get()->toArray();
        
        if(empty($dataHasil) && empty($dataHasilKiper))
        {
            return redirect('/home');
        }
        
        //PEMAINNN ---------------------------------------------------------
        //DataGoal
        $dataGoal = HasilSubKriteria::jumlahGoal()->toArray();

        //Data Assist
        $dataAssist = HasilSubKriteria::jumlahAssist()->toArray();

        //Data Kartu Kuning
        $dataPelanggaranKuning = HasilSubKriteria::jumlahPelanggaranKuning()->toArray();
        $dataProvokasiKuning = HasilSubKriteria::jumlahProvokasiKuning()->toArray();
        $dataMemukulKuning = HasilSubKriteria::jumlahMemukulKuning()->toArray();
        $dataSelebrasiKuning = HasilSubKriteria::jumlahSelebrasiKuning()->toArray();
            

        //Data Kartu Merah
        $dataPelanggaranMerah = HasilSubKriteria::jumlahPelanggaranMerah()->toArray();
        $dataProvokasiMerah = HasilSubKriteria::jumlahProvokasiMerah()->toArray();
        $dataMemukulMerah = HasilSubKriteria::jumlahMemukulMerah()->toArray();
        $dataSelebrasiMerah = HasilSubKriteria::jumlahSelebrasiMerah()->toArray();

        //Data Attitude
        $dataWaktuPemain = HasilSubKriteria::jumlahWaktuPemain();
        $dataRespectPemain = HasilSubKriteria::jumlahRespectPemain();
        $dataMentalPemain = HasilSubKriteria::jumlahMentalPemain();


        $hasilGoal = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            array_push($hasilGoal, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$dataGoal[$i]['jumlah_goal'], 3, '.', '')]);
        }
        

        $hasilAssist = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            array_push($hasilAssist, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$dataAssist[$i]['jumlah_assist'], 3, '.', '')]);
        }

        $hasilKuning = [];
        $jumlahKuning = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahKuning = $dataPelanggaranKuning[$i]['jumlah_pelanggaran_kuning'] + $dataProvokasiKuning[$i]['jumlah_provokasi_kuning'] + $dataMemukulKuning[$i]['jumlah_memukul_kuning'] + $dataSelebrasiKuning[$i]['jumlah_selebrasi_kuning'];
            $pv = 0.049;
            $hasilKalipv = $jumlahKuning * $pv;
            array_push($hasilKuning, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerah = [];
        $jumlahMerah = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahMerah = $dataPelanggaranMerah[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerah[$i]['jumlah_provokasi_merah'] + $dataMemukulMerah[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerah[$i]['jumlah_selebrasi_merah'];
            $pv = 0.076;
            $hasilKalipv = $jumlahMerah * $pv;
            array_push($hasilMerah, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitude = [];
        $jumlahAttitude = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahAttitude = $dataWaktuPemain[$i]['jumlah_waktu_pemain'] + $dataRespectPemain[$i]['jumlah_respect_pemain'] + $dataMentalPemain[$i]['jumlah_mental_pemain'];
            $pv = 0.119;
            $hasilKalipv = $jumlahAttitude * $pv;
            array_push($hasilAttitude, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        

        $hasilFinal = [];
        $jumlahFinal = [];
        $hasilFinish = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahFinal = $hasilGoal[$i]['jumlah'] + $hasilAssist[$i]['jumlah'] - $hasilKuning[$i]['jumlah'] - $hasilMerah[$i]['jumlah'] + $hasilAttitude[$i]['jumlah'];
            array_push($hasilFinal, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$jumlahFinal, 3, '.', '')]);
            $hasilFinish = collect($hasilFinal)->sortByDesc('jumlah');
        }

        //KIPERR ---------------------------------------------------------
        //DataKebobolan
        $dataKebobolan = HasilSubKriteria::jumlahKebobolan()->toArray();

        //Data Penyelamatan
        $dataPenyelamatan = HasilSubKriteria::jumlahPenyelamatan()->toArray();

        //Data Kartu Kuning
        $dataPelanggaranKuningKiper = HasilSubKriteria::jumlahPelanggaranKuningKiper()->toArray();
        $dataProvokasiKuningKiper = HasilSubKriteria::jumlahProvokasiKuningKiper()->toArray();
        $dataMemukulKuningKiper = HasilSubKriteria::jumlahMemukulKuningKiper()->toArray();
        $dataSelebrasiKuningKiper = HasilSubKriteria::jumlahSelebrasiKuningKiper()->toArray();
            

        //Data Kartu Merah
        $dataPelanggaranMerahKiper = HasilSubKriteria::jumlahPelanggaranMerahKiper()->toArray();
        $dataProvokasiMerahKiper = HasilSubKriteria::jumlahProvokasiMerahKiper()->toArray();
        $dataMemukulMerahKiper = HasilSubKriteria::jumlahMemukulMerahKiper()->toArray();
        $dataSelebrasiMerahKiper = HasilSubKriteria::jumlahSelebrasiMerahKiper()->toArray();

        //Data Attitude
        $dataWaktuPemainKiper = HasilSubKriteria::jumlahWaktuPemainKiper();
        $dataRespectPemainKiper = HasilSubKriteria::jumlahRespectPemainKiper();
        $dataMentalPemainKiper = HasilSubKriteria::jumlahMentalPemainKiper();

        $hasilKebobolan = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            array_push($hasilKebobolan, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$dataKebobolan[$i]['jumlah_kebobolan'], 3, '.', '')]);
        }
        

        $hasilPenyelamatan = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            array_push($hasilPenyelamatan, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$dataPenyelamatan[$i]['jumlah_penyelamatan'], 3, '.', '')]);
        }

        $hasilKuningKiper = [];
        $jumlahKuningKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahKuningKiper = $dataPelanggaranKuningKiper[$i]['jumlah_pelanggaran_kuning'] + $dataProvokasiKuningKiper[$i]['jumlah_provokasi_kuning'] + $dataMemukulKuningKiper[$i]['jumlah_memukul_kuning'] + $dataSelebrasiKuningKiper[$i]['jumlah_selebrasi_kuning'];
            $pv = 0.049;
            $hasilKalipv = $jumlahKuningKiper * $pv;
            array_push($hasilKuningKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerahKiper = [];
        $jumlahMerahKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahMerahKiper = $dataPelanggaranMerahKiper[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerahKiper[$i]['jumlah_provokasi_merah'] + $dataMemukulMerahKiper[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerahKiper[$i]['jumlah_selebrasi_merah'];
            $pv = 0.076;
            $hasilKalipv = $jumlahMerahKiper * $pv;
            array_push($hasilMerahKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitudeKiper = [];
        $jumlahAttitudeKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahAttitudeKiper = $dataWaktuPemainKiper[$i]['jumlah_waktu_pemain'] + $dataRespectPemainKiper[$i]['jumlah_respect_pemain'] + $dataMentalPemainKiper[$i]['jumlah_mental_pemain'];
            $pv = 0.119;
            $hasilKalipv = $jumlahAttitudeKiper * $pv;
            array_push($hasilAttitudeKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        

        $hasilFinalKiper = [];
        $jumlahFinalKiper = [];
        $hasilFinishKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahFinalKiper =  $hasilPenyelamatan[$i]['jumlah'] - $hasilKebobolan[$i]['jumlah'] - $hasilKuningKiper[$i]['jumlah'] - $hasilMerahKiper[$i]['jumlah'] + $hasilAttitudeKiper[$i]['jumlah'];
            array_push($hasilFinalKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$jumlahFinalKiper, 3, '.', '')]);
            $hasilFinishKiper = collect($hasilFinalKiper)->sortByDesc('jumlah');
        }
        

        return view('dashboard.public.pemain-terbaik', compact('hasilFinish', 'hasilFinishKiper'));
    }
}
