<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Anggota;

use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user-views.dashboard');
    }

    public function formulir()
    {
        return view('user-views.formulir-anggota');
    }


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
            Session::flash('sukses', $request->nama);
            return redirect()->route('user.formulir');           

        } catch (QueryException $e) {                                 
            Session::flash('gagal', $e->errorInfo);
            return redirect()->route('user.formulir');  
        }
    }

    public function store(Request $request)
    {
        
    }

    public function daftarAnggota($usia)
    {
        $data = Anggota::where('kelompokUsia', $usia)->orderBy('id', 'DESC')->get();
        
        return view('user-views.daftar-anggota',['usia' => $usia, 'data' => $data]);
        // return view('page.muzakki.index', );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
