@extends('layouts.public')

@section('content')

<section class="page-section" id="contact">
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bobot Penilaian Terbaik</div>

                <div class="card-body">
                    <form method="POST" action="{{route('kriteriasubkriteria')}}" >
                        @csrf
                        <center>
                            <label for="pemain" class="mb-3"><b>Bobot Pemain</b></label>
                        </center>
                        <div class="form-group row">
                            <label for="goal" class="col-md-4 col-form-label text-md-right">{{ __('Goal') }}</label>

                            <div class="col-md-6">
                                <input id="goal" type="text" class="form-control" name="goal" value="{{ $goal[0]['bobot'] }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="assist" class="col-md-4 col-form-label text-md-right">{{ __('Assist') }}</label>

                            <div class="col-md-6">
                                <input id="assist" type="text" class="form-control @error('assist') is-invalid @enderror" name="assist" value="{{ $assist[0]['bobot'] }}" required autocomplete="assist">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kuning" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Kuning') }}</label>
                            <div class="col-md-6">
                                <input id="kuning" type="text" class="form-control @error('kuning') is-invalid @enderror" name="kuning" value="{{ $kuning[0]['bobot'] }}" required autocomplete="kuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranKuning" type="text" class="form-control @error('pelanggaranKuning') is-invalid @enderror" name="pelanggaranKuning" value="{{ $pelanggaranKuning[0]['bobot'] }}" required autocomplete="pelanggaranKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiKuning" type="text" class="form-control @error('provokasiKuning') is-invalid @enderror" name="provokasiKuning" value="{{ $provokasiKuning[0]['bobot'] }}" required autocomplete="provokasiKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulKuning" type="text" class="form-control @error('memukulKuning') is-invalid @enderror" name="memukulKuning" value="{{ $memukulKuning[0]['bobot'] }}" required autocomplete="memukulKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiKuning" type="text" class="form-control @error('selebrasiKuning') is-invalid @enderror" name="selebrasiKuning" value="{{ $selebrasiKuning[0]['bobot'] }}" required autocomplete="selebrasiKuning">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="merah" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Merah') }}</label>

                            <div class="col-md-6">
                                <input id="merah" type="text" class="form-control @error('merah') is-invalid @enderror" name="merah" value="{{ $merah[0]['bobot'] }}" required autocomplete="merah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranMerah" type="text" class="form-control @error('pelanggaranMerah') is-invalid @enderror" name="pelanggaranMerah" value="{{ $pelanggaranMerah[0]['bobot'] }}" required autocomplete="pelanggaranMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiMerah" type="text" class="form-control @error('provokasiMerah') is-invalid @enderror" name="provokasiMerah" value="{{ $provokasiMerah[0]['bobot'] }}" required autocomplete="provokasiMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulMerah" type="text" class="form-control @error('memukulMerah') is-invalid @enderror" name="memukulMerah" value="{{ $memukulMerah[0]['bobot'] }}" required autocomplete="memukulMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiMerah" type="text" class="form-control @error('selebrasiMerah') is-invalid @enderror" name="selebrasiMerah" value="{{ $selebrasiMerah[0]['bobot'] }}" required autocomplete="selebrasiMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="attitude" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>

                            <div class="col-md-6">
                                <input id="attitude" type="text" class="form-control @error('attitude') is-invalid @enderror" name="attitude" value="{{ $attitude[0]['bobot'] }}" required autocomplete="attitude">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="waktu" class="col-md-4 col-form-label text-md-right"><li>{{ __('Waktu') }}</li></label>
                            <div class="col-md-6">
                                <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu" value="{{ $waktu[0]['bobot'] }}" required autocomplete="waktu">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="respect" class="col-md-4 col-form-label text-md-right"><li>{{ __('Respect') }}</li></label>
                            <div class="col-md-6">
                                <input id="respect" type="text" class="form-control @error('respect') is-invalid @enderror" name="respect" value="{{ $respect[0]['bobot'] }}" required autocomplete="respect">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="mental" class="col-md-4 col-form-label text-md-right"><li>{{ __('Mental') }}</li></label>
                            <div class="col-md-6">
                                <input id="mental" type="text" class="form-control @error('mental') is-invalid @enderror" name="mental" value="{{ $mental[0]['bobot'] }}" required autocomplete="mental">
                            </div>
                        </div> 
                        <hr>
                        <center>
                            <label for="kiper" class="mb-3"><b>Bobot Kiper</b></label>
                        </center>
                        <div class="form-group row">
                            <label for="kebobolan" class="col-md-4 col-form-label text-md-right">{{ __('Kebobolan') }}</label>

                            <div class="col-md-6">
                                <input id="kebobolan" type="text" class="form-control @error('kebobolan') is-invalid @enderror" name="kebobolan" value="{{ $kebobolan[0]['bobot'] }}" required autocomplete="kebobolan" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penyelamatan" class="col-md-4 col-form-label text-md-right">{{ __('Penyelamatan') }}</label>

                            <div class="col-md-6">
                                <input id="penyelamatan" type="text" class="form-control @error('penyelamatan') is-invalid @enderror" name="penyelamatan" value="{{ $penyelamatan[0]['bobot'] }}" required autocomplete="penyelamatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kuningKiper" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Kuning') }}</label>
                            <div class="col-md-6">
                                <input id="kuningKiper" type="text" class="form-control @error('kuning') is-invalid @enderror" name="kuningKiper" value="{{ $kuningKiper[0]['bobot'] }}" required autocomplete="kuningKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranKuningKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranKuningKiper" type="text" class="form-control @error('pelanggaranKuningKiper') is-invalid @enderror" name="pelanggaranKuningKiper" value="{{ $pelanggaranKuningKiper[0]['bobot'] }}" required autocomplete="pelanggaranKuningKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiKuningKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiKuningKiper" type="text" class="form-control @error('provokasiKuningKiper') is-invalid @enderror" name="provokasiKuningKiper" value="{{ $provokasiKuningKiper[0]['bobot'] }}" required autocomplete="provokasiKuningKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulKuningKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulKuningKiper" type="text" class="form-control @error('memukulKuningKiper') is-invalid @enderror" name="memukulKuningKiper" value="{{ $memukulKuningKiper[0]['bobot'] }}" required autocomplete="memukulKuningKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiKuningKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiKuningKiper" type="text" class="form-control @error('selebrasiKuningKiper') is-invalid @enderror" name="selebrasiKuningKiper" value="{{ $selebrasiKuningKiper[0]['bobot'] }}" required autocomplete="selebrasiKuningKiper">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="merahKiper" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Merah') }}</label>

                            <div class="col-md-6">
                                <input id="merahKiper" type="text" class="form-control @error('merahKiper') is-invalid @enderror" name="merahKiper" value="{{ $merahKiper[0]['bobot'] }}" required autocomplete="merahKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranMerahKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranMerahKiper" type="text" class="form-control @error('pelanggaranMerahKiper') is-invalid @enderror" name="pelanggaranMerahKiper" value="{{ $pelanggaranMerahKiper[0]['bobot'] }}" required autocomplete="pelanggaranMerahKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiMerahKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiMerahKiper" type="text" class="form-control @error('provokasiMerahKiper') is-invalid @enderror" name="provokasiMerahKiper" value="{{ $provokasiMerahKiper[0]['bobot'] }}" required autocomplete="provokasiMerahKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulMerahKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulMerahKiper" type="text" class="form-control @error('memukulMerahKiper') is-invalid @enderror" name="memukulMerahKiper" value="{{ $memukulMerahKiper[0]['bobot'] }}" required autocomplete="memukulMerahKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiMerahKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiMerahKiper" type="text" class="form-control @error('selebrasiMerahKiper') is-invalid @enderror" name="selebrasiMerahKiper" value="{{ $selebrasiMerahKiper[0]['bobot'] }}" required autocomplete="selebrasiMerahKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="attitudeKiper" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>

                            <div class="col-md-6">
                                <input id="attitudeKiper" type="text" class="form-control @error('attitudeKiper') is-invalid @enderror" name="attitudeKiper" value="{{ $attitudeKiper[0]['bobot'] }}" required autocomplete="attitudeKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="waktuKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Waktu') }}</li></label>
                            <div class="col-md-6">
                                <input id="waktuKiper" type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktuKiper" value="{{ $waktuKiper[0]['bobot'] }}" required autocomplete="waktuKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="respectKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Respect') }}</li></label>
                            <div class="col-md-6">
                                <input id="respectKiper" type="text" class="form-control @error('respectKiper') is-invalid @enderror" name="respectKiper" value="{{ $respectKiper[0]['bobot'] }}" required autocomplete="respectKiper">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="mentalKiper" class="col-md-4 col-form-label text-md-right"><li>{{ __('Mental') }}</li></label>
                            <div class="col-md-6">
                                <input id="mentalKiper" type="text" class="form-control @error('mentalKiper') is-invalid @enderror" name="mentalKiper" value="{{ $mentalKiper[0]['bobot'] }}" required autocomplete="mentalKiper">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
