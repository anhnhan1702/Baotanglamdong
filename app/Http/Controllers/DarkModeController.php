<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bosuutap;
use App\Models\Chatlieu;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Hinhthucsuutam;
use App\Models\Kho;
use App\Models\Loaihienvat;

class DarkModeController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switch()
    {
        session([
            'dark_mode' => session()->has('dark_mode') ? !session()->get('dark_mode') : true
        ]);

        return back();
    }
    public function thongtinhienvat($id)
    { 
        $infoThongtinhienvat = Hienvat::where('id',$id)->first();
        if ($infoThongtinhienvat->loaihienvat_id) {
            $loaihienvat = Loaihienvat::find($infoThongtinhienvat->loaihienvat_id);
         
            $infoThongtinhienvat->tenloaihienvat =  $loaihienvat->name;
        } else {
            $infoThongtinhienvat->tenloaihienvat = 'Chưa xác định';
        }

        if ($infoThongtinhienvat->bosuutap_id) {
            $bosuutap = Bosuutap::find($infoThongtinhienvat->bosuutap_id);
            $infoThongtinhienvat->tenbosuutap =  $bosuutap->name;
        } else {
            $infoThongtinhienvat->tenbosuutap = 'Chưa xác định';
        }

        if ($infoThongtinhienvat->hinhthucst_id) {
            $hinhthuc = Hinhthucsuutam::find($infoThongtinhienvat->hinhthucst_id);
            $infoThongtinhienvat->hinhthucsuutam =  $hinhthuc->name;
        } else {
            $infoThongtinhienvat->hinhthucsuutam = 'Chưa xác định';
        }

        if ($infoThongtinhienvat->chatlieu_id) {
            $chatlieu = Chatlieu::find($infoThongtinhienvat->chatlieu_id);
            $infoThongtinhienvat->chatlieu =  $chatlieu->name;
        } else {
            $infoThongtinhienvat->chatlieu = 'Chưa xác định';
        }

        if ($infoThongtinhienvat->vitrihv_id) {
            $vitri = Kho::find($infoThongtinhienvat->vitrihv_id);
            $infoThongtinhienvat->vitrihienvat =  $vitri->name;
        } else {
            $infoThongtinhienvat->vitrihienvat = 'Chưa xác định';
        }
        $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$infoThongtinhienvat->id)->orderBy('id', 'desc')->get();

        if (count($fileuploads) >= 2) {
            $infoThongtinhienvat->anh1 =   $fileuploads[0]['link'];
            $infoThongtinhienvat->anh2 =    $fileuploads[1]['link'];
        } else if (count($fileuploads) > 0) {
            $infoThongtinhienvat->anh1 =    $fileuploads[0]['link'];
            $infoThongtinhienvat->anh2 = null;
        }
        if($fileuploads == null){
            $infoThongtinhienvat->fileuploads = null;
        }else{
            $infoThongtinhienvat->fileuploads =  $fileuploads;
        }
        if ($infoThongtinhienvat->thoi_gian_st) {
            $time = strtotime($infoThongtinhienvat->thoi_gian_st);
            $newformat = date('d/m/Y ',$time);
           
            $infoThongtinhienvat->thoi_gian_st = $newformat;
        
        } else {
            $infoThongtinhienvat->thoi_gian_st = '';
        }
        if ($infoThongtinhienvat->tg_nhap_kho) {
            $time = strtotime($infoThongtinhienvat->tg_nhap_kho);
            $newformat = date('d/m/Y ',$time);
           
            $infoThongtinhienvat->tg_nhap_kho = $newformat;
        
        } else {
            $infoThongtinhienvat->tg_nhap_kho = '';
        }
        // return $infoThongtinhienvat;
        return view('qrhienvat.thongtinhienvat', [
            'infoThongtinhienvat' => $infoThongtinhienvat,
        ]);
    }
}
