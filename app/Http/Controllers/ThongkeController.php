<?php

namespace App\Http\Controllers;

use App\Models\Bosuutap;
use App\Models\Chatlieu;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Hinhthucsuutam;
use App\Models\Kho;
use App\Models\Thongke;
use App\Models\Loaihienvat;
use App\Models\Xuatnhap;
use App\Models\User;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;
use Carbon\Carbon;
class ThongkeController extends Controller
{
    public function baocaouser(Request $request)
    {
        return view('quanlyhienvat.baocaouser');
    }
  
    function ajaxbaocaouser()
    {
        $users = User::all();
        foreach($users as $user)
        {
            $user->dem = Hienvat::where('create_by',$user->id)->count();
        }
        return $users;
    }
    public function baocaothongke(Request $request)
    {
        return view('quanlyhienvat.baocaothongke');
    }
    public function ajaxbaocaothongke(Request $request)
    {
        // return $request->hinhthucsuutam;
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $bosuutapsearch =  $request->bosuutap;
        $hinhthucsuutam = $request->hinhthucsuutam;
        $kho = $request->kho;
        $vitrihienvat = $request->vitrihienvat;
        $chatlieu = $request->chatlieu;
        $loaihienvat = $request->loaihienvat;
        $timenow = $request->timenow;
        // return $hinhthucsuutam;
        // Query dữ liệu
        $baocaothongke = Hienvat::orderBy('id', 'desc')->where('kiemtra',1);
        $baocaothongke = searchColum($baocaothongke, $searchcolum, $searchnow);

        if($hinhthucsuutam){
            $baocaothongke->where('hinhthucst_id', $hinhthucsuutam);
            // return 1;
        }

        if($kho){
            $baocaothongke->where('kho_id', $kho);
        }

        if($vitrihienvat){
            $baocaothongke->where('vitrihv_id', $vitrihienvat);
        }

        if($chatlieu){
            $baocaothongke->where('chatlieu_id', $chatlieu);
        }

        if($loaihienvat){
            $baocaothongke->where('loaihienvat_id', $loaihienvat);
        }

        if ($bosuutapsearch) {
            $hienvat_id_bst = $this::dequybst($bosuutapsearch);
            $hienvat_id_bst[] = $bosuutapsearch;
            // return $hienvat_id_bst;
            $baocaothongke->whereIn('bosuutap_id', $hienvat_id_bst);
        }
        if($timenow){
            $baocaothongke->where('tg_nhap_kho', $timenow);
        }

        $baocaothongke = $baocaothongke->get();
        // return $baocaothongke;
        foreach ($baocaothongke as $bctk) {
            $bctk->stt = ++$dem;
            if ($bctk->loaihienvat_id) {
                $bctk->tenloaihienvat =  $bctk->loaihienvat->name;
            } else {
                $bctk->tenloaihienvat = 'Chưa xác định';
            }
            if ($bctk->bosuutap_id) {
                $bctk->tenbosuutap =  $bctk->bosuutap->name;
            } else {
                $bctk->tenbosuutap = 'Chưa xác định';
            } 
             if ($bctk->hinhthucst_id) {
                $bctk->hinhthucsuutam =  $bctk->tenhinhthucsuutam->name;
            } else {
                $bctk->hinhthucsuutam = 'Chưa xác định';
            }
              if ($bctk->chatlieu_id) {
                $bctk->chatlieu =  $bctk->tenchatlieu->name;
            } else {
                $bctk->chatlieu = 'Chưa xác định';
            }
            if ($bctk->vitrihv_id) {
             
                $bctk->vitrihienvat =  $bctk->kho->name;
           
            } else {
                $bctk->vitrihienvat = 'Chưa xác định';
            }
            $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$bctk->id)->orderBy('id', 'desc')->first();
            if($fileuploads == null){
                $bctk->fileuploads = null;
            }else{
                $bctk->fileuploads =  $fileuploads->link;
            }
        }
        return DataTables::of($baocaothongke)->make(true);
    }
    // public function savebaocaothongke(Request $request)
    // {
    //     $baocaothongke = new Thongke();
    //     $baocaothongke->name = $request->name;
    //     $baocaothongke->save();
    //    return response('Thành công', 200);
    // }
    // public function updatebaocaothongke(Request $request)
    // {
    //     $baocaothongke = Thongke::where('id', $request->id)->first();
    //     $baocaothongke->name = $request->data['name'];
    //     $baocaothongke->save();
    //    return response('Thành công', 200);
    // }
    // public function deletebaocaothongke(Request $request)
    // {
    //     Thongke::destroy($request->id);
    //    return response('Thành công', 200);
    // }
    // gallery hiện vật
    public function galleryhienvat(Request $request)
    {   

        $table = $request->table;
        $id = $request->id;

    //    $arraybst =$this::dequybst( $id);
        $info = DB::table($table)->where('id',$id)->first();
 
        return view('galleryhienvat.index', [ 
        'name' =>$info->name,
        ]);
      
    
    }
   
    public function dequybst($id)
    {
        $arrayid = [];
        $bosuutap  = Bosuutap::where('parent_id',$id)->get();

        foreach($bosuutap as $btc) {
          
               $arr= $this::dequybst( $btc->id);
               foreach($arr as $ar) {
                $arrayid[] =$ar;
               }

            $arrayid[] =$btc->id;
         

        }
       return  $arrayid;
    }
    public function ajaxgalleryhienvat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $id  = $request->id;
        $table = $request->table;
        $bosuutap =  $request->bosuutap;
        $hinhthucsuutam = $request->hinhthucsuutam;
        $vitrihienvat = $request->vitrihienvat;
        $chatlieu = $request->chatlieu;
        $loaihienvat = $request->loaihienvat;
        $hienvat_id=[];
        // Query dữ liệu
        if($table == 'quanlytrungbays'){
            $infoxuatnhap = Hienvat::where('trungbay_id', $id)->get();
 
            foreach($infoxuatnhap as $xn)
            {
                $hienvat_id[]=$xn->id;
            }
            
  
        }elseif($table == 'bosuutaps'){
            $bst = $this::dequybst( $id);
            $infohienvats = Hienvat::whereIn('bosuutap_id',$bst)->where('kiemtra',1)->get();
            foreach ($infohienvats as $hv) {
               $hienvat_id[]=$hv->id;
            }
        }
        else{
            $infotable=  DB::table($table)->where('id',$id)->first();
            $hienvat_id = json_decode($infotable->hienvat_id, true);
          
        }
        $infoHienvat= Hienvat::whereIn('id', $hienvat_id);
        $infoHienvat = searchColum($infoHienvat, $searchcolum, $searchnow);
        if($hinhthucsuutam){
            $infoHienvat->where('hinhthucst_id', $hinhthucsuutam);
            // return 1;
        }
    
        if($vitrihienvat){
            $infoHienvat->where('vitrihv_id', $vitrihienvat);
        }
    
        if($chatlieu){
            $infoHienvat->where('chatlieu_id', $chatlieu);
        }
    
        if($loaihienvat){
            $infoHienvat->where('loaihienvat_id', $loaihienvat);
        }
    
        
        if($bosuutap){
            $infoHienvat->where('bosuutap_id', $bosuutap);
        }
        $infoHienvat = $infoHienvat->get();
        foreach ($infoHienvat as $hv) {
            if ($hv->loaihienvat_id) {
                $hv->tenloaihienvat =  $hv->loaihienvat->name;
            } else {
                $hv->tenloaihienvat = 'Chưa xác định';
            }
            if ($hv->bosuutap_id) {
                $hv->tenbosuutap =  $hv->bosuutap->name;
            } else {
                $hv->tenbosuutap = 'Chưa xác định';
            } 
             if ($hv->hinhthucst_id) {
                $hv->hinhthucsuutam =  $hv->tenhinhthucsuutam->name;
            } else {
                $hv->hinhthucsuutam = 'Chưa xác định';
            }
              if ($hv->chatlieu_id) {
                $hv->chatlieu =  $hv->tenchatlieu->name;
            } else {
                $hv->chatlieu = 'Chưa xác định';
            }
            if ($hv->vitrihv_id) {
             
                $hv->vitrihienvat =  $hv->kho->name;
           
            } else {
                $hv->vitrihienvat = 'Chưa xác định';
            }
            if ($hv->ghichu) {
                $data =  $hv->ghichu;
                foreach ($hv->ghichu as $key => $gc) {
                    $time = new Carbon($gc['thoigian']);
                    $data[$key]['thoigian'] = $time->format('H:i d/m/Y');
                }
                $hv->ghichu =  $data;
            }
            $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$hv->id)->orderBy('id', 'desc')->get();
            if($fileuploads == null){
                $hv->fileuploads = null;
            }else{
                $hv->fileuploads =  $fileuploads;
            }
        }
    
    
        return DataTables::of($infoHienvat)->make(true);
    }
}