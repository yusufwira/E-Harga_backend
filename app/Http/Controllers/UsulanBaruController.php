<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UsulanBaru;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class UsulanBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKategori1 = DB::select("SELECT * FROM usulan where kategori='1' ORDER BY id desc");
        $dataKategori2 = DB::select("SELECT * FROM usulan where kategori='2' ORDER BY id desc");
        $dataKategori3 = DB::select("SELECT * FROM usulan where kategori='3' ORDER BY id desc");
        $data[0] = $dataKategori1;
        $data[1] = $dataKategori2;
        $data[2] = $dataKategori3;
        echo json_encode($data);
    }

    public function indexPenyusun()
    {  
        $dataKategori1 = DB::select("SELECT * FROM usulan where kategori='1' and status_admin='Verivikasi' ORDER BY id desc");
        $dataKategori2 = DB::select("SELECT * FROM usulan where kategori='2'and status_admin='Verivikasi' ORDER BY id desc");
        $dataKategori3 = DB::select("SELECT * FROM usulan where kategori='3'and status_admin='Verivikasi' ORDER BY id desc");
        $data[0] = $dataKategori1;
        $data[1] = $dataKategori2;
        $data[2] = $dataKategori3;
        echo json_encode($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
         header('Access-Control-Allow-Origin: *');   
         header('Access-Control-Allow-Headers: *');

         $detailUsulan = json_decode($request->get('detailUsulan'));
         if($request->get('detail') == 'tidak'){
             $data = new UsulanBaru();
             $data->tipe_usulan = $detailUsulan->tipe;
             $data->nama = $detailUsulan->nama;
             $data->merk = $detailUsulan->merk;
             $data->spek = $detailUsulan->spek;
             $data->satuan = $detailUsulan->satuan;
             $data->harga = $detailUsulan->harga;
             $data->referensi = $detailUsulan->refrensi;
             $data->kategori = $detailUsulan->kategori;
             $data->status_admin = 'Pending';
             $data->status_penyusun = 'Pending';
             $data->dinas = $request->get('dinas');
             $data->save();

         }
         else{

             $data = new UsulanBaru();
             $data->tipe_usulan = $detailUsulan->tipe;
             $data->nama = $detailUsulan->nama;
             $data->merk = $detailUsulan->merk;
             $data->spek = $detailUsulan->spek;
             $data->satuan = $detailUsulan->satuan;
             $data->harga = $detailUsulan->harga;
             $data->referensi = $detailUsulan->refrensi;
             $data->kategori = $detailUsulan->kategori;
             $data->status_admin = 'Pending';
             $data->status_penyusun = 'Pending';
             $data->dinas = $request->get('dinas');

             $file = $request->file('file');
             $filename  = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             $path      = $file->storeAs("file_usulanBaru/".$request->get('dinas')."/".$detailUsulan->tipe,$filename);

             $data->nama_file = $filename;          
             $data->path_file = $path;
             $data->save();  

         }
         return json_encode("sukses"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        $data = UsulanBaru::whereid($id)->firstOrFail();
        echo json_encode($data);

    }

    public function showCount()
    {
        $dataKategori1 = DB::select("SELECT count(*) FROM usulan where kategori='1'");
        $dataKategori2 = DB::select("SELECT count(*) FROM usulan where kategori='2'");
        $dataKategori3 = DB::select("SELECT count(*) FROM usulan where kategori='3'");
        $data[0] = $dataKategori1;
        $data[1] = $dataKategori2;
        $data[2] = $dataKategori3;
        echo json_encode($data);
    }

    public function showCountPenyusun()
    {
        $dataKategori1 = DB::select("SELECT count(*) FROM usulan where kategori='1' and status_admin='Verivikasi'");
        $dataKategori2 = DB::select("SELECT count(*) FROM usulan where kategori='2' and status_admin='Verivikasi'");
        $dataKategori3 = DB::select("SELECT count(*) FROM usulan where kategori='3' and status_admin='Verivikasi'");
        $data[0] = $dataKategori1;
        $data[1] = $dataKategori2;
        $data[2] = $dataKategori3;
        echo json_encode($data);
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
    public function update(Request $request)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
     
        $data = UsulanBaru::whereid($request->get('id'))->firstOrFail();
        $data->nama = $request->get('nama');
        $data->merk = $request->get('merk');
        $data->spek = $request->get('spek');
        $data->satuan = $request->get('satuan');
        $data->harga = $request->get('harga');
        $data->status_edit = $request->get('edit');
        $data->save();

        echo json_encode("Sukses");

    }

    public function updateStatus(Request $request)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
     
        $data = UsulanBaru::whereid($request->get('id'))->firstOrFail();

        if($request->get('hak_akses') == "Admin OPD"){
            $data->status_admin = $request->get('status');
            $data->save();
        }
        else{
             $data->status_penyusun = $request->get('status');
             $data->save();
        }
        echo json_encode("Sukses");

       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        $data = UsulanBaru::whereid($request->get('id'))->firstOrFail();
        $data->delete();
        return response()->json('sukses');
    }
}
