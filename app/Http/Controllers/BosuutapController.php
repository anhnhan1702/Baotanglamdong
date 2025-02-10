<?php

namespace App\Http\Controllers;

use App\Models\Bosuutap;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Kho;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helper;

class BosuutapController extends Controller
{
    //
    public function bosuutap(Request $request)
    {
        return view('bosuutap.index');
    }
    public function ajaxbosuutap(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $bosuutap = Bosuutap::orderBy('id', 'desc')->whereNull('parent_id');
        $bosuutap = searchColum($bosuutap, $searchcolum, $searchnow);

        $bosuutap = $bosuutap->get();
        foreach ($bosuutap as $btc) {
            
            if( Bosuutap::where('parent_id',$btc->id)->count() >0)
            {
                $btc->children = $this::dequybst($btc->id)['bosuutap'];
                $btc->slhienvat = $this::dequybst($btc->id)['dem'];

            }
    
            
        }
        return DataTables::of($bosuutap)->make(true);
    }

    public function dequybst($id)
    {
        $dem = 0;
        $bosuutap  = Bosuutap::where('parent_id',$id)->get();
        foreach($bosuutap as $btc) {
            $btc->children = $this::dequybst( $btc->id);
            $btc->slhienvat = hienvat::where('bosuutap_id',$btc->id)->count();
            $dem += $btc->slhienvat;
        }
       return  [
        'bosuutap'=>$bosuutap,
        'dem'=>$dem,

       ]
      ;
    }

    public function savebosuutap(Request $request)
    {
        $bosuutap = new Bosuutap();
        $bosuutap->name = $request->name;
        $bosuutap->description = $request->description;
        $bosuutap->parent_id = $request->parent_id;
        $bosuutap->save();
        Helper::saveHistory('Thêm bộ sưu tập', $bosuutap->name);

       return ('Thành công');
    }
    public function updatebosuutap(Request $request)
    {   
        $bosuutap = Bosuutap::where('id', $request->id)->first();
        $bosuutap->name = $request->data['name'];
        $bosuutap->description = $request->data['description'];
        $bosuutap->parent_id = $request->data['parent_id'];
        $bosuutap->hienvat_id = $request->data['hienvat_id'];
        $bosuutap->save();
        Helper::saveHistory('Sửa bộ sưu tập', $bosuutap->name);

       return ('Thành công');
    }
    public function deletebosuutap(Request $request)
    {
        $bosuutap = Bosuutap::where('id', $request->id)->first();
        Helper::saveHistory('Xoá bộ sưu tập', $bosuutap->name);
        Bosuutap::destroy($request->id);
       return ('Thành công');
    }
    // hiện vật thuộc bộ sưu tập
    public function hienvatbosuutap()
    {   
        
        return view('bosuutap.viewxemhienvat');
    }
    public function ajaxhienvatbosuutap(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $Bosutap_id  = $request->bosuutap_id;
        // Query dữ liệu
        
        $infobosuutap = Bosuutap::where('id',$Bosutap_id)->first();
    
        $infoHienvat= Hienvat::whereIn('id', $infobosuutap->hienvat_id);
        $infoHienvat = searchColum($infoHienvat, $searchcolum, $searchnow);
        $infoHienvat = $infoHienvat->get();
        foreach ($infoHienvat as $hv) {
            $hv->namebosuutap = $infobosuutap->name;
            $fileupload =  Fileuploads::where('tenbang','fileuploads')->where('idtruong', $hv->id)->orderBy('id', 'desc')->first();
            if($fileupload){
                $hv->fileupload =  $fileupload->link;
            }
        
        }
    
    
        return DataTables::of($infoHienvat)->make(true);
    }
    public function infobosuutap(Request $request)
    {
        $infobosuutap = Bosuutap::where('id',$request->bosuutap_id)->first()->name;
        return $infobosuutap;
    }
    public function hienvatthuocbosuutap(Request $request)
    {
        $id = $request->id;
        if($request->table == 'bosuutaps'){
            // kiểm tra bộ sưu tập có phải bộ sưu tập cha hay ko 
            $kiemtrabosuutap = Bosuutap::where('id',$id)->where('parent_id',null)->count();
            if($kiemtrabosuutap == 1){
                $bst = $this::dequybst( $id);
                $bosuutap_id = [];
               foreach ($bst['bosuutap'] as $bst) {
                $bosuutap_id[]=$bst->id;
               }
               $Hienvats = Hienvat::whereIn('bosuutap_id',$bosuutap_id)->get();
             
              
            }else{
                $Hienvats = Hienvat::where('bosuutap_id',$id)->get();
            }
           
           
           
        }elseif($request->table == 'trungbayaos'){
            $infotable=  DB::table($request->table)->where('id',$id)->first();
            $hienvat_id = json_decode($infotable->hienvat_id, true);
            $Hienvats= Hienvat::whereIn('id', $hienvat_id)->get();
            
        }else{
            $Hienvats = Hienvat::where('trungbay_id',$id)->get();
        }
        
        foreach($Hienvats as $hv){
            $hv->tentrungbayao =  $hv->name.'-'.$hv->so_ky_hieu;
            $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$hv->id)->orderBy('id', 'desc')->first();
            if($fileuploads == null){
                $hv->fileuploads = null;
            }else{
                $hv->fileuploads =  $fileuploads->link;
            }  
            if ($hv->vitrihv_id) {
                $vitri = Kho::find($hv->vitrihv_id);
                $hv->vitrihienvat =  $vitri->name;
            } else {
                $hv->vitrihienvat = 'Chưa xác định';
            }
        }

        return $Hienvats;
    }
}
