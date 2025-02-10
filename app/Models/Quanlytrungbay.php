<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quanlytrungbay extends Model
{
    use HasFactory;
    protected $casts = [
        'hienvat_id' => 'array',
    ];
}
