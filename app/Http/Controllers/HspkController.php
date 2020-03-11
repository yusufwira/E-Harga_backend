<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Hspk;
use App\HspkSsh;
use App\HspkSbu;


class HspkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hspk::all();
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);
    }

    public function search(Request $request)
    {
        $data =  DB::select("SELECT * FROM hspk where nama like '%".$request->get('keyword')."%'");
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);
    }

    public function indexlimit(Request $request)
    {
        $data = Hspk::skip( $request->get('page'))->take($request->get('pageSize'))->get();
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

        if($request->get('pilihan') == 'A'){
            $data = new Hspk();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->profit =$request->get('profit'); 
            $data->status = "Pending";     
            $data->save();
        }
        elseif($request->get('pilihan') == 'B'){
             $ssh_id = $request['ssh_id'];
             $ssh_jumlah = $request['ssh_jumlah'];

                $data = new Hspk();
                $data->kode = $request->get('kode');
                $data->nama = $request->get('nama');
                $data->satuan = $request->get('satuan');
                $data->tag_pencarian =$request->get('tag');   
                $data->profit =$request->get('profit');
                $data->status = "Pending";       
                $data->save();    

                
                for ($i=0; $i <sizeof($ssh_id) ; $i++) { 
                     $datassh = new HspkSsh();
                     $datassh->hspk_id = $data->id;
                     $datassh->ssh_id = $ssh_id[$i];
                     $datassh->jumlah = $ssh_jumlah[$i];
                     $datassh->save();   
                }

        }
        elseif ($request->get('pilihan') == 'C') {
            $sbu_id = $request['sbu_id'];
            $sbu_jumlah = $request['sbu_jumlah'];

            $data = new Hspk();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->profit =$request->get('profit'); 
            $data->status = "Pending";      
            $data->save();

            for ($i=0; $i <sizeof($sbu_id) ; $i++) { 
             $datasbu = new HspkSbu();
             $datasbu->hspk_id = $data->id;
             $datasbu->sbu_id = $sbu_id[$i];
             $datasbu->jumlah = $sbu_jumlah[$i];
             $datasbu->save();   
            }
        }
        else{

             $ssh_id = $request['ssh_id'];
             $sbu_id = $request['sbu_id'];
             $ssh_jumlah = $request['ssh_jumlah'];
             $sbu_jumlah = $request['sbu_jumlah'];


            $data = new Hspk();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->profit =$request->get('profit');
            $data->status = "Pending";       
            $data->save();    

            
            for ($i=0; $i <sizeof($ssh_id) ; $i++) { 
                 $datassh = new HspkSsh();
                 $datassh->hspk_id = $data->id;
                 $datassh->ssh_id = $ssh_id[$i];
                 $datassh->jumlah = $ssh_jumlah[$i];
                 $datassh->save();   
            }  

             
            for ($i=0; $i <sizeof($sbu_id) ; $i++) { 
                 $datasbu = new HspkSbu();
                 $datasbu->hspk_id = $data->id;
                 $datasbu->sbu_id = $sbu_id[$i];
                 $datasbu->jumlah = $sbu_jumlah[$i];
                 $datasbu->save();   
            }

        }

        return response()->json("sukses");
    }

    public function storessh(Request $request){
        $ssh_id = $request['ssh_id'];
        $ssh_jumlah = $request['ssh_jumlah'];

        for ($i=0; $i <sizeof($ssh_id) ; $i++) { 
                     $datassh = new HspkSsh();
                     $datassh->hspk_id = $request->get('id');
                     $datassh->ssh_id = $ssh_id[$i];
                     $datassh->jumlah = $ssh_jumlah[$i];
                     $datassh->save();   
                }
        return response()->json("sukses");
    }

    public function storesbu(Request $request){
        $sbu_id = $request['sbu_id'];
        $sbu_jumlah = $request['sbu_jumlah'];

        for ($i=0; $i <sizeof($sbu_id) ; $i++) { 
                 $datasbu = new HspkSbu();
                 $datasbu->hspk_id = $request->get('id');
                 $datasbu->sbu_id = $sbu_id[$i];
                 $datasbu->jumlah = $sbu_jumlah[$i];
                 $datasbu->save();   
            }
        return response()->json("sukses");
       
    }

    public function updateHarga(Request $request){
        $harga =$request['harga_total'];
        $data = Hspk::whereid($request->get('id'))->firstOrFail();
        $data->harga_total = $harga;
        $data->save();
        return response()->json("sukses");

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

         $dataHSPK = Hspk::whereid($id)->firstOrFail();

         $dataSSH = $posts = DB::select("SELECT * FROM hspk as h inner join hspk_ssh as hs on h.id = hspk_id inner join ssh as s on s.id=ssh_id where h.id =".$id);
          $dataSBU = $posts = DB::select("SELECT * FROM hspk as h inner join hspk_sbu as hb on h.id = hspk_id inner join sbu as b on b.id=sbu_id where h.id =".$id);

          $data[0]=$dataSSH;
          $data[1]=$dataSBU;
          $data[2]=$dataHSPK;
         
         echo json_encode($data);
    }

    public function showCount()
    {
        $dataTerverivikasi = DB::select("SELECT count(*) FROM hspk where status='Terverivikasi'");
        $dataTertolak = DB::select("SELECT count(*) FROM hspk where status='Tertolak'");
        $dataProses = DB::select("SELECT count(*) FROM hspk where status='Proses'");
        $dataPending = DB::select("SELECT count(*) FROM hspk where status='Pending'");
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
           
         if($request->get('pilihan') == 'A'){
            $data = Hspk::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');
            $data->profit =$request->get('profit');           
            $data->save();
           
         }
         elseif ($request->get('pilihan') == 'B') {

            $ssh_id = $request['ssh_id'];
            $ssh_jumlah = $request['ssh_jumlah'];

            $data = Hspk::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');
            $data->profit =$request->get('profit');           
            $data->save();

            for ($i=0; $i <sizeof($ssh_id) ; $i++) {             
                $datassh=HspkSsh::where(['hspk_id'=>$request->get('id'),'ssh_id'=>$ssh_id[$i]])->update(['jumlah'=>$ssh_jumlah[$i]]);                          
            }

          
         }
         elseif ($request->get('pilihan') == 'C') {

            $sbu_id = $request['sbu_id'];
            $sbu_jumlah = $request['sbu_jumlah'];

            $data = Hspk::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');
            $data->profit =$request->get('profit');           
            $data->save();

            for ($i=0; $i <sizeof($sbu_id) ; $i++) { 
             $datasbu=HspkSbu::where(['hspk_id'=>$request->get('id'),'sbu_id'=>$sbu_id[$i]])->update(['jumlah'=>$sbu_jumlah[$i]]);                         
            }

           
             
         }
         else{

             $ssh_id = $request['ssh_id'];
             $sbu_id = $request['sbu_id'];
             $ssh_jumlah = $request['ssh_jumlah'];
             $sbu_jumlah = $request['sbu_jumlah'];

            $data = Hspk::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');
            $data->profit =$request->get('profit');           
            $data->save();

             for ($i=0; $i <sizeof($ssh_id) ; $i++) {             
                 $datassh=HspkSsh::where(['hspk_id'=>$request->get('id'),'ssh_id'=>$ssh_id[$i]])->update(['jumlah'=>$ssh_jumlah[$i]]);                          
            }  

             
            for ($i=0; $i <sizeof($sbu_id) ; $i++) { 
                 $datasbu=HspkSbu::where(['hspk_id'=>$request->get('id'),'sbu_id'=>$sbu_id[$i]])->update(['jumlah'=>$sbu_jumlah[$i]]);                         
            }             

         }

         return response()->json('Sukses');
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

        // $dataSSH =  DB::delete("DELETE FROM hspk_ssh where hspk_id =".$request->get('id'))
        // $dataSBU =  DB::delete("DELETE FROM hspk_sbu where hspk_id =".$request->get('id'))

        HspkSsh::where('hspk_id', $request->get('id'))->delete();
        HspkSbu::where('hspk_id', $request->get('id'))->delete();
        //$datassh = HspkSsh::wherehspk_id($request->get('id'))->firstOrFail();
        // $datassh->delete();

        // $datasbu = HspkSbu::wherehspk_id($request->get('id'))->firstOrFail();
        // $datasbu->delete();

        $data = Hspk::whereid($request->get('id'))->firstOrFail();
        $data->delete();
        return response()->json('sukses');
    }
}
