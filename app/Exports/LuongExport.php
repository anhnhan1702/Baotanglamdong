<?php

namespace App\Exports;

use App\Models\Donvi;
use App\Models\Hesoluong;
use App\Models\Luong;
use App\Models\Nhansu;
use App\Models\Phucapchucvu;
use App\Models\Phucapthamnien;
use App\Models\Quyluong;
use App\Models\Thamnienvuotkhung;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LuongExport implements FromView, WithStyles
{
    public function __construct(int $loainv)
    {
        $this->loainv =2;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if ($this->loainv) {
            if ($this->loainv == 1) {
                $luong = Luong::where('chucvu', 0)->get();
            } else {
                $luong = DB::table('luongs')->join('nhansus','nhansus.id','=','luongs.user_id')
                ->where('luongs.chucvu', 1)->orderBy('nhansus.donvi_ma','desc')->get();
                foreach($luong as $l)
                {
                    $l->ngaysinh1 = Carbon::createFromFormat('Y-m-d',$l->ngaysinh)->format('d/m/Y');
                    $l->namcongtac1 = Carbon::createFromFormat('Y-m-d',$l->namcongtac)->format('d/m/Y');
                    $l->hesoluong = Hesoluong::where('id',$l->hesoluong_id)->first()->name;
                    $l->thamnienvuotkhung = Thamnienvuotkhung::where('id',$l->thamnienvuotkhung_id)->first()->name;
                    $l->phucapthamnien = Phucapthamnien::where('id',$l->phucapthamnien_id)->first()->name;
                    $l->phucapchucvu = Phucapchucvu::where('id',$l->phucapchucvu_id)->first()->name;
                    $quyluong = Quyluong::where('id',$l->quyluong)->first();
                    $l->quyluong = (int)$quyluong->name;
                    $l->tiendongbaohiem = (int)$quyluong->name * $l->tongluong;
                    $l->csdld = $quyluong->congtytra;
                    $l->nld = $quyluong->nguoilaodongtra;
                    $donvi = Donvi::where('ma',$l->donvi_ma)->first();
                    if( $donvi)
                    {
                        $l->donvi = $donvi->name;
                    }
                    else
                    {
                        $l->donvi ='';
                    }

                }
            }
            $dem = $nhansu = Nhansu::select('donvi_ma')->distinct()->get();
            $this->sodong = 6 + count($luong) + count($dem) ;
            return view('thongke.export-luong', [
                'luong' => $luong,
                'check' => '',
                'loainv' => $this->loainv
            ]);
        }
    }
    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFFF0000'],
                ],
            ],
        ];
        $sheet->getStyle('A6:O'.$this->sodong)->applyFromArray($styleArray);
        $sheet->getStyle('A6:O'.$this->sodong)->getAlignment()->setWrapText(true);
        // $sheet->getStyle('5:7')->getAlignment()->setWrapText(true);
        $sheet->getStyle('1:2')->getFont()->setSize(12);
        $sheet->getStyle('1:2')->getFont()->setBold(true);
        $sheet->getStyle('6')->getFont()->setBold(true);
        $sheet->getStyle('6')->getFont()->setSize(12);
        $sheet->getStyle('4')->getFont()->setSize(12);
        $sheet->getStyle('4')->getFont()->setBold(true);





    }
}
