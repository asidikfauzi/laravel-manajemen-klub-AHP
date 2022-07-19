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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;

class KlubController extends Controller
{
    //
    public function index()
    {
        $data = Klub::where('users_username', Auth()->user()->username)->get()->toArray();
        return view('dashboard.klub.index', compact('data'));
    }

    public function editKlub(Request $request)
    {
        $tglBeridiri = $request->input('tglBerdiri'); 
        $alamat = $request->input('alamat');
        $notelp = $request->input('notelp');
        $jadwalLatihan = $request->input('jadwalLatihan');
        $sejarahKlub = $request->input('sejarahKlub');
        $image = $request->file('image');
        

        $data = Klub::where('users_username', Auth()->user()->username)->first();
    
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
    
    public function profile()
    {
        return view('dashboard.klub.profile');
    }

    public function show($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.public.detailklub', compact('data','id'));
    }

    public function indexPublic()
    {
        $data = Klub::select('*')->get()->toArray();
        return view('dashboard.public.klub', compact('data'));
    }

    public function showStruktur($id)
    {
        $data = StrukturKlub::where('klub_id', $id)->get()->toArray();
        if(empty($data))
        {
            return back()->with('failed', 'Struktur data dari klub ini masih belum ada, silahkan tambahkan terlebih dahulu');
        }
        return view('dashboard.klub.dataStruktur', compact('data', 'id'));
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
        
        return view('dashboard.klub.strukturKlub', compact('ketua', 'sekretaris1', 'sekretaris2', 'bendahara1', 'bendahara2', 'id'));
    }

    public function showTambahStrukturKlub($id)
    {
        $data = Klub::where('id', $id)->get()->toArray();
        return view('dashboard.klub.tambahStrukturKlub', compact('data', 'id'));
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
            return back()->with('failed', 'Jabatan Untuk Klub anda sudah ada');
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

    public function showEditStrukturKlub($id)
    {
        $data = StrukturKlub::where('id', $id)->get()->toArray();
        if(empty($data))
        {
            return back()->with('failed', 'Struktur data dari klub ini masih belum ada, silahkan tambahkan terlebih dahulu');
        }
        return view('dashboard.klub.editStrukturKlub', compact('data'));
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

    public function showChangePassword()
    {
        return view('dashboard.klub.changePassword');
    }

    public function changePassword(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $reNewPassword = $request->input('reNewPassword');

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

    public function showMessage()
    {
        $users = User::get()->toArray();
        $message = Pesan::where('kepada_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'dari_username'=>$item['dari_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
        return view('dashboard.klub.message', compact('data', 'users'));
    }

    public function showOpenMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.klub.openmessage', compact('data'));
    }

    public function showOpenSentMessage($id)
    {
        $data = Pesan::where('id', $id)->get()->toArray();
        return view('dashboard.klub.opensentmessage', compact('data'));
    }

    public function showSentMessage()
    {
        $message = Pesan::where('dari_username', Auth::user()->username)->orderBy('created_at', 'desc')->get()->toArray();
        $data = [];
        foreach($message as $item)
        {
            array_push($data, ['id'=>$item['id'],'kepada_username'=>$item['kepada_username'], 'isi_pesan'=>substr($item['isi_pesan'],0,80), 'created_at'=>$item['created_at']]);
        }
       
        return view('dashboard.klub.sentMessage', compact('data'));
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

    public function deleteStruktur($id)
    {
        $struktur = StrukturKlub::where('id', $id)->delete();
        return back()->with('success', 'Data struktur berhasil di delete');
    }


    public function showRekom()
    {

        $hasil1 = Session::get('hasilFinal');
        $hasil2 = Session::get('hasilFinalKiper');

        if(!empty($hasil1) || !empty($hasil2)){
            session()->forget(['hasilFinal', 'hasilFinalKiper']);
        }
        
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
        

        return view('dashboard.klub.poinpemain', compact('hasilFinish', 'hasilFinishKiper'));
    
    }

    public function showRekomendasi()
    {
       

        $hasilFinal = Session::get('hasilFinal');

        if(empty($hasilFinal))
        {
            $hasilFinal[0]['nama_pemain'] = "-";
            $hasilFinal[0]['nama_klub'] = "-";
            $hasilFinal[0]['musim'] = "-";
            $hasilFinal[0]['jumlah'] = "-";
        }
       

        return view('dashboard.klub.rekomendasi-pemain', compact('hasilFinal'));
    }

    public function showRekomendasiKiper()
    {
        $hasilFinal = Session::get('hasilFinalKiper');

        if(empty($hasilFinal))
        {
            $hasilFinal[0]['nama_pemain'] = "-";
            $hasilFinal[0]['nama_klub'] = "-";
            $hasilFinal[0]['musim'] = "-";
            $hasilFinal[0]['jumlah'] = "-";
        }

        return view('dashboard.klub.rekomendasi-kiper', compact('hasilFinal'));
    }

    public function rekomendasi(Request $request)
    {
        $dataHasil = HasilSubKriteria::select('hasil_sub_kriteria.pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'hasil_sub_kriteria.musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'pemain')
                    ->where('pemain.status', 'aktif')
                    ->groupBy('hasil_sub_kriteria.pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'hasil_sub_kriteria.musim')->get()->toArray();
        
        $goal = $request->input('goal');
        $assist = $request->input('assist');
        $kuning = $request->input('kuning');
        $merah = $request->input('merah');
        $pelanggaranKuning = $request->input('pelanggaranKuning');
        $provokasiKuning = $request->input('provokasiKuning');
        $memukulKuning = $request->input('memukulKuning');
        $selebrasiKuning = $request->input('selebrasiKuning');
        $pelanggaranMerah = $request->input('pelanggaranMerah');
        $provokasiMerah = $request->input('provokasiMerah');
        $memukulMerah = $request->input('memukulMerah');
        $selebrasiMerah = $request->input('selebrasiMerah');
        $attitude = $request->input('attitude');
        $waktu = $request->input('waktu');
        $respect = $request->input('respect');
        $mental = $request->input('mental');

        $dataGoal = HasilSubKriteria::select('hasil_sub_kriteria.pemain_id', 'hasil_sub_kriteria.musim', DB::raw("SUM(hasil_sub_kriteria.jumlah * $goal) as jumlah_goal"))
                ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                ->where('hasil_sub_kriteria.sub_kriteria_id', 23)
                ->where('pemain.status', 'aktif')
                ->groupBy('hasil_sub_kriteria.pemain_id', 'hasil_sub_kriteria.musim')->get()->toArray();
        
        $dataAssist = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$assist) as jumlah_assist"))
                ->where('sub_kriteria_id', 24)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataPelanggaranKuning = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$pelanggaranKuning) as jumlah_pelanggaran_kuning"))
                ->where('sub_kriteria_id', 1)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataProvokasiKuning = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$provokasiKuning) as jumlah_provokasi_kuning"))
                ->where('sub_kriteria_id', 2)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataMemukulKuning = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$memukulKuning) as jumlah_memukul_kuning"))
                ->where('sub_kriteria_id', 3)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataSelebrasiKuning = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$selebrasiKuning) as jumlah_selebrasi_kuning"))
                ->where('sub_kriteria_id', 4)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataPelanggaranMerah = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$pelanggaranMerah) as jumlah_pelanggaran_merah"))
                ->where('sub_kriteria_id', 5)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataProvokasiMerah = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$provokasiMerah) as jumlah_provokasi_merah"))
                ->where('sub_kriteria_id', 6)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataMemukulMerah = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$memukulMerah) as jumlah_memukul_merah"))
                ->where('sub_kriteria_id', 7)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataSelebrasiMerah =  $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$selebrasiMerah) as jumlah_selebrasi_merah"))
                ->where('sub_kriteria_id', 8)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataWaktuPemain = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$waktu) as jumlah_waktu_pemain"))
                ->where('sub_kriteria_id', 17)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataRespectPemain = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$respect) as jumlah_respect_pemain"))
                ->where('sub_kriteria_id', 18)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        $dataMentalPemain = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$mental) as jumlah_mental_pemain"))
                ->where('sub_kriteria_id', 19)
                ->groupBy('pemain_id', 'musim')->get()->toArray();
        

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
            
            $hasilKalipv = $jumlahKuning * $kuning;
            array_push($hasilKuning, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerah = [];
        $jumlahMerah = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahMerah = $dataPelanggaranMerah[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerah[$i]['jumlah_provokasi_merah'] + $dataMemukulMerah[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerah[$i]['jumlah_selebrasi_merah'];
            
            $hasilKalipv = $jumlahMerah * $merah;
            array_push($hasilMerah, ['nama_pemain'=>$dataHasil[$i]['nama_pemain'],'nama_klub'=>$dataHasil[$i]['nama_klub'],'musim'=>$dataHasil[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitude = [];
        $jumlahAttitude = [];
        for($i = 0; $i < count($dataHasil); $i++)
        {
            $jumlahAttitude = $dataWaktuPemain[$i]['jumlah_waktu_pemain'] + $dataRespectPemain[$i]['jumlah_respect_pemain'] + $dataMentalPemain[$i]['jumlah_mental_pemain'];
           
            $hasilKalipv = $jumlahAttitude * $attitude;
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

        $session = session(['hasilFinal' => $hasilFinish]);
     
        return back();
    }

    public function rekomendasiKiper(Request $request)
    {
        $kebobolan = $request->input('kebobolan');
        $penyelamatan = $request->input('penyelamatan');
        $kuning = $request->input('kuning');
        $merah = $request->input('merah');
        $pelanggaranKuning = $request->input('pelanggaranKuning');
        $provokasiKuning = $request->input('provokasiKuning');
        $memukulKuning = $request->input('memukulKuning');
        $selebrasiKuning = $request->input('selebrasiKuning');
        $pelanggaranMerah = $request->input('pelanggaranMerah');
        $provokasiMerah = $request->input('provokasiMerah');
        $memukulMerah = $request->input('memukulMerah');
        $selebrasiMerah = $request->input('selebrasiMerah');
        $attitude = $request->input('attitude');
        $waktu = $request->input('waktu');
        $respect = $request->input('respect');
        $mental = $request->input('mental');

        $dataHasilKiper = HasilSubKriteria::select('pemain_id', 'pemain.nama_pemain', 'pemain.nama_klub', 'musim')
                    ->join('pemain', 'pemain.id', '=', 'hasil_sub_kriteria.pemain_id')
                    ->where('pemain.posisi', 'kiper')
                    ->groupBy('pemain_id','pemain.nama_pemain', 'pemain.nama_klub', 'musim')->get()->toArray();

        $dataKebobolan = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$kebobolan) as jumlah_kebobolan"))
        ->where('sub_kriteria_id', 25)
        ->groupBy('pemain_id', 'musim')->get();
        //Data Penyelamatan
        $dataPenyelamatan = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$penyelamatan) as jumlah_penyelamatan"))
        ->where('sub_kriteria_id', 26)
        ->groupBy('pemain_id', 'musim')->get();

        //Data Kartu Kuning
        $dataPelanggaranKuningKiper =HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$pelanggaranKuning) as jumlah_pelanggaran"))
        ->where('sub_kriteria_id', 9)
        ->groupBy('pemain_id', 'musim')->get();
        $dataProvokasiKuningKiper =HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$provokasiKuning) as jumlah_provokasi_kuning"))
        ->where('sub_kriteria_id', 10)
        ->groupBy('pemain_id', 'musim')->get();
        $dataMemukulKuningKiper =HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$memukulKuning) as jumlah_memukul_kuning"))
        ->where('sub_kriteria_id',11)
        ->groupBy('pemain_id', 'musim')->get();
        $dataSelebrasiKuningKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$selebrasiMerah) as jumlah_selebrasi_kuning"))
        ->where('sub_kriteria_id', 12)
        ->groupBy('pemain_id', 'musim')->get();
            

        //Data Kartu Merah
        $dataPelanggaranMerahKiper =HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$pelanggaranMerah) as jumlah_pelanggaran_merah"))
        ->where('sub_kriteria_id', 13)
        ->groupBy('pemain_id', 'musim')->get();
        $dataProvokasiMerahKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$provokasiMerah) as jumlah_provokasi_merah"))
        ->where('sub_kriteria_id', 14)
        ->groupBy('pemain_id', 'musim')->get();
        $dataMemukulMerahKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$memukulMerah) as jumlah_memukul_merah"))
        ->where('sub_kriteria_id', 15)
        ->groupBy('pemain_id', 'musim')->get();
        $dataSelebrasiMerahKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$selebrasiMerah) as jumlah_selebrasi_merah"))
        ->where('sub_kriteria_id', 16)
        ->groupBy('pemain_id', 'musim')->get();
        //Data Attitude
        $dataWaktuPemainKiper =HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$waktu) as jumlah_waktu_pemain"))
        ->where('sub_kriteria_id', 20)
        ->groupBy('pemain_id', 'musim')->get();
        $dataRespectPemainKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$respect) as jumlah_respect_pemain"))
        ->where('sub_kriteria_id', 21)
        ->groupBy('pemain_id', 'musim')->get();
        $dataMentalPemainKiper = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$mental) as jumlah_mental_pemain"))
        ->where('sub_kriteria_id', 22)
        ->groupBy('pemain_id', 'musim')->get();

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
            $hasilKalipv = $jumlahKuningKiper * $kuning;
            array_push($hasilKuningKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }

        $hasilMerahKiper = [];
        $jumlahMerahKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahMerahKiper = $dataPelanggaranMerahKiper[$i]['jumlah_pelanggaran_merah'] + $dataProvokasiMerahKiper[$i]['jumlah_provokasi_merah'] + $dataMemukulMerahKiper[$i]['jumlah_memukul_merah'] + $dataSelebrasiMerahKiper[$i]['jumlah_selebrasi_merah'];
    
            $hasilKalipv = $jumlahMerahKiper * $merah;
            array_push($hasilMerahKiper, ['nama_pemain'=>$dataHasilKiper[$i]['nama_pemain'],'nama_klub'=>$dataHasilKiper[$i]['nama_klub'],'musim'=>$dataHasilKiper[$i]['musim'],'jumlah'=> number_format((float)$hasilKalipv, 3, '.', '')]);
        }
        
        $hasilAttitudeKiper = [];
        $jumlahAttitudeKiper = [];
        for($i = 0; $i < count($dataHasilKiper); $i++)
        {
            $jumlahAttitudeKiper = $dataWaktuPemainKiper[$i]['jumlah_waktu_pemain'] + $dataRespectPemainKiper[$i]['jumlah_respect_pemain'] + $dataMentalPemainKiper[$i]['jumlah_mental_pemain'];
            
            $hasilKalipv = $jumlahAttitudeKiper * $attitude;
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
        $sessionKiper = session(['hasilFinalKiper' => $hasilFinishKiper]);
     
        return back();
    }
}
