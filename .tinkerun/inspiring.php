<?php

use App\Models\Nhansu;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;


$nhansu = Nhansu::select('donvi_ma')->distinct()->get();
return count($nhansu);