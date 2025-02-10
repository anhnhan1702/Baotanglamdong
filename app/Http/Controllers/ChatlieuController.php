<?php

namespace App\Http\Controllers;

use App\Models\Chatlieu;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;

class ChatlieuController extends Controller
{
    public function chatlieu(Request $request)
    {
        return view('quanlyhienvat.chatlieu');
    }
    public function ajaxchatlieu(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $chatlieu = Chatlieu::orderBy('id', 'desc');
        $chatlieu = searchColum($chatlieu, $searchcolum, $searchnow);
       
        $chatlieu = $chatlieu->get();
        foreach ($chatlieu as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($chatlieu)->make(true);
    }
    public function savechatlieu(Request $request)
    {
        $chatlieu = new Chatlieu();
        $chatlieu->name = $request->name;
        $chatlieu->save();
        Helper::saveHistory('Thêm chất liệu', $chatlieu->name);

       return ('Thành công');
    }
    public function updatechatlieu(Request $request)
    {
        $chatlieu = Chatlieu::where('id', $request->id)->first();
        $chatlieu->name = $request->data['name'];
        $chatlieu->save();
        Helper::saveHistory('Sửa chất liệu', $chatlieu->name);

       return ('Thành công');
    }
    public function deletechatlieu(Request $request)
    {
        $chatlieu = Chatlieu::where('id', $request->id)->first();
        Helper::saveHistory('Xoá chất liệu', $chatlieu->name);
        Chatlieu::destroy($request->id);
       return ('Thành công');
    }
}
