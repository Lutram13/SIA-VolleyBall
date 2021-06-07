@extends('layouts.admin')
   
@section('content-admin')


<div class="card">
    <div class="card-header">
        <h5>Formulir Tambah Data Pelatih</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            @csrf

            <div class="row mb-2">
                <label for="namaPelatih" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaPelatih" name="namaPelatih">
                </div>
            </div>
            <div class="row mb-2">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" style="height: 100px"></textarea>
                </div>
            </div>     
            <div class="row mb-2">
                <label for="telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon">
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
                <label for="image" class="col-sm-2 col-form-label">Masukkan Foto</label>
                <div class="col-sm-4">
                    <input class="col-sm-10 form-control" type="file" id="image" name="image">
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


@endsection