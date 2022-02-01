@extends('layouts.public')

@section('content')

<section class="page-section" id="contact">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>KONTRIBUSI PEMAIN DALAM 1 PERTANDINGAN</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Username / Nama Pemain') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="goal" class="col-md-4 col-form-label text-md-right">{{ __('Goal') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="assist" class="col-md-4 col-form-label text-md-right">{{ __('Assist') }}</label>

                            <div class="col-md-6">
                                <input id="kartu" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="kartu" class="col-md-4 col-form-label text-md-right">{{ __('Kartu') }}</label>
                            <div class="col-md-6">
                                <input type="radio" id="kartu" name="kartu" value="kuning">
                                <label for="admin">Kuning</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" id="kartu" name="kartu" value="merah">
                                <label for="klub">Merah</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                <div class="col-md-12 offset-md-1">
                                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                    <label for="vehicle1">Pelanggaran</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                    <label for="vehicle1">Provokasi</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                    <label for="vehicle2">Memukul</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                    <label for="vehicle3">Selebrasi Berlebihan</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="attitude" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>

                            <div class="col-md-6">
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1">Ontime</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1">Respect</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                <label for="vehicle2">Non Respect</label>&nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                <label for="vehicle3">Mental</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
