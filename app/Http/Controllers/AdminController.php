<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pelatih;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {        
        return view('admin-views.dashboard');
    }

    public function daftarAnggota($usia)
    {
        $data = Anggota::where('kelompokUsia', $usia)->orderBy('id', 'DESC')->get();
        
        return view('admin-views.daftar-anggota',['usia' => $usia, 'data' => $data]);
        // return view('page.muzakki.index', );
    }

    public function pelatih()
    {
        $data = Pelatih::orderBy('id', 'DESC')->get();

        return view('admin-views.pelatih-index', ['data' => $data]);

    }

    public function pelatihTambah()
    {
        return view('admin-views.pelatih-tambah');
    }

    public function pelatihStore(Request $request)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'namaPelatih'=> ['required','max:255'],
            'alamat'=> ['required'], 
            'nomorTelepon'=> ['required'], 
            'tempatLahir'=> ['required'],
            'tanggalLahir'=> ['required', 'date'],
            'kelompokUsia'=> ['required'],
            'image'=> ['mimes:jpg,bmp,png'],
            
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.pelatih.tambah');

        }

        // proses input data ke database
        try {
            $tanggal = date('d-m-Y');
            $file = $request->file('image');
    
            // membuat nama file unik
            $nama_file = $tanggal.'_'.$file->getClientOriginalName();
    
            // upload ke folder image di dalam folder public
            $file->move('images/pelatih',$nama_file);
            
            $pelatih = Pelatih::create([                
                'namaPelatih'=> $request->namaPelatih,
                'alamat'=> $request->alamat, 
                'nomorTelepon'=> $request->nomorTelepon, 
                'tempatLahir'=> $request->tempatLahir,
                'tanggalLahir'=> $request->tanggalLahir,
                'kelompokUsia'=> $request->kelompokUsia,
                'image'=> $nama_file,
            ]);       
            Session::flash('sukses', $request->namaPelatih);
            return redirect()->route('admin.pelatih.tambah');           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('admin.pelatih.tambah');  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function pelatihEdit($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('admin-views.pelatih-edit',['pelatih'=>$pelatih]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pelatihUpdate(Request $request, $id)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'namaPelatih'=> ['required','max:255'],
            'alamat'=> ['required'], 
            'nomorTelepon'=> ['required'], 
            'tempatLahir'=> ['required'],
            'tanggalLahir'=> ['required', 'date'],
            'kelompokUsia'=> ['required'],
            'image'=> ['mimes:jpg,bmp,png'],
            
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.pelatih');

        }

        // proses input data ke database
        try {
            $pelatih = Pelatih::findOrFail($id);

            $pelatih->namaPelatih = $request->namaPelatih;
            $pelatih->alamat = $request->alamat; 
            $pelatih->nomorTelepon = $request->nomorTelepon; 
            $pelatih->tempatLahir = $request->tempatLahir;
            $pelatih->tanggalLahir = $request->tanggalLahir;
            $pelatih->kelompokUsia = $request->kelompokUsia;

            if ($request->image) {                
                $tanggal = date('d-m-Y');
                $file = $request->file('image');
        
                // membuat nama file unik
                $nama_file = $tanggal.'_'.$file->getClientOriginalName();
        
                // upload ke folder image di dalam folder public
                $file->move('images/pelatih',$nama_file);

                $pelatih->image = $nama_file;
            }

            $pelatih->save();
  
            Session::flash('sukses', 'Data pelatih '.$pelatih->namaPelatih.' telah berhasil diupdate');
            return redirect()->route('admin.pelatih',);           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', 'Terjadi kesalahan : '. $e->errorInfo);
            return redirect()->route('admin.pelatih');  
        }
    }

    public function pelatihDestroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $nama = $pelatih->namaPelatih;
        $pelatih->delete();
                    
        Session::flash('sukses', 'Data pelatih '.$nama.' telah berhasil dihapus');
        return redirect()->route('admin.pelatih', ['nama'=>$nama]);          
    }
}
