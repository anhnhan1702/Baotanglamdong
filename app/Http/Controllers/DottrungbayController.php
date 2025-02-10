<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;
use App\Models\dottrungbay;
use Illuminate\Http\Request;

class DottrungbayController extends Controller
{
    public function dottrungbay(Request $request)
    {
        return view('quanlytrungbay.dottrungbay');
    }
    public function ajaxdottrungbay(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $dottrungbay = dottrungbay::orderBy('id', 'desc');
        $dottrungbay = searchColum($dottrungbay, $searchcolum, $searchnow);
       
        $dottrungbay = $dottrungbay->get();
        foreach ($dottrungbay as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($dottrungbay)->make(true);
    }
    public function savedottrungbay(Request $request)
    {
        $dottrungbay = new dottrungbay();
        $dottrungbay->title = $request->title;
        $dottrungbay->mota = $request->mota;
        if ($request->hasFile('file')) {
            $dottrungbay->file = $request->file('file')->store('uploads', 'public');
        }
        $dottrungbay->save();
        Helper::saveHistory('Thêm đợt trưng bày', $dottrungbay->title);

        return 'thành công';
    }
    public function updatedottrungbay(Request $request)
    {
        $dottrungbay = dottrungbay::where('id', $request->id)->first();
        $dottrungbay->title = $request->data['title'];
        $dottrungbay->mota = $request->data['mota'];
        $dottrungbay->save();
        Helper::saveHistory('Sửa đợt trưng bày', $dottrungbay->title);

        return 'thành công';
    }
    public function deletedottrungbay(Request $request)
    {
        $dottrungbay = dottrungbay::where('id', $request->id)->first();
        Helper::saveHistory('Xoá đợt trưng bày', $dottrungbay->title);
        dottrungbay::destroy($request->id);
        return 'thành công';
    }
}
