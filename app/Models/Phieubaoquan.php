<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieubaoquan extends Model
{
    use HasFactory;
    public function hienvats()
    {
        return $this->belongsToMany(HienVat::class, 'kho_hienvat_loaibaoquan', 'phieubaoquan_id', 'hienvat_id')
            ->withPivot('baoquan_id', 'trangthai')
            ->withTimestamps();
    }
    protected $casts = [
        'hienvat_id' => 'array',
        'kho_id' => 'array',
    ];
}
