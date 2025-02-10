<?php

namespace App\Http\Controllers;

use App\Exports\ExportFile;
use App\Models\Testapi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class XuatexcellController extends Controller
{
    public function export() 
    {
        return Excel::download(new ExportFile, 'hienvat.xlsx');
    }
    public function testapi(Request $request)
    {
       return view('testapi');
    }
    public function apiluu(Request $request)
    {
       $data = new Testapi();
       $data->name =$request->all();
       $data->save();
       return $request->all();
    }
    public function apilay(Request $request)
    {
       return Testapi::all();
    }
}
