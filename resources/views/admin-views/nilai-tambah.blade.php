@extends('layouts.admin')
   
@section('content-admin')

    @if ($message = Session::get('sukses'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <p>Penilaian atas nama <strong>{{$message}}</strong> telah <strong>BERHASIL</strong> dilakukan.</p>    
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
        <h5>Formulir Penilaian Anggota : <strong>Usia {{$usia}} Tahun</strong></h5>
    </div>
    <div class="card-body">
        <form method="POST" action={{route('admin.nilai.store')}} enctype="multipart/form-data">
            @csrf

            <div class="row mb-2">
                <label for="anggota_id" class="col-sm-2 col-form-label">Nama Anggota</label>
                <div class="col-sm-4">     
                    <select class="form-control form-select" name="anggota_id" id="anggota_id" >
                        <option value="" selected disabled>Silahkan pilih nama anggota</option>
                        @foreach ($anggota as $data)
                            <option value={{$data->id}}>{{$data->nama}}</option>                            
                        @endforeach
                    </select>
                </div>
            </div>   
            <div class="row mb-2">
                <label for="passingAtas" class="col-sm-2 col-form-label">Nilai Passing Atas</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="passingAtas" name="passingAtas" value=0 onkeyup=cariRata()>
                </div>
            </div>   
            <div class="row mb-2">
                <label for="passingBawah" class="col-sm-2 col-form-label">Nilai Passing Bawah</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="passingBawah" name="passingBawah" value=0 onkeyup=cariRata()>
                </div>
            </div>   
            <div class="row mb-2">
                <label for="blocking" class="col-sm-2 col-form-label">Nilai Blocking</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="blocking" name="blocking" value=0 onkeyup=cariRata()>
                </div>
            </div>   
            <div class="row mb-2">
                <label for="servis" class="col-sm-2 col-form-label">Nilai Servis</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="servis" name="servis" value=0 onkeyup=cariRata()>
                </div>
            </div>   
            <div class="row mb-2">
                <label for="rataRata" class="col-sm-2 col-form-label"><strong>Nilai Rata-rata</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="rataRata" name="rataRata" readonly>
                </div>
            </div>   
            

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
<script>
    function cariRata() {
        var a = parseInt(document.getElementById("passingAtas").value);
        var b = parseInt(document.getElementById("passingBawah").value);
        var c = parseInt(document.getElementById("blocking").value);
        var d = parseInt(document.getElementById("servis").value);
        var hasil = document.getElementById("rataRata");
        var rata;
        rata = (a+b+c+d)/4;
        hasil.value = rata;
    } 
</script>
@endpush 