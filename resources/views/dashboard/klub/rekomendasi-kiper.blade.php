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
                    <form method="POST" action="{{route('klub.rekomendasi.kiper')}}" >
                        @csrf
                        <center>
                            <label for="pemain" class="mb-3"><b>Bobot Kiper</b></label>
                        </center>
                        <div class="form-group row">
                            <label for="kebobolan" class="col-md-4 col-form-label text-md-right">{{ __('Kebobolan') }}</label>

                            <div class="col-md-6">
                                <input id="kebobolan" type="text" class="form-control" name="kebobolan" value="{{ old('kebobolan') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penyelamatan" class="col-md-4 col-form-label text-md-right">{{ __('Penyelamatan') }}</label>

                            <div class="col-md-6">
                                <input id="penyelamatan" type="text" class="form-control @error('penyelamatan') is-invalid @enderror" name="penyelamatan" value="{{ old('penyelamatan') }}" required autocomplete="penyelamatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kuning" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Kuning') }}</label>
                            <div class="col-md-6">
                                <input id="kuning" type="text" class="form-control @error('kuning') is-invalid @enderror" name="kuning" value="{{ old('kuning') }}" required autocomplete="kuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranKuning" type="text" class="form-control @error('pelanggaranKuning') is-invalid @enderror" name="pelanggaranKuning" value="{{ old('pelanggaranKuning') }}" required autocomplete="pelanggaranKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiKuning" type="text" class="form-control @error('provokasiKuning') is-invalid @enderror" name="provokasiKuning" value="{{ old('provokasiKuning') }}" required autocomplete="provokasiKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulKuning" type="text" class="form-control @error('memukulKuning') is-invalid @enderror" name="memukulKuning" value="{{ old('memukulKuning') }}" required autocomplete="memukulKuning">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiKuning" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiKuning" type="text" class="form-control @error('selebrasiKuning') is-invalid @enderror" name="selebrasiKuning" value="{{ old('selebrasiKuning') }}" required autocomplete="selebrasiKuning">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="merah" class="col-md-4 col-form-label text-md-right">{{ __('Kartu Merah') }}</label>

                            <div class="col-md-6">
                                <input id="merah" type="text" class="form-control @error('merah') is-invalid @enderror" name="merah" value="{{ old('merah') }}" required autocomplete="merah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pelanggaranMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Pelanggaran') }}</li></label>
                            <div class="col-md-6">
                                <input id="pelanggaranMerah" type="text" class="form-control @error('pelanggaranMerah') is-invalid @enderror" name="pelanggaranMerah" value="{{old('pelanggaranMerah')}}" required autocomplete="pelanggaranMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="provokasiMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Provokasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="provokasiMerah" type="text" class="form-control @error('provokasiMerah') is-invalid @enderror" name="provokasiMerah" value="{{ old('provokasiMerah') }}" required autocomplete="provokasiMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="memukulMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Memukul') }}</li></label>
                            <div class="col-md-6">
                                <input id="memukulMerah" type="text" class="form-control @error('memukulMerah') is-invalid @enderror" name="memukulMerah" value="{{ old('memukulMerah') }}" required autocomplete="memukulMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="selebrasiMerah" class="col-md-4 col-form-label text-md-right"><li>{{ __('Selebrasi') }}</li></label>
                            <div class="col-md-6">
                                <input id="selebrasiMerah" type="text" class="form-control @error('selebrasiMerah') is-invalid @enderror" name="selebrasiMerah" value="{{ old('selebrasiMerah') }}" required autocomplete="selebrasiMerah">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="attitude" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>

                            <div class="col-md-6">
                                <input id="attitude" type="text" class="form-control @error('attitude') is-invalid @enderror" name="attitude" value="{{ old('attitude') }}" required autocomplete="attitude">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="waktu" class="col-md-4 col-form-label text-md-right"><li>{{ __('Waktu') }}</li></label>
                            <div class="col-md-6">
                                <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu" value="{{ old('waktu')  }}" required autocomplete="waktu">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="respect" class="col-md-4 col-form-label text-md-right"><li>{{ __('Respect') }}</li></label>
                            <div class="col-md-6">
                                <input id="respect" type="text" class="form-control @error('respect') is-invalid @enderror" name="respect" value="{{ old('respect') }}" required autocomplete="respect">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="mental" class="col-md-4 col-form-label text-md-right"><li>{{ __('Mental') }}</li></label>
                            <div class="col-md-6">
                                <input id="mental" type="text" class="form-control @error('mental') is-invalid @enderror" name="mental" value="{{ old('mental') }}" required autocomplete="mental">
                            </div>
                        </div> 
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12 mt-3">
                                <button type="submit" name="btnSubmit" class="btn btn-primary w-100">
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
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;

}
</style>

<h2 class="mt-5">HASIL REKOMENDASI KIPER</h2>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-xl-12 stretch-card-center grid-margin">
        <table>
            <tr>
                <th>No.</th>
                <th>Nama Pemain</th>
                <th>Musim</th>
                <th>Nama Klub</th>
                <th>Jumlah Poin</th>
            </tr>

            @foreach ($hasilFinal as $data)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$data['nama_pemain']}}</td>
                <td>{{$data['musim']}}</td>
                <td>{{$data['nama_klub']}}</td>
                <td>{{$data['jumlah']}}</td>
            </tr>    
            @endforeach
           
        </table>
    </div>
   
</div>


@endsection
