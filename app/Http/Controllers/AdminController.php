<?php

namespace App\Http\Controllers;

use App\Helper\Storage;
use App\Helper\Uuid;
use App\Models\BeritaDanAktivitas;
use App\Models\HasilSubKriteria;
use App\Models\Klub;
use App\Models\Kontrak;
use App\Models\Kriteria;
use App\Models\Pemain;
use App\Models\Pesan;
use App\Models\StrukturKlub;
use App\Models\SubKriteria;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function showAdmin()
    {
        $data = User::select('*')->where('role_id', 'admin')->get()->toArray();
        if(empty($data))
        {
            return redirect('/admin/registerAdmin');
        }
        return view('dashboard.admin.admin', compact('data'));
    }

    public function showBerita()
    {
        $data = BeritaDanAktivitas::orderBy('created_at', 'desc')->get()->toArray();
        if(empty($data))
        {
            return redirect('/admin/tambahBerita');
        }
        return view('dashboard.admin.beritadanaktivitas', compact('data'));
    }

    public function showEditBerita($id)
    {
        $data = BeritaDanAktivitas::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editBerita', compact('data'));
    }

    public function showKlub()
    {
        $data = Klub::join('users', 'username', '=', 'users_username')->where('klub.status', 'aktif')->get()->toArray();
        if(empty($data))
        {
            return redirect('/admin/registerKlub');
        }
        return view('dashboard.admin.klub', compact('data'));
    }

    public function showEditKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.editKlub', compact('data'));
    }

    public function showPemain()
    {
        $data = Pemain::select('*')->orderBy('created_at', 'DESC')->get()->toArray();
        if(empty($data))
        {
            return redirect('/admin/registerPemain');
        }
        return view('dashboard.admin.pemain', compact('data'));
    }

    public function showMessage()
    {
        $users = User::get()->toArray();
        $message = Pesan::where('kepada_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'dari_username'=>$item['dari_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
        return view('dashboard.admin.message', compact('data', 'users'));
    }

    public function showOpenMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.admin.openmessage', compact('data'));
    }

    public function showOpenSentMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.admin.opensentmessage', compact('data'));
    }

    public function showSentMessage()
    {
        $message = Pesan::where('dari_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'kepada_username'=>$item['kepada_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
       
        return view('dashboard.admin.sentMessage', compact('data'));
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


    public function showKontrak()
    {
        $kontrak = Kontrak::join('pemain', 'pemain.id', '=', 'kontrak.pemain_id')
                        ->join('klub', 'klub.id', '=', 'kontrak.klub_id')
                        ->where('kontrak.status', 'aktif')
                        ->get()->toArray();
        if(empty($kontrak))
        {
            return redirect('/admin/registerPemain');
        }
        
        $data = [];
       
        foreach($kontrak as $item)
        {
            array_push($data, ['id'=>$item['pemain_id'],'nama_pemain'=>$item['nama_pemain'], 'nama_klub'=>$item['nama_klub'], 'foto_kontrak'=>$item['foto_kontrak'], 'awal_kontrak'=>$item['awal_kontrak'], 'akhir_kontrak'=>$item['akhir_kontrak']]);
        }
        
        return view('dashboard.admin.kontrak', compact('data'));
    }

    public function showStruktur($id)
    {
        $data = StrukturKlub::where('klub_id', $id)->get()->toArray();
        if(empty($data))
        {
            return redirect('/admin/struktur/klub/add/'.$id);
        }
        return view('dashboard.admin.strukturKlub', compact('data'));
    }

    public function showEditPemain($id)
    {
        $data = Pemain::join('kontrak', 'pemain.id', 'pemain_id')->where('kontrak.status', 'aktif')->where('pemain.id', $id)->get()->toArray();
        if(empty($data))
        {
            $data = Pemain::where('id', $id)->get()->toArray();
            $data[0]['gaji'] = '-';
            $data[0]['awal_kontrak'] = '-';
            $data[0]['akhir_kontrak'] = '-';
            $data[0]['foto_kontrak'] = '-';
        }   
        $nonaktif = Kontrak::select('klub.nama_klub', 'kontrak.gaji', 'kontrak.awal_kontrak', 'kontrak.akhir_kontrak', 'kontrak.foto_kontrak', 'kontrak.status')
                            ->where('kontrak.pemain_id', $id)
                            ->join('klub', 'kontrak.klub_id', '=', 'klub.id')
                            ->get()->toArray();
        
        if(empty($nonaktif))
        {
            $nonaktif[0]['nama_klub'];
            $nonaktif[0]['gaji'] = '-';
            $nonaktif[0]['awal_kontrak'] = '-';
            $nonaktif[0]['akhir_kontrak'] = '-';
            $nonaktif[0]['foto_kontrak'] = '-';
            $nonaktif[0]['status'];
        } 
        $dataKlub = Klub::get()->toArray();
        return view('dashboard.admin.editPemain', compact('data', 'dataKlub', 'nonaktif'));
    }

    public function showPoinPemain()
    {
        $dataHasil = HasilSubKriteria::select('hasil_sub_kriteria.pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'hasil_sub_kriteria.musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'pemain')
                    ->where('pemain.status', 'aktif')
                    ->groupBy('hasil_sub_kriteria.pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'hasil_sub_kriteria.musim')->get()->toArray();

        $dataHasilKiper = HasilSubKriteria::select('pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'kiper')
                    ->groupBy('pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'musim')->get()->toArray();
        
        if(empty($dataHasil) && empty($dataHasilKiper))
        {
            return redirect('/admin/tambahpoin');
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
            array_push($hasilGoal, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> $dataGoal[$i]['jumlah_goal']]);
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
            $bobot = Kriteria::where('id', 3)->get()->toArray();
            $pv = $bobot[0]['bobot'];
            $hasilKalipv = $jumlahKuning * $pv;
            array_push($hasilKuning, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerah = [];
        $jumlahMerah = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahMerah = $dataPelanggaranMerah[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerah[$i]['jumlah_provokasi_merah'] + $dataMemukulMerah[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerah[$i]['jumlah_selebrasi_merah'];
            $bobot = Kriteria::where('id', 4)->get()->toArray();
            $pv = $bobot[0]['bobot'];
            $hasilKalipv = $jumlahMerah * $pv;
            array_push($hasilMerah, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitude = [];
        $jumlahAttitude = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahAttitude = $dataWaktuPemain[$i]['jumlah_waktu_pemain'] + $dataRespectPemain[$i]['jumlah_respect_pemain'] + $dataMentalPemain[$i]['jumlah_mental_pemain'];
            $bobot = Kriteria::where('id', 3)->get()->toArray();
            $pv = $bobot[0]['bobot'];
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
            $bobot = Kriteria::where('id', 8)->get()->toArray();
            $pv = $bobot[0]['bobot'];
            $hasilKalipv = $jumlahKuningKiper * $pv;
            array_push($hasilKuningKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerahKiper = [];
        $jumlahMerahKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahMerahKiper = $dataPelanggaranMerahKiper[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerahKiper[$i]['jumlah_provokasi_merah'] + $dataMemukulMerahKiper[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerahKiper[$i]['jumlah_selebrasi_merah'];
            $bobot = Kriteria::where('id', 9)->get()->toArray();
            $pv = $bobot[0]['bobot'];
            $hasilKalipv = $jumlahMerahKiper * $pv;
            array_push($hasilMerahKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitudeKiper = [];
        $jumlahAttitudeKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahAttitudeKiper = $dataWaktuPemainKiper[$i]['jumlah_waktu_pemain'] + $dataRespectPemainKiper[$i]['jumlah_respect_pemain'] + $dataMentalPemainKiper[$i]['jumlah_mental_pemain'];
            $bobot = Kriteria::where('id', 10)->get()->toArray();
            $pv = $bobot[0]['bobot'];
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
        

        return view('dashboard.admin.poinpemain', compact('hasilFinish', 'hasilFinishKiper'));
    }

    public function showTambahPoin()
    {
        $dataPemain = Pemain::select('pemain.id', 'pemain.nama_pemain', 'users.username', 'pemain.posisi')
                            ->join('users', 'users.username', '=', 'pemain.users_username')
                            ->where('pemain.posisi', 'pemain')
                            ->get()->toArray();
        
        $dataSubKriteria = SubKriteria::select('sub_kriteria.id', 'sub_kriteria.nama_sub_kriteria', 'kriteria.nama_kriteria', 
                                                'sub_kriteria.bobot', 'sub_kriteria.kriteria_id', 'sub_kriteria.min_max')
                            ->join('kriteria', 'kriteria.id', '=', 'sub_kriteria.kriteria_id')
                            ->where('kriteria.jenis', 'pemain') 
                            ->orderBy('sub_kriteria.id', 'asc')
                            ->get()->toArray();
        $kartuKuning = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 4)
                            ->get()->toArray();
        $kartuMerah = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 3)
                            ->get()->toArray();
        $attitude = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 5)
                            ->get()->toArray();

        return view('dashboard.admin.tambahpoin', compact('dataPemain', 'dataSubKriteria', 'kartuKuning', 'kartuMerah', 'attitude'));
    }

    public function showTambahPoinKiper()
    {
        $dataPemain = Pemain::select('pemain.id', 'pemain.nama_pemain', 'users.username', 'pemain.posisi')
                            ->join('users', 'users.username', '=', 'pemain.users_username')
                            ->where('pemain.posisi', 'kiper')
                            ->get()->toArray();
        
        $dataSubKriteria = SubKriteria::select('sub_kriteria.id', 'sub_kriteria.nama_sub_kriteria', 'kriteria.nama_kriteria', 
                                                'sub_kriteria.bobot', 'sub_kriteria.kriteria_id', 'sub_kriteria.min_max')
                            ->join('kriteria', 'kriteria.id', '=', 'sub_kriteria.kriteria_id')
                            ->where('kriteria.jenis', 'pemain') 
                            ->orderBy('sub_kriteria.id', 'asc')
                            ->get()->toArray();
        $kartuKuning = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 4)
                            ->get()->toArray();
        $kartuMerah = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 3)
                            ->get()->toArray();
        $attitude = SubKriteria::select('id','nama_sub_kriteria')
                            ->where('kriteria_id', 5)
                            ->get()->toArray();

        return view('dashboard.admin.tambah-poin-kiper', compact('dataPemain', 'dataSubKriteria', 'kartuKuning', 'kartuMerah', 'attitude'));
    }

    public function tambahPoinPemain(Request $request)
    {
        $pemain_id = $request->input('pemain');
        $goal = $request->input('goal');
        $assist = $request->input('assist');
        $pelanggaran = $request->input('pelanggaran');
        $provokasi = $request->input('provokasi');
        $memukul = $request->input('memukul');
        $selebrasi = $request->input('selebrasi');
        $pelanggaranM = $request->input('pelanggaran_merah');
        $provokasiM = $request->input('provokasi_merah');
        $memukulM = $request->input('memukul_merah');
        $selebrasiM = $request->input('selebrasi_merah');
        $waktu = $request->input('waktu');
        $respect = $request->input('respect');
        $mental = $request->input('mental');
        $musim = $request->input('musim');

        if(empty($pemain_id))
        {
            return back()->with('failed', 'Pemain Harus Diisi!');
        }
        if(empty($musim))
        {
            return back()->with('failed', 'Musim Harus Diisi!');
        }

        $jumlahPelanggaran = 1;
        $jumlahProvokasi = 1;
        $jumlahMemukul = 1;
        $jumlahSelebrasi = 1;

        $jumlahPelanggaranMerah = 1;
        $jumlahProvokasiMerah = 1;
        $jumlahMemukulMerah = 1;
        $jumlahSelebrasiMerah = 1;

        $jumlahWaktu =1;
        $jumlahRespect =1;
        $jumlahMental = 1;

        if(empty($goal))
        {
            $goal = 0;
        }
        if(empty($assist))
        {
            $assist = 0;
        }

        if(!isset($pelanggaran))
        {
            $jumlahPelanggaran = 0;
        }
        if(!isset($provokasi))
        {
            $jumlahProvokasi = 0;
        }
        if(!isset($memukul))
        {
            $jumlahMemukul = 0;
        }
        if(!isset($selebrasi))
        {
            $jumlahSelebrasi = 0;
        }
        if(!isset($pelanggaranM))
        {
            $jumlahPelanggaranMerah = 0;
        }
        if(!isset($provokasiM))
        {
            $jumlahProvokasiMerah = 0;
        }
        if(!isset($memukulM))
        {
            $jumlahMemukulMerah = 0;
        }
        if(!isset($selebrasiM))
        {
            $jumlahSelebrasiMerah = 0;
        }
        if(!isset($waktu))
        {
            $jumlahWaktu = 0;
        }
        if(!isset($respect))
        {
            $jumlahRespect = 0;
        }
        if(!isset($mental))
        {
            $jumlahMental = 0;
        }
        DB::transaction(function() use ($pemain_id, $goal, $assist, $pelanggaran, $provokasi, 
                                            $memukul, $selebrasi, $pelanggaranM, $provokasiM,
                                            $memukulM, $selebrasiM ,$waktu, $respect, $mental, 
                                            $musim, $jumlahPelanggaran, $jumlahProvokasi, $jumlahMemukul,
                                            $jumlahSelebrasi, $jumlahPelanggaranMerah, $jumlahProvokasiMerah,
                                            $jumlahMemukulMerah, $jumlahSelebrasiMerah, $jumlahWaktu,
                                            $jumlahRespect, $jumlahMental)
        {
            try
            {
                
                $data = new HasilSubKriteria();
                $data->pemain_id = $pemain_id;
                $data->sub_kriteria_id = 23;
                $data->musim = $musim;
                $data->jumlah = $goal;
                $data->save();
            
                $data1 = new HasilSubKriteria();
                $data1->pemain_id = $pemain_id;
                $data1->sub_kriteria_id = 24;
                $data1->musim = $musim;
                $data1->jumlah = $assist;
                $data1->save();
                
                $data2 = new HasilSubKriteria();
                $data2->pemain_id = $pemain_id;
                $data2->sub_kriteria_id = 1;
                $data2->musim = $musim;
                $data2->jumlah = $jumlahPelanggaran;
                $data2->save();
                
                $data3 = new HasilSubKriteria();
                $data3->pemain_id = $pemain_id;
                $data3->sub_kriteria_id = 2;
                $data3->musim = $musim;
                $data3->jumlah = $jumlahProvokasi;
                $data3->save();
                
                $data4 = new HasilSubKriteria();
                $data4->pemain_id = $pemain_id;
                $data4->sub_kriteria_id = 3;
                $data4->musim = $musim;
                $data4->jumlah = $jumlahMemukul;
                $data4->save();
                
                $data5 = new HasilSubKriteria();
                $data5->pemain_id = $pemain_id;
                $data5->sub_kriteria_id = 4;
                $data5->musim = $musim;
                $data5->jumlah = $jumlahSelebrasi;
                $data5->save();
            
                $data6 = new HasilSubKriteria();
                $data6->pemain_id = $pemain_id;
                $data6->sub_kriteria_id = 5;
                $data6->musim = $musim;
                $data6->jumlah = $jumlahPelanggaranMerah;
                $data6->save();
                
                $data7 = new HasilSubKriteria();
                $data7->pemain_id = $pemain_id;
                $data7->sub_kriteria_id = 6;
                $data7->musim = $musim;
                $data7->jumlah = $jumlahProvokasiMerah;
                $data7->save();
                
                $data8 = new HasilSubKriteria();
                $data8->pemain_id = $pemain_id;
                $data8->sub_kriteria_id = 7;
                $data8->musim = $musim;
                $data8->jumlah = $jumlahMemukulMerah;
                $data8->save();
            
                $data9 = new HasilSubKriteria();
                $data9->pemain_id = $pemain_id;
                $data9->sub_kriteria_id = 8;
                $data9->musim = $musim;
                $data9->jumlah = $jumlahSelebrasiMerah;
                $data9->save();
            
                $data10 = new HasilSubKriteria();
                $data10->pemain_id = $pemain_id;
                $data10->sub_kriteria_id = 17;
                $data10->musim = $musim;
                $data10->jumlah = $jumlahWaktu;
                $data10->save();
                
                $data11 = new HasilSubKriteria();
                $data11->pemain_id = $pemain_id;
                $data11->sub_kriteria_id = 18;
                $data11->musim = $musim;
                $data11->jumlah = $jumlahRespect;
                $data11->save();
                
                $data12 = new HasilSubKriteria();
                $data12->pemain_id = $pemain_id;
                $data12->sub_kriteria_id = 19;
                $data12->musim = $musim;
                $data12->jumlah = $jumlahMental;
                $data12->save();
            
            }
            catch (Exception $e)
            {
                return back()->with('failed', 'Data not succesfully added!');
            }
            
        });
        
        return back()->with('success', 'Data succesfully added!');
    }

    public function tambahPoinKiper(Request $request)
    {
        $pemain_id = $request->input('pemain');
        $kebobolan = $request->input('kebobolan');
        $penyelamatan = $request->input('penyelamatan');
        $pelanggaran = $request->input('pelanggaran');
        $provokasi = $request->input('provokasi');
        $memukul = $request->input('memukul');
        $selebrasi = $request->input('selebrasi');
        $pelanggaranM = $request->input('pelanggaran_merah');
        $provokasiM = $request->input('provokasi_merah');
        $memukulM = $request->input('memukul_merah');
        $selebrasiM = $request->input('selebrasi_merah');
        $waktu = $request->input('waktu');
        $respect = $request->input('respect');
        $mental = $request->input('mental');
        $musim = $request->input('musim');

        if(empty($pemain_id))
        {
            return back()->with('failed', 'Pemain Harus Diisi!');
        }
        if(empty($musim))
        {
            return back()->with('failed', 'Musim Harus Diisi!');
        }

        $jumlahPelanggaran = 1;
        $jumlahProvokasi = 1;
        $jumlahMemukul = 1;
        $jumlahSelebrasi = 1;

        $jumlahPelanggaranMerah = 1;
        $jumlahProvokasiMerah = 1;
        $jumlahMemukulMerah = 1;
        $jumlahSelebrasiMerah = 1;

        $jumlahWaktu =1;
        $jumlahRespect =1;
        $jumlahMental = 1;

        if(empty($kebobolan))
        {
            $kebobolan = 0;
        }
        if(empty($penyelamatan))
        {
            $penyelamatan = 0;
        }

        if(!isset($pelanggaran))
        {
            $jumlahPelanggaran = 0;
        }
        if(!isset($provokasi))
        {
            $jumlahProvokasi = 0;
        }
        if(!isset($memukul))
        {
            $jumlahMemukul = 0;
        }
        if(!isset($selebrasi))
        {
            $jumlahSelebrasi = 0;
        }
        if(!isset($pelanggaranM))
        {
            $jumlahPelanggaranMerah = 0;
        }
        if(!isset($provokasiM))
        {
            $jumlahProvokasiMerah = 0;
        }
        if(!isset($memukulM))
        {
            $jumlahMemukulMerah = 0;
        }
        if(!isset($selebrasiM))
        {
            $jumlahSelebrasiMerah = 0;
        }
        if(!isset($waktu))
        {
            $jumlahWaktu = 0;
        }
        if(!isset($respect))
        {
            $jumlahRespect = 0;
        }
        if(!isset($mental))
        {
            $jumlahMental = 0;
        }
        DB::transaction(function() use ($pemain_id, $kebobolan, $penyelamatan, $pelanggaran, $provokasi, 
                                            $memukul, $selebrasi, $pelanggaranM, $provokasiM,
                                            $memukulM, $selebrasiM ,$waktu, $respect, $mental, 
                                            $musim, $jumlahPelanggaran, $jumlahProvokasi, $jumlahMemukul,
                                            $jumlahSelebrasi, $jumlahPelanggaranMerah, $jumlahProvokasiMerah,
                                            $jumlahMemukulMerah, $jumlahSelebrasiMerah, $jumlahWaktu,
                                            $jumlahRespect, $jumlahMental)
        {
            try
            {
                
                $data = new HasilSubKriteria();
                $data->pemain_id = $pemain_id;
                $data->sub_kriteria_id = 25;
                $data->musim = $musim;
                $data->jumlah = $kebobolan;
                $data->save();
            
                $data1 = new HasilSubKriteria();
                $data1->pemain_id = $pemain_id;
                $data1->sub_kriteria_id = 26;
                $data1->musim = $musim;
                $data1->jumlah = $penyelamatan;
                $data1->save();
                
                $data2 = new HasilSubKriteria();
                $data2->pemain_id = $pemain_id;
                $data2->sub_kriteria_id = 9;
                $data2->musim = $musim;
                $data2->jumlah = $jumlahPelanggaran;
                $data2->save();
                
                $data3 = new HasilSubKriteria();
                $data3->pemain_id = $pemain_id;
                $data3->sub_kriteria_id = 10;
                $data3->musim = $musim;
                $data3->jumlah = $jumlahProvokasi;
                $data3->save();
                
                $data4 = new HasilSubKriteria();
                $data4->pemain_id = $pemain_id;
                $data4->sub_kriteria_id = 11;
                $data4->musim = $musim;
                $data4->jumlah = $jumlahMemukul;
                $data4->save();
                
                $data5 = new HasilSubKriteria();
                $data5->pemain_id = $pemain_id;
                $data5->sub_kriteria_id = 12;
                $data5->musim = $musim;
                $data5->jumlah = $jumlahSelebrasi;
                $data5->save();
            
                $data6 = new HasilSubKriteria();
                $data6->pemain_id = $pemain_id;
                $data6->sub_kriteria_id = 13;
                $data6->musim = $musim;
                $data6->jumlah = $jumlahPelanggaranMerah;
                $data6->save();
                
                $data7 = new HasilSubKriteria();
                $data7->pemain_id = $pemain_id;
                $data7->sub_kriteria_id = 14;
                $data7->musim = $musim;
                $data7->jumlah = $jumlahProvokasiMerah;
                $data7->save();
                
                $data8 = new HasilSubKriteria();
                $data8->pemain_id = $pemain_id;
                $data8->sub_kriteria_id = 15;
                $data8->musim = $musim;
                $data8->jumlah = $jumlahMemukulMerah;
                $data8->save();
            
                $data9 = new HasilSubKriteria();
                $data9->pemain_id = $pemain_id;
                $data9->sub_kriteria_id = 16;
                $data9->musim = $musim;
                $data9->jumlah = $jumlahSelebrasiMerah;
                $data9->save();
            
                $data10 = new HasilSubKriteria();
                $data10->pemain_id = $pemain_id;
                $data10->sub_kriteria_id = 20;
                $data10->musim = $musim;
                $data10->jumlah = $jumlahWaktu;
                $data10->save();
                
                $data11 = new HasilSubKriteria();
                $data11->pemain_id = $pemain_id;
                $data11->sub_kriteria_id = 21;
                $data11->musim = $musim;
                $data11->jumlah = $jumlahRespect;
                $data11->save();
                
                $data12 = new HasilSubKriteria();
                $data12->pemain_id = $pemain_id;
                $data12->sub_kriteria_id = 22;
                $data12->musim = $musim;
                $data12->jumlah = $jumlahMental;
                $data12->save();
            
            }
            catch (Exception $e)
            {
                return back()->with('failed', 'Data not succesfully added!');
            }
            
        });
        
        return back()->with('success', 'Data succesfully added!');
    }

    public function showTambahBerita()
    {
        return view('dashboard.admin.tambahBerita');
    }
    public function showTambahStrukturKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.admin.tambahStrukturKlub', compact('data', 'id'));
    }

    public function showChangePassword()
    {
        return view('dashboard.admin.changePassword');
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
        $klub_id = $request->input('klub_id');
        $posisi = $request->input('posisi');   
        $image = $request->file('image');

        $gaji = $request->input('gaji');
        $awalKontrak = $request->input('awal_kontrak');
        $akhirKontrak = $request->input('akhir_kontrak');
        $fotoKontrak = $request->file('foto_kontrak');
        
        $data = Pemain::where('id',$id)->first();
        if(!$data)
        {
            return back()->with('failed', 'pemain tidak ditemukan');
        }

        $kontrakUpdate = Kontrak::where('pemain_id', $id)->where('status', 'aktif')->first();

        $dataKlub = Klub::where('nama_klub', $klub)->get()->toArray();

        DB::transaction(function() use ($klub_id, $kontrakUpdate, $dataKlub, $request, $data, $nama, $tempat, $tglLahir, $alamat, $notelp, $tinggi, $berat, $status, $klub, $posisi, $image, $id, $awalKontrak, $akhirKontrak, $gaji, $fotoKontrak){
            
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

            if($kontrakUpdate)
            {
                $kontrakUpdate->status = 'nonaktif';
                $kontrakUpdate->save();
            }
            
            if(!empty($gaji) && !empty($awalKontrak) && !empty($akhirKontrak) && !empty($fotoKontrak)){
                $kontrak = new Kontrak();
                $kontrak->awal_kontrak = $awalKontrak;
                $kontrak->akhir_kontrak = $akhirKontrak;
                $kontrak->pemain_id = $id;
                $kontrak->klub_id = $klub_id;
                $kontrak->gaji = $gaji;
                $kontrak->status = 'aktif';
                if($request->hasFile('foto_kontrak'))   
                {
                    $uploadImageKontrak = Storage::uploadImageKontrak($fotoKontrak);
                    $kontrak->foto_kontrak = $uploadImageKontrak;
                }
                
                $kontrak->save();
                
            }
            
            
        });

        return back()->with('success', 'Data succesfully update!');
    }

    public function editBerita(Request $request, $id)
    {
        $judul = $request->input('judul');
        $isiBerita = $request->input('isi_berita');
        $image = $request->file('image');
        
        $data = BeritaDanAktivitas::where('id', $id)->first();
        $data->judul_berita = $judul;
        $data->isi_berita = urlencode($isiBerita);
        $data->users_username = Auth::user()->username;
        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImageBerita($image);
            $data->img = $uploadImage;
        }
        $data->save();

        return back()->with('success', 'Data Changed Successfully');
    }

    public function tambahBerita(Request $request)
    {
        $uuid = Uuid::getId();
        $judul = $request->input('judul_berita');
        $isiBerita = $request->input('isi_berita');
        $image = $request->file('image');

        $uploadImage = Storage::uploadImageBerita($image);

        $berita = new BeritaDanAktivitas();
        $berita->id = $uuid;
        $berita->judul_berita = $judul;
        $berita->isi_berita = urlencode($isiBerita);
        $berita->img = $uploadImage;
        $berita->users_username = Auth::user()->username;
        $berita->save();

        return back()->with('success', 'Data succesfully saved');
    }

    public function tambahStrukturKlub(Request $request, $id)
    {
        $uuid = Uuid::getId();
        $nama = $request->input('nama');
        $notelp = $request->input('notelp');
        $jabatan = $request->input('jabatan');
        $image = $request->file('image');
        
        

        $dataStruktur = StrukturKlub::where('klub_id', $id)->where('jabatan', $jabatan)->get()->toArray();

        if($dataStruktur)
        {
            return back()->with('failed', 'Jabatan Untuk Klub ini sudah ada');
        }

        $uploadImage = Storage::uploadImageStruktur($image);

        $struktur = new StrukturKlub();
        $struktur->id = $uuid;
        $struktur->nama_sk = $nama;
        $struktur->notelp = $notelp;
        $struktur->jabatan = $jabatan;
        $struktur->img = $uploadImage;
        $struktur->klub_id = $id;
        $struktur->save();

        return back()->with('success', 'Data succesfully saved');
    }

    public function changePassword(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $reNewPassword = $request->input('reNewPassword');

        if(empty($oldPassword))
        {
            return back()->with('failed', 'Old Password Harus Di Isi');
        }
        if(empty($newPassword))
        {
            return back()->with('failed', 'New Password Harus Di Isi');
        }
        if(empty($reNewPassword))
        {
            return back()->with('failed', 'Confirm-Password Harus Di Isi');
        }

        if($newPassword !== $reNewPassword)
        {
            return back()->with('failed', 'Password tidak sama');
        }
        $data = User::where('username', Auth()->user()->username)->first();

        if(!Hash::check($oldPassword, $data->password ))
        {
            return back()->with('failed', 'Password lama salah');
        }
        if(empty($newPassword) && empty($reNewPassword))
        {
            return back()->with('failed', 'Password baru tidak boleh kosong');
        }
        else if(strlen($newPassword) < 8) 
        {
            return back()->with('failed', 'Password minimal 8 Karakter');
        }
        $hashPassword = Hash::make($newPassword);

        $data->password = $hashPassword;
        $data->save();
        return back()->with('success', 'Password changes succesfully ');

    }

    public function showEditStrukturKlub($id)
    {
        $data = StrukturKlub::where('id', $id)->get()->toArray();
        if(empty($data))
        {
            return back()->with('failed', 'Struktur data dari klub ini masih belum ada, silahkan tambahkan terlebih dahulu');
        }
        return view('dashboard.admin.editStrukturKlub', compact('data'));
    }

    public function resetPasswordAdmin($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::where('role_id', 'admin')->where('username', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
    }

    public function resetPasswordKlub($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::join('klub', 'username', '=', 'users_username')->where('klub.id', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
           
    }

    public function editStrukturKlub(Request $request, $id)
    {
        $namaSk = $request->input('nama_sk');
        $notelp = $request->input('notelp');
        $jabatan = $request->input('jabatan');
        $image = $request->file('image');

        $struktur = StrukturKlub::where('jabatan', $jabatan)->where('id', "!=", $id)->get()->toArray();

        if(!empty($struktur))
        {
            return back()->with('failed', 'Jabatan sudah ada');
        }
        $data = StrukturKlub::where('id', $id)->first();
        $data->nama_sk = $namaSk;
        $data->notelp = $notelp;
        $data->jabatan = $jabatan;
        if($request->hasFile('image'))   
        {
            $uploadImage = Storage::uploadImageStruktur($image);
            $data->img = $uploadImage;
        }
        $data->save();

        return back()->with('success', 'Data Changed Successfully');
    }

    public function resetPasswordPemain($id)
    {
        $password = '12345678';
        $hashPassword = Hash::make($password);

        $data = User::join('pemain', 'username', '=', 'users_username')->where('pemain.id', $id)->first();
        $data->password = $hashPassword;
        $data->save();

        return back()->with('success', 'Reset Password succesfully');
           
    }

    public function deleteKlub($id)
    {
        $klubb = Klub::where('id', $id)->get();
        $kontrak = Kontrak::join('klub', 'klub_id', '=', 'klub.id')->where('klub.id', $id);
        $pemain = Pemain::join('users', 'users_username', 'username')->where('id', $id);
        $klub = Klub::join('users', 'users_username', 'username')->where('id', $id);
        $pesan = Pesan::where('dari_username', $klubb[0]->users_username)->orWhere('kepada_username', $klubb[0]->users_username);
        $usersKlub = User::where('users.role_id', 'klub')->leftJoin('klub', function($join){
            $join->on('username', '=', 'klub.users_username');
        })->whereNull('klub.users_username');
        $usersKlub = User::where('users.role_id', 'pemain')->leftJoin('pemain', function($join){
            $join->on('username', '=', 'pemain.users_username');
        })->whereNull('pemain.users_username');
        
        DB::transaction(function() use ($id, $kontrak, $pemain, $klub, $pesan, $usersKlub){
            
            $kontrak->delete();
            $pesan->delete();
            $pemain->delete();
            $usersKlub->delete();
            $usersKlub->delete();
            $klub->delete();
            
        });

        return back()->with('success', 'Klub, Pemain, dan Kontrak yang terkait berhasil di delete');
    }
    public function deleteStruktur($id)
    {
        $struktur = StrukturKlub::where('id', $id)->delete();
        return back()->with('success', 'Data struktur berhasil di delete');
    }

    public function deleteBerita($id)
    {
        $berita = BeritaDanAktivitas::where('id', $id)->delete();
        return back()->with('success', 'Berita dan aktivitas berhasil di delete');
    }

    public function deletePemain($id)
    {
        
        DB::transaction(function() use ($id){
            $pemain = Pemain::where('id', $id)->first();
            $kontrak = Kontrak::where('pemain_id', $id)->where('status', 'aktif')->first();
            $pemain->status = 'nonaktif';
            $kontrak->status = 'nonaktif';
            $kontrak->save();
            $pemain->save();
        });

        return back()->with('failed', 'Pemain berhasil di delete');
    }

    public function deleteKontrak($id)
    {
        DB::transaction(function() use ($id){
            $pemain = Pemain::where('id', $id)->first();
            $kontrak = Kontrak::where('pemain_id', $id)->first();  
            $pemain->status = 'nonaktif';
            $kontrak->status = 'nonaktif';
            $pemain->save();         
            $kontrak->save();
        });

        return back()->with('success', 'Kontrak berhasil di delete');
    }


    public function showKriteriaSubKriteria()
    {
        $goal = Kriteria::where('id', 1)->get()->toArray();
        $assist = Kriteria::where('id', 2)->get()->toArray();
        $kuning = Kriteria::where('id', 3)->get()->toArray();
        $merah = Kriteria::where('id', 4)->get()->toArray();
        $attitude = Kriteria::where('id', 5)->get()->toArray();
        $kebobolan = Kriteria::where('id', 6)->get()->toArray();
        $penyelamatan = Kriteria::where('id', 7)->get()->toArray();
        $kuningKiper = Kriteria::where('id', 8)->get()->toArray();
        $merahKiper = Kriteria::where('id', 9)->get()->toArray();
        $attitudeKiper = Kriteria::where('id', 10)->get()->toArray();
        
        $pelanggaranKuning = SubKriteria::where('id', 1)->get()->toArray();
        $provokasiKuning = SubKriteria::where('id', 2)->get()->toArray();
        $memukulKuning = SubKriteria::where('id', 3)->get()->toArray();
        $selebrasiKuning = SubKriteria::where('id', 4)->get()->toArray();
        $pelanggaranMerah = SubKriteria::where('id', 5)->get()->toArray();
        $provokasiMerah = SubKriteria::where('id', 6)->get()->toArray();
        $memukulMerah = SubKriteria::where('id', 7)->get()->toArray();
        $selebrasiMerah = SubKriteria::where('id', 8)->get()->toArray();
        $waktu = SubKriteria::where('id', 17)->get()->toArray();
        $respect = SubKriteria::where('id', 18)->get()->toArray();
        $mental = SubKriteria::where('id', 19)->get()->toArray();
        $pelanggaranKuningKiper = SubKriteria::where('id', 9)->get()->toArray();
        $provokasiKuningKiper = SubKriteria::where('id', 10)->get()->toArray();
        $memukulKuningKiper = SubKriteria::where('id', 11)->get()->toArray();
        $selebrasiKuningKiper = SubKriteria::where('id', 12)->get()->toArray();
        $pelanggaranMerahKiper = SubKriteria::where('id', 13)->get()->toArray();
        $provokasiMerahKiper = SubKriteria::where('id', 14)->get()->toArray();
        $memukulMerahKiper = SubKriteria::where('id', 15)->get()->toArray();
        $selebrasiMerahKiper = SubKriteria::where('id', 16)->get()->toArray();
        $waktuKiper = SubKriteria::where('id', 20)->get()->toArray();
        $respectKiper = SubKriteria::where('id', 21)->get()->toArray();
        $mentalKiper = SubKriteria::where('id', 22)->get()->toArray();

        return view('dashboard.admin.kriteriasubkriteria', compact('goal','assist','kuning','merah','attitude','kebobolan','penyelamatan','kuningKiper',
        'merahKiper','attitudeKiper','pelanggaranKuning','provokasiKuning','memukulKuning','selebrasiKuning','pelanggaranMerah','provokasiMerah','memukulMerah','selebrasiMerah','waktu','respect','mental','pelanggaranKuningKiper','provokasiKuningKiper','memukulKuningKiper','selebrasiKuningKiper',
        'pelanggaranMerahKiper','provokasiMerahKiper','memukulMerahKiper','selebrasiMerahKiper','waktuKiper','respectKiper','mentalKiper'));
    }

    public function editKriteriaSubKriteria(Request $request)
    {

        $igoal = $request->input('goal');
        $iassist = $request->input('assist');
        $ikuning = $request->input('kuning');
        $ipelanggaranKuning = $request->input('pelanggaranKuning');
        $iprovokasiKuning = $request->input('provokasiKuning');
        $imemukulKuning = $request->input('memukulKuning');
        $iselebrasiKuning = $request->input('selebrasiKuning');
        $imerah = $request->input('merah');
        $ipelanggaranMerah = $request->input('pelanggaranMerah');
        $iprovokasiMerah = $request->input('provokasiMerah');
        $imemukulMerah = $request->input('memukulMerah');
        $iselebrasiMerah = $request->input('selebrasiMerah');
        $iattitude = $request->input('attitude');
        $iwaktu = $request->input('waktu');
        $irespect = $request->input('respect');
        $imental = $request->input('mental');
        $ikebobolan = $request->input('kebobolan');
        $ipenyelamatan = $request->input('penyelamatan');
        $ikuningKiper = $request->input('kuningKiper');
        $ipelanggaranKuningKiper = $request->input('pelanggaranKuningKiper');
        $iprovokasiKuningKiper = $request->input('provokasiKuningKiper');
        $imemukulKuningKiper = $request->input('memukulKuningKiper');
        $iselebrasiKuningKiper = $request->input('selebrasiKuningKiper');
        $imerahKiper = $request->input('merahKiper');
        $ipelanggaranMerahKiper = $request->input('pelanggaranMerahKiper');
        $iprovokasiMerahKiper = $request->input('provokasiMerahKiper');
        $imemukulMerahKiper = $request->input('memukulMerahKiper');
        $iselebrasiMerahKiper = $request->input('selebrasiMerahKiper');
        $iattitudeKiper = $request->input('attitudeKiper');
        $iwaktuKiper = $request->input('waktuKiper');
        $irespectKiper = $request->input('respectKiper');
        $imentalKiper = $request->input('mentalKiper');

        

        $result = DB::transaction(function() use($igoal, $iassist, $ikuning, $imerah, $ipelanggaranKuning, $iprovokasiKuning,
                                                    $imemukulKuning, $iselebrasiKuning, $ipelanggaranMerah, $iprovokasiMerah, 
                                                    $imemukulMerah, $iselebrasiMerah, $iattitude, $iwaktu, $irespect, $imental,
                                                    $ipelanggaranMerahKiper, $iprovokasiMerahKiper, $imemukulMerahKiper, $iselebrasiMerahKiper,
                                                    $ipelanggaranKuningKiper, $iprovokasiKuningKiper, $imemukulKuningKiper, $iselebrasiKuningKiper,
                                                    $iattitudeKiper, $iwaktuKiper, $irespectKiper, $imentalKiper, $ikebobolan, $ipenyelamatan, 
                                                    $ikuningKiper, $imerahKiper) {
            $goal = Kriteria::where('id', 1)->first();
            
            $goal->bobot = $igoal;
            $goal->save();
            $assist = Kriteria::where('id', 2)->first();
            $assist->bobot = $iassist;
            $assist->save();
            $kuning = Kriteria::where('id', 3)->first();
            $kuning->bobot = $ikuning;
            $kuning->save();
            $merah = Kriteria::where('id', 4)->first();
            $merah->bobot = $imerah;
            $merah->save();
            $attitude = Kriteria::where('id', 5)->first();
            $attitude->bobot = $iattitude;
            $attitude->save();
            $kebobolan = Kriteria::where('id', 6)->first();
            $kebobolan->bobot = $ikebobolan;
            $kebobolan->save();
            $penyelamatan = Kriteria::where('id', 7)->first();
            $penyelamatan->bobot = $ipenyelamatan;
            $penyelamatan->save();
            $kuningKiper = Kriteria::where('id', 8)->first();
            $kuningKiper->bobot = $ikuningKiper;
            $kuningKiper->save();
            $merahKiper = Kriteria::where('id', 9)->first();
            $merahKiper->bobot = $imerahKiper;
            $merahKiper->save();
            $attitudeKiper = Kriteria::where('id', 10)->first();
            $attitudeKiper->bobot = $iattitudeKiper;
            $attitudeKiper->save();
            
            $pelanggaranKuning = SubKriteria::where('id', 1)->first();
            $pelanggaranKuning->bobot = $ipelanggaranKuning;
            $pelanggaranKuning->save();
            $provokasiKuning = SubKriteria::where('id', 2)->first();
            $provokasiKuning->bobot = $iprovokasiKuning;
            $provokasiKuning->save();
            $memukulKuning = SubKriteria::where('id', 3)->first();
            $memukulKuning->bobot = $imemukulKuning;
            $memukulKuning->save();
            $selebrasiKuning = SubKriteria::where('id', 4)->first();
            $selebrasiKuning->bobot = $iselebrasiKuning;
            $selebrasiKuning->save();
            $pelanggaranMerah = SubKriteria::where('id', 5)->first();
            $pelanggaranMerah->bobot = $ipelanggaranMerah;
            $pelanggaranMerah->save();
            $provokasiMerah = SubKriteria::where('id', 6)->first();
            $provokasiMerah->bobot = $iprovokasiMerah;
            $provokasiMerah->save();
            $memukulMerah = SubKriteria::where('id', 7)->first();
            $memukulMerah->bobot = $imemukulMerah;
            $memukulMerah->save();
            $selebrasiMerah = SubKriteria::where('id', 8)->first();
            $selebrasiMerah->bobot = $iselebrasiMerah;
            $selebrasiMerah->save();
            $waktu = SubKriteria::where('id', 17)->first();
            $waktu->bobot = $iwaktu;
            $waktu->save();
            $respect = SubKriteria::where('id', 18)->first();
            $respect->bobot = $irespect;
            $respect->save();
            $mental = SubKriteria::where('id', 19)->first();
            $mental->bobot = $imental;
            $mental->save();
            $pelanggaranKuningKiper = SubKriteria::where('id', 9)->first();
            $pelanggaranKuningKiper->bobot = $ipelanggaranKuningKiper;
            $pelanggaranKuningKiper->save();
            $provokasiKuningKiper = SubKriteria::where('id', 10)->first();
            $provokasiKuningKiper->bobot = $iprovokasiKuningKiper;
            $provokasiKuningKiper->save();
            $memukulKuningKiper = SubKriteria::where('id', 11)->first();
            $memukulKuningKiper->bobot = $imemukulKuningKiper;
            $memukulKuningKiper->save();
            $selebrasiKuningKiper = SubKriteria::where('id', 12)->first();
            $selebrasiKuningKiper->bobot = $iselebrasiKuningKiper;
            $selebrasiKuningKiper->save();
            $pelanggaranMerahKiper = SubKriteria::where('id', 13)->first();
            $pelanggaranMerahKiper->bobot = $ipelanggaranMerahKiper;
            $pelanggaranMerahKiper->save();
            $provokasiMerahKiper = SubKriteria::where('id', 14)->first();
            $provokasiMerahKiper->bobot = $iprovokasiMerahKiper;
            $provokasiMerahKiper->save();
            $memukulMerahKiper = SubKriteria::where('id', 15)->first();
            $memukulMerahKiper->bobot = $imemukulMerahKiper;
            $memukulMerahKiper->save();
            $selebrasiMerahKiper = SubKriteria::where('id', 16)->first();
            $selebrasiMerahKiper->bobot = $iselebrasiMerahKiper;
            $selebrasiMerahKiper->save();
            $waktuKiper = SubKriteria::where('id', 20)->first();
            $waktuKiper->bobot = $iwaktuKiper;
            $waktuKiper->save();
            $respectKiper = SubKriteria::where('id', 21)->first();
            $respectKiper->bobot = $irespectKiper;
            $respectKiper->save();
            $mentalKiper = SubKriteria::where('id', 22)->first();
            $mentalKiper->bobot = $imentalKiper;
            $mentalKiper->save();

            return "ok";
        });

        if($result)
        {
            return back()->with('success', 'Nilai bobot berhasil diubah');
        }
        else
        {
            return back()->with('failed', 'Nilai bobot gagal diubah');
        }




        
    }
}
