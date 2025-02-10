<?php

namespace App\Http\Controllers;

use App\Models\Hinhthucsuutam;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Helper;

class HinhthucsuutamController extends Controller
{
    public function hinhthucsuutam(Request $request)
    {
        return view('quanlyhienvat.hinhthucsuutam');
    }
    public function ajaxhinhthucsuutam(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $hinhthucsuutam = Hinhthucsuutam::orderBy('id', 'desc');
        $hinhthucsuutam = searchColum($hinhthucsuutam, $searchcolum, $searchnow);
        
        $hinhthucsuutam = $hinhthucsuutam->get();
        foreach ($hinhthucsuutam as $btc) {
            $btc->stt = ++$dem;
        }
       
        return Datatables::of($hinhthucsuutam)->make(true);
    }
    public function savehinhthucsuutam(Request $request)
    {
        $hinhthucsuutam = new Hinhthucsuutam();
        $hinhthucsuutam->name = $request->name;
        $hinhthucsuutam->save();
        Helper::saveHistory('Thêm hình thức sưu tầm', $hinhthucsuutam->name);

        return 'thành công';
    }
    public function updatehinhthucsuutam(Request $request)
    {
        $hinhthucsuutam = Hinhthucsuutam::where('id', $request->id)->first();
        $hinhthucsuutam->name = $request->data['name'];
        $hinhthucsuutam->save();
        Helper::saveHistory('Sửa hình thức sưu tầm', $hinhthucsuutam->name);

        return 'thành công';
    }
    public function deletehinhthucsuutam(Request $request)
    { 
        $hinhthucsuutam = Hinhthucsuutam::where('id', $request->id)->first();
        Helper::saveHistory('Xoá hình thức sưu tầm', $hinhthucsuutam->name);
        Hinhthucsuutam::destroy($request->id);
        return 'thành công';
    }
}
