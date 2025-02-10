<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Trungbayao;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class TrungbayaoController extends Controller
{
    //
    public function trungbayao(Request $request)
    {
        return view('quanlytrungbayao.index');
    }
    public function ajaxtrungbayao(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $trungbayao = Trungbayao::orderBy('id', 'desc');
        $trungbayao = searchColum($trungbayao, $searchcolum, $searchnow);
        $trungbayao = $trungbayao->get();
        foreach ($trungbayao as $tba) {
            $tba->stt = ++$dem;
            if ($tba->parent_id) {
                $tba->nameparent = Trungbayao::where('id',$tba->id)->first()->name;
            }else{
                $tba->nameparent = null;
            }
        }
        return DataTables::of($trungbayao)->make(true);
    }
    public function savetrungbayao(Request $request)
    {
        $trungbayao = new Trungbayao();
        $trungbayao->name = $request->name;
        $trungbayao->description = $request->description;
        $trungbayao->save();
        Helper::saveHistory('Thêm trưng bày ảo', $trungbayao->name);

        return 'thành công';
    }
    public function updatetrungbayao(Request $request)
    {   
        $trungbayao = Trungbayao::where('id', $request->id)->first();
        $trungbayao->name = $request->data['name'];
        $trungbayao->description = $request->data['description'];
        $trungbayao->hienvat_id = $request->data['hienvat_id'];
        $trungbayao->save();
        Helper::saveHistory('Sửa trưng bày ảo', $trungbayao->name);

        return 'thành công';
    }
    public function deletetrungbayao(Request $request)
    {
        $trungbayao = Trungbayao::where('id', $request->id)->first();

        Helper::saveHistory('Xoá trưng bày ảo', $trungbayao->name);
       
        Trungbayao::destroy($request->id);
        return 'thành công';
    }
    // trưng bày ảo hiện vật
    public function trungbayaohienvat()
    {   
        
        return view('quanlytrungbayao.danhsachhienvattrungbayao');
    }
    public function ajaxtrungbayaohienvat(Request $request)
    {
      
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $Trungbayao_id  = $request->trungbayao_id;
        // Query dữ liệu
        
        $infoquanlytrungbayao = Trungbayao::where('id',$Trungbayao_id)->first();
        $infoHienvat= Hienvat::whereIn('id', $infoquanlytrungbayao->hienvat_id);
        $infoHienvat = searchColum($infoHienvat, $searchcolum, $searchnow);
        $infoHienvat = $infoHienvat->get();
        foreach ($infoHienvat as $hv) {
            $hv->nametrungbay = $infoquanlytrungbayao->name;
            $fileupload =  Fileuploads::where('tenbang','hienvats')->where('idtruong', $hv->id)->orderBy('id', 'desc')->first();
            if($fileupload){
                $hv->fileupload =  $fileupload->link;
            }
        }
    
    
        return DataTables::of($infoHienvat)->make(true);
    }
}
