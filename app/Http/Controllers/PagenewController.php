<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Pagenew;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PagenewController extends Controller
{
    public function pagenew(Request $request)
    {
        return view('portal.pagenew');
    }

    public function ajaxPagenew(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Pagenew = Pagenew::orderBy('id', 'desc');
        $Pagenew = searchColum($Pagenew, $searchcolum, $searchnow);

        $Pagenew = $Pagenew->get();
        foreach ($Pagenew as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($Pagenew)->make(true);
    }

    public function savePagenew(Request $request)
    {
        $Pagenew = new Pagenew();
        $Pagenew->title = $request->title;
        $Pagenew->content = $request->content;
        $Pagenew->desc = $request->desc;
        $Pagenew->keyword = $request->keyword;
        if ($request->hasFile('file')) {
            $Pagenew->thumbnail = $request->file('file')->store('uploads', 'public');
        }
        $Pagenew->save();
        Helper::saveHistory('Thêm trang con', $Pagenew->title);

        return 'thành công';
    }

    public function updatePagenew(Request $request)
    {
        $Pagenew = Pagenew::where('id', $request->id)->first();
        $Pagenew->title = $request->data['title'];
        $Pagenew->desc = $request->data['desc'];
        $Pagenew->content = $request->data['content'];
        $Pagenew->keyword = $request->data['keyword'];

        $Pagenew->save();
        Helper::saveHistory('Sửa trang con', $Pagenew->title);

        return 'thành công';
    }

    public function deletePagenew(Request $request)
    {
        $Pagenew = Pagenew::where('id', $request->id)->first();
        Helper::saveHistory('Xoá trang con', $Pagenew->title);
        Pagenew::destroy($request->id);
        return 'thành công';
    }
}
