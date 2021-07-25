<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Jadwal;
use App\Models\Pelatih;
use App\Models\Nilai;

use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // controller untuk dashboard user 
    public function index()
    {
        return view('user-views.dashboard');
    }

    // controller untuk menampilkan formulir pendaftaran -sisi user
    public function formulir()
    {
        return view('user-views.formulir-anggota');
    }


    // controller untuk menyimpan data pendaftaran ke database -sisi user
    public function formulirStore(Request $request)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'nama'=> ['required'],
            'alamat'=> ['required'], 
            'tempatLahir'=> ['required'],
            'tanggalLahir'=> ['required', 'date'],
            'umur'=> ['required', 'numeric'],
            'pendidikan'=> ['required'],
            'tinggiBadan'=> ['required', 'numeric'],
            'beratBadan'=> ['required', 'numeric'],
            'kelompokUsia'=> ['required'],
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai');
            return redirect()->route('user.formulir');

        }

        // proses input data ke database
        try {
            $anggota = Anggota::create($request->all());       

            Session::flash('sukses','Data anggota atas nama ' . $request->nama. 'BERHASIL dibuat.');

            return redirect()->route('user.anggota',0);           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('user.formulir');  
        }
    }


    // controller untuk menampilkan data anggota -sisi user
    public function anggota($usia)
    {
        if ($usia) {
            $anggota = Anggota::where('kelompokUsia', $usia)->orderBy('id', 'DESC')->get();
            $keterangan = "Usia ". $usia ." Tahun";
            return view('user-views.anggota-index',['keterangan' => $keterangan, 'anggota' => $anggota]);
        } else {
            $anggota = Anggota::select()->orderBy('id', 'DESC')->get();  
            $keterangan = "Semua Usia";
            return view('user-views.anggota-index',['keterangan' => $keterangan, 'anggota' => $anggota]);       
        } 
    }

    // controller untuk menampilkan form edit data anggota -sisi user
    public function anggotaEdit($id)
    {        
        $anggota = Anggota::findOrFail($id);
        return view('user-views.anggota-edit',['anggota'=>$anggota]);    
    }

    // controller untuk mengupdate data anggota ke database -sisi user
    public function anggotaUpdate(Request $request, $id)
    {
        // validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'nama'=> ['required'],
            'alamat'=> ['required'], 
            'tempatLahir'=> ['required'],
            'tanggalLahir'=> ['required', 'date'],
            'umur'=> ['required', 'numeric'],
            'pendidikan'=> ['required'],
            'tinggiBadan'=> ['required', 'numeric'],
            'beratBadan'=> ['required', 'numeric'],
            'kelompokUsia'=> ['required'],
        ]);

        // tindakan jika tipe data yang masuk tidak sesuai
        if($validator->fails()){
            Session::flash('peringatan','Data yang diinputkan tidak sesuai');
            return redirect()->route('user.formulir');

        }

        // proses input data ke database
        try {            
            $anggota = Anggota::findOrFail($id);

            $anggota->nama = $request->nama;
            $anggota->alamat = $request->alamat; 
            $anggota->tempatLahir = $request->tempatLahir; 
            $anggota->tanggalLahir = $request->tanggalLahir;
            $anggota->umur = $request->umur;
            $anggota->pendidikan = $request->pendidikan;      
            $anggota->tinggiBadan = $request->tinggiBadan;      
            $anggota->beratBadan = $request->beratBadan;      
            $anggota->kelompokUsia = $request->kelompokUsia;      
            $anggota->save();

            Session::flash('sukses','Data anggota atas nama ' . $request->nama. ' telah berhasil DIUPDATE.');

            return redirect()->route('user.anggota',0);           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('user.formulir');  
        }
    }

    // controller untuk menghapus data anggota dari database -sisi user
    public function anggotaDestroy($id)
    {
        
        $anggota = Anggota::findOrFail($id);
        $nama = $anggota->nama;
        $anggota->delete();

        Session::flash('sukses', 'Data anggota '.$nama.' telah berhasil DIHAPUS');
        return redirect()->route('user.anggota',0);      
    }

    // controller untuk menampilkan jadwal -sisi user
    public function jadwal($usia)
    {
        
        if ($usia) {
            $keterangan = 'Usia '.$usia.' Tahun';
            $jadwal = Jadwal::query()
                    ->where('jadwals.kelompokUsia','=',$usia)
                    ->join('pelatihs','pelatihs.id','=','namaPelatih_id')
                    ->select('pelatihs.namaPelatih',
                            'jadwals.kelompokUsia','jadwals.id','jadwals.tempatLatihan','jadwals.hariLatihan','jadwals.jamLatihan')  
                    ->orderBy('jadwals.id', 'DESC')                      
                    ->get();    
    
            return view('user-views.jadwal-index', ['jadwal'=>$jadwal, 'keterangan'=>$keterangan]);  
        } else {
            $keterangan = 'Semua Usia';
            $jadwal = Jadwal::query()
                    ->join('pelatihs','pelatihs.id','=','namaPelatih_id')
                    ->select('pelatihs.namaPelatih',
                            'jadwals.kelompokUsia','jadwals.id','jadwals.tempatLatihan','jadwals.hariLatihan','jadwals.jamLatihan')  
                    ->orderBy('jadwals.id', 'DESC')                      
                    ->get();    
    
            return view('user-views.jadwal-index', ['jadwal'=>$jadwal, 'keterangan'=>$keterangan]);  
        } 
    }
    
    // controller untuk menampilkan pelatih -sisi user
    public function pelatih()
    {
        $data = Pelatih::orderBy('id', 'DESC')->get();
        return view('user-views.pelatih-index', ['data' => $data]);
    }

    // controller untuk menampilkan nilai -sisi user
    public function nilai($usia)
    {
        if ($usia) {
            $keterangan = 'Usia '.$usia.' Tahun';
            $nilai = Nilai::query()
                    ->join('anggotas','anggotas.id','=','anggota_id')
                    ->select('anggotas.nama','anggotas.kelompokUsia',
                            'nilais.id','nilais.passingAtas','nilais.passingBawah','nilais.blocking','nilais.servis','nilais.rataRata')  
                    ->where('anggotas.kelompokUsia','=',$usia)   
                    ->orderBy('anggotas.kelompokUsia', 'ASC')                      
                    ->get();   
            return view('user-views.nilai-index',['nilai' => $nilai, 'keterangan'=>$keterangan]); 
        } else {
            $keterangan = 'Semua Usia';
            $nilai = Nilai::query()
                    ->join('anggotas','anggotas.id','=','anggota_id')
                    ->select('anggotas.nama','anggotas.kelompokUsia',
                            'nilais.id','nilais.passingAtas','nilais.passingBawah','nilais.blocking','nilais.servis','nilais.rataRata')  
                    ->orderBy('anggotas.kelompokUsia', 'ASC')                      
                    ->get();   
            return view('user-views.nilai-index',['nilai' => $nilai, 'keterangan'=>$keterangan]);  
        } 
    }
}
