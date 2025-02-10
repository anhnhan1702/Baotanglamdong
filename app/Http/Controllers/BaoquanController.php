<?php

namespace App\Http\Controllers;

use App\Models\Baoquan;
use App\Models\Hienvat;
use App\Models\Phieubaoquan;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Helper;

class BaoquanController extends Controller
{

    public function hienvattrongkho(Request $request)
    {
        $kho_id = $request->all();
        $hienvat = Hienvat::whereIn('vitrihv_id', $kho_id)->where('checkxuatnhap', 1)->select('name', 'id', 'so_ky_hieu')->get();
        foreach ($hienvat as $hv) {
            $hv->name = $hv->name . '-' . $hv->so_ky_hieu;
        }
        return $hienvat;
    }
    public function updatephieu(Request $request)
    {

        $baoquan = Phieubaoquan::where('id', $request->id)->first();
        $baoquan->hienvat_id = $request->hienvat_id;
        $baoquan->kho_id = $request->ajaxkho;
        $baoquan->save();
      return response()->json(['message' => 'Thành công'], 200);
    }
    public function ajaxphieubaoquan(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $phieubaoquan = Phieubaoquan::orderBy('id', 'desc');
        $phieubaoquan = searchColum($phieubaoquan, $searchcolum, $searchnow);

        $phieubaoquan = $phieubaoquan->get();
        foreach ($phieubaoquan as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($phieubaoquan)->make(true);
    }
    public function savephieubaoquan(Request $request)
    {
        $phieubaoquan = new Phieubaoquan();
        $phieubaoquan->name = $request->name;
        $phieubaoquan->save();
        Helper::saveHistory('Thêm phiếu bảo quản', $phieubaoquan->name);

      return response()->json(['message' => 'Thành công'], 200);
    }
    public function updatephieubaoquan(Request $request)
    {
        $phieubaoquan = Phieubaoquan::where('id', $request->id)->first();
        $phieubaoquan->name = $request->data['name'];
        $phieubaoquan->hienvat_id = $request->data['hienvat_id'];
        $phieubaoquan->save();
        Helper::saveHistory('Sửa phiếu bảo quản', $phieubaoquan->name);

      return response()->json(['message' => 'Thành công'], 200);
    }
    public function deletephieubaoquan(Request $request)
    {
        $phieubaoquan = Phieubaoquan::where('id', $request->id)->first();
        Helper::saveHistory('Xoá phiếu bảo quản', $phieubaoquan->name);
        Phieubaoquan::destroy($request->id);
      return response()->json(['message' => 'Thành công'], 200);
    }
    //
    public function phieubaoquan(Request $request)
    {
        return view('quanlyhienvat.quanlyphieubaoquan');
    }
    public function baoquan(Request $request)
    {
        return view('quanlyhienvat.quanlybaoquan');
    }
    public function ajaxbaoquan(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $baoquan = Baoquan::orderBy('id', 'desc');
        $baoquan = searchColum($baoquan, $searchcolum, $searchnow);

        $baoquan = $baoquan->get();
        foreach ($baoquan as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($baoquan)->make(true);
    }
    public function savebaoquan(Request $request)
    {
        $baoquan = new Baoquan();
        $baoquan->name = $request->name;
        $baoquan->save();
        Helper::saveHistory('Thêm bảo quản', $baoquan->name);

      return response()->json(['message' => 'Thành công'], 200);
    }
    public function updatebaoquan(Request $request)
    {
        $baoquan = Baoquan::where('id', $request->id)->first();
        $baoquan->name = $request->data['name'];
        $baoquan->hienvat_id = $request->data['hienvat_id'];
        $baoquan->save();
        Helper::saveHistory('Sửa bảo quản', $baoquan->name);

      return response()->json(['message' => 'Thành công'], 200);
    }
    public function deletebaoquan(Request $request)
    {
        $baoquan = Baoquan::where('id', $request->id)->first();
        Helper::saveHistory('Xoá bảo quản', $baoquan->name);
        Baoquan::destroy($request->id);
      return response()->json(['message' => 'Thành công'], 200);
    }
    public function trahienvatbaoquan(Request $request)
    {
        $data = $request->hienvat_id;
        if ($data) {
            foreach ($data as $dm) {
                $hienvat = Hienvat::find($dm);
                $hienvat->checkxuatnhap = 1;
                $ghichu = [];
                $ghichu['noidung'] = 'Đã chuyển về kho bảo quản';
                $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                $data = $hienvat->ghichu;
                $data[] = $ghichu;
                // $data[] = $ghichu;
                $hienvat->ghichu = $data;
                $hienvat->save();
            }
        }
        $Baoquan = Phieubaoquan::find($request->id);
        $Baoquan->trangthai = 2;
        $Baoquan->save();
        return 1;
    }
    public function duyetbaoquan(Request $request)
    {

        $data = $request->hienvat_id;
        if ($data) {
            foreach ($data as $dm) {
                $hienvat = Hienvat::find($dm);
                $hienvat->checkxuatnhap = 3;
                $ghichu = [];
                $ghichu['noidung'] = 'Đã chuyển đến kho bảo quản: ' . $request->name;
                $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                $data = $hienvat->ghichu;
                $data[] = $ghichu;
                // $data[] = $ghichu;
                $hienvat->ghichu = $data;
                $hienvat->save();
            }
        }

        $Baoquan = Phieubaoquan::find($request->id);
        $Baoquan->trangthai = 1;
        $Baoquan->save();
        return 1;
    }
    //  Sổ bảo quản hiện vật
    public function SoBaoQuanHienVat(Request $request)
    {
        return view('baoquan.index');
    }

    public function ajaxSoBaoQuanHienVat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $SoBaoQuanHienVat = Phieubaoquan::orderBy('id', 'desc');
        $SoBaoQuanHienVat = searchColum($SoBaoQuanHienVat, $searchcolum, $searchnow);

        $SoBaoQuanHienVat = $SoBaoQuanHienVat->with('hienvats')->get();

        foreach ($SoBaoQuanHienVat as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($SoBaoQuanHienVat)->make(true);
    }


    public function saveSoBaoQuanHienVat(Request $request)
    {
        $SoBaoQuanHienVat = new Phieubaoquan();
        $SoBaoQuanHienVat->name = $request->name;

        $SoBaoQuanHienVat->save();

        $result = [];
        foreach ($request->hienvats as $item) {
            $result[] = $item['id'];
        }

        $SoBaoQuanHienVat->hienvats()->attach($result);

        Helper::saveHistory('Thêm phiếu bảo quản', $request->name);

      return response()->json(['message' => 'Thành công'], 200);
    }

    public function updateSoBaoQuanHienVat(Request $request)
    {
        $SoBaoQuanHienVat = Phieubaoquan::where('id', $request->id)->first();
        $SoBaoQuanHienVat->name = $request->data['name'];

        $SoBaoQuanHienVat->save();

        $result = [];
        foreach ($request->data['hienvats'] as $item) {
            $result[] = $item['id'];
        }
        $SoBaoQuanHienVat->hienvats()->sync($result);

        Helper::saveHistory('Sửa phiếu bảo quản', $request->data['name']);

      return response()->json(['message' => 'Thành công'], 200);
    }

    public function deleteSoBaoQuanHienVat(Request $request)
    {
        $title = Phieubaoquan::where('id', $request->id)->first()->name;
        Helper::saveHistory('Xoá phiếu bảo quản', $title);
        Phieubaoquan::destroy($request->id);
      return response()->json(['message' => 'Thành công'], 200);
    }
}
