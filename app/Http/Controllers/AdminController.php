<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pelatih;

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

    public function create()
    {
        //
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
