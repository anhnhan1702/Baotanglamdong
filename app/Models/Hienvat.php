<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hienvat extends Model
{
    use HasFactory;
    // public function loaihienvat()
    // {
    //     return $this->hasOne(Loaihienvat::class);
    // }
    // public function niendai()
    // {
    //     return $this->belongsTo(Niendai::class,'niem_dai_tuong_doi');
    // }
    // public function thoiky()
    // {
    //     return $this->belongsTo(Thoiky::class,'thoi_ky');
    // }
    public function loaihienvat()
    {
        return $this->belongsTo(Loaihienvat::class,'loaihienvat_id');
    }
    public function bosuutap()
    {
        return $this->belongsTo(Bosuutap::class,'bosuutap_id');
    }
    public function tenhinhthucsuutam()
    {
        return $this->belongsTo(Hinhthucsuutam::class,'hinhthucst_id');
    }
    public function tenchatlieu()
    {
        return $this->belongsTo(Chatlieu::class,'chatlieu_id');
    }
    public function kho()
    {
        return $this->belongsTo(Kho::class,'vitrihv_id');
    }

    public function sodichuyens(){
        return $this->belongsToMany(Sodichuyenhienvat::class, 'sodichuyen_hienvat', 'hienvat_id', 'sodichuyen_id')->withPivot('trangthai');
    }
    public function phieubaoquans(){
        return $this->belongsToMany(Phieubaoquan::class, 'kho_hienvat_loaibaoquan', 'hienvat_id', 'phieubaoquan_id')->withPivot('baoquan_id', 'trangthai')
        ->withTimestamps();
    }
    public function baoquans(){
        return $this->belongsToMany(Baoquan::class, 'kho_hienvat_loaibaoquan', 'hienvat_id', 'baoqua_id')->withPivot('phieubaoquan_id', 'trangthai')
        ->withTimestamps();
    }
    protected $casts = [
        'quyet_dinh_giam_doc_ngay' => 'date',
        'ngay_quyet_dinh_nhap' => 'date',
        'thoi_gian_tiep_can_hien_vat' => 'date',
        'thoi_gian_dang_ky' => 'date',
        'thoi_gian_kiem_ke' => 'date',
        'ngay_bao_quan' => 'date',
        'ngay_luu_giu' => 'date',
        'ngay_quyet_dinh' => 'date',
        'ghichu' => 'array',
  
        

    ];
    protected $fillable = [
        'active'
    ];
}
