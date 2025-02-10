<?php

namespace App\Http\Controllers;
use App\Helper;

use Illuminate\Http\Request;
use App\Models\Module;
use Yajra\DataTables\Facades\DataTables;

class ModuleController extends Controller
{
    public function Module(Request $request)
    {
        return view('danhmuc.module');
    }

    public function ajaxModule(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Module = Module::orderBy('id', 'desc')->get();
        return $Module;
    }

    public function statusModule(string $id)
    {
        $module = Module::where('id', $id)->first();
        $module->is_active = !$module->is_active;
        $module->save();
        Helper::saveHistory($module->is_active ? 'Thêm module' : 'Gỡ module', $module->title);

        return $module;
    }
}

