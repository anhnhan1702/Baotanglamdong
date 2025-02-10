<?php

namespace App\Http\Controllers;

use App\Models\Vitritrungbayao;
use Illuminate\Http\Request;
use App\Helper;
use Yajra\DataTables\DataTables;

class VitritrungbayaoController extends Controller
{
    //
    public function ViTriTrungBayAo(Request $request)
    {
        return view('trungbayaotrenweb.vitritrungbayao');
    }

    public function ajaxViTriTrungBayAo(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $viTriTrungBayAo = Vitritrungbayao::orderBy('id', 'desc');
        $viTriTrungBayAo = searchColum($viTriTrungBayAo, $searchcolum, $searchnow);

        $viTriTrungBayAo = $viTriTrungBayAo->get();

        foreach ($viTriTrungBayAo as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($viTriTrungBayAo)->make(true);
    }


    public function saveViTriTrungBayAo(Request $request)
    {
        $viTriTrungBayAo = new Vitritrungbayao();
        $viTriTrungBayAo->name = $request->name;

        $viTriTrungBayAo->save();

        Helper::saveHistory('Thêm vị tri trưng bày ảo', $request->name);

       return response('Thành công', 200);
    }

    public function updateViTriTrungBayAo(Request $request)
    {
        $viTriTrungBayAo = Vitritrungbayao::where('id', $request->id)->first();
        $viTriTrungBayAo->name = $request->data['name'];

        $viTriTrungBayAo->save();
        Helper::saveHistory('Sửa vị tri trưng bày ảo', $request->data['name']);

       return response('Thành công', 200);
    }

    public function deleteViTriTrungBayAo(Request $request)
    {
        $title = Vitritrungbayao::where('id', $request->id)->first()->name;
        Helper::saveHistory('Xoá vị tri trưng bày ảo', $title);
        Vitritrungbayao::destroy($request->id);
       return response('Thành công', 200);
    }
}
