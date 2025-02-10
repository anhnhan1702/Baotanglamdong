<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;
use App\Models\hienvattrungbay;

class HienvattrungbayController extends Controller
{
    public function quanlyhienvattrungbay(Request $request)
    {
        return view('quanlytrungbay.hienvatduoctrungbay');
    }
    public function ajaxquanlyhienvattrungbay(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $quanlyhienvattrungbay = hienvattrungbay::orderBy('id', 'desc');
        $quanlyhienvattrungbay = searchColum($quanlyhienvattrungbay, $searchcolum, $searchnow);
       
        $quanlyhienvattrungbay = $quanlyhienvattrungbay->get();
        foreach ($quanlyhienvattrungbay as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($quanlyhienvattrungbay)->make(true);
    }
    public function savequanlyhienvattrungbay(Request $request)
    {
        $quanlyhienvattrungbay = new hienvattrungbay();
        $quanlyhienvattrungbay->title = $request->title;
        $quanlyhienvattrungbay->mota = $request->mota;
        if ($request->hasFile('file')) {
            $quanlyhienvattrungbay->file = $request->file('file')->store('uploads', 'public');
        }
        $quanlyhienvattrungbay->save();
        Helper::saveHistory('Thêm hiện vật được trưng bày', $quanlyhienvattrungbay->title);

       return response('Thành công', 200);
    }
    public function updatequanlyhienvattrungbay(Request $request)
    {
        $quanlyhienvattrungbay = hienvattrungbay::where('id', $request->id)->first();
        $quanlyhienvattrungbay->title = $request->data['title'];
        $quanlyhienvattrungbay->mota = $request->data['mota'];
        $quanlyhienvattrungbay->save();
        Helper::saveHistory('Sửa hiện vật được trưng bày', $quanlyhienvattrungbay->title);

       return response('Thành công', 200);
    }
    public function deletequanlyhienvattrungbay(Request $request)
    {
        $quanlyhienvattrungbay = hienvattrungbay::where('id', $request->id)->first();
        Helper::saveHistory('Xoá hiện vật được trưng bày', $quanlyhienvattrungbay->title);
        hienvattrungbay::destroy($request->id);
       return response('Thành công', 200);
    }
}
