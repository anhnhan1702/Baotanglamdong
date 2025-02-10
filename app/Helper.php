<?php

namespace App;

use App\Models\System;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Helper
{

    public static function saveHistory($action, $content)
    {
        $history = new System();
        $history->title = Auth::user()->name;
        $history->time = Carbon::now()->format('d-m-Y H:i:s');
        $history->action = $action;
        $history->content = $content;
        $history->save();
    }

    public static function formatCode($code)
    {
        return str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', $code));
    }
}
