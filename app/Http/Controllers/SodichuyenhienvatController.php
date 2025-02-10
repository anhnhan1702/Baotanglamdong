<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Sodichuyenhienvat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class SodichuyenhienvatController extends Controller
{
    public function SoDiChuyen(Request $request)
    {
        return view('quanlyhienvat.sodichuyen');
    }

    public function ajaxSoDiChuyen(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $SoDiChuyen = Sodichuyenhienvat::orderBy('id', 'desc');
        $SoDiChuyen = searchColum($SoDiChuyen, $searchcolum, $searchnow);

        $SoDiChuyen = $SoDiChuyen->with('hienvats')->get();

        foreach ($SoDiChuyen as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($SoDiChuyen)->make(true);
    }


    public function saveSoDiChuyen(Request $request)
    {
        $SoDiChuyen = new Sodichuyenhienvat();
        $SoDiChuyen->name = $request->name;
        $SoDiChuyen->mota = $request->mota;
        $SoDiChuyen->save();

        $result = [];
        foreach ($request->hienvats as $item) {
            $result[$item['id']] = ['trangthai' => $item['trangthai']];
        }

        $SoDiChuyen->hienvats()->attach($result);
      
        Helper::saveHistory('Thêm sổ di chuyển hiện vật', $request->name);
        
       return ('Thành công');
    }

    public function updateSoDiChuyen(Request $request)
    {
        $SoDiChuyen = Sodichuyenhienvat::where('id', $request->id)->first();
        $SoDiChuyen->name = $request->data['name'];
        $SoDiChuyen->mota = $request->data['mota'];
        $SoDiChuyen->save();

        $result = [];
        foreach ($request->data['hienvats'] as $item) {
            $result[$item['id']] = ['trangthai' => $item['trangthai']];
        }
        $SoDiChuyen->hienvats()->sync($result);
      
        Helper::saveHistory('Sửa sổ di chuyển hiện vật', $request->data['name']);

       return ('Thành công');
    }

    public function deleteSoDiChuyen(Request $request)
    {
        $title = Sodichuyenhienvat::where('id',$request->id)->first()->name;
        Helper::saveHistory('Xoá sổ di chuyển hiện vật', $title);
        Sodichuyenhienvat::destroy($request->id);
       return ('Thành công');
    }
}
