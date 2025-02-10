<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Fileuploads;
use App\Models\Sohoadulieuhienvat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SohoadulieuhienvatController extends Controller
{
    public function duLieuSoHoaHienVat(Request $request)
    {
        return view('dulieusohoahienvat.index');
    }

    public function ajaxduLieuSoHoaHienVat(Request $request)
    {

        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $duLieuSoHoaHienVat = Sohoadulieuhienvat::orderBy('id', 'desc');
        $duLieuSoHoaHienVat = searchColum($duLieuSoHoaHienVat, $searchcolum, $searchnow);

        $duLieuSoHoaHienVat = $duLieuSoHoaHienVat->get();
        foreach ($duLieuSoHoaHienVat as $shhv) {
            $shhv->stt = ++$dem;
            $fileuploads = Fileuploads::where('tenbang', 'sohodulieuhienvat')->where('idtruong', $shhv->id)->orderBy('id', 'desc')->get();
            if ($fileuploads == null) {
                $shhv->fileuploads = null;
            } else {
                $shhv->fileuploads =  $fileuploads;
            }
        }
        return DataTables::of($duLieuSoHoaHienVat)->make(true);
    }

    public function saveduLieuSoHoaHienVat(Request $request)
    {
        $duLieuSoHoaHienVat = new Sohoadulieuhienvat();
        $duLieuSoHoaHienVat->name = $request->name;
        $duLieuSoHoaHienVat->save();
        $file = Fileuploads::where('tenbang', 'sohodulieuhienvat')->Where('idtruong', $request->uuid)->get();
        foreach ($file as $f) {
            $f->idtruong =  $duLieuSoHoaHienVat->id;
            $f->save();
        }
        Helper::saveHistory('Thêm dữ liệu số hóa hiện vật', $duLieuSoHoaHienVat->name);
        return 'thành công';
    }

    public function updateduLieuSoHoaHienVat(Request $request)
    {
        $duLieuSoHoaHienVat = Sohoadulieuhienvat::where('id', $request->id)->first();
        $duLieuSoHoaHienVat->name = $request->data['name'];
        $duLieuSoHoaHienVat->save();
        Helper::saveHistory('Sửa dữ liệu số hóa hiện vật', $duLieuSoHoaHienVat->name);
        return 'thành công';
    }

    public function deleteduLieuSoHoaHienVat(Request $request)
    {
        $duLieuSoHoaHienVat = Sohoadulieuhienvat::where('id', $request->id)->first();
        Helper::saveHistory('Xoá dữ liệu số hóa hiện vật', $duLieuSoHoaHienVat->name);
        $file = Fileuploads::where('tenbang', 'sohodulieuhienvat')->Where('idtruong', $duLieuSoHoaHienVat->id)->get();
        foreach ($file as $f) {
            Fileuploads::destroy($f->id);
        }
        Sohoadulieuhienvat::destroy($request->id);

        return 'thành công';
    }
  
}
