<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Bosuutap;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Kho;
use App\Models\Quanlytrungbay;
use App\Models\User;
use App\Models\Vitrikho;
use App\Models\Xuatnhap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LDAP\Result;
use Yajra\DataTables\DataTables;

class XuatnhapController extends Controller
{

    
    public function hienvattontai(Request $request)
    {
        $bosuutap = $request->all();
        // $vitrikho = Vitrikho::distinct()->whereNotNull('hienvat_id')->pluck('hienvat_id');
        // $hienvat = Hienvat::whereIn('bosuutap_id', $bosuutap)->whereIn('id', $vitrikho)->get();
        $hienvat = Hienvat::where('checkxuatnhap', 1)->whereIn('bosuutap_id', $bosuutap)->select('id', 'name','vitrihv_id','tinh_trang_hv','kich_thuoc')->get();

        foreach ($hienvat as $hv) {
            $fileuploads = Fileuploads::where('tenbang','hienvats')->where('idtruong',$hv->id)->orderBy('id', 'desc')->first();
            if($fileuploads == null){
                $hv->fileuploads = null;
            }else{
                $hv->fileuploads =  $fileuploads->link;
            }

            $kho = Kho::where('id',$hv->vitrihv_id)->first();
        
            $hv->vitri =  $kho->name;
            $hv->vitri_id = $kho->id;
        }
        return $hienvat;
    }
    public function duyetphieuxuat(Request $request)
    {
        $check = 0;
        $data = $request->all();
        if( count($data['danhmuchienvat']) > 0){
            $xuatnhap = Xuatnhap::find($data['id']);
            $xuatnhap->trangthai = 1;
            $xuatnhap->save();
            foreach ($data['danhmuchienvat'] as $dm) {

                $hienvat = Hienvat::find($dm['hienvat_id']);
                $hienvat->checkxuatnhap = 2;
                $ghichu = [];
                $ghichu['noidung'] = 'Xuất kho ';
                $ghichu['thoigian'] =Carbon::now()->format('Y-m-d H:i:s');
                $data = $hienvat->ghichu;
                $data[] = $ghichu;
                // $data[] = $ghichu;
                $hienvat->ghichu = $data;
                $hienvat->save();
            }
            return 0;
        }else{
            return 1;
        }

    }
    public function duyetphieu(Request $request)
    {
        $data = $request->all();
        $check = 0;
      
        if( count($data['danhmuchienvat']) > 0){
            foreach ($data['danhmuchienvat'] as $dm) { 
                if (!array_key_exists('vitri_id', $dm)) {
                    $check = 1;
                }
            }
            if ($check == 0) {
                $xuatnhap = Xuatnhap::find($data['id']);
                $xuatnhap->trangthai = 1;
                $xuatnhap->save();
                foreach ($data['danhmuchienvat'] as $dm) {
                    $hienvat = Hienvat::find($dm['hienvat_id']);
                    $hienvat->checkxuatnhap = 1;
                    $hienvat->vitrihv_id =$dm['vitri_id'];
                   
                    $ghichu = [];
                    $ghichu['noidung'] = 'Nhâp vào kho';
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                    $data = [];
                    $data = $hienvat->ghichu;
                    $data[] = $ghichu;
               
                    $hienvat->ghichu = $data;
                    $hienvat->save();
                }
                return 0;
            } else {
                return 1;
            }
        }else{
            return 3;
        }
       
    }
    public function hienvat(Request $request)
    {
      
        $bosuutap = $request->all();
        $hienvat = Hienvat::whereIn('bosuutap_id', $bosuutap)->whereNull('checkxuatnhap')->get();
        foreach($hienvat as $hv){
            $fileuploads = Fileuploads::where('tenbang','hienvats')->where('idtruong',$hv->id)->orderBy('id', 'desc')->first();
            if($fileuploads == null){
                $hv->fileuploads = null;
            }else{
                $hv->fileuploads =  $fileuploads->link;
            }  
        }
        return $hienvat;
    }

    public function gethienvat(Request $request)
    {
        // return $request->all();
        $hienvat_id = $request->hienvat_id;
        $hienvat = Hienvat::where('id', $hienvat_id)->first();
        if ($hienvat->loaihienvat_id) {
            $hienvat->nameloaihienvat =  $hienvat->loaihienvat->name;
        } else {
            $hienvat->nameloaihienvat = 'Chưa xác định';
        }
        if ($hienvat->bosuutap_id) {
            $hienvat->tenbosuutap =  $hienvat->bosuutap->name;
        } else {
            $hienvat->tenbosuutap = 'Chưa xác định';
        }
        if ($hienvat->hinhthucst_id) {
            $hienvat->namehinhthucsuutam =  $hienvat->tenhinhthucsuutam->name;
        } else {
            $hienvat->namehinhthucsuutam = 'Chưa xác định';
        }
        if ($hienvat->chatlieu_id) {
            $hienvat->namechatlieu =  $hienvat->tenchatlieu->name;
        } else {
            $hienvat->namechatlieu = 'Chưa xác định';
        }
        if ($hienvat->vitrihv_id) {

            $hienvat->vitrihienvat =  $hienvat->kho->name;
        } else {
            $hienvat->vitrihienvat = 'Chưa xác định';
        }
        return $hienvat;
    }
    public function laynguoinhap(Request $request)
    {
        $phongban =  $request->phongban_id;
        $user = User::all();
        return $user;
    }
    public function layvitri2(Request $request)
    {

        $vitrikhi = Vitrikho::where('kho_id', $request->kho_id)->whereNotNull('hienvat_id')->get();
        foreach ($vitrikhi as $vtk) {
            $hienvat = Hienvat::find($vtk->hienvat_id);
            if ($hienvat) {
                $vtk->name =  $vtk->name . '(hiện vật:' . $hienvat->name . ')';
                $vtk->hienvat =  $hienvat->name;
            }
        }
        return $vitrikhi;
    }
    public function bosutap()
    {
        // $kho = Kho::select('id', 'name')->get();
        // foreach ($kho as $k) {
        //     $vitrikhi = Vitrikho::where('kho_id', $k->id)->get();
        //     // foreach ($vitrikhi as $vtk) {
        //     //     $vtk->name =    $vtk->hienvat_id ? $vtk->name 
        //     // }
        //     $k->children = $vitrikhi;
        //     unset($k->id);
        // }
        // return $kho;
        $bosutap = Bosuutap::whereNull('parent_id')->select('id', 'name')->get();
        foreach ($bosutap as $bst) {
            $bst->children = XuatnhapController::dequyhienvat($bst->id);
            // $bst->label = 
        }
        return $bosutap;
    }
    public function dequyhienvat($bosutap_id)
    {
        $bosutap = Bosuutap::where('parent_id', $bosutap_id)->select('id', 'name')->get();
        if ($bosutap) {
            foreach ($bosutap as $bst) {
                $dem =  Bosuutap::where('parent_id', $bst->id)->count();
                if ($dem > 0) {
                    $bst->children = XuatnhapController::dequyhienvat($bst->id);
                } else {
                    // $data = Hienvat::whereIn('id',$bst->hienvat_id)->get();
                    // if ($bst->hienvat_id) {
                    //     $bst->children =  Hienvat::whereIn('id', $bst->hienvat_id)->select('id', 'name')->get();
                    // }
                }
            }
        }
        return  $bosutap;
    }

    public function xuatnhap(Request $request)
    {
        return view('quanlyhienvat.xuatnhap');
    }
    public function ajaxxuatnhap(Request $request)
    {
       
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $xuatnhap = Xuatnhap::orderBy('id', 'desc')->where('loaixuatnhap', 1);
        $xuatnhap = searchColum($xuatnhap, $searchcolum, $searchnow);

        $xuatnhap = $xuatnhap->get();
        foreach ($xuatnhap as $btc) {
            $btc->stt = ++$dem;
           $newDate = date("d-m-Y", strtotime($btc->thoigiantra));
           $btc->formatthoigiantra =  $newDate;
        }
        return DataTables::of($xuatnhap)->make(true);
    }
    public function ajaxxuatnhap2(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $xuatnhap = Xuatnhap::orderBy('id', 'desc')->where('loaixuatnhap', 2);
        $xuatnhap = searchColum($xuatnhap, $searchcolum, $searchnow);

        $xuatnhap = $xuatnhap->get();
        foreach ($xuatnhap as $btc) {
            $btc->stt = ++$dem;
        }
        return DataTables::of($xuatnhap)->make(true);
    }
    public function savexuatnhap(Request $request)
    {

        $xuatnhap = new Xuatnhap();
        $xuatnhap->name = $request->name;
        $xuatnhap->loaixuatnhap = $request->loaixuatnhap;
        $xuatnhap->diadiem = $request->diadiem;
        $xuatnhap->mucdichxuat = $request->mucdichxuat;
        $xuatnhap->cancuxuat = $request->cancuxuat;
        $xuatnhap->nguoixuat = $request->nguoixuat;
        $xuatnhap->donvixuat = $request->donvixuat;
        $xuatnhap->nguoinhan = $request->nguoinhan;
        $xuatnhap->donvinhan = $request->donvinhan;
        $xuatnhap->danhmuchienvat = $request->danhmuchienvat;
        
        $xuatnhap->thoigiantra = $request->thoigiantra;
        $xuatnhap->danhmucxuat = $request->danhmucxuat; 
        $xuatnhap->trungbay_id = $request->trungbay_id;
        $xuatnhap->trangthai = 0;
        $xuatnhap->save();
        Helper::saveHistory('Lưu nhập xuất', $xuatnhap->name);
        
        if(count($xuatnhap->danhmuchienvat) > 0){
        
            foreach ($xuatnhap->danhmuchienvat as $dmhv) {
                $infohienvat = Hienvat::where('id',$dmhv['hienvat_id'])->first();
        
                if($request->trangthai == 'nhap'){
                    $infohienvat->checkxuatnhap = 4;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hàng chờ nhập hiện vật'.' '.$xuatnhap->name;
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');     
                }else{
                    $infohienvat->checkxuatnhap = 5;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hàng chờ xuất hiện vật'.' '.$xuatnhap->name;
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                }
                $data = [];
                $data = $infohienvat->ghichu;
                $data[] = $ghichu;
                $infohienvat->xuatnhap_id = $xuatnhap->id;
                $infohienvat->ghichu = $data;
                $infohienvat->save();
                
            }
        }
   
      
        


      
       return ('Thành công');
    }
    public function updatexuatnhap(Request $request)
    {
      
        $xuatnhap = Xuatnhap::where('id', $request->id)->first();
        $xuatnhap->name = $request->data['name'];
        $xuatnhap->loaixuatnhap = $request->data['loaixuatnhap'];
        $xuatnhap->diadiem = $request->data['diadiem'];
        $xuatnhap->mucdichxuat = $request->data['mucdichxuat'];
        $xuatnhap->cancuxuat = $request->data['cancuxuat'];
        $xuatnhap->nguoixuat = $request->data['nguoixuat'];
        $xuatnhap->donvixuat = $request->data['donvixuat'];
        $xuatnhap->nguoinhan = $request->data['nguoinhan'];
        $xuatnhap->donvinhan = $request->data['donvinhan'];
        $xuatnhap->danhmuchienvat = $request->data['danhmuchienvat'];
        $xuatnhap->thoigiantra = $request->data['thoigiantra'];
        $xuatnhap->danhmucxuat = $request->data['danhmucxuat'];
        $xuatnhap->trungbay_id = $request->data['trungbay_id'];
        
        if($request->data['danhmuchienvat'] > 0){
            $hienvatmoi = [];
            foreach($request->data['danhmuchienvat'] as $dmhv){
                $hienvatmoi[]=$dmhv['hienvat_id'];
            }
         
            
            $hienvatkhac =array_diff($request->data['hienvat_id_old'],$hienvatmoi);
            $hienvatmoithem =array_diff($hienvatmoi,$request->data['hienvat_id_old']);

            // các hiện vật đã bị loại bỏ trả về trang thái cũ
            foreach ($hienvatkhac as $hv) {
          
                $infohienvat = Hienvat::where('id',$hv)->first();
                if( $request->data['trangthai'] == 'nhap'){
                    $infohienvat->checkxuatnhap = 0;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hiện vật chưa nhập kho';
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                }else{
                    $infohienvat->checkxuatnhap = 1;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hiện vật chưa xuất kho';
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                }
                $infohienvat->xuatnhap_id = null;
                $data = [];
                $data = $infohienvat->ghichu;
                $data[] = $ghichu;
                $infohienvat->ghichu = $data;
                $infohienvat->save();
            }
            // các hiện vật đã được vào hàng chờ 
            foreach ($hienvatmoithem as $hv) {
                $infohienvat = Hienvat::where('id',$hv)->first();
                if( $request->data['trangthai'] == 'nhap'){
                    $infohienvat->checkxuatnhap = 4;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hàng chờ nhập hiện vật'.' '.$request->data['name'];
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                }else{
                    $infohienvat->checkxuatnhap = 5;
                    $ghichu = [];
                    $ghichu['noidung'] = 'Hàng chờ xuất hiện vật'.' '.$request->data['name'];
                    $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                }
                $infohienvat->xuatnhap_id = $request->id;
                $data = [];
                $data = $infohienvat->ghichu;
                $data[] = $ghichu;
                $infohienvat->ghichu = $data;
                $infohienvat->save();
            }
        }
      
        $xuatnhap->save();
        Helper::saveHistory('Sửa nhập xuất', $xuatnhap->name);

       return ('Thành công');
    }
    public function deletexuatnhap(Request $request)
    {
        $xuatnhap = Xuatnhap::where('id', $request->id)->first();
        Helper::saveHistory('Xoá nhập xuất', $xuatnhap->name);
        Xuatnhap::destroy($request->id);
       return ('Thành công');
    }
    // lấy thông tin hiện vật và vị trí hiện vật
    public function infohienvatvitrikho(Request $request)
    {
        $danhmuchienvat = $request->all();
        $datahienvat=[];
        foreach($danhmuchienvat as $dmhv){
    
            $infohienvat = Hienvat::where('id',$dmhv['hienvat_id'])->first();
            $fileuploads = Fileuploads::where('tenbang','anhhienvat')->where('idtruong',$dmhv['hienvat_id'])->orderBy('id', 'desc')->first();
            $infohienvat->soluong = $dmhv['soluong'];
            if($fileuploads == null){
                $infohienvat->fileuploads = null;
            }else{
                $infohienvat->fileuploads =  $fileuploads->link;
            } 
           array_push($datahienvat,$infohienvat);
        }
        return $datahienvat;
    }
    // lấy thông tin bộ sưu tập đẫ xuất
    public function infobosuutapdaxuat(Request $request)
    {
       
        $infodataxuat = Xuatnhap::where('id',$request->id)->first();    
        $bosuutaps = Bosuutap::whereIn('id',$infodataxuat->bosuutap)->select('id', 'name','parent_id')->get();
        $parent_id =[];
        foreach($bosuutaps as $bst){
            if(!in_array(intval( $bst->parent_id),$parent_id)){
                $parent_id[]= intval( $bst->parent_id);
            }
          
        }
        $parents = Bosuutap::whereIn('id',$parent_id)->select('id', 'name')->get();
        foreach($parents as $p){
            $children=[];
            foreach($bosuutaps as $bst){
              if($p->id == $bst->parent_id){
                $children[]= $bst;
              }
              
            }    
            $p->children=   $children;
        }
        return  $parents;
    } 
    // trả hiện vật
    public function viewtrahienvat(Request $request)
    {
        return view('trahienvat.trahienvat',[
              'id'=>$request->id,
              'tieude'=>'Trả Hiện Vật',
        ]);
    
    }
    public function ajaxhienvatdaxuat(Request $request)
    {

        $dem = 0;
        $xuatnhap_id = $request->id;
        $bosuutap_id = [];
        if($request->bosuutap_id != null){
            foreach ($request->bosuutap_id as $key => $value) {
                $bosuutap_id[]=intval( $value );
            }
        }
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // lấy dữ liệu hiện vật đã xuât bằng id xuất nhập
        $infoXuatnhap = Xuatnhap::where('id',$xuatnhap_id)->first();
        $hienvat_id =[];
        if($infoXuatnhap->hienvatchuatra == null){
            foreach($infoXuatnhap->danhmuchienvat as $dmhv){
               
                $hienvat_id[] =$dmhv['hienvat_id'];
            
            }
        }else{
            foreach($infoXuatnhap->hienvatchuatra as $hvct){
                $hienvat_id[] =$hvct['hienvat_id'];
            
            }
        }
        
        // Query dữ liệu
        $datahienvats = Hienvat::whereIn('id',$hienvat_id)->orderBy('id', 'desc');
        $datahienvats = searchColum($datahienvats, $searchcolum, $searchnow);
        if($bosuutap_id != [] ){
            $datahienvats->whereIn('bosuutap_id',$bosuutap_id);
        }
        $datahienvats = $datahienvats->get();
        foreach ($datahienvats as $btc) {
            $btc->stt = ++$dem;
            
        }
        return DataTables::of($datahienvats)->make(true);
    }
    public function trahienvat(Request $request)
    {
        $infoxuat = Xuatnhap::where('id',$request->id)->first();
        $hienvatdatra=[];
        if($infoxuat->hienvatdatra != null){
            $hienvatdatra= $infoxuat->hienvatdatra;  
            $infohienvat=[];
            $infohienvat['id'] = $request->data['id'];
            $infohienvat['thoigiantrahienvat'] =Carbon::now()->format('H:i:s Y-m-d ');
            $hienvatdatra[] = $infohienvat;
            $infoxuat->hienvatdatra=  $hienvatdatra;
            $infoxuat->save();
       
        }else{
            $infohienvat=[];
            $infohienvat['id'] = $request->data['id'];
            $infohienvat['thoigiantrahienvat'] =Carbon::now()->format('H:i:s Y-m-d ');
            $hienvatdatra[] = $infohienvat;
            $infoxuat->hienvatdatra=  $hienvatdatra;
            $infoxuat->save(); 
        }
        $hienvat = Hienvat::find($request->data['id']);
        $hienvat->checkxuatnhap = 1;
        $ghichu = [];
        $ghichu['noidung'] = 'Trả hiện vật đã xuất'.' '.$infoxuat->name;
        $ghichu['thoigian'] =Carbon::now()->format('Y-m-d H:i:s');
        $data = $hienvat->ghichu;
        $data[] = $ghichu;
        $hienvat->ghichu = $data;
        $hienvat->save();
        return 1;
    }
    public function huytrahienvat(Request $request)
    {
        $infoxuat = Xuatnhap::where('id',$request->id)->first();
        $infohienvat =Hienvat::find($request->data['id']);
        if($infohienvat->checkxuatnhap == 1){
            return 1;
        }else{
            return 2;
        }
    }
    public function trahethienvat(Request $request)
    {
        $infoxuat = Xuatnhap::where('id',$request->id)->first();
        $danhmuchienvat_id=[];
        foreach($infoxuat->danhmuchienvat as $dmhv){
            $danhmuchienvat_id[] =  $dmhv['hienvat_id'];
        }
        $hienvatdatra_id=[];
        foreach($infoxuat->hienvatdatra as $hvdt){
            $hienvatdatra_id[] =  $hvdt['id'];
        }
        $hienvatchuatra_id = array_diff($danhmuchienvat_id, $hienvatdatra_id);
       
        $infohienvats =Hienvat::whereIn('id',$hienvatchuatra_id)->get();
        foreach($infohienvats as $hv){
            $hienvatdatra=[];
            if($infoxuat->hienvatdatra != null){
                $hienvatdatra= $infoxuat->hienvatdatra;  
                $infohienvat=[];
                $infohienvat['id'] = $hv->id;
                $infohienvat['thoigiantrahienvat'] =Carbon::now()->format('H:i:s Y-m-d ');
                $hienvatdatra[] = $infohienvat;
                $infoxuat->hienvatdatra=  $hienvatdatra;
                $infoxuat->save();
        
            }else{
                $infohienvat=[];
                $infohienvat['id'] = $hv->id;
                $infohienvat['thoigiantrahienvat'] =Carbon::now()->format('H:i:s Y-m-d ');
                $hienvatdatra[] = $infohienvat;
                $infoxuat->hienvatdatra=  $hienvatdatra;
                $infoxuat->save(); 
            }
        
            $hv->checkxuatnhap = 1;
            $ghichu = [];
            $ghichu['noidung'] = 'Trả hiện vật đã xuất'.' '.$infoxuat->name;
            $ghichu['thoigian'] =Carbon::now()->format('Y-m-d H:i:s');
            $data = $hv->ghichu;
            $data[] = $ghichu;
            $hv->ghichu = $data;
            $hv->save();
        }
        return 1;
       
    }
    // tìm kiếm và lấy hiện vật xuất nhập
    public function gettimkiemhienvatxuatnhap(Request $request)
    {
     
        $columns = ['so_ky_hieu', 'name'];
        if($request->checkxuatnhap == 0){
            $datahienvats = Hienvat::where('checkxuatnhap',0)->where('kiemtra',1);
        }else{
            $datahienvats = Hienvat::where('checkxuatnhap',1)->where('kiemtra',1);  
        }
     
 
        
            $datahienvats = $datahienvats->orderBy('id', 'desc');
       
 
        if($request->bosuutaps != null){
            $datahienvats =  $datahienvats->whereIn('bosuutap_id',$request->bosuutaps);
         
        }
        if($request->timkiemhienvat != null){
            $datahienvats = searchColum($datahienvats, $columns, $request->timkiemhienvat);
            if($request->checkxuatnhap == 0){
                $datahienvats =$datahienvats->where('checkxuatnhap',0);
            }else{
                $datahienvats =$datahienvats->where('checkxuatnhap',1);  
            }
        }
  
        if($request->bosuutaps != null || $request->timkiemhienvat != null){
           
            if($request->checkxuatnhap == 0){
               
                $datahienvats = $datahienvats->select('name', 'id','so_ky_hieu','soluong','tinh_trang_hv','kich_thuoc')->get();
            
            }else{
                $datahienvats = $datahienvats->select('name', 'id','so_ky_hieu','soluong','tinh_trang_hv','kich_thuoc','vitrihv_id')->get();
            }
      
            foreach($datahienvats as $hienvat){
                $hienvat->label = $hienvat->name.'-'.$hienvat->so_ky_hieu;
            }
        }else{
            $datahienvats = [];
        }
      
        if($request->hienvat_id != null){
       
            if($request->checkxuatnhap == 0){
               
                $datahienvatdaco = Hienvat::whereIn('id',$request->hienvat_id)->select('name', 'id','so_ky_hieu','soluong','tinh_trang_hv','kich_thuoc')->get();
              
                
            }else{
               
              
                $datahienvatdaco = Hienvat::whereIn('id',$request->hienvat_id)->select('name', 'id','so_ky_hieu','soluong','tinh_trang_hv','kich_thuoc','vitrihv_id')->get();
            }
           
            foreach($datahienvatdaco as $hv){
                    $hv->label = $hv->name.'-'.$hv->so_ky_hieu;
                        $datahienvats[]= $hv;        
            }
        
           
        }
        if($request->checkxuatnhap == 1){
            foreach ($datahienvats as $hv) {
                $infovitri = Kho::where('id',$hv->vitrihv_id)->first()->name;
                $hv->vitri = $infovitri;
            }
        }
        return $datahienvats;
    }
}