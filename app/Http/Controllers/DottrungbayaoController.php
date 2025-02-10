<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Dottrungbayao;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class DottrungbayaoController extends Controller
{

    public function QuanLyDotTruongBayAo(Request $request)
    {
        return view('trungbayaotrenweb.dottrungbayao');
    }

    public function ajaxQuanLyDotTruongBayAo(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $dotTrungBayAo = Dottrungbayao::orderBy('id', 'desc');
        $dotTrungBayAo = searchColum($dotTrungBayAo, $searchcolum, $searchnow);
        $dotTrungBayAo = $dotTrungBayAo->get();

        foreach ($dotTrungBayAo as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($dotTrungBayAo)->make(true);
    }


    public function saveQuanLyDotTruongBayAo(Request $request)
    {
        $dotTrungBayAo = new Dottrungbayao();
        $dotTrungBayAo->name = $request->name;
        $dotTrungBayAo->link = $request->link;
        $dotTrungBayAo->thoigianbatdau = $request->thoigianbatdau;
        $dotTrungBayAo->thoigianketthuc = $request->thoigianketthuc;
        $dotTrungBayAo->save();
        Helper::saveHistory('Thêm sổ di chuyển hiện vật', $request->name);
       return ('Thành công');
    }

    public function updateQuanLyDotTruongBayAo(Request $request)
    {
        $dotTrungBayAo = Dottrungbayao::where('id', $request->id)->first();
        $dotTrungBayAo->name = $request->data['name'];
        $dotTrungBayAo->link = $request->data['link'];
        $dotTrungBayAo->thoigianbatdau = $request->data['thoigianbatdau'];
        $dotTrungBayAo->thoigianketthuc = $request->data['thoigianketthuc'];
        $dotTrungBayAo->save();
        Helper::saveHistory('Sửa sổ di chuyển hiện vật', $request->data['name']);

       return ('Thành công');
    }

    public function deleteQuanLyDotTruongBayAo(Request $request)
    {
        $title = Dottrungbayao::where('id', $request->id)->first()->name;
        Helper::saveHistory('Xoá sổ di chuyển hiện vật', $title);
        Dottrungbayao::destroy($request->id);
       return ('Thành công');
    }
}
