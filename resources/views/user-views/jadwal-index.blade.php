@extends('layouts.user')

@section('pageHeader', 'Jadwal Latihan '.$keterangan)

@section('content-user')

<div class="mt-n4 mb-4">
    <a class="btn btn-primary" href={{route('user.jadwal',12)}} role="button">Usia 12 Tahun</a>
    <a class="btn btn-primary" href={{route('user.jadwal',15)}} role="button">Usia 15 Tahun</a>
    <a class="btn btn-primary" href={{route('user.jadwal',17)}} role="button">Usia 17 Tahun</a>   
    <a class="btn btn-primary" href={{route('user.jadwal',0)}} role="button">Semua Usia</a> 
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Pelatih</th>
                <th scope="col">Kelompok Usia</th>
                <th scope="col">Senin</th>
                <th scope="col">Selasa</th>
                <th scope="col">Rabu</th>
                <th scope="col">Kamis</th>
                <th scope="col">Jumat</th>
                <th scope="col">Sabtu</th>
                <th scope="col">Minggu</th>
                <th scope="col">Tempat Latihan</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    $nomor=1;
                    $hari=['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
                ?>
                @foreach ($jadwal as $dataJadwal)
                    <tr>
                    <th scope="row">{{$nomor}}</th>
                    <td>{{$dataJadwal->namaPelatih}}</td>
                    <td>Usia {{$dataJadwal->kelompokUsia}} Tahun</td>
                    
                    @foreach ($hari as $dataHari)
                        <?php              
                        if ($dataJadwal->hariLatihan == $dataHari) {
                            echo '<td>'.$dataJadwal->jamLatihan.'</td>';
                        } else {
                            echo '<td> - </td>';
                        }   
                        ?>        
                    @endforeach
                    <td>{{$dataJadwal->tempatLatihan}}</td>
                                 
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach                 
                
            </tbody>
        </table>
    </div>
</div>
@endsection
