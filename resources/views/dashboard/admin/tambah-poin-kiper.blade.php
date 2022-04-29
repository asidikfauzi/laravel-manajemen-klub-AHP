@extends('layouts.public')

@section('content')

<section class="page-section" id="contact">
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>KONTRIBUSI KIPER DALAM 1 PERTANDINGAN</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{route('tambahpoin-kiper')}}">
                        @csrf
                        <div class="form-group row mb-2">
                            <label for="pemain" class="col-md-4 col-form-label text-md-right">{{ __('Username / Nama Pemain') }}</label>
                            <div class="col-md-6">
                                <select name="pemain" id="pemain" class="form-control @error('pemain') is-invalid @enderror">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($dataPemain as $data)
                                    <option value="{{$data['id']}}">{{$data['username']}} - {{$data['nama_pemain']}} &nbsp;&nbsp;&nbsp;({{$data['posisi']}}) </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kebobolan" class="col-md-4 col-form-label text-md-right">{{ __('Kebobolan') }}</label>
                            <div class="col-md-6">
                                <input id="kebobolan" type="text" class="form-control @error('kebobolan') is-invalid @enderror" name="kebobolan">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="penyelamatan" class="col-md-4 col-form-label text-md-right">{{ __('Penyelamatan') }}</label>
                            <div class="col-md-6">
                                <input id="penyelamatan" type="text" class="form-control @error('penyelamatan') is-invalid @enderror" name="penyelamatan" >
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Kuning') }}</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="pelanggaran" name="pelanggaran" value="9">
                                <label for="pelanggaran">Pelanggaran</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="provokasi" name="provokasi" value="10">
                                <label for="provokasi">Provokasi</label><br>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-2">
                                <input type="checkbox" id="memukul" name="memukul" value="11">
                                <label for="memukul">Memukul</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="selebrasi" name="selebrasi" value="12">
                                <label for="selebrasi">Selebrasi Berlebihan</label><br>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Merah') }}</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="pelanggaran_merah" name="pelanggaran_merah" value="13">
                                <label for="pelanggaran_merah">Pelanggaran</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="provokasi_merah" name="provokasi_merah" value="14">
                                <label for="provokasi_merah">Provokasi</label><br>
                            </div>
                        </div>
                        <div class="form-group row mb-2 ">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-2">
                                <input type="checkbox" id="memukul_merah" name="memukul_merah" value="15">
                                <label for="memukul_merah">Memukul</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="selebrasi_merah" name="selebrasi_merah" value="16">
                                <label for="selebrasi_merah">Selebrasi Berlebihan</label><br>
                            </div>
                        </div>
                        <div class="form-group row mb-2 mt-4">
                            <label for="attitude" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="waktu" name="waktu" value="20">
                                <label for="waktu">Waktu</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="respect" name="respect" value="21">
                                <label for="respect">Respect</label><br>
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" id="mental" name="mental" value="22">
                                <label for="mental">Mental</label><br>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="musim" class="col-md-4 col-form-label text-md-right">{{ __('Musim') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="datepicker" type="text" class="form-control @error('musim') is-invalid @enderror" name="musim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
