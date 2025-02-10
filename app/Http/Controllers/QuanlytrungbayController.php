<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Quanlytrungbay;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class QuanlytrungbayController extends Controller
{
    //
    public function showhienvats(Request $request)
    {
      return Hienvat::where('checkxuatnhap',1)->get();
    }
    public function quanlytrungbay(Request $request)
    {
        return view('quanlytrungbay.index');
    }
    public function ajaxquanlytrungbay(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $quanlytrungbay = Quanlytrungbay::orderBy('id', 'desc');
        $quanlytrungbay = searchColum($quanlytrungbay, $searchcolum, $searchnow);

        $quanlytrungbay = $quanlytrungbay->get();
        foreach ($quanlytrungbay as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($quanlytrungbay)->make(true);
    }
    public function savequanlytrungbay(Request $request)
    {
        $quanlytrungbay = new Quanlytrungbay();
        $quanlytrungbay->name = $request->name;
        $quanlytrungbay->description = $request->description;
        $quanlytrungbay->save();
        Helper::saveHistory('Thêm trưng bày', $quanlytrungbay->name);

       return response('Thành công', 200);
    }
    public function updatequanlytrungbay(Request $request)
    {   
        // return $request->hienvat_id;
        $quanlytrungbay = Quanlytrungbay::where('id', $request->id)->first();
        $quanlytrungbay->name = $request->data['name'];
        $quanlytrungbay->description = $request->data['description'];
        $quanlytrungbay->hienvat_id = $request->data['hienvat_id'];
        $quanlytrungbay->save();
        Helper::saveHistory('Sửa trưng bày', $quanlytrungbay->name);

       return response('Thành công', 200);
    }
    public function deletequanlytrungbay(Request $request)
    {
        $quanlytrungbay = Quanlytrungbay::where('id', $request->id)->first();
        Helper::saveHistory('Xoá trưng bày', $quanlytrungbay->name);
        Quanlytrungbay::destroy($request->id);
       return response('Thành công', 200);
    }
    // view trưng bày hiện vật
    public function trungbayhienvat()
    {   
        
        return view('quanlytrungbay.danhsachhienvattrungbay');
    }
    public function ajaxtrungbayhienvat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $Trungbay_id  = $request->trungbay_id;
        // Query dữ liệu
        
        $infoquanlytrungbay = Quanlytrungbay::where('id',$Trungbay_id)->first();
        $infoHienvat= Hienvat::whereIn('id', $infoquanlytrungbay->hienvat_id);
        $infoHienvat = searchColum($infoHienvat, $searchcolum, $searchnow);
        $infoHienvat = $infoHienvat->get();
        foreach ($infoHienvat as $hv) {
            $hv->nametrungbay = $infoquanlytrungbay->name;
            $fileupload =  Fileuploads::where('tenbang','hienvats')->where('idtruong', $hv->id)->orderBy('id', 'desc')->first();
            if($fileupload){
                $hv->fileupload =  $fileupload->link;
            }
        }
    
    
        return DataTables::of($infoHienvat)->make(true);
    }
}
