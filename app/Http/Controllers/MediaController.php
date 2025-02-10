<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Hienvat;
use App\Models\Media;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MediaController extends Controller
{
    public function media(Request $request)
    {
        return view('xulyhinhanh.media');
    }
    public function ajaxmedia(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $media = Media::orderBy('id', 'desc');
        $media = searchColum($media, $searchcolum, $searchnow);

        $media = $media->get();
        foreach ($media as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($media)->make(true);
    }
    public function savemedia(Request $request)
    {
        $media = new Media();
        $media->name = $request->name;
        $media->save();
        Helper::saveHistory('Lưu media', $media->name);

       return ('Thành công');
    }
    public function updatemedia(Request $request)
    {
        $media = Media::where('id', $request->id)->first();
        $media->name = $request->data['name'];
        $media->save();
        Helper::saveHistory('Sửa media', $media->name);

       return ('Thành công');
    }
    public function deletemedia(Request $request)
    {
        $media = Media::where('id', $request->id)->first();
        Helper::saveHistory('Xoá media', $media->name);
        Media::destroy($request->id);
       return ('Thành công');
    }

    public function testscss()
    {
        $listHienVat = Hienvat::where('create_by', null)->get();

        foreach ($listHienVat as $hv) {
            $hv->create_by = 16;
            $hv->save();

            # code...
        }
        return $listHienVat;
        return view('layout.testscss');
    }
}
