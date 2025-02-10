<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Fileuploads;
use Illuminate\Http\Request;
use App\Models\Portal;
use Yajra\DataTables\Facades\DataTables;

class PortalController extends Controller
{
    public function portal(Request $request)
    {
        return view('portal.portal');
    }

    public function ajaxPortal(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Portal = Portal::orderBy('id', 'desc');
        $Portal = searchColum($Portal, $searchcolum, $searchnow);

        $Portal = $Portal->get();
        foreach ($Portal as $btc) {
            $btc->stt = ++$dem;
            $fileGiaoDienimport=Fileuploads::where('tenbang','giaodien')->Where('idtruong', $btc->id)->get();
   
            if ($fileGiaoDienimport) {
                $arrGiaoDienImport = [];
                $index = 3;
                foreach ($fileGiaoDienimport as $file) {
                    $arr= [];
                    $arr['name'] = 'Giao diện số '.$index;
                    $arr['id'] = $file->id;
                    array_push($arrGiaoDienImport,$arr);
                    $index = $index ++;
                }
                $btc->arrgiaodienimport = $arrGiaoDienImport;
            }
        }
        return DataTables::of($Portal)->make(true);
    }

    public function savePortal(Request $request)
    {
        $Portal = new Portal();
        $Portal->title = $request->title;
        $Portal->content = $request->content;
        $Portal->type = $request->type;
        $Portal->save();
        Helper::saveHistory('Thêm portal', $Portal->title);
        $file = Fileuploads::Where('idtruong', $request->uuid1)->get();
        foreach ($file as $f) {
            $f->idtruong =  $Portal->id;
            $f->save();
        }
       return response('Thành công', 200);
    }

    public function updatePortal(Request $request)
    {
        // return $request->data['content'];
        $Portal = Portal::where('id', $request->id)->first();
        $Portal->title = $request->data['title'];
        $Portal->content = $request->data['content'];
        $Portal->type = $request->data['type'];
        
        $Portal->save();

        Helper::saveHistory('Sửa portal', $Portal->title);

       return response('Thành công', 200);
    }

    public function deletePortal(Request $request)
    {
        $Portal = Portal::where('id', $request->id)->first();
        Helper::saveHistory('Xoá portal', $Portal->title);
        Portal::destroy($request->id);
       return response('Thành công', 200);
    }
}
