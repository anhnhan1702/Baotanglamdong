<?php

namespace App\Http\Controllers;

use App\Models\Loaihienvat;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper;

class LoaihienvatController extends Controller
{
    public function loaihienvat(Request $request)
    {
        return view('quanlyhienvat.loaihienvat');
    }
    public function ajaxloaihienvat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $loaihienvat = Loaihienvat::orderBy('id', 'desc');
        $loaihienvat = searchColum($loaihienvat, $searchcolum, $searchnow);

        $loaihienvat = $loaihienvat->get();
        foreach ($loaihienvat as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($loaihienvat)->make(true);
    }
    public function saveloaihienvat(Request $request)
    {
        $loaihienvat = new Loaihienvat();
        $loaihienvat->name = $request->name;
        $loaihienvat->save();
        Helper::saveHistory('Thêm loại hiện vật', $loaihienvat->name);

       return ('Thành công');
    }
    public function updateloaihienvat(Request $request)
    {
        $loaihienvat = Loaihienvat::where('id', $request->id)->first();
        $loaihienvat->name = $request->data['name'];
        $loaihienvat->save();
        Helper::saveHistory('Sửa loại hiện vật', $loaihienvat->name);

       return ('Thành công');
    }
    public function deleteloaihienvat(Request $request)
    {
        $loaihienvat = Loaihienvat::where('id', $request->id)->first();
        Helper::saveHistory('Xoá loại hiện vật', $loaihienvat->name);
        Loaihienvat::destroy($request->id);
       return ('Thành công');
    }
}
