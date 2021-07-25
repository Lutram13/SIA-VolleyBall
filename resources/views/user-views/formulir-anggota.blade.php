@extends('layouts.user')

@section('pageHeader', 'Formulir Anggota')

@section('content-user')

    @if ($message = Session::get('sukses'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <p>{{$message}}</p>    
        </div>
    @endif

    @if ($message = Session::get('gagal'))    
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <p>Data <strong>GAGAL</strong> diinputkan : <strong>{{ $message }}</strong>. </p>
        </div>
    @endif

    @if ($message = Session::get('peringatan'))  
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <p>Terjadi kesalahan : <strong>{{ $message }}</strong>. </p>            
        </div>
    @endif

<div class="card">
    <div class="card-body">
        <form method="POST" action={{route('user.formulir.store')}}>
            @csrf

            <div class="row mb-2">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
            </div>
            <div class="row mb-2">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                </div>
            </div>            
            <div class="row mb-2">
                <label for="tempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tempatLahir" name="tempatLahir">
                </div>
            </div>       
            <div class="row mb-2">
                <label for="tanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir">
                </div>
            </div>
            <div class="row mb-2">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="umur" name="umur">
                </div>
            </div> 
            <div class="row mb-2">
                <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan">
                </div>
            </div> 
            <div class="row mb-2">
                <label for="tinggiBadan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" class="form-control" id="tinggiBadan" name="tinggiBadan">                     
                        <div class="input-group-text"> CM </div>
                    </div>
                </div>
            </div> 
            <div class="row mb-2">
                <label for="beratBadan" class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-4">                
                    <div class="input-group">
                        <input type="number" class="form-control" id="beratBadan" name="beratBadan">  
                        <div class="input-group-text"> KG </div>                       
                    </div> 
                </div>
            </div> 
            <div class="row mb-2">
                <label for="kelompokUsia" class="col-sm-2 col-form-label">Kelompok Usia</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="kelompokUsia" id="kelompokUsia" >
                        <option value="" selected disabled>Silahkan pilih kelompok usia</option>
                        <option value="12">Kelompok 12 Tahun</option>
                        <option value="15">Kelompok 15 Tahun</option>
                        <option value="17">Kelompok 17 Tahun</option>
                    </select>
                </div>
            </div> 
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
