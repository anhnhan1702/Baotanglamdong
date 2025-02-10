<?php
namespace App\Http\Controllers;
// use Illuminate\Http\Request;

use App\Helper;
use App\Models\Chucvu;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function nguoidung()
    {
        return view('quanlihethong.user');
    }
  
    public function ajaxnguoidung(Request $request)
    {
        // $x = Infomationuse::first();
        // return gettype($x->id);
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $nguoidung = User::orderBy('id', 'desc');
        $nguoidung = searchColum($nguoidung, $searchcolum, $searchnow);
        $nguoidung = $nguoidung->get();
        $nguoidung = $nguoidung->map(function ($user) {
            $user->chucvu = Chucvu::where('id', $user->chucvu_id)->first()->name;
            if (!isset($user->last_seen) || $user->last_seen === null) {
                Log::info('aaaaaaa');
                $user->last_seen = null;
                $user->online = false;
            } else {
                Log::info('bbbbbbbb');
                Log::info($user->last_seen);
                Log::info(now()->subMinutes(5));

                $user->online = Carbon::parse($user->last_seen)->gte(now()->subMinutes(10));
            }
            return $user;
        });
        // return $nguoidung->password;

        // return $htro->dschukyso;

        return DataTables::of($nguoidung)->make(true);
    }
   
    public function savenguoidung(Request $request)
    {
        
        $nguoidung = new User();
        $nguoidung->name = $request->name;
        $nguoidung->email = $request->email;
        $nguoidung->password = Hash::make($request->password);
        $nguoidung->gender = $request->gender;
        $nguoidung->donvi_ma = $request->donvi_ma;
        $nguoidung->chucvu_id = $request->chucvu_id;
        $nguoidung->phongban_id = $request->phongban_id;
        $nguoidung->save();
        Helper::saveHistory('Thêm người dùng', $nguoidung->name);

       return response('Thành công', 200);
    }

    public function updatenguoidung(Request $request)
    {
        $nguoidung = User::where('id', $request->id)->first();
        // return $nguoidung;

        $nguoidung->name = $request->data['name'];
        $nguoidung->email = $request->data['email'];
        $nguoidung->password = Hash::make($request->data['password']) ;
        $nguoidung->gender = $request->data['gender'];
        $nguoidung->donvi_ma = $request->data['donvi_ma'];
        $nguoidung->chucvu_id = $request->data['chucvu_id'];
        $nguoidung->phongban_id = $request->data['phongban_id'];
        $nguoidung->save();
        Helper::saveHistory('Sửa người dùng', $nguoidung->name);

        // return $nguoidung;
       return response('Thành công', 200);
    }
    
    public function deletenguoidung(Request $request)
    {
        $nguoidung = User::where('id', $request->id)->first();
        Helper::saveHistory('Xoá người dùng', $nguoidung->name);
        User::destroy($request->id);
       return response('Thành công', 200);
    }
    public function changepassword()
    {
        return view('login.changepassword');
    }
    public function changepw(Request $request)
    {
        $pass = auth()->user()->password;

        if (Hash::check($request->oldpassword, $pass) && $request->newpassword == $request->newpassword2) {
            $user = User::where('id', auth()->user()->id)->first();
            $user->password = Hash::make($request->newpassword);
 
            $user->save();
            Helper::saveHistory('Đổi mật khẩu', '');

            return 1;
        } else {
            return 2;
        }
    }
}
