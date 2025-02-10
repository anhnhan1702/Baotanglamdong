<?php

namespace App\Http\Controllers;

use App\Models\Thoiky;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ThoikyController extends Controller
{
    public function thoiky(Request $request)
    {
        return view('quanlyhienvat.thoiky');
    }
    public function ajaxthoiky(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $thoiky = Thoiky::orderBy('id', 'desc');
        $thoiky = searchColum($thoiky, $searchcolum, $searchnow);
       
        $thoiky = $thoiky->get();
        foreach ($thoiky as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($thoiky)->make(true);
    }
    public function savethoiky(Request $request)
    {
        $thoiky = new Thoiky();
        $thoiky->name = $request->name;
        $thoiky->save();
       return ('Thành công');
    }
    public function updatethoiky(Request $request)
    {
        $thoiky = Thoiky::where('id', $request->id)->first();
        $thoiky->name = $request->data['name'];
        $thoiky->save();
       return ('Thành công');
    }
    public function deletethoiky(Request $request)
    {
        Thoiky::destroy($request->id);
       return ('Thành công');
    }
}
