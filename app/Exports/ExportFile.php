<?php

namespace App\Exports;

use App\Models\Hienvat;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFile implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hienvat::all();
    }
}
