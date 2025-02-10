<?php

namespace App\Imports;

use App\Models\Donvi;
use App\Models\Hesoluong;
use App\Models\Nhansu;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class DulieubandauImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $check = 0;
        foreach ($collection as $key => $row) {
            if ($key >= 8) {
                $cot2 = preg_replace('/\s+/', '', $row[1]);
                if ($cot2 == 'NGƯỜILẬPBIỂU') {
                    $check = 1;
                }
                if (!$row[0] && $row[1]  && $check == 0) {

                    $donvi = new Donvi();
                    $donvi->name = $row[1];
                    $donvi->save();
                }
                if ($row[0] && $row[1] && $row[2]) {
                    $nhansu = new Nhansu();
                    $nhansu->name = $row[1];
                    // $nhansu->ngaysinh = $row[2];
                    $ngaysinh = explode('/', $row[2]);
                    for($i=0;$i<count($ngaysinh);$i++)
                    {
                        if(strlen($ngaysinh[$i]) == 1)
                        {
                            $ngaysinh[$i] = '0'.$ngaysinh[$i];
                        }
                    }
                    if($ngaysinh)
                    {
                        $date = $ngaysinh[2].'-'. $ngaysinh[1].'-'. $ngaysinh[0];
                        $date1 = str_replace('`','', $date); 
                        $nhansu->ngaysinh = new Carbon($date1);
                    }
                    

                    // $nhansu->namcongtac = $row[3];
                    // $nhansu->vaocongty = $row[4];
                    $hsl = Hesoluong::where('name',$row[5])->first();
                    if($hsl)
                    {
                        $nhansu->hesoluong_id = $hsl->id;
                    }
                    else
                    {
                        $newhsl = new Hesoluong();
                        $newhsl->name = $row[5];
                        $newhsl->save();
                        $nhansu->hesoluong_id = $newhsl->id;
                    }
                    $nhansu->thamnienvuotkhung_id = $row[6];
                    $nhansu->phucapthamnien_id = $row[7];
                    $nhansu->phucapchucvu_id = $row[8];
                    $nhansu->thulao = $row[9];
                    $nhansu->quyluong = $row[10];
                    $nhansu->phucap5 = $row[11];
                    $nhansu->sosobaohiem = $row[13];
                    // $nhansu->donvi_ma = $row[1];
                    $nhansu->save();
                }
            }
        }
    }
}
