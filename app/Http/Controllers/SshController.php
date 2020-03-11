<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ssh;


class SshController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ssh::all();
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);       
    }

    public function search(Request $request)
    {
        $data =  DB::select("SELECT * FROM ssh where nama like '%".$request->get('keyword')."%'");
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        echo $request->get('nama');
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
     
       // return response()->json($request);
        $data = new Ssh();
        $data->kode = $request->get('kode');
        $data->nama = $request->get('nama');
        $data->merk = $request->get('merk');
        $data->spek = $request->get('spek');
        $data->satuan =$request->get('satuan');
        $data->tag_pencarian = $request->get('tag');
        $data->status = '';

        $data->nama_toko_survey1 =$request->get('namaTokoS1');
        $data->merk_survey1 = $request->get('merkS1');
        $data->harga_survey1 = $request->get('hargaS1');
        $data->keterangan_survey1 =$request->get('keteranganS1');
        $data->file_survey1 ='';

        $data->nama_toko_survey2 = $request->get('namaTokoS2');
        $data->merk_survey2 = $request->get('merkS2');
        $data->harga_survey2 = $request->get('hargaS2');
        $data->keterangan_survey2 =$request->get('keteranganS2');
        $data->file_survey2 ='';

        $data->nama_toko_survey3 =$request->get('namaTokoS3');
        $data->merk_survey3 =$request->get('merkS3');
        $data->harga_survey3 =$request->get('hargaS3');
        $data->keterangan_survey3 =$request->get('keteranganS3');
        $data->file_survey3 ='';

        $data->nama_toko_survey4 = $request->get('namaTokoS4');
        $data->merk_survey4 = $request->get('merkS4');
        $data->harga_survey4 = $request->get('hargaS4');
        $data->keterangan_survey4 =$request->get('keteranganS4');
        $data->file_survey4 ='';

        $data->harga_final =$request->get('hargaFinal');
        $data->alasan =$request->get('alasan');
        $data->file_alasan ='';
        $data->save();

       return response()->json('Sukses');


     
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



        //echo json_encode($id);
        $data = Ssh::wherekode($id)->firstOrFail();
        //$data = Ssh::where('kode','=',$id)->firstOrFail();
        echo json_encode($data);
        //return view('berita.show',['berita'=>$beritaModel]);
    }

    public function showCount()
    {
        $dataTerverivikasi = DB::select("SELECT count(*) FROM ssh where status='terverivikasi'");
        $dataTertolak = DB::select("SELECT count(*) FROM ssh where status='tertolak'");
        $dataProses = DB::select("SELECT count(*) FROM ssh where status='proses'");
        $dataPending = DB::select("SELECT count(*) FROM ssh where status='pending'");
        $data[0] = $dataTerverivikasi;
        $data[1] = $dataTertolak;
        $data[2] = $dataProses;
        $data[3] = $dataPending;
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
        //echo json_encode('haiii');
        $data = Ssh::wherekode($request->get('kode'))->firstOrFail();
        $data->kode = $request->get('kode');
        $data->nama = $request->get('nama');
        $data->merk = $request->get('merk');
        $data->spek = $request->get('spek');
        $data->satuan =$request->get('satuan');
        $data->tag_pencarian = $request->get('tag');
        $data->status = '';

        $data->nama_toko_survey1 =$request->get('namaTokoS1');
        $data->merk_survey1 = $request->get('merkS1');
        $data->harga_survey1 = $request->get('hargaS1');
        $data->keterangan_survey1 =$request->get('keteranganS1');
        $data->file_survey1 ='';

        $data->nama_toko_survey2 = $request->get('namaTokoS2');
        $data->merk_survey2 = $request->get('merkS2');
        $data->harga_survey2 = $request->get('hargaS2');
        $data->keterangan_survey2 =$request->get('keteranganS2');
        $data->file_survey2 ='';

        $data->nama_toko_survey3 =$request->get('namaTokoS3');
        $data->merk_survey3 =$request->get('merkS3');
        $data->harga_survey3 =$request->get('hargaS3');
        $data->keterangan_survey3 =$request->get('keteranganS3');
        $data->file_survey3 ='';

        $data->nama_toko_survey4 = $request->get('namaTokoS4');
        $data->merk_survey4 = $request->get('merkS4');
        $data->harga_survey4 = $request->get('hargaS4');
        $data->keterangan_survey4 =$request->get('keteranganS4');
        $data->file_survey4 ='';

        $data->harga_final =$request->get('hargaFinal');
        $data->alasan =$request->get('alasan');
        $data->file_alasan ='';
        $data->save();
        //echo json_encode($request->get('kode'));
         echo json_encode('sukses');
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
        $data = Ssh::wherekode($request->get('kode'))->firstOrFail();
        $data->delete();
        return response()->json('sukses');
    }
}
