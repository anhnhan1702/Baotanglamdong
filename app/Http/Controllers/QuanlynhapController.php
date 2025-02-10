<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\nhap;
use Illuminate\Support\Facades\Auth;

class QuanlynhapController extends Controller
{
        public function nhap(Request $request)
    {
        return view('quanlyhienvat.quanlynhap');
    }
    public function ajaxxuatnhap(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $xuatnhap = Nhap::orderBy('id', 'desc');
        $xuatnhap = searchColum($xuatnhap, $searchcolum, $searchnow);

        $xuatnhap = $xuatnhap->get();
        foreach ($xuatnhap as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($xuatnhap)->make(true);
    }

    public function getdangnhap()
    {
        return Auth::user();
        
    }
}
