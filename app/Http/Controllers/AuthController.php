<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Cauhinhhethong;
use Illuminate\Support\Facades\Log;
use App\Models\System;
use Carbon\Carbon;
class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        $cauhinh = Cauhinhhethong::first();
        if($cauhinh->ngungsudung =="có")
        {
            return view('error/error', [
                'text' => $cauhinh->noidungtb
            ]);
        }
        return view('login/main', [
            'layout' => 'login'
        ]);
    }

    /**z
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (!\Auth::attempt([
            'name' => $request->name, 
            'password' => $request->password
        ])) {
            throw new \Exception('Wrong email or password.');
        }
        Helper::saveHistory('Đăng nhập', '');
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
