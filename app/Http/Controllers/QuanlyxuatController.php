<?php

namespace App\Http\Controllers;

use App\Models\Xuatnhap;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class QuanlyxuatController extends Controller
{
    //
    public function xuat(Request $request)
    {
        return view('quanlyhienvat.quanlyxuat');
    }
    public function ajaxxuat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $xuat = Xuatnhap::orderBy('id', 'desc');
        $xuat = searchColum($xuat, $searchcolum, $searchnow);

        $xuat = $xuat->get();
        foreach ($xuat as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($xuat)->make(true);
    }
    public function savexuat(Request $request)
    {
        $xuat = new Xuatnhap();
        $xuat->name = $request->name;
        $xuat->loaixuat = $request->loaixuat;
        $xuat->diadiem = $request->diadiem;
        $xuat->mucdichxuat = $request->mucdichxuat;
        $xuat->cancuxuat = $request->cancuxuat;
        $xuat->nguoixuat = $request->nguoixuat;
        $xuat->donvixuat = $request->donvixuat;
        // $xuat->nguoinhan = $request->nguoinhan;
        // $xuat->donvinhan = $request->donvinhan;
        $xuat->danhmuchienvat = $request->danhmuchienvat;
        $xuat->save();
     return response()->json(['message' => 'Thành công'], 200);
    }
    public function updatexuat(Request $request)
    {
        $xuat = Xuatnhap::where('id', $request->id)->first();
        $xuat->name = $request->data['name'];
        $xuat->loaixuat = $request->data['loaixuat'];
        $xuat->diadiem = $request->data['diadiem'];
        $xuat->mucdichxuat = $request->data['mucdichxuat'];
        $xuat->cancuxuat = $request->data['cancuxuat'];
        $xuat->nguoixuat = $request->data['nguoixuat'];
        $xuat->donvixuat = $request->data['donvixuat'];
        // $xuat->nguoinhan = $request->data['nguoinhan'];
        // $xuat->donvinhan = $request->data['donvinhan'];
        $xuat->danhmuchienvat = $request->data['danhmuchienvat'];
        $xuat->save();
     return response()->json(['message' => 'Thành công'], 200);
    }
    public function deletexuat(Request $request)
    {
        Xuatnhap::destroy($request->id);
     return response()->json(['message' => 'Thành công'], 200);
    }
}
