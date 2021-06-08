@extends('layouts.admin')
   
@section('content-admin')

    @if ($message = Session::get('sukses'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        {{$message}}  
    </div>
    @endif

    @if ($message = Session::get('gagal'))    
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        {{$message}}
    </div>
    @endif

    @if ($message = Session::get('peringatan'))  
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        {{$message}}     
    </div>
    @endif

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                <h5>Daftar Data Pelatih</h5>
            </div>
            <div class="col-md-2 d-md-flex justify-content-md-end btn-sm">
                <a href={{route('admin.pelatih.tambah')}} class="btn btn-primary" role="button">Tambah Pelatih</a>
            </div>
        </div>
        
    </div>
    <div class="card-body" >
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($data as $pelatih)
                <div class="col">
                    <div class="card h-100">                    
                        <div class="card-header text-center">
                            Pelatih Usia {{$pelatih->kelompokUsia}} Tahun
                        </div>
                        <div class="croping rounded mx-auto d-block mt-2">
                            <img src="/images/pelatih/{{$pelatih->image}}" class="" alt="photo">                            
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$pelatih->namaPelatih}}</h5>
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{$pelatih->alamat}}</td>
                                  </tr>
                                  <tr>
                                    <th>No.Telepon</th>
                                    <td>:</td>
                                    <td>{{$pelatih->nomorTelepon}}</td>
                                  </tr>
                                  <tr>
                                    <th>TTL</th>
                                    <td>:</td>
                                    <?php 
                                        $tanggalLahir = DateTime::createFromFormat('Y-m-d', $pelatih->tanggalLahir);
                                        $formattanggalLahir = $tanggalLahir->format('d M Y');
                                    ?>
                                    <td>{{$pelatih->tempatLahir}}, {{$formattanggalLahir}}</td>
                                  </tr>
                                </tbody>
                            </table>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href={{route('admin.pelatih.edit',$pelatih->id)}} class="btn btn-primary btn-sm" role="button">Edit</a>
                                
                                <form action="{{ route('admin.pelatih.destroy',$pelatih->id) }}" method="POST">              
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelatih {{$pelatih->namaPelatih}} ?')">Hapus</button>
                                </form>

                            </div>
                        </div>
                    </div>       
                </div>             
            @endforeach


        </div>
    </div>
</div>



@endsection