<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baoquan extends Model
{
    use HasFactory;
    public function hienvats()
    {
        return $this->belongsToMany(HienVat::class, 'kho_hienvat_loaibaoquan', 'baoquan_id', 'hienvat_id')
            ->withPivot('phieubaoquan_id', 'trangthai')
            ->withTimestamps();
    }
    protected $casts = [
        'hienvat_id' => 'array',
    ];
}
