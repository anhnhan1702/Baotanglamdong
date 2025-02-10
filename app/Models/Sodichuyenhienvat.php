<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sodichuyenhienvat extends Model
{
    use HasFactory;

    public function hienvats(){
        return $this->belongsToMany(Hienvat::class, 'sodichuyen_hienvat', 'sodichuyen_id', 'hienvat_id')->withPivot('trangthai')->select('id', 'name');
    }
}
