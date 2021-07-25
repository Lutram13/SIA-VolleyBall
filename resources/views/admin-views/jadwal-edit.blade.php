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
        <h5>Edit Jadwal Latihan</h5>
    </div>
    <div class="card-body">
        <form method="POST" action={{route('admin.jadwal.update', $jadwal->id)}} enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="row mb-2">
                <label for="namaPelatih" class="col-sm-2 col-form-label">Nama Pelatih</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="namaPelatih" id="namaPelatih" >
                        <option value="" selected disabled>Silahkan pilih pelatih</option>
                        @foreach ($pelatih as $dataPelatih)                        
                            <option value={{$dataPelatih->id}} <?php echo $jadwal->namaPelatih_id == $dataPelatih->id ? 'selected="selected"' : '' ?>>{{$dataPelatih->namaPelatih}}</option>                           
                        @endforeach
                    </select>
                </div>
            </div> 
            <div class="row mb-2">
                <label for="kelompokUsia" class="col-sm-2 col-form-label">Kelompok Usia</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="kelompokUsia" id="kelompokUsia" >
                        <option value="" selected disabled>Silahkan pilih kelompok usia</option>
                        <option value="12" <?php echo $jadwal->kelompokUsia == 12 ? 'selected="selected"' : '' ?>>Kelompok 12 Tahun</option>
                        <option value="15" <?php echo $jadwal->kelompokUsia == 15 ? 'selected="selected"' : '' ?>>Kelompok 15 Tahun</option>
                        <option value="17" <?php echo $jadwal->kelompokUsia == 17 ? 'selected="selected"' : '' ?>>Kelompok 17 Tahun</option>
                    </select>
                </div>
            </div> 
            <div class="row mb-2">
                <label for="tempatLatihan" class="col-sm-2 col-form-label">Tempat Latihan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="tempatLatihan" name="tempatLatihan" style="height: 100px">{{$jadwal->tempatLatihan}}</textarea>
                </div>
            </div>     
            <div class="row mb-2">
                <label for="hariLatihan" class="col-sm-2 col-form-label">Hari Latihan</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="hariLatihan" id="hariLatihan" >
                        <option value="" selected disabled>Silahkan pilih hari latihan</option>
                        <option value="Senin" <?php echo $jadwal->hariLatihan == "Senin" ? 'selected="selected"' : '' ?>>Senin</option>
                        <option value="Selasa" <?php echo $jadwal->hariLatihan == "Selasa" ? 'selected="selected"' : '' ?>>Selasa</option>
                        <option value="Rabu" <?php echo $jadwal->hariLatihan == "Rabu" ? 'selected="selected"' : '' ?>>Rabu</option>
                        <option value="Kamis" <?php echo $jadwal->hariLatihan == "Kamis" ? 'selected="selected"' : '' ?>>Kamis</option>
                        <option value="Jumat" <?php echo $jadwal->hariLatihan == "Jumat" ? 'selected="selected"' : '' ?>>Jumat</option>
                        <option value="Sabtu" <?php echo $jadwal->hariLatihan == "Sabtu" ? 'selected="selected"' : '' ?>>Sabtu</option>
                        <option value="Minggu" <?php echo $jadwal->hariLatihan == "Minggu" ? 'selected="selected"' : '' ?>>Minggu</option>
                    </select>
                </div>
            </div>       
            <div class="row mb-2">
                <label for="jamLatihan" class="col-sm-2 col-form-label">Jam Latihan</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="jamLatihan" name="jamLatihan" value="{{$jadwal->jamLatihan}}">
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>


@endsection