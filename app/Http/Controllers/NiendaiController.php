<?php

namespace App\Http\Controllers;

use App\Models\Niendai;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class NiendaiController extends Controller
{
    public function niendaituongdoi(Request $request)
    {
        return view('quanlyhienvat.niendai');
    }
    public function ajaxniendaituongdoi(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $niendaituongdoi = Niendai::orderBy('id', 'desc');
        $niendaituongdoi = searchColum($niendaituongdoi, $searchcolum, $searchnow);

        $niendaituongdoi = $niendaituongdoi->get();
        foreach ($niendaituongdoi as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($niendaituongdoi)->make(true);
    }
    public function saveniendaituongdoi(Request $request)
    {
        $niendaituongdoi = new Niendai();
        $niendaituongdoi->name = $request->name;
        $niendaituongdoi->save();
     return response()->json(['message' => 'Thành công'], 200);
    }
    public function updateniendaituongdoi(Request $request)
    {
        $niendaituongdoi = Niendai::where('id', $request->id)->first();
        $niendaituongdoi->name = $request->data['name'];
        $niendaituongdoi->save();
     return response()->json(['message' => 'Thành công'], 200);
    }
    public function deleteniendaituongdoi(Request $request)
    {
        Niendai::destroy($request->id);
     return response()->json(['message' => 'Thành công'], 200);
    }
}
