<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XuLyAnhController extends Controller
{
    public function index() {
        return view('xulyanh.index');
    }
}
