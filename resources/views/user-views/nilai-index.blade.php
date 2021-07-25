@extends('layouts.user')

@section('pageHeader', 'Hasil Penilaian '.$keterangan)

@section('content-user')

<div class="mt-n4 mb-4">
    <a class="btn btn-primary" href={{route('user.nilai',12)}} role="button">Usia 12 Tahun</a>
    <a class="btn btn-primary" href={{route('user.nilai',15)}} role="button">Usia 15 Tahun</a>
    <a class="btn btn-primary" href={{route('user.nilai',17)}} role="button">Usia 17 Tahun</a>   
    <a class="btn btn-primary" href={{route('user.nilai',0)}} role="button">Semua Usia</a> 
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelompok Usia</th>
                <th scope="col">Passing Atas</th>
                <th scope="col">Passing Bawah</th>
                <th scope="col">Blocking</th>
                <th scope="col">Servis</th>
                <th scope="col">Rata-Rata</th>
              </tr>
            </thead>
            <tbody>
                <?php $nomor=1 ?>
                @foreach ($nilai as $data)
                    <tr>
                    <th scope="row">{{$nomor}}</th>
                    <td>{{$data->nama}}</td>
                    <td>Usia {{$data->kelompokUsia}} Tahun</td>
                    <td>{{$data->passingAtas}}</td>
                    <td>{{$data->passingBawah}}</td>
                    <td>{{$data->blocking}}</td>
                    <td>{{$data->servis}}</td>
                    <td>{{$data->rataRata}}</td>
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach              
            </tbody>
        </table>
    </div>
</div>
@endsection
