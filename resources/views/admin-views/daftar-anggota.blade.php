@extends('layouts.admin')
   
@section('content-admin')
<div class="mt-n4 mb-4">
    <a class="btn btn-primary" href={{route('admin.anggota',12)}} role="button">Usia 12 Tahun</a>
    <a class="btn btn-primary" href={{route('admin.anggota',15)}} role="button">Usia 15 Tahun</a>
    <a class="btn btn-primary" href={{route('admin.anggota',17)}} role="button">Usia 17 Tahun</a>    
</div>

<div class="card">
    <div class="card-header">
        <h5>Daftar Anggota Usia <strong>{{$usia}} Tahun</strong> Klub Bola Voli Tunas</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tempat, Tanggal Lahir</th>
                <th scope="col">Kelompok Usia</th>
              </tr>
            </thead>
            <tbody>
                <?php $nomor=1 ?>
                @foreach ($data as $anggota)
                    <tr>
                    <th scope="row">{{$nomor}}</th>
                    <td>{{$anggota->nama}}</td>
                    <td>{{$anggota->alamat}}</td>
                    <?php 
                        $tanggalLahir = DateTime::createFromFormat('Y-m-d', $anggota->tanggalLahir);
                        $formattanggalLahir = $tanggalLahir->format('d M Y');
                    ?>
                    <td>{{$anggota->tempatLahir}}, {{$formattanggalLahir}}</td>
                    <td>{{$anggota->kelompokUsia}} Tahun</td>
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach              
            </tbody>
          </table>
    </div>
</div>



@endsection