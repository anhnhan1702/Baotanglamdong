<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use App\Models\Danhmuc;
use Yajra\DataTables\Facades\DataTables;

class DanhmucController extends Controller
{
    public function Category(Request $request)
    {
        return view('danhmuc.danhmuc');
    }

    public function ajaxCategory(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Category = Danhmuc::orderBy('id', 'desc');
        $Category = searchColum($Category, $searchcolum, $searchnow);

        $Category = $Category->get();
        foreach ($Category as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($Category)->make(true);
    }

    public function saveCategory(Request $request)
    {
        $Category = new Danhmuc();
        $Category->title = $request->title;
        $Category->order = $request->order;
        $Category->save();
        Helper::saveHistory('Thêm danh mục', $request->title);
        
       return ('Thành công');
    }

    public function updateCategory(Request $request)
    {
        $Category = Danhmuc::where('id', $request->id)->first();
        $Category->title = $request->data['title'];
        $Category->order = $request->data['order'];
        $Category->save();
        Helper::saveHistory('Sửa danh mục', $request->data['title']);

       return ('Thành công');
    }

    public function deleteCategory(Request $request)
    {
        $title = Danhmuc::where('id',$request->id)->first()->title;
        Helper::saveHistory('Xoá danh mục', $title);
        Danhmuc::destroy($request->id);
       return ('Thành công');
    }
}
