<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pelatih;
use App\Models\Jadwal;
use App\Models\Nilai;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Session;
use DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // controller untuk dashboard admin
    public function index()
    {        
        return view('admin-views.dashboard');
    }

    // controller untuk menampilkan data anggota -sisi admin
    public function anggota($usia)
    {
        if ($usia) {
            $data = Anggota::where('kelompokUsia', $usia)->orderBy('id', 'DESC')->get();
            $keterangan = "Usia". $usia ."Tahun";
            return view('admin-views.anggota-index',['keterangan' => $keterangan, 'data' => $data]);
        } else {
            $data = Anggota::select()->orderBy('id', 'DESC')->get();  
            $keterangan = "Semua Usia";
            return view('admin-views.anggota-index',['keterangan' => $keterangan, 'data' => $data]);       
        }        
    }


    // controller untuk menampilkan data pelatih -sisi admin
    public function pelatih()
    {
        $data = Pelatih::orderBy('id', 'DESC')->get();
        return view('admin-views.pelatih-index', ['data' => $data]);
    }

    // controller untuk menampilkan form menambah data pelatih -sisi admin
    public function pelatihTambah()
    {
        return view('admin-views.pelatih-tambah');
    }

    // controller untuk menambah data pelatih ke database -sisi admin
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
            Session::flash('sukses','Data Pelatih ' . $request->namaPelatih. 'BERHASIL dibuat');
            return redirect()->route('admin.pelatih.tambah');       
        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('admin.pelatih.tambah');  
        }
    }

    // controller untuk menampilkan form edit data pelatih -sisi admin
    public function pelatihEdit($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('admin-views.pelatih-edit',['pelatih'=>$pelatih]);        
    }

    // controller untuk mengupdate data pelatih ke database-sisi admin
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
            Session::flash('sukses', 'Data pelatih '.$pelatih->namaPelatih.' telah berhasil DIUPDATE');
            return redirect()->route('admin.pelatih',);  
        } catch (QueryException $e) {                                 
            Session::flash('gagal', 'Terjadi kesalahan : '. $e->errorInfo);
            return redirect()->route('admin.pelatih');  
        }
    }

    // controller untuk menghapus data pelatih dari database-sisi admin
    public function pelatihDestroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $nama = $pelatih->namaPelatih;
        $pelatih->delete();

        Session::flash('sukses', 'Data pelatih '.$nama.' telah berhasil DIHAPUS');
        return redirect()->route('admin.pelatih', ['nama'=>$nama]);          
    }

    // controller untuk menampilkan jadwal latihan-sisi admin
    public function jadwal()
    {        
        $jadwal = Jadwal::query()
                ->join('pelatihs','pelatihs.id','=','namaPelatih_id')
                ->select('pelatihs.namaPelatih',
                        'jadwals.kelompokUsia','jadwals.id','jadwals.tempatLatihan','jadwals.hariLatihan','jadwals.jamLatihan')  
                ->orderBy('jadwals.id', 'DESC')                      
                ->get();    

        return view('admin-views.jadwal-index', ['jadwal'=>$jadwal]);
    }

    // controller untuk menampilkan tambah jadwal latihan-sisi admin
    public function jadwalTambah()
    {        
        $pelatih = Pelatih::query()
                ->select('id','namaPelatih')
                ->get();    

        return view('admin-views.jadwal-tambah', ['pelatih'=>$pelatih]);
    }
    
    // controller untuk menambahkan data jadwal latihan ke database -sisi admin
    public function jadwalStore(Request $request)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [            
            'namaPelatih'=> ['required'],
            'kelompokUsia'=> ['required'], 
            'tempatLatihan'=> ['required'], 
            'hariLatihan'=> ['required'],
            'jamLatihan'=> ['required'],            
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.jadwal.tambah');

        }

        // proses input data ke database
        try {            
            $jadwal = Jadwal::create([                
                'namaPelatih_id'=> $request->namaPelatih,
                'kelompokUsia'=> $request->kelompokUsia, 
                'tempatLatihan'=> $request->tempatLatihan, 
                'hariLatihan'=> $request->hariLatihan,
                'jamLatihan'=> $request->jamLatihan,
            ]);       
            Session::flash('sukses', 'Jadwal Hari ' . $request->hariLatihan .' Jam '. $request->jamLatihan. ' BERHASIL dibuat.');
            return redirect()->route('admin.jadwal');           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('admin.jadwal.tambah');  
        }
    }

    // controller untuk menampilkan form edit jadwal latihan -sisi admin
    public function jadwalEdit($id)
    {

        $pelatih = Pelatih::query()
                ->select('id','namaPelatih')
                ->get();    
        $jadwal = Jadwal::findOrFail($id);
        return view('admin-views.jadwal-edit',['jadwal'=>$jadwal,'pelatih'=>$pelatih]);        
    }

    // controller untuk mengupdate data jadwal latihan ke database -sisi admin
    public function jadwalUpdate(Request $request, $id)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [       
            'namaPelatih'=> ['required'],
            'kelompokUsia'=> ['required'], 
            'tempatLatihan'=> ['required'], 
            'hariLatihan'=> ['required'],
            'jamLatihan'=> ['required'],       
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.jadwal.edit');

        }

        // proses input data ke database
        try {
            $jadwal = Jadwal::findOrFail($id);   

            $jadwal->namaPelatih_id = $request->namaPelatih;
            $jadwal->kelompokUsia = $request->kelompokUsia; 
            $jadwal->tempatLatihan = $request->tempatLatihan; 
            $jadwal->hariLatihan = $request->hariLatihan;
            $jadwal->jamLatihan = $request->jamLatihan;

            $jadwal->save();

            Session::flash('sukses', 'Jadwal Hari ' . $request->hariLatihan .' Jam '. $request->jamLatihan. ' telah DIUPDATE.');
            return redirect()->route('admin.jadwal');         

        } catch (QueryException $e) {                                 
            Session::flash('gagal', 'Terjadi kesalahan : '. $e->errorInfo);
            return redirect()->route('admin.jadwal');  
        }
    }

    // controller untuk menghapus data jadwal latihan dari database -sisi admin
    public function jadwalDestroy($id)
    {
        $pelatih = Jadwal::findOrFail($id);
        $pelatih->delete();
                    
        Session::flash('sukses', 'Jadwal latihan telah berhasil dihapus');
        return redirect()->route('admin.jadwal');          
    }

    
    // controller untuk menampilkan data nilai -sisi admin
    public function nilai()
    {
        $nilai = Nilai::query()
                ->join('anggotas','anggotas.id','=','anggota_id')
                ->select('anggotas.nama','anggotas.kelompokUsia',
                        'nilais.id','nilais.passingAtas','nilais.passingBawah','nilais.blocking','nilais.servis','nilais.rataRata')  
                ->orderBy('anggotas.kelompokUsia', 'ASC')                      
                ->get();   
        return view('admin-views.nilai-index',['nilai' => $nilai]);
    }
    
    // controller untuk menampilkan form tambah data nilai -sisi admin
    public function nilaiTambah($usia)
    {        
        $anggota = Anggota::where('kelompokUsia', $usia)->orderBy('id', 'ASC')->get();

        return view('admin-views.nilai-tambah', ['anggota'=>$anggota, 'usia'=>$usia]);
    }
    
    // controller untuk menambah data nilai ke databaase -sisi admin
    public function nilaiStore(Request $request)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [           
            'anggota_id'=> ['required'],
            'passingAtas'=> ['required'], 
            'passingBawah'=> ['required'], 
            'blocking'=> ['required'],
            'servis'=> ['required'],            
            'rataRata'=> ['required'],            
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.nilai.tambah');

        }

        // proses input data ke database
        try {            
            $jadwal = Nilai::create([                
                'anggota_id'=> $request->anggota_id,
                'passingAtas'=> $request->passingAtas, 
                'passingBawah'=> $request->passingBawah, 
                'blocking'=> $request->blocking,
                'servis'=> $request->servis,
                'rataRata'=> $request->rataRata,
            ]);       
            $anggota = Anggota::findOrFail($request->anggota_id);

            Session::flash('sukses', "Penilaian atas nama ". $anggota->nama . " telah BERHASIL dilakukan.");
            return redirect()->route('admin.nilai');           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('admin.nilai.tambah');  
        }
    }
    
    // controller untuk menampilkan form edit data nilai -sisi admin
    public function nilaiEdit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $anggota = Anggota::findOrFail($nilai->anggota_id);

        return view('admin-views.nilai-edit',['nilai'=>$nilai,'anggota'=>$anggota]);        
    }

    // controller untuk update data nilai ke database -sisi admin
    public function nilaiUpdate(Request $request, $id)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [    
            'passingAtas'=> ['required'], 
            'passingBawah'=> ['required'], 
            'blocking'=> ['required'],
            'servis'=> ['required'],            
            'rataRata'=> ['required'],            
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai'.$validator->errors());
            return redirect()->route('admin.nilai.edit');
        }

        // proses input data ke database
        try {
            $nilai = Nilai::findOrFail($id);   
            $nilai->passingAtas = $request->passingAtas;
            $nilai->passingBawah = $request->passingBawah; 
            $nilai->blocking = $request->blocking; 
            $nilai->servis = $request->servis;
            $nilai->rataRata = $request->rataRata;
            $nilai->save();
            $nilai = Nilai::findOrFail($id);
            $anggota = Anggota::findOrFail($nilai->anggota_id);
            Session::flash('sukses', "Penilaian atas nama ". $anggota->nama . " telah DIUPDATE");
            return redirect()->route('admin.nilai');         

        } catch (QueryException $e) {                                 
            Session::flash('gagal', 'Terjadi kesalahan : '. $e->errorInfo);
            return redirect()->route('admin.nilai');  
        }
    }

    // controller untuk menghapus data nilai dari database -sisi admin
    public function nilaiDestroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $anggota = Anggota::findOrFail($nilai->anggota_id);
        $nilai->delete();
                    
        Session::flash('sukses', "Penilaian atas nama ". $anggota->nama . " telah DIHAPUS.");
        return redirect()->route('admin.nilai');          
    }

    public function dataTableNilai()
    {
        $model = Nilai::query()
            ->join('anggotas','anggotas.id','=','anggota_id')
            ->select('anggotas.nama','anggotas.kelompokUsia',
                    'nilais.id','nilais.passingAtas','nilais.passingBawah','nilais.blocking','nilais.servis','nilais.rataRata')  
            ->orderBy('anggotas.kelompokUsia', 'ASC')                      
            ->get();   
        return DataTables::of($model)
            ->addIndexColumn()

        // $nilai = DB::table('nilais')->select('*');
        // return datatables()->of($nilai)
            ->make(true);
    }
}
