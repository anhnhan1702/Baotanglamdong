<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Quanlyhinhanh;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class QuanlyhinhanhController extends Controller
{
    //
    public function quanlyhinhanh(Request $request)
    {
        return view('xulyhinhanh.quanlyhinhanh');
    }
    public function ajaxquanlyhinhanh(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $quanlyhinhanh = Quanlyhinhanh::orderBy('id', 'desc');
        $quanlyhinhanh = searchColum($quanlyhinhanh, $searchcolum, $searchnow);
       
        $quanlyhinhanh = $quanlyhinhanh->get();
        foreach ($quanlyhinhanh as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($quanlyhinhanh)->make(true);
    }
    public function savequanlyhinhanh(Request $request)
    {
        $quanlyhinhanh = new Quanlyhinhanh();
        $quanlyhinhanh->name = $request->name;
        $quanlyhinhanh->save();
        Helper::saveHistory('Thêm quản lý hình ảnh', $quanlyhinhanh->name);

        return 'thành công';
    }
    public function updatequanlyhinhanh(Request $request)
    {
        $quanlyhinhanh = Quanlyhinhanh::where('id', $request->id)->first();
        $quanlyhinhanh->name = $request->data['name'];
        $quanlyhinhanh->save();
        Helper::saveHistory('Sửa quản lý hình ảnh', $quanlyhinhanh->name);

        return 'thành công';
    }
    public function deletequanlyhinhanh(Request $request)
    {
        $quanlyhinhanh = Quanlyhinhanh::where('id', $request->id)->first();
        Helper::saveHistory('Xoá quản lý hình ảnh', $quanlyhinhanh->name);

        Quanlyhinhanh::destroy($request->id);
        return 'thành công';
    }
}
