<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
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
     

        $data = new User();
        $data->username = $request->get('username');
        $data->password = Hash::make($request->get('password'));
        $data->email = $request->get('email');
        $data->nip =$request->get('nip');
        $data->nama =$request->get('nama');
        $data->no_telp =$request->get('no_telp');
        $data->unit_id =$request->get('unit_id');
        $data->dinas =$request->get('dinas');
        $data->hak_akses =$request->get('hak_akses');
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

        $data = User::whereusername($id)->firstOrFail();
        echo json_encode($data);

    }

    public function showDetail(Request $request)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');

        $data =[];
        if($request->get('hak_akses') == 'Penyusun'){
            $data_admin = DB::select("SELECT * FROM users WHERE hak_akses = 'Admin OPD'");
            $data_operator = DB::select("SELECT * FROM users WHERE hak_akses = 'Operator OPD'");
            $data[0] = $data_admin;
            $data[1] = $data_operator;
        
        }
        else{
            $data_admin = DB::select("SELECT * FROM users WHERE hak_akses = 'Admin OPD'");
            $data_operator = DB::select("SELECT * FROM users WHERE hak_akses = 'Operator OPD' and dinas = '".$request->get('dinas')."'");
            $data[0] = $data_admin;
            $data[1] = $data_operator;
        }
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
     

        $data = User::whereusername($request->get('username'))->firstOrFail();       
        $data->email = $request->get('email');
        $data->nama =$request->get('nama');
        $data->no_telp =$request->get('no_telp');
        $data->save();

       return response()->json('Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        $data = User::wherekode($request->get('kode'))->firstOrFail();
        $data->delete();
        return response()->json('sukses');
    }
}
