<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UsulanBaru;
use App\Notifikasi;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Notifikasi::all();
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);

    }

     public function tampilkan(Request $request)
    {
        $data = DB::select("SELECT * FROM notifikasi as n inner join usulan as u on n.usulan_id=u.id where u.dinas ='".$request->get('dinas')."'");
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
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

        $data = new Notifikasi();
        $data->isi_notif = $request->get('isi');
        $data->tipe_notif = $request->get('tipe');
        $data->usulan_id =$request->get('usulan_id');
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
