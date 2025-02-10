<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phongban extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'phongban_users', 'phongban_id', 'user_id');
    }
}
