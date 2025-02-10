<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiaodienController extends Controller
{
    public function index()
    {
        return view('giaodien.giaodien2.index');
    }

    public function tintuc()
    {
        return view('giaodien.giaodien2.tintuc');
    }

    public function chitiettintuc()
    {
        return view('giaodien.giaodien2.chitiettintuc');
    }

    public function lienhe()
    {
        return view('giaodien.giaodien2.lienhe');
    }
}
