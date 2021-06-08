@extends('layouts.admin')
   
@section('content-admin')

    @if ($message = Session::get('sukses'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <p>Pendaftaran atas nama <strong>{{$message}}</strong> telah <strong>BERHASIL</strong> dilakukan.</p>    
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
        <h5>Formulir Edit Data Pelatih : {{$pelatih->namaPelatih}}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action={{route('admin.pelatih.update',$pelatih->id)}} enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="row mb-2">
                <label for="namaPelatih" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaPelatih" name="namaPelatih" value="{{$pelatih->namaPelatih}}" >
                </div>
            </div>
            <div class="row mb-2">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" style="height: 100px">{{$pelatih->alamat}}</textarea>
                </div>
            </div>     
            <div class="row mb-2">
                <label for="nomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nomorTelepon" name="nomorTelepon" value="{{$pelatih->nomorTelepon}}" >
                </div>
            </div>   
            <div class="row mb-2">
                <label for="tempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="{{$pelatih->tempatLahir}}">
                </div>
            </div>       
            <div class="row mb-2">
                <label for="tanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="{{$pelatih->tanggalLahir}}">
                </div>
            </div>
            <div class="row mb-2">
                <label for="kelompokUsia" class="col-sm-2 col-form-label">Kelompok Usia</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="kelompokUsia" id="kelompokUsia">
                        <option value="" selected disabled>Silahkan pilih kelompok usia</option>
                        <option value="12" <?php echo $pelatih->kelompokUsia == 12 ? 'selected="selected"' : '' ?>>Kelompok 12 Tahun</option>
                        <option value="15" <?php echo $pelatih->kelompokUsia == 15 ? 'selected="selected"' : '' ?>>Kelompok 15 Tahun</option>
                        <option value="17" <?php echo $pelatih->kelompokUsia == 17 ? 'selected="selected"' : '' ?>>Kelompok 17 Tahun</option>
                    </select>
                </div>
            </div> 
            <div class="row mb-2">
                <label for="image" class="col-sm-2 col-form-label">Masukkan Foto</label>
                <div class="col-sm-4">
                    <input class="col-sm-10 form-control" type="file" id="image" name="image">                    
                    <div class="croping rounded mx-auto d-block mt-2">
                        <img src="/images/pelatih/{{$pelatih->image}}" class="" alt="photo">                            
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


@endsection