@extends('layouts.admin')
   
@section('content-admin')

    @if ($message = Session::get('sukses'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <p>Input Jadwal <strong>{{$message}}</strong> telah <strong>BERHASIL</strong> dilakukan.</p>    
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
    <div class="card-header">
        <h5>Buat Jadwal Latihan</h5>
    </div>
    <div class="card-body">
        <form method="POST" action={{route('admin.jadwal.store')}} enctype="multipart/form-data">
            @csrf

            <div class="row mb-2">
                <label for="namaPelatih" class="col-sm-2 col-form-label">Nama Pelatih</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="namaPelatih" id="namaPelatih" >
                        <option value="" selected disabled>Silahkan pilih pelatih</option>
                        @foreach ($pelatih as $dataPelatih)
                            <option value={{$dataPelatih->id}}>{{$dataPelatih->namaPelatih}}</option>                           
                        @endforeach
                    </select>
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
            <div class="row mb-2">
                <label for="tempatLatihan" class="col-sm-2 col-form-label">Tempat Latihan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="tempatLatihan" name="tempatLatihan" style="height: 100px"></textarea>
                </div>
            </div>     
            <div class="row mb-2">
                <label for="hariLatihan" class="col-sm-2 col-form-label">Hari Latihan</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="hariLatihan" id="hariLatihan" >
                        <option value="" selected disabled>Silahkan pilih hari latihan</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
            </div>       
            <div class="row mb-2">
                <label for="jamLatihan" class="col-sm-2 col-form-label">Jam Latihan</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="jamLatihan" name="jamLatihan">
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


@endsection