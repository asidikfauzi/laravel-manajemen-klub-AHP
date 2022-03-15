@extends('layouts.public')

@section('content')

<section class="page-section" id="contact">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>KONTRIBUSI PEMAIN DALAM 1 PERTANDINGAN</h3></div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group row mb-2">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username / Nama Pemain') }}</label>
                            <div class="col-md-6">
                                <select name="username" id="username" class="form-control @error('username') is-invalid @enderror">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($dataPemain as $data)
                                    <option value="{{$data['username']}}">{{$data['username']}} - {{$data['nama_pemain']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="goal" class="col-md-4 col-form-label text-md-right">{{ __('Goal') }}</label>
                            <div class="col-md-6">
                                <input id="goal" type="text" class="form-control @error('goal') is-invalid @enderror" name="goal">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="assist" class="col-md-4 col-form-label text-md-right">{{ __('Assist') }}</label>
                            <div class="col-md-6">
                                <input id="assist" type="text" class="form-control @error('assist') is-invalid @enderror" name="assist" >
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Kuning') }}</label>
                            <div class="col-md-6">
                                <select name="kuning" id="kuning" class="form-control @error('kuning') is-invalid @enderror">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($kartuKuning as $kuning)
                                        <option value="{{$kuning['id']}}">{{$kuning['nama_sub_kriteria']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Merah') }}</label>
                            <div class="col-md-6">
                                <select name="merah" id="merah" class="form-control @error('merah') is-invalid @enderror">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($kartuMerah as $merah)
                                        <option value="{{$merah['id']}}">{{$merah['nama_sub_kriteria']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="attitude" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>
                            <div class="col-md-6">
                                <select name="attitude" id="attitude" class="form-control @error('attitude') is-invalid @enderror">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($attitude as $at)
                                        <option value="{{$at['id']}}">{{$at['nama_sub_kriteria']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="musim" class="col-md-4 col-form-label text-md-right">{{ __('Musim') }}</label>
                            <div class="col-md-6 mb-2">
                                <input id="datepicker" type="text" class="form-control @error('musim') is-invalid @enderror" name="musim">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
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
