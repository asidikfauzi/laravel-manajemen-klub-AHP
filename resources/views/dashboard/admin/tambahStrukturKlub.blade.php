@extends('layouts.public')

@section('content')

<section class="page-section" id="contact">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-uppercase"><h3>Tambah Struktur Klub {{$data[0]['nama_klub']}}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('strukturKlub', $data[0]['id']) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notelp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telephone') }}</label>
                            <div class="col-md-6">
                                <input id="notelp" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{ old('notelp') }}" required autocomplete="notelp" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>
                            <div class="col-md-6">
                                <select name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror">
                                    <option value="ketua">Ketua Umum</option>
                                    <option value="wakil ketua">Wakil Ketua Umum</option>
                                    <option value="sekretaris1">Sekretaris I</option>
                                    <option value="sekretaris2">Sekretaris II</option>
                                    <option value="bendahara1">Bendahara I</option>
                                    <option value="bendahara2">Bendahara II</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image')}}" required autocomplete="image">
                            </div>
                        </div>
                        <br>

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
