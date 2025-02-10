<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chucvu;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;

class ChucvuController extends Controller
{
    public function nhomquyen(Request $request)
    {
        return view('nhomquyen.nhomquyen');
    }

    public function ajaxnhomquyen(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $nhomquyen = Chucvu::orderBy('id', 'desc');
        $nhomquyen = searchColum($nhomquyen, $searchcolum, $searchnow);

        $nhomquyen = $nhomquyen->get();
        foreach ($nhomquyen as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($nhomquyen)->make(true);
    }

    public function savenhomquyen(Request $request)
    {
        $nhomquyen = new Chucvu();
        $nhomquyen->name = $request->name;
        $nhomquyen->save();
        Helper::saveHistory('Thêm nhóm quyền', $nhomquyen->name);

        return 'thành công';
    }

    public function updatenhomquyen(Request $request)
    {
        $nhomquyen = Chucvu::where('id', $request->id)->first();
        $nhomquyen->name = $request->data['name'];
        $nhomquyen->save();
        Helper::saveHistory('Sửa nhóm quyền', $nhomquyen->name);

        return 'thành công';
    }

    public function deletenhomquyen(Request $request)
    {
        $nhomquyen = Chucvu::where('id', $request->id)->first();
        Helper::saveHistory('Xoá nhóm quyền', $nhomquyen->name);

        Chucvu::destroy($request->id);
        return 'thành công';
    }
   
}

