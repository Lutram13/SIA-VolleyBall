@extends('layouts.user')

@section('pageHeader', 'Daftar Anggota Usia '.$usia.' Tahun Klub Bola Voli Tunas')

@section('content-user')

<div class="card">
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
                    <td>{{$anggota->tempatLahir}}, {{$anggota->tanggalLahir}}</td>
                    <td>{{$anggota->kelompokUsia}} Tahun</td>
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach              
            </tbody>
          </table>
    </div>
</div>
@endsection
