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
                <div class="card-header">{{ __('Register Pemain') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registerPemain') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <hr>
                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pemain') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama')}}" required autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ttl" class="col-md-4 col-form-label text-md-right">{{ __('Tempat/Tgl Lahir') }}</label>

                            <div class="col-md-2">
                                <input id="tempat" type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat')}}" required autocomplete="tempat">
                            </div>
                            <div class="col-md-4">
                                <input id="tglLahir" type="date" class="form-control @error('tglLahir') is-invalid @enderror" name="tglLahir" value="{{ old('tglLahir')}}" required autocomplete="tglLahir">
                                @error('ttl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat')}}" required autocomplete="alamat">

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notelp" class="col-md-4 col-form-label text-md-right">{{ __('No. Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="notelp" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{ old('notelp')}}" required autocomplete="notelp">

                                @error('notelp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tinggiberat" class="col-md-4 col-form-label text-md-right">{{ __('Tinggi / Berat Badan') }}</label>
                            
                                <div class="col-md-3">
                                    <input id="tinggi" type="text" class="form-control @error('tinggi') is-invalid @enderror" name="tinggi" value="{{ old('tinggi')}}" required autocomplete="tinggi">
                                    @error('tinggi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <input id="berat" type="text" class="form-control @error('berat') is-invalid @enderror" name="berat" value="{{ old('berat')}}" required autocomplete="berat">
                                    @error('berat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="nama_klub" class="col-md-4 col-form-label text-md-right">{{ __('Klub') }}</label>

                            <div class="col-md-6">
                                <select name="nama_klub" id="nama_klub" class="form-control @error('nama_klub') is-invalid @enderror">
                                    @foreach ($dataKlub as $data)
                                    <option value="{{$data['nama_klub']}}">{{$data['nama_klub']}}</option>
                                    @endforeach
                                </select>
                                @error('nama_klub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="posisi" class="col-md-4 col-form-label text-md-right">{{ __('Posisi') }}</label>
                            <div class="col-md-6"> 
                                <select name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror">
                                    <option value="pemain">Pemain</option>
                                    <option value="kiper">Kiper</option>
                                </select>
                                @error('posisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image')}}" required autocomplete="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="gaji" class="col-md-4 col-form-label text-md-right">{{ __('Gaji') }}</label>
                            <div class="col-md-6">
                                <input id="gaji" type="number" class="form-control @error('gaji') is-invalid @enderror" name="gaji" value="{{ old('gaji')}}" required autocomplete="gaji">
                                @error('gaji')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="awal_kontrak" class="col-md-4 col-form-label text-md-right">{{ __('Awal Kontrak') }}</label>
                            <div class="col-md-6">
                                <input id="awal_kontrak" type="date" class="form-control @error('awal_kontrak') is-invalid @enderror" name="awal_kontrak" value="{{ old('awal_kontrak')}}" required autocomplete="awal_kontrak">
                                @error('awal_kontrak')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="akhir_kontrak" class="col-md-4 col-form-label text-md-right">{{ __('Akhir Kontrak') }}</label>
                            <div class="col-md-6">
                                <input id="akhir_kontrak" type="date" class="form-control @error('akhir_kontrak') is-invalid @enderror" name="akhir_kontrak" value="{{ old('akhir_kontrak')}}" required autocomplete="akhir_kontrak">
                                @error('akhir_kontrak')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img_kontrak" class="col-md-4 col-form-label text-md-right">{{ __('Upload Kontrak') }}</label>

                            <div class="col-md-6">
                                <input id="img_kontrak" type="file" class="form-control @error('img_kontrak') is-invalid @enderror" name="img_kontrak" value="{{ old('img_kontrak')}}" required autocomplete="img_kontrak">

                                @error('img_kontrak')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
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
