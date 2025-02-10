<?php

namespace App\Http\Controllers;

use App\Models\Hienvat;
use App\Models\Kho;
use App\Models\Vitrikho;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Helper;


class KhoController extends Controller
{
    public function xemkho(Request $request)
    {
        $kho_id = $request->kho_id;
        $vitri = Vitrikho::where('kho_id', $kho_id)->where('tinhtrang', 1)->get();
        foreach ($vitri as $vt) {
            if ($vt->hienvat) {
                $vt->tenhienvat = $vt->hienvat->name;
                $vt->color = 'text-green-500';
            } else {
                $vt->tenhienvat = 'Đang trống';
                $vt->color = 'text-red-500';
            }
        }
        return $vitri;
    }
    public function layout(Request $request)
    {
        return view('quanlyhienvat.quanlykho');
    }
    public function ajaxkho(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $kho = Kho::orderBy('id', 'desc');
        $kho = searchColum($kho, $searchcolum, $searchnow);

        $kho = $kho->get();
        foreach ($kho as $btc) {
            $btc->stt = ++$dem;
            $btc->namekhocha = null;
            $khocon = KhoController::laykho($btc->id);
            // $btc->khocon=$khocon;
            $btc->tonghienvat = Hienvat::whereIn('vitrihv_id',$khocon)->count();

            if ($btc->kho_id != null) {
                $namekhocha = Kho::where('id', $btc->kho_id)->first();
                $btc->namekhocha = $namekhocha->name;
            }
        }
        return DataTables::of($kho)->make(true);
    }
    public function laykho($kho_id)
    {
        $arr = [$kho_id];
        $kho = Kho::where('kho_id', $kho_id)->get();
        foreach ($kho as $k) {
            $check =  Kho::where('kho_id', $k->id)->count();
            if ($check > 0) {
                $kho = KhoController::laykho($k->id);
                // $arr[] = $k->id;
                foreach ($kho as $k1) {
                    $arr[] = $k1;
                }
            } else {
                $arr[] = $k->id;
            }
        }

        return  $arr;
    }
    public function savekho(Request $request)
    {
        $kho = new Kho();
        $kho->name = $request->name;
        // $kho->soluong = $request->soluong;
        $kho->kho_id = $request->kho_id;
        $kho->save();
        Helper::saveHistory('Thêm kho', $kho->name);

       return ('Thành công');
    }
    public function updatekho(Request $request)
    {
        $kho = Kho::where('id', $request->id)->first();
        $kho->name = $request->data['name'];
        $kho->kho_id = $request->data['kho_id'];
        // $kho->soluong = $request->data['soluong'];
        $kho->save();
        Helper::saveHistory('Sửa kho', $kho->name);

       return ('Thành công');
    }
    public function deletekho(Request $request)
    {
        $kho = Kho::where('id', $request->id)->first();
        Helper::saveHistory('Xoá kho', $kho->name);

        Kho::destroy($request->id);
       return ('Thành công');
    }
    public function datakho()
    {
        $infoKho = Kho::where('kho_id', null)->get();
        foreach ($infoKho as $kho) {
            $kiemtracocon = Kho::where('kho_id', $kho->id)->count();

            if ($kiemtracocon > 0) {
                $children = $this->khocon($kho->id);
                $kho->children = $children;
            }
        }

        return $infoKho;
    }
    public function khocon($id)
    {
        $infoKho = Kho::where('kho_id', $id)->get();
        foreach ($infoKho as $kho) {
            $kiemtracocon = Kho::where('kho_id', $kho->id)->count();

            if ($kiemtracocon > 0) {
                $children = $this->khocon($kho->id);
                $kho->children = $children;
            }
        }
        return $infoKho;
        # code...
    }



    public function danhsachhienvat(Request $request)
    {
        return view('quanlybaoquanhienvat.danhsachhienvat');
    }
    public function danhsachhienvattrungbay(Request $request)
    {
        return view('quanlytrungbay.danhsachhienvattrungbay');
    }
    public function danhsachhienvattrungbayao(Request $request)
    {
        return view('quanlytrungbayao.danhsachhienvattrungbayao');
    }
}
