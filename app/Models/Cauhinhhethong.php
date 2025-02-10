<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cauhinhhethong extends Model
{
    use HasFactory;
    protected $data_colum = [
        array(
            "name"  => 'name',
            "label"  => 'Tên',
            "type"  => 'string',
            "value" => '',
            "hiden" => true,
            "center" => true,
        ),
        array(
            "name"  => 'giaodien',
            "label"  => 'Giao diện được sử dụng',
            "type"  => 'checkbox',
            "datacheckbox"  => ['Tự dộng', 'máy tính', 'Di động'],
            "value" => '',
            "hiden" => true,
            "center" => true,
        ),
        array(
            "name"  => 'mota',
            "label"  => 'Mô tả',
            "type"  => 'ckeditor',
            "value" => '',
            "hiden" => false,
            "center" => true,
        ),
        array(
            "name"  => 'ngungsudung',
            "label"  => 'Ngưng sử dụng',
            "type"  => 'checkbox',
            "datacheckbox"  => ['có', 'Không'],
            "value" => '',
            "hiden" => true,
            "center" => true,
        ),
        array(
            "name"  => 'noidungtb',
            "label"  => 'Nội dung thông báo ngưng sử dung',
            "type"  => 'ckeditor',
            "value" => '',
            "hiden" => false,
            "center" => true,
        ),
    
        
    ];

    public function scopeNoAdd() {
        return true;
    }

    public function scopeDatacolum($query)
    {
        return $this->data_colum;
    }
    // Khai báo các cột không được phép thêm vào bảng
    protected $guarded = [
        'remember_token'
    ];
    protected $casts = [];
}
