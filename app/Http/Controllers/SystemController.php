<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class SystemController extends Controller
{
    public function hethong(Request $request)
    {
        return view('hethong.hethong');
    }

    public function ajaxhethong(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $hethong = System::orderBy('id', 'desc');
        $hethong = searchColum($hethong, $searchcolum, $searchnow);

        $hethong = $hethong->get();
        foreach ($hethong as $btc) {
            $btc->stt = ++$dem;
        }
        Log::info($hethong);
        return DataTables::of($hethong)->make(true);
    }

    public function savehethong(Request $request)
    {
        $hethong = new System();
        $hethong->name = $request->name;
        $hethong->save();
     return response()->json(['message' => 'Thành công'], 200);
    }

}
