<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Asb;
use App\AsbHspk;
use App\AsbSsh;

class AsbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Asb::all();
            header('Access-Control-Allow-Origin: *');   
            header('Access-Control-Allow-Headers: *');
            echo json_encode($data);    
        }
        catch(\Exception $ex){
            dd($ex);
            return $this->error("Terjadi kesalahan", 404);
        }
        
    }

    public function search(Request $request)
    {
        $data =  DB::select("SELECT * FROM asb where nama like '%".$request->get('keyword')."%'");
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
            $data = new Asb();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->status = "Pending";     
            $data->save();
        }
        elseif($request->get('pilihan') == 'B'){
            $ssh_id = $request['ssh_id'];
            $ssh_jumlah = $request['ssh_jumlah'];

            $data = new Asb();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->status = "Pending";     
            $data->save();    

                
            for ($i=0; $i <sizeof($ssh_id) ; $i++) { 
                $datassh = new AsbSsh();
                $datassh->asb_id = $data->id;
                $datassh->ssh_id = $ssh_id[$i];
                $datassh->jumlah = $ssh_jumlah[$i];
                $datassh->save();   
            }

        }
        elseif ($request->get('pilihan') == 'C') {
            $hspk_id = $request['hspk_id'];
            $hspk_jumlah = $request['hspk_jumlah'];

            $data = new Asb();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->status = "Pending";     
            $data->save();

            for ($i=0; $i <sizeof($hspk_id); $i++) { 
             $datahspk = new AsbHspk();
             $datahspk->asb_id = $data->id;
             $datahspk->hspk_id = $hspk_id[$i];
             $datahspk->jumlah = $hspk_jumlah[$i];
             $datahspk->save();   
            }
        }
        else{

            $ssh_id = $request['ssh_id'];
            $ssh_jumlah = $request['ssh_jumlah'];
            $hspk_id = $request['hspk_id'];
            $hspk_jumlah = $request['hspk_jumlah'];


            $data = new Asb();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');   
            $data->status = "Pending";     
            $data->save();    

            
            for ($i=0; $i <sizeof($ssh_id) ; $i++) { 
                $datassh = new AsbSsh();
                $datassh->asb_id = $data->id;
                $datassh->ssh_id = $ssh_id[$i];
                $datassh->jumlah = $ssh_jumlah[$i];
                $datassh->save();   
            }  

             
            for ($i=0; $i <sizeof($hspk_id); $i++) { 
                 $datahspk = new AsbHspk();
                 $datahspk->asb_id = $data->id;
                 $datahspk->hspk_id = $hspk_id[$i];
                 $datahspk->jumlah = $hspk_jumlah[$i];
                 $datahspk->save();   
            }

        }

        return response()->json("sukses");
    }



    public function updateHarga(Request $request){
        $harga =$request->get('harga_total');
        $data = Asb::whereid($request->get('id'))->firstOrFail();
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

         $dataAsb = Asb::whereid($id)->firstOrFail();

         $dataSSH = $posts = DB::select("SELECT * FROM asb as b inner join asb_ssh as bs on b.id = asb_id inner join ssh as s on s.id=ssh_id where b.id =".$id);
          $dataHspk = $posts = DB::select("SELECT * FROM asb as b inner join asb_hspk as bh on b.id = asb_id inner join hspk as h on h.id=hspk_id where b.id =".$id);

          $data[0]=$dataSSH;
          $data[1]=$dataHspk;
          $data[2]=$dataAsb;
         
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

            $data = Asb::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');
            $data->save();
           
         }
         elseif ($request->get('pilihan') == 'B') {

            $ssh_id = $request['ssh_id'];
            $ssh_jumlah = $request['ssh_jumlah'];

            $data = Asb::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');        
            $data->save();

            for ($i=0; $i <sizeof($ssh_id) ; $i++) {             
                $datassh=AsbSsh::where(['asb_id'=>$request->get('id'),'ssh_id'=>$ssh_id[$i]])->update(['jumlah'=>$ssh_jumlah[$i]]);                          
            }

          
         }
         elseif ($request->get('pilihan') == 'C') {

            $hspk_id = $request['hspk_id'];
            $hspk_jumlah = $request['hspk_jumlah'];

            $data = Asb::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');        
            $data->save();

            for ($i=0; $i <sizeof($hspk_id) ; $i++) { 
             $datahspk=AsbHspk::where(['asb_id'=>$request->get('id'),'hspk_id'=>$hspk_id[$i]])->update(['jumlah'=>$hspk_jumlah[$i]]);                         
            }

           
             
         }
         else{

            $ssh_id = $request['ssh_id'];
            $ssh_jumlah = $request['ssh_jumlah'];

            $data = Asb::whereid($request->get('id'))->firstOrFail();
            $data->kode = $request->get('kode');
            $data->nama = $request->get('nama');
            $data->satuan = $request->get('satuan');
            $data->tag_pencarian =$request->get('tag');        
            $data->save();

            for ($i=0; $i <sizeof($ssh_id) ; $i++) {             
                $datassh=AsbSsh::where(['asb_id'=>$request->get('id'),'ssh_id'=>$ssh_id[$i]])->update(['jumlah'=>$ssh_jumlah[$i]]);                          
            }

            $hspk_id = $request['hspk_id'];
            $hspk_jumlah = $request['hspk_jumlah'];
           

            for ($i=0; $i <sizeof($hspk_id) ; $i++) { 
             $datahspk=AsbHspk::where(['asb_id'=>$request->get('id'),'hspk_id'=>$hspk_id[$i]])->update(['jumlah'=>$hspk_jumlah[$i]]);                         
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

        AsbHspk::where('asb_id', $request->get('id'))->delete();
        AsbSsh::where('asb_id', $request->get('id'))->delete();

        $data = Asb::whereid($request->get('id'))->firstOrFail();
        $data->delete();
        return response()->json('sukses');
    }
}
