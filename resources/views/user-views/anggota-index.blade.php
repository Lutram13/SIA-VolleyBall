@extends('layouts.user')

@section('pageHeader', 'Daftar Anggota '.$keterangan.' Klub Bola Voli Tunas')

@section('content-user')

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

<div class="mt-n4 mb-4">
    <a class="btn btn-primary" href={{route('user.anggota',12)}} role="button">Usia 12 Tahun</a>
    <a class="btn btn-primary" href={{route('user.anggota',15)}} role="button">Usia 15 Tahun</a>
    <a class="btn btn-primary" href={{route('user.anggota',17)}} role="button">Usia 17 Tahun</a>   
    <a class="btn btn-primary" href={{route('user.anggota',0)}} role="button">Semua Usia</a> 
</div>
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
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php $nomor=1 ?>
                @foreach ($anggota as $data)
                    <tr>
                    <th scope="row">{{$nomor}}</th>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->alamat}}</td>
                    <td>{{$data->tempatLahir}}, {{$data->tanggalLahir}}</td>
                    <td>{{$data->kelompokUsia}} Tahun</td>
                    <td>                               
                        <form action="{{ route('user.anggota.destroy',$data->id) }}" method="POST">              
                            @csrf
                            @method('DELETE')
                            <a href={{route('user.anggota.edit',$data->id)}} class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data {{$data->nama}} ?')"><i class="bi bi-trash"></i></button>
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
