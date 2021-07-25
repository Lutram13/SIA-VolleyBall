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


<div class="mt-n4 mb-4">
    <a class="btn btn-primary" href={{route('admin.nilai.tambah',12)}} role="button">Tambah Nilai Usia 12 Tahun</a>
    <a class="btn btn-primary" href={{route('admin.nilai.tambah',15)}} role="button">Tambah Nilai Usia 15 Tahun</a>
    <a class="btn btn-primary" href={{route('admin.nilai.tambah',17)}} role="button">Tambah Nilai Usia 17 Tahun</a>    
</div>

<div class="card">
    <div class="card-header">
        <h5>Daftar Nilai Klub Bola Voli Tunas </h5>
    </div>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelompok Usia</th>
                    <th>Passing Atas</th>
                    <th>Passing Bawah</th>
                    <th>Blocking</th>
                    <th>Servis</th>
                    <th>Rata-Rata</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>  
            <tbody>
            </tbody>          
        </table>



        {{-- <table class="table table-bordered">
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
                <th scope="col">Aksi</th>
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
                    <td>                               
                        <form action="{{ route('admin.nilai.destroy',$data->id) }}" method="POST">              
                            @csrf
                            @method('DELETE')
                            <a href={{route('admin.nilai.edit',$data->id)}} class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus Nilai {{$data->nama}} ?')"><i class="bi bi-trash"></i></button>
                        </form>     
                    </td>
                    </tr>                         
                    <?php $nomor++ ?>               
                @endforeach              
            </tbody>
          </table> --}}
    </div>
</div>



@endsection


@push('script')
<script>    
$(document).ready(function(){
    pTable=$('#datatable').DataTable({
        language: {            
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json'            
        },        
        responsive: true,
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: "{{ route('admin.nilai.datatable') }}",
        columns: [                  
            {data: 'DT_RowIndex', name: 'id'},
            // {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama'},
            {data: 'kelompokUsia', name: 'kelompokUsia'},
            {data: 'passingAtas', name: 'passingAtas'},
            {data: 'passingBawah', name: 'passingBawah'},
            {data: 'blocking', name: 'blocking'},
            {data: 'servis', name: 'servis'},
            {data: 'rataRata', name: 'rataRata'}
        ]
    });
    
    //Untuk membuat select row
    $('#datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            pTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#button').click( function () {
        pTable.row('.selected').remove().draw( false );
    } );

});
</script>

@endpush 