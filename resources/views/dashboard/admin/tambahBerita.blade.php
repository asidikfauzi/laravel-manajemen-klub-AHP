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
                <div class="card-header"><h3>TAMBAH BERITA DAN AKTIVITAS</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tambahBerita') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="judul_berita" class="col-md-4 col-form-label text-md-right">{{ __('Judul Berita') }}</label>
                            <div class="col-md-6">
                                <input id="judul_berita" type="text" class="form-control @error('judul_berita') is-invalid @enderror" name="judul_berita" value="{{ old('judul_berita') }}" required autocomplete="judul_berita" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isi_berita" class="col-md-4 col-form-label text-md-right">{{ __('Isi Berita') }}</label>
                            <div class="col-md-6">
                                <textarea  rows="5" cols="50" id="isi_berita" class="form-control @error('isi_berita') is-invalid @enderror" name="isi_berita" required autocomplete="isi_berita">{{ old('isi_berita')}}</textarea>
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
