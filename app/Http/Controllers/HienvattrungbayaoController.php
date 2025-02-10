<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Hienvat;
use App\Models\Hienvattrungbayao;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class HienvattrungbayaoController extends Controller
{
    //
    public function HienVatTrungBayAo(Request $request)
    {
        return view('trungbayaotrenweb.hienvattrungbayao');
    }

    public function ajaxHienVatTrungBayAo(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $hienvatTrungBayAo = Hienvattrungbayao::orderBy('id', 'desc');
        $hienvatTrungBayAo = searchColum($hienvatTrungBayAo, $searchcolum, $searchnow);

        $hienvatTrungBayAo = $hienvatTrungBayAo->get();

        foreach ($hienvatTrungBayAo as $btc) {
            $btc->stt = ++$dem;
            $infohienvat = Hienvat::where('id',$btc->hienvat_id)->first();
            if ($infohienvat) {
               $btc->namehienvat = $infohienvat->name.'-'.$infohienvat->so_ky_hieu;
            }else{
                $btc->namehienvat = '';
            }
        }
        return DataTables::of($hienvatTrungBayAo)->make(true);
    }


    public function saveHienVatTrungBayAo(Request $request)
    {
        $hienvatTrungBayAo = new Hienvattrungbayao();
        $hienvatTrungBayAo->hienvat_id = $request->hienvat_id;
        $hienvatTrungBayAo->mota = $request->mota;
        $hienvatTrungBayAo->link = $request->link;
        $hienvatTrungBayAo->save();

        Helper::saveHistory('Thêm hiện vật trưng bày ảo', $request->hienvat_id);
        
        return 'thành công';
    }

    public function updateHienVatTrungBayAo(Request $request)
    {
        $hienvatTrungBayAo = Hienvattrungbayao::where('id', $request->id)->first();
        $hienvatTrungBayAo->hienvat_id = $request->data['hienvat_id'];
        $hienvatTrungBayAo->mota = $request->data['mota'];
        $hienvatTrungBayAo->link = $request->data['link'];
        $hienvatTrungBayAo->save();
      
        Helper::saveHistory('Sửa hiện vật trưng bày ảo', $request->data['hienvat_id']);

        return 'thành công';
    }

    public function deleteHienVatTrungBayAo(Request $request)
    {
        $title = Hienvattrungbayao::where('id',$request->id)->first()->name;
        Helper::saveHistory('Xoá hiện vật trưng bày ảo', $title);
        Hienvattrungbayao::destroy($request->id);
        return 'thành công';
    }
}
