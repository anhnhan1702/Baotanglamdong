<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Bosuutaphinhanh;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BosuutaphinhanhController extends Controller
{
    public function bosuutaphinhanh(Request $request)
    {
        return view('xulyhinhanh.bosuutaphinhanh');
    }
    public function ajaxbosuutaphinhanh(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $bosuutaphinhanh = Bosuutaphinhanh::orderBy('id', 'desc');
        $bosuutaphinhanh = searchColum($bosuutaphinhanh, $searchcolum, $searchnow);
       
        $bosuutaphinhanh = $bosuutaphinhanh->get();
        foreach ($bosuutaphinhanh as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($bosuutaphinhanh)->make(true);
    }
    public function savebosuutaphinhanh(Request $request)
    {
        $bosuutaphinhanh = new Bosuutaphinhanh();
        $bosuutaphinhanh->name = $request->name;
        $bosuutaphinhanh->save();
        Helper::saveHistory('Thêm bộ sưu tập hình ảnh', $bosuutaphinhanh->name);

        return 'thành công';
    }
    public function updatebosuutaphinhanh(Request $request)
    {
        $bosuutaphinhanh = Bosuutaphinhanh::where('id', $request->id)->first();
        $bosuutaphinhanh->name = $request->data['name'];
        $bosuutaphinhanh->save();
        Helper::saveHistory('Sửa bộ sưu tập hình ảnh', $bosuutaphinhanh->name);

        return 'thành công';
    }
    public function deletebosuutaphinhanh(Request $request)
    {
        $bosuutaphinhanh = Bosuutaphinhanh::where('id', $request->id)->first();
        Helper::saveHistory('Xoá bộ sưu tập hình ảnh', $bosuutaphinhanh->name);
        Bosuutaphinhanh::destroy($request->id);
        return 'thành công';
    }
}
