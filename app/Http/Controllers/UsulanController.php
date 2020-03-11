<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usulan;
use App\File_Usulan;
use App\Surat_usulan;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Usulan::all();
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);
    }

    public function indexSurat()
    {
        $data = DB::select("SELECT *,s.id as idsurat FROM surat_usulan as s INNER JOIN file_usulan as f on s.id = f.surat_usulan_id Order by s.id desc");
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

            $detailUsulan = json_decode($request->get('detailUsulan'));
            $dataUsulan = new Surat_usulan();
            $dataUsulan->nama_berkas = $detailUsulan->namaBerkas;
            //$dataUsulan->nama_berkas = 'asdsa';            
            $dataUsulan->jumlah_berkas ="1";
            $dataUsulan->status ="Pending";
            $dataUsulan->save();
        
            $file = $request->file('file');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $path      = $file->storeAs("file_usulan/".$detailUsulan->users_id."/".$dataUsulan->id,$filename);
        
             $fileUsulan = new File_Usulan();
             $fileUsulan->nama_file = $filename;
             $fileUsulan->users_id = $detailUsulan->users_id;
             $fileUsulan->path = $path;
             $fileUsulan->surat_usulan_id =$dataUsulan->id; 
             $fileUsulan->save();  

            return json_encode('sukses'); 
        
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function showCount()
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        $dataTerverivikasi = DB::select("SELECT count(*) FROM surat_usulan where status='Verivikasi'");
        $dataTertolak = DB::select("SELECT count(*) FROM surat_usulan where status='Tolak'");
        $dataPending = DB::select("SELECT count(*) FROM surat_usulan where status='Pending'");
        $data[0] = $dataTerverivikasi;
        $data[1] = $dataTertolak;
        $data[2] = $dataPending;
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
        $id = $request->get('idsuratusulan');
        $ket = $request->get('keterangan');
        $data = Surat_usulan::whereid($id)->firstOrFail();       
         $data->status = $ket;
         $data->save();
        return json_encode("sukses"); 
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

     function path_fixer($path) {
        // Laravel uses / separator by default.
        
        if (DIRECTORY_SEPARATOR != '/') { // Let's check the current system default is this.
            return str_replace('/', DIRECTORY_SEPARATOR, $path); // Change the separator for current system.
        }
    
        return $path; // Use coming path.
    }

    public function downloadFileUsulan(Request $request)
    {
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        $idusers = $request->get('idusers');
        $idsuratusulan = $request->get('idsuratusulan');
        $extension = $request->get('ext');
        $namaFile = $request->get('namaFile');
         // $nameFileFix = str_replace('%20'," ", $namaFile).".".$extension;
        $namaFile = $namaFile.".".$extension;
        // $nama = 'cartoon-playful-pink-cat-colorful-book-page-design-kids-children-cartoon-playful-pink-cat-108193845.jpg';
        // //return json_encode($namaFile); 
        $pathToFile = $this->path_fixer(storage_path('app/file_usulan/'.$idusers.'/'.$idsuratusulan.'/'.$namaFile));
        //return json_encode($namaFile);  
        return response()->download($pathToFile);
    }

    public function suratPerUsers(Request $request)
    {
        $data = DB::select("SELECT * FROM surat_usulan as s INNER JOIN file_usulan as f on s.id = f.surat_usulan_id where f.users_id =".$request->get('users_id')." Order by s.id desc");
        header('Access-Control-Allow-Origin: *');   
        header('Access-Control-Allow-Headers: *');
        echo json_encode($data);
    }

    


}
