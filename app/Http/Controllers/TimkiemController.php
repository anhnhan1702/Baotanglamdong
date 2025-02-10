<?php

namespace App\Http\Controllers;

use App\Models\Bosuutap;
use App\Models\Chatlieu;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Hinhthucsuutam;
use App\Models\Kho;
use App\Models\Loaihienvat;
use App\Models\Vitrihienvat;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
class TimkiemController extends Controller
{
   public function timkiemhienvat(Request $request)
   {
    return view('timkiem.index');

    # code...
   }
   public function ajaxtimkiemhienvat(Request $request)
   {
    $dem = 0;
    $searchnow = $request->searchnow;
    $searchcolum =  $request->searchcolum;
    $bosuutap =  $request->bosuutap;
    $hinhthucsuutam = $request->hinhthucsuutam;
    $vitrihienvat = $request->vitrihienvat;
    $chatlieu = $request->chatlieu;
    $loaihienvat = $request->loaihienvat;
    // $searchxa = $request->searchxa;
    // Query dữ liệu
    $quanlyhienvat = Hienvat::orderBy('id', 'desc')->where('kiemtra',1);
    $quanlyhienvat = searchColum($quanlyhienvat, $searchcolum, $searchnow);
    // if ($searchxa) {
    //     $quanlyhienvat = $quanlyhienvat->where('xa_id', $searchxa);
    // }
    if($hinhthucsuutam){
        $quanlyhienvat->where('hinhthucst_id', $hinhthucsuutam);
        // return 1;
    }

    if($vitrihienvat){
        $quanlyhienvat->where('vitrihv_id', $vitrihienvat);
    }

    if($chatlieu){
        $quanlyhienvat->where('chatlieu_id', $chatlieu);
    }

    if($loaihienvat){
        $quanlyhienvat->where('loaihienvat_id', $loaihienvat);
    }

    
    if($bosuutap){
        $quanlyhienvat->where('bosuutap_id', $bosuutap);
    }

    $quanlyhienvat = $quanlyhienvat->get();
    foreach ($quanlyhienvat as $qlhv) {
        $qlhv->stt = ++$dem;
        if ($qlhv->loaihienvat_id) {
            $qlhv->tenloaihienvat =  $qlhv->loaihienvat->name;
        } else {
            $qlhv->tenloaihienvat = 'Chưa xác định';
        }
        if ($qlhv->bosuutap_id) {
            $qlhv->tenbosuutap =  $qlhv->bosuutap->name;
        } else {
            $qlhv->tenbosuutap = 'Chưa xác định';
        } 
         if ($qlhv->hinhthucst_id) {
            $qlhv->hinhthucsuutam =  $qlhv->tenhinhthucsuutam->name;
        } else {
            $qlhv->hinhthucsuutam = 'Chưa xác định';
        }
          if ($qlhv->chatlieu_id) {
            $qlhv->chatlieu =  $qlhv->tenchatlieu->name;
        } else {
            $qlhv->chatlieu = 'Chưa xác định';
        }
        if ($qlhv->vitrihv_id) {
         
            $qlhv->vitrihienvat =  $qlhv->kho->name;
       
        } else {
            $qlhv->vitrihienvat = 'Chưa xác định';
        }
        if ($qlhv->ghichu) {
            $data =  $qlhv->ghichu;
            foreach ($qlhv->ghichu as $key => $gc) {
                $time = new Carbon($gc['thoigian']);
                $data[$key]['thoigian'] = $time->format('H:i d/m/Y');
            }
            $qlhv->ghichu =  $data;
        }
 
        $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$qlhv->id)->orderBy('id', 'desc')->get();
        if($fileuploads == null){
            $qlhv->fileuploads = null;
        }else{
            $qlhv->fileuploads =  $fileuploads;
        }
    
    }
    return DataTables::of($quanlyhienvat)->make(true);
   }
   public function hotro()
   {
    return view('hotro.index');
   }
   public function infofilehienvat(Request $request)
   {
     $hienvat_id = $request->hienvat_id;
     $anh = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$hienvat_id)->get();
     $tailieuhienvat = Fileuploads::where('tenbang','tailieuhienvat')->where('idtruong',$hienvat_id)->get();
     return [
        'anh' => $anh,
        'tailieuhienvat'=>$tailieuhienvat
     ];
   }
}
