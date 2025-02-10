<?php

namespace App\Http\Controllers;

use App\Models\Fileuploads;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function danhmuc($table)
    {
        $info = DB::table($table)->orderBy('id', 'desc')->get();
        return $info;
    }
    public function dulieudanhmuc(Request $request)
    {
        $table =  $request->table;
        $id =  $request->id;
        $data = DB::table($table)->where('id', $id)->first();
        if ($data) {
            return  $data->name;
        } else {
            return  '';
        }
    }
    function searchColum($table, $searchcolum, $searchnow)
    {
        // Kiểm tra có biến search được đẩy lên hay ko
        if ($searchnow) {
            // Kiểm tra số lượng cột được phép search có lớn hơn 0 ko
            if (count($searchcolum) > 0) {
                // Cộng query
                $table = $table->where($searchcolum[0], 'like', '%' . $searchnow . '%');
                for ($i = 1; $i < count($searchcolum); $i++) {
                    $table = $table->orWhere($searchcolum[$i], 'like', '%' . $searchnow . '%');
                }
            }
        }
        return $table;
    }
    // public function scopeTest($query)
    // {
    //     return $query->where('id', '>', 0);
    // }
    public function get_table($table)
    {
        return 'App\Models\\' . $table;
    }
    public function plugin_table(Request $request)
    {
        $table =  $request->table;
        return view('plugin_table.index', ['table' => $table]);
    }
    public function get_plugin_table(Request $request)
    {
        // Dữ liệu ban đầu
        $data = [];
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $table =  $request->table;
        $page = $request->pagenow;
        $sodong = $request->length;
        $batdau = ($page - 1) * $sodong;
        // Lấy dữ liệu + phân trang
        $getmodel_table = Controller::get_table($table);
        $data_table = $getmodel_table::orderBy('id', 'desc')->offset($batdau)->limit($sodong);
        $data_table = Controller::searchColum($data_table, $searchcolum, $searchnow);
        // Lấy cột hiển thị
        $data['data_colum'] = $getmodel_table::datacolum();
        $data['noAdd'] = $getmodel_table::noAdd();
        // cột được hiển thị
        // $datacolum = ['id'];
        // cột có bảng nối
        $dataselect = [];
        // Lấy dữ liệu các cột hiển thị và nối
        foreach ($data['data_colum'] as $dt) {
            if (array_key_exists('jointable',  $dt)) {
                if (!array_key_exists('dependentfield',  $dt)) {
                    $dataselect[$dt['name']] = Controller::danhmuc($dt['jointable']);
                } else {
                    $returndatadependent = [];
                    $datadependent = Controller::danhmuc($dt['dependenttable']);
                    foreach ($datadependent as $dtdp) {
                        $returndatadependent[$dtdp->id] = DB::table($dt['jointable'])->where($dt['dependentfield'], $dtdp->id)->get();
                    }
                    $dataselect[$dt['name']] =  $returndatadependent;
                }
            }
        }
        // lấy dữ liệu
        $data_table = $data_table->get();
        // tùy chỉnh thông tin
        // foreach ($data_table as $key => $dt) {
        //     return $key;

        // }
        $data['data']['data'] =  $data_table;
        // đếm tổng bản ghi
        $data['data']['recordsTotal'] =  $getmodel_table::count();
        $data['data']['dataselect'] =  $dataselect;

        // Lấy dữ liệu cấu hình của cột
        return  $data;
    }
    public function save_plugin_table(Request $request)
    {
        $getmodel_table = Controller::get_table($request['table']);
        $data = $getmodel_table::create($request['data']);
        // đổi uuid  file upload thành id trường
        $files = Fileuploads::where('idtruong', $request['uuid'])->get();
        foreach ($files as $file) {
            $file->idtruong = $data->id;
            $file->save();
        }
        return $data;
        // return 
    }
    public function update_plugin_table(Request $request)
    {
        $getmodel_table = Controller::get_table($request['table']);
        return $getmodel_table::where('id', $request['id'])->update($request['data']);
    }
    public function delete_plugin_table(Request $request)
    {
        $getmodel_table = Controller::get_table($request['table']);
        return $getmodel_table::where('id', $request['id'])->delete();
    }
}
