<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;
use App\Models\vitritrungbay;

class VitritrungbayController extends Controller
{
    public function vitritrungbay(Request $request)
    {
        return view('quanlytrungbay.vitritrungbay');
    }
    public function ajaxvitritrungbay(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $vitritrungbay = vitritrungbay::orderBy('id', 'desc');
        $vitritrungbay = searchColum($vitritrungbay, $searchcolum, $searchnow);
       
        $vitritrungbay = $vitritrungbay->get();
        foreach ($vitritrungbay as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($vitritrungbay)->make(true);
    }
    public function savevitritrungbay(Request $request)
    {
        $vitritrungbay = new vitritrungbay();
        $vitritrungbay->title = $request->title;
        $vitritrungbay->mota = $request->mota;
        if ($request->hasFile('file')) {
            $vitritrungbay->file = $request->file('file')->store('uploads', 'public');
        }
        $vitritrungbay->save();
        Helper::saveHistory('Thêm vị trí trưng bày', $vitritrungbay->title);

     return response()->json(['message' => 'Thành công'], 200);
    }
    public function updatevitritrungbay(Request $request)
    {
        $vitritrungbay = vitritrungbay::where('id', $request->id)->first();
        $vitritrungbay->title = $request->data['title'];
        $vitritrungbay->mota = $request->data['mota'];
        $vitritrungbay->save();
        Helper::saveHistory('Sửa vị trí trưng bày', $vitritrungbay->title);

     return response()->json(['message' => 'Thành công'], 200);
    }
    public function deletevitritrungbay(Request $request)
    {
        $vitritrungbay = vitritrungbay::where('id', $request->id)->first();
        Helper::saveHistory('Xoá vị trí trưng bày', $vitritrungbay->title);
        vitritrungbay::destroy($request->id);
     return response()->json(['message' => 'Thành công'], 200);
    }
}
