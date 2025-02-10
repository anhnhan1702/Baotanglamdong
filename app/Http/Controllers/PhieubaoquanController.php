<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Phieubaoquan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PhieubaoquanController extends Controller
{
    //
    public function DanhSachHienVatSoBaoQuan(Request $request)
    {
        $title = Phieubaoquan::where('id', $request->id)->first()->name;
        return view('baoquan.danhsachhienvatdangbaoquan', [
            'name' => $title,
            'id' => $request->id,
        ]);
    }

    public function ajaxDanhSachHienVatSoBaoQuan(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $phieuBaoQuan_Id =  $request->phieuBaoQuan_Id;
        // Query dữ liệu
        $DanhSachHienVatSoBaoQuan = DB::table('kho_hienvat_loaibaoquan')
            ->join('hienvats', 'kho_hienvat_loaibaoquan.hienvat_id', '=', 'hienvats.id')
            ->select('kho_hienvat_loaibaoquan.*', 'hienvats.name as name_hienvat', 'hienvats.so_ky_hieu as so_ky_hieu_hienvat')
            ->where('phieubaoquan_id', $phieuBaoQuan_Id)->orderBy('id', 'desc');
        $DanhSachHienVatSoBaoQuan = searchColum($DanhSachHienVatSoBaoQuan, $searchcolum, $searchnow);

        $DanhSachHienVatSoBaoQuan = $DanhSachHienVatSoBaoQuan->get();

        foreach ($DanhSachHienVatSoBaoQuan as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($DanhSachHienVatSoBaoQuan)->make(true);
    }


    public function saveDanhSachHienVatSoBaoQuan(Request $request)
    {

        $dataDanhSachHienVatSoBaoQuan = $request->all();

        foreach ($dataDanhSachHienVatSoBaoQuan as $hienVatSoBaoQuan) {

            DB::table('kho_hienvat_loaibaoquan')->where('id', $hienVatSoBaoQuan['id'])->update([
                'trangthai' => $hienVatSoBaoQuan['trangthai'],
                'baoquan_id' => $hienVatSoBaoQuan['baoquan_id'],
                'ghichu' => $hienVatSoBaoQuan['ghichu'],
            ]);
            $name = $hienVatSoBaoQuan['name_hienvat'] .' - '.$hienVatSoBaoQuan['so_ky_hieu_hienvat'];
            Helper::saveHistory('Cập nhật dữ liệu hiện vật sổ bảo quản hiện vật', $name);
        }
     return response()->json(['message' => 'Thành công'], 200);
    }
}
