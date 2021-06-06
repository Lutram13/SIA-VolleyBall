@extends('layouts.admin')
   
@section('content-admin')
<div class="card">
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
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button type="button" class="btn btn-secondary btn-sm">Hapus</button>
                            </div>
                        </div>
                    </div>       
                </div>             
            @endforeach


        </div>
    </div>
</div>



@endsection