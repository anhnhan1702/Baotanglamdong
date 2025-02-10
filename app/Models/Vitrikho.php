<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitrikho extends Model
{
    use HasFactory;
    public function hienvat()
    {
        return $this->belongsTo(Hienvat::class)->select(['id','name']);
    }
    public function kho()
    {
        return $this->belongsTo(Kho::class)->select(['id','name']);
    }
}
