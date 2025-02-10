<?php

namespace App\Http\Controllers;

use App\Models\Phongban;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper;
use Illuminate\Support\Facades\DB;

class PhongbanController extends Controller
{
    public function phongban(Request $request)
    {
        return view('quanlihethong.phongban');
    }
    public function ajaxphongban(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $phongban = Phongban::orderBy('id', 'desc');
        $phongban = searchColum($phongban, $searchcolum, $searchnow);
       
        $phongban = $phongban->get();
        
        foreach ($phongban as $btc) {
            $btc->stt = ++$dem;
            $btc->users =  DB::table('phongban_users')->where('phongban_id', $btc->id)->get()->pluck('user_id');

        }
        return DataTables::of($phongban)->make(true);
    }
    public function savephongban(Request $request)
    {
        $phongban = new Phongban();
        $phongban->name = $request->name;
        $phongban->save();
        if($request->users){
            $phongban->users()->attach($request->users);
        }
        Helper::saveHistory('Thêm phòng ban', $phongban->name);

       return response('Thành công', 200);
    }
    public function updatephongban(Request $request)
    {
        $phongban = Phongban::where('id', $request->id)->first();
        $phongban->name = $request->data['name'];
        $phongban->save();
        if($request->users){
            $phongban->users()->sync($request->users);
        }
        Helper::saveHistory('Sửa phòng ban', $phongban->name);

       return response('Thành công', 200);
    }
    public function deletephongban(Request $request)
    {
        $user = User::where('phongban_id', $request->id)->get();
        $phongban = Phongban::where('id', $request->id)->first();
        if(count($user) == 0){
            Helper::saveHistory('Xoá phòng ban', $phongban->name);
            Phongban::destroy($request->id);
            return ['true','thành công'];
        }else{
            return['false', 'Cần di chuyển những người thuộc "'.$phongban->name.'" đến những phòng ban khác'];
        }
    }
}
