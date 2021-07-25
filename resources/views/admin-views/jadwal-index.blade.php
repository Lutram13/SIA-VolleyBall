@extends('layouts.admin')
   
@section('content-admin')

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
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h5>Jadwal Latihan PBV.Tunas Banyumanik</h5>
            </div>
            <div class="col-md-4 d-md-flex justify-content-md-end btn-sm">
                <a href={{route('admin.jadwal.tambah')}} class="btn btn-primary" role="button">Tambah Jadwal Latihan</a>
            </div>
        </div>
    </div>
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
                <th scope="col">Aksi</th>
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
                    <td>           
                        <form action="{{ route('admin.jadwal.destroy',$dataJadwal->id) }}" method="POST">              
                            @csrf
                            @method('DELETE')
                            <a href={{route('admin.jadwal.edit',$dataJadwal->id)}} class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Jadwal Latihan {{$dataJadwal->namaPelatih}} ?')"><i class="bi bi-trash"></i></button>
                        </form>                        
                        
                    </td>                    
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach                 
                
            </tbody>
          </table>
    </div>
</div>



@endsection