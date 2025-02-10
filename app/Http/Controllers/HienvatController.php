<?php

namespace App\Http\Controllers;

use App\Models\Hienvat;
use App\Models\Bosuutap;
use App\Models\Chatlieu;
use App\Models\Fileuploads;
use App\Models\Loaihienvat;
use App\Models\Trungbayao;
use App\Models\Quanlytrungbay;
use App\Models\Hinhthucsuutam;
use App\Models\Kho;

use App\Models\Vitrikho;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Yajra\Datatables\Datatables;
use App\Models\Cauhinhhethong;
use App\Helper;


class HienvatController extends Controller
{
    public function bieudo()
    {
        $cauhinh = Cauhinhhethong::first();
        if ($cauhinh->ngungsudung == "có") {
            return view('error/error', [
                'text' => $cauhinh->noidungtb
            ]);
        }
        //Đếm hiện vật

        $demhienvat  = Hienvat::count();

        //Đếm bộ sưu tập 
        $dembosuutap = 0;
        $quanlybosuutap = Bosuutap::orderby('id', 'desc');
        $quanlybosuutap = $quanlybosuutap->get();
        foreach ($quanlybosuutap as $qlbst) {
            $qlbst->stt = ++$dembosuutap;
        }

        //Đếm nơi trưng bày
        $demnoitrungbay = 0;
        $qlnoitrungbay = Quanlytrungbay::orderBy('id', 'desc');
        $qlnoitrungbay = $qlnoitrungbay->get();
        foreach ($qlnoitrungbay as $qlntb) {
            $qlntb->stt = ++$demnoitrungbay;
        }
        //Đếm nơi trung bày ảo
        $demntbAo = 0;
        $qlntbAo = Trungbayao::orderBy('id', 'desc');
        $qlntbAo = $qlntbAo->get();
        foreach ($qlntbAo as $trungbayAo) {
            $trungbayAo->stt = ++$demntbAo;
        }
        //Thống kê hiện vật theo hình thức sưu tầm
        $hinhthucsuutam = Hinhthucsuutam::all();
        $data = array();
        $datajson = array();
        foreach ($hinhthucsuutam as $htst) {
            $mang = array();
            $Slhienvattheohinhthucsuutam = Hienvat::where('hinhthucst_id', $htst->id)->count();
            $datajson['name'] = $htst->name;
            $datajson['y'] = $Slhienvattheohinhthucsuutam;
            $data[] = $datajson;
        }

        // return $data;
        // Thống kê theo vị trí hiện vật
        $datajson = array();
        $vitrihienvat = Kho::all();
        $datavthv = array();
        $datajson = array();
        foreach ($vitrihienvat as $vthv) {

            $datajson['name'] = $vthv->name;
            $Slhienvattheovitri = Hienvat::where('vitrihv_id', $vthv->id)->count();
            $datajson['y'] = $Slhienvattheovitri;
            $datajson['drilldown'] = $vthv->name;
            $datavthv[] = $datajson;
        }
        //Thống kê hiện vật theo chất liệu
        $InfoChatlieu = Chatlieu::all();
        $datachatlieu = [];
        $datajsonchatlieu = array();

        foreach ($InfoChatlieu as $chatlieu) {
            $mang = array();
            $Slhienvattheochatlieu = Hienvat::where('chatlieu_id', $chatlieu->id)->count();
            $datajsonchatlieu['name'] = $chatlieu->name;
            $datajsonchatlieu['y'] = $Slhienvattheochatlieu;
            $datachatlieu[] = $datajsonchatlieu;
        }

        //Thống kê hiện vật theo loại hiện vật
        $InfoLoaihienvat = Loaihienvat::all();
        $dataloaihienvat = [];
        $datajsonloaihienvat = array();

        foreach ($InfoLoaihienvat as $loaihienvat) {

            $Slhienvattheoloaihienvat = Hienvat::where('loaihienvat_id', $loaihienvat->id)->count();
            $datajsonloaihienvat['name'] = $loaihienvat->name;
            $datajsonloaihienvat['y'] = $Slhienvattheoloaihienvat;
            $dataloaihienvat[] = $datajsonloaihienvat;
        }


        //return $soluong;
        return view('quanlyhienvat.bieudo', [

            'demhienvat' => $demhienvat,
            'quanlybosuutap' => $quanlybosuutap,
            'dembosuutap' => $dembosuutap,
            'qlnoitrungbay' => $qlnoitrungbay,
            'demnoitrungbay' => $demnoitrungbay,
            'demntbAo' => $demntbAo,
            'qlntbAo' => $qlntbAo,
            // Biểu đồ tròn
            'hinhthucsuutam' => $hinhthucsuutam,
            'data' => $data,
            //End biểu đò tròn
            //Biểu đồ cột lớn
            'vitrihienvat' => $vitrihienvat,
            'datavthv' => $datavthv,
            //End biểu đồ cột lớn 
            //Thống kê loại hiện vật
            'dataloaihienvat' => $dataloaihienvat,
            //End thống kê loại hiện vật
            //Thống kê hiện vật theo chất liệu
            'datachatlieu' => $datachatlieu,
        ]);
    }


    public function ajaxbosuutap1()
    {
        $bosuutap = Bosuutap::select('id', 'name')->where('parent_id', null)->get();
        // $bosuutapcon = Bosuutap::where('parent_id', 1)->get();
        //     return $bosuutapcon;
        foreach ($bosuutap as $bst) {
            $bosuutapcon = Bosuutap::where('parent_id', $bst->id)->get();
            // return $bosuutapcon;

            $bst->children = $bosuutapcon;
            // unset($bst->id);
        }
        return $bosuutap;
    }

    public function danhmuc($table)
    {
        if ($table == 'hienvats') {
            $info = DB::table($table)->orderBy('id', 'desc')->get();
            foreach ($info as $hv) {
                $hv->tentrungbayao =  $hv->name . '-' . $hv->so_ky_hieu;
                $fileuploads = Fileuploads::where('tenbang', 'anhhienvat')->where('idtruong', $hv->id)->orderBy('id', 'desc')->first();
                if ($fileuploads == null) {
                    $hv->fileuploads = null;
                } else {
                    $hv->fileuploads =  $fileuploads->link;
                }
                if ($hv->vitrihv_id) {
                    $vitri = Kho::find($hv->vitrihv_id);
                    $hv->vitrihienvat =  $vitri->name;
                } else {
                    $hv->vitrihienvat = 'Chưa xác định';
                }
            }
        } else {
            $info = DB::table($table)->orderBy('id', 'desc')->get();
        }
        return $info;
    }


    public function quanlyhienvat(Request $request)
    {
        return view('quanlyhienvat.quanlyhienvat');
    }
    public function dequybst($id)
    {
        $arrayid = [];
        $bosuutap  = Bosuutap::where('parent_id', $id)->get();

        foreach ($bosuutap as $btc) {

            $arr = $this::dequybst($btc->id);
            foreach ($arr as $ar) {
                $arrayid[] = $ar;
            }

            $arrayid[] = $btc->id;
        }
        return  $arrayid;
    }

    
    public function listhienvat(Request $request){
        $quanlyhienvat = Hienvat::select('id', 'name','so_ky_hieu')->get();
        return $quanlyhienvat;
    }
    public function ajaxquanlyhienvat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $bosuutapsearch =  $request->bosuutap;
        $hinhthucsuutam = $request->hinhthucsuutam;
        $kho = $request->kho;
        $chatlieusearch = $request->chatlieu;
        $loaihienvatsearch = $request->loaihienvat;
        $sodong = $request->length;
        $batdau = $request->start;
        // $searchxa = $request->searchxa;
        // Query dữ liệu
        $quanlyhienvat = Hienvat::orderBy('id', 'desc');
        $quanlyhienvat = searchColum($quanlyhienvat, $searchcolum, $searchnow);
        // if ($searchxa) {
        //     $quanlyhienvat = $quanlyhienvat->where('xa_id', $searchxa);
        // }
        if ($hinhthucsuutam) {
            $quanlyhienvat->where('hinhthucst_id', $hinhthucsuutam);
            // return 1;
        }

        if ($kho) {
            $quanlyhienvat->where('vitrihv_id', $kho);
        }

        if ($chatlieusearch) {
            $quanlyhienvat->where('chatlieu_id', $chatlieusearch);
        }

        if ($loaihienvatsearch) {
            $quanlyhienvat->where('loaihienvat_id', $loaihienvatsearch);
        }


        if ($bosuutapsearch) {
            $hienvat_id_bst = $this::dequybst($bosuutapsearch);
            $hienvat_id_bst[] = $bosuutapsearch;
            // return $hienvat_id_bst;
            $quanlyhienvat->whereIn('bosuutap_id', $hienvat_id_bst);
        }
        $coutquanlyhienvat = $quanlyhienvat->count();

        $quanlyhienvat = $quanlyhienvat->offset($batdau)->limit($sodong)->get();
        foreach ($quanlyhienvat as $qlhv) {
            $qlhv->stt = ++$dem;
            $qlhv->sokyhieu = 'BTLĐ.' . $qlhv->sokyhieu;
            if ($qlhv->loaihienvat_id) {
                $qlhv->nameloaihienvat =  $qlhv->loaihienvat->name;
            } else {
                $qlhv->nameloaihienvat = 'Chưa xác định';
            }
            if ($qlhv->bosuutap_id) {
                $qlhv->namebosuutap =  $qlhv->bosuutap->name;
            } else {
                $qlhv->namebosuutap = 'Chưa xác định';
            }
            if ($qlhv->hinhthucst_id) {
                $qlhv->hinhthucsuutam =  $qlhv->tenhinhthucsuutam->name;
            } else {
                $qlhv->hinhthucsuutam = 'Chưa xác định';
            }
            if ($qlhv->chatlieu_id) {
                $qlhv->chatlieu =  $qlhv->tenchatlieu->name;
            } else {
                $qlhv->chatlieu = 'Chưa xác định';
            }
            if ($qlhv->vitrihv_id) {

                $qlhv->namevitrihienvat =  $qlhv->kho->name;
            } else {
                $qlhv->namevitrihienvat = 'Chưa xác định';
            }
            if ($qlhv->ghichu) {
                $data =  $qlhv->ghichu;
                foreach ($qlhv->ghichu as $key => $gc) {
                    $time = new Carbon($gc['thoigian']);
                    $data[$key]['thoigian'] = $time->format('H:i d/m/Y');
                }
                $qlhv->ghichu =  $data;
            }
            $fileuploads = Fileuploads::where('tenbang', 'anhhienvat')->where('idtruong', $qlhv->id)->orderBy('id', 'desc')->get();
            if ($fileuploads == null) {
                $qlhv->fileuploads = null;
            } else {
                $qlhv->fileuploads =  $fileuploads;
            }
            $fileuploadstailieu = Fileuploads::where('tenbang', 'tailieuhienvat')->where('idtruong', $qlhv->id)->orderBy('id', 'desc')->get();
            if ($fileuploadstailieu == null) {
                $qlhv->fileuploadstailieu = null;
            } else {
                $qlhv->fileuploadstailieu =  $fileuploadstailieu;
            }
            if ($qlhv->thoi_gian_st) {
                $time = strtotime($qlhv->thoi_gian_st);
                $newformat = date('d/m/Y ', $time);

                $qlhv->thoi_gian_st = $newformat;
            } else {
                $qlhv->thoi_gian_st = '';
            }
            if ($qlhv->tg_nhap_kho) {
                $time = strtotime($qlhv->tg_nhap_kho);
                $newformat = date('d/m/Y ', $time);

                $qlhv->tg_nhap_kho = $newformat;
            } else {
                $qlhv->tg_nhap_kho = '';
            }
          
        }
        return [
            'data' => $quanlyhienvat,
            'recordsTotal' =>$coutquanlyhienvat,

        ];
        // return DataTables::of($quanlyhienvat)->make(true);
    }
    public function savequanlyhienvat(Request $request)
    {
        $user = Auth::user();
        // return $request->bosuutap_id;
        // kiểm tra số ký hiệu đã tồn tại hay chưa
        $checkhienvat = Hienvat::where('so_ky_hieu',$request->so_ky_hieu)->first();
        if ($checkhienvat) {
            return 'Hiện vật và số ký hiệu đã tồn tại';
        }
        $quanlyhienvat = new Hienvat();
        // $quanlyhienvat->uuid=  $request->uuid;
        $quanlyhienvat->name =  $request->name;
        $quanlyhienvat->ten_khac =  $request->ten_khac;
        $quanlyhienvat->soluong =  $request->soluong;
        $quanlyhienvat->sothanhphan =  $request->sothanhphan;
        $quanlyhienvat->chu_nhan =  $request->chu_nhan;
        $quanlyhienvat->dia_diem_st =  $request->dia_diem_st;
        $quanlyhienvat->hinhthucst_id =  $request->hinhthucst_id;
        $quanlyhienvat->thoi_gian_st =  $request->thoi_gian_st;
        $quanlyhienvat->chatlieu_id =  $request->chatlieu_id;
        $quanlyhienvat->mau_sac =  $request->mau_sac;
        $quanlyhienvat->checkxuatnhap =  0;
        $quanlyhienvat->kich_thuoc =  $request->kich_thuoc;
        $quanlyhienvat->trong_luong =  $request->trong_luong;
        $quanlyhienvat->hinh_dang =  $request->hinh_dang;
        $quanlyhienvat->ky_thuat_ct =  $request->ky_thuat_ct;
        $quanlyhienvat->mota =  $request->mota;
        $quanlyhienvat->tinh_trang_hv =  $request->tinh_trang_hv;
        $quanlyhienvat->tg_nhap_kho =  $request->tg_nhap_kho;
        $quanlyhienvat->loaihienvat_id =  $request->loaihienvat_id;
        $quanlyhienvat->nguon_goc =  $request->nguon_goc;
        $quanlyhienvat->dudoan_niendai =  $request->dudoan_niendai;
        $quanlyhienvat->baoquan_phucche =  $request->baoquan_phucche;
        $quanlyhienvat->so_ky_hieu = $request->so_ky_hieu;
        $quanlyhienvat->vitrihv_id =  $request->vitrihv_id;
        $quanlyhienvat->trungbay_id =  $request->trungbay_id;
        $quanlyhienvat->linkfile3d =  $request->linkfile3d;


        if ($request->vitrihv_id != null) {

            $quanlyhienvat->checkxuatnhap = 1;
            $ghichu = [];
            $ghichu['noidung'] = 'Nhâp vào kho';
            $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
            $data = [];
            $data[] = $ghichu;
            $quanlyhienvat->ghichu = $data;
        }
        $quanlyhienvat->bosuutap_id =  $request->bosuutap_id;
        $quanlyhienvat->ghinho =  $request->ghinho;
        if ($user->chucvu_id == 1) {
            $quanlyhienvat->kiemtra =  true;
        } else {
            $quanlyhienvat->kiemtra =  false;
        }
        $quanlyhienvat->save();
      
        // tìm hiện vật bằng số ký hiệu
        $Infoquanlyhienvat= Hienvat::where('so_ky_hieu',$request->so_ky_hieu)->first();
        $file = Fileuploads::Where('idtruong', $request->uuid)->get();
        foreach ($file as $f) {
            $f->idtruong =  $Infoquanlyhienvat->id;
            $f->save();
        }
        $file = Fileuploads::Where('idtruong', $request->uuid1)->get();
        foreach ($file as $f) {
            $f->idtruong =  $Infoquanlyhienvat->id;
            $f->save();
        }


        // kiểm tra bộ sưu tập đã có hiện vật chưa 
        if ($user->chucvu_id == 1) {
            $infoBosuutap = Bosuutap::where('id', $request->bosuutap_id)->first();

            // chưa có thì tạo json rồi thêm vào    
            $hienvat_id = [];
            if ($infoBosuutap->hienvat_id == null) {
                $hienvat_id[] = $Infoquanlyhienvat->id;
                $infoBosuutap->hienvat_id = $hienvat_id;
                $infoBosuutap->save();
            }
            // có thì thêm bổ sung vào json
            else {
                $hienvat_id[] = $Infoquanlyhienvat->id;
                $hienvat_id = array_merge($infoBosuutap->hienvat_id,  $hienvat_id);
                $infoBosuutap->hienvat_id = $hienvat_id;
                $infoBosuutap->save();
            }
        }
        Helper::saveHistory('Lưu hiện vật', $quanlyhienvat->name);

       return response('Thành công', 200);
    }
    public function updatequanlyhienvat(Request $request)
    {
        $user = Auth::user();
        $quanlyhienvat = Hienvat::where('id', $request->id)->first();
        // $quanlyhienvat->uuid= $request->data['uuid'];
        $quanlyhienvat->name = $request->data['name'];
        $quanlyhienvat->ten_khac = $request->data['ten_khac'];
        $quanlyhienvat->soluong = $request->data['soluong'];
        $quanlyhienvat->sothanhphan = $request->data['sothanhphan'];
        $quanlyhienvat->chu_nhan = $request->data['chu_nhan'];
        $quanlyhienvat->dia_diem_st = $request->data['dia_diem_st'];
        $quanlyhienvat->hinhthucst_id = $request->data['hinhthucst_id'];
        $quanlyhienvat->thoi_gian_st = $request->data['thoi_gian_st'];
        $quanlyhienvat->chatlieu_id = $request->data['chatlieu_id'];
        $quanlyhienvat->mau_sac = $request->data['mau_sac'];
        $quanlyhienvat->checkxuatnhap =  0;
        $quanlyhienvat->kich_thuoc = $request->data['kich_thuoc'];
        $quanlyhienvat->trong_luong = $request->data['trong_luong'];
        $quanlyhienvat->hinh_dang = $request->data['hinh_dang'];
        $quanlyhienvat->ky_thuat_ct = $request->data['ky_thuat_ct'];
        $quanlyhienvat->mota = $request->data['mota'];
        $quanlyhienvat->tinh_trang_hv = $request->data['tinh_trang_hv'];
        $quanlyhienvat->tg_nhap_kho = $request->data['tg_nhap_kho'];
        $quanlyhienvat->loaihienvat_id = $request->data['loaihienvat_id'];
        $quanlyhienvat->nguon_goc = $request->data['nguon_goc'];
        $quanlyhienvat->dudoan_niendai = $request->data['dudoan_niendai'];
        $quanlyhienvat->baoquan_phucche = $request->data['baoquan_phucche'];
        $quanlyhienvat->vitrihv_id = $request->data['vitrihv_id'];
        $quanlyhienvat->ghinho = $request->data['ghinho'];
        $quanlyhienvat->bosuutap_id = $request->data['bosuutap_id'];
        $quanlyhienvat->so_ky_hieu = $request->data['so_ky_hieu'];
        $quanlyhienvat->trungbay_id = $request->data['trungbay_id'];
        $quanlyhienvat->linkfile3d = $request->data['linkfile3d'];

        

        if ($user->chucvu_id == 1) {
            $quanlyhienvat->kiemtra = 1;
        }

        if ($request->data['vitrihv_id'] != $request->data['vitrihv_idbefore'] && $request->data['vitrihv_idbefore'] != null) {

            if ($quanlyhienvat->ghichu != null) {

                $ghichu = [];
                $ghichu['noidung'] = 'Thay đổi vị trí hiên vật';
                $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                $data = [];
                $data[] = $ghichu;
                $quanlyhienvat->ghichu = array_merge($quanlyhienvat->ghichu,  $data);
            }
        } else {
            if ($request->data['vitrihv_id'] != null) {
                $quanlyhienvat->checkxuatnhap = 1;
                $ghichu = [];
                $ghichu['noidung'] = 'Nhâp vào kho';
                $ghichu['thoigian'] = Carbon::now()->format('Y-m-d H:i:s');
                $data = [];
                $data[] = $ghichu;
                $quanlyhienvat->ghichu = $data;
            }
        }

        $quanlyhienvat->save();
        if ($user->chucvu_id == 1 && $quanlyhienvat->kiemtra == 1 || $user->chucvu_id == 2) {
            if ($request->data['bosuutap_id'] != $request->data['bosuutap_idbefore'] && $request->data['bosuutap_idbefore'] != null) {

                // chuyển sting sang int của bộ sưu tập id cũ
                $Bosuutap_idbefore  = intval($request->data['bosuutap_idbefore']);
                // lấy thông tin bộ sưu tập cũ 
                $infoBosuutap = Bosuutap::where('id', $Bosuutap_idbefore)->first();
                // tạo mảng hiện vật  
                $hienvat_id = [];
                // loại bỏ hienvat_id ở bộ sưu tập cũ
                foreach ($infoBosuutap->hienvat_id as $hv) {
                    if ($hv != $request->id) {
                        $hienvat_id[] = $hv;
                    }
                }

                // kiểm tra mảng hiện vật có phần tử không
                if (count($hienvat_id) == 0) {
                    $infoBosuutap->hienvat_id = null;
                    $infoBosuutap->save();
                } else {
                    $infoBosuutap->hienvat_id = $hienvat_id;
                    $infoBosuutap->save();
                }
            } else {

                $infoBosuutap = Bosuutap::where('id', $request->data['bosuutap_id'])->first();

                // chưa có thì tạo json rồi thêm vào    

                $hienvat_id = [];
                if ($infoBosuutap->hienvat_id == null) {

                    $hienvat_id[] = $quanlyhienvat->id;
                    $infoBosuutap->hienvat_id = $hienvat_id;
                    $infoBosuutap->save();
                }
                // có thì thêm bổ sung vào json
                else {

                    if (!in_array($request->id, $infoBosuutap->hienvat_id)) {

                        $hienvat_id[] = $quanlyhienvat->id;
                        $hienvat_id = array_merge($infoBosuutap->hienvat_id,  $hienvat_id);
                        $infoBosuutap->hienvat_id = $hienvat_id;
                        $infoBosuutap->save();
                    }
                }
            }
        }
        Helper::saveHistory('Sửa hiện vật', $quanlyhienvat->name);

       return response('Thành công', 200);
    }
    public function deletequanlyhienvat(Request $request)
    {
        $quanlyhienvat = Hienvat::where('id', $request->id)->first();
        Helper::saveHistory('Xoá hiện vật', $quanlyhienvat->name);
        Hienvat::destroy($request->id);
       return response('Thành công', 200);
    }
    public function viewthemsuahienvat(Request $request)
    {
        if ($request->id == null) {
            $infohienvat = [];
            return view('quanlyhienvat.themsuahienvat', [
                'infohienvat' =>  $infohienvat,
                'tieude' => 'Thêm mới thông tin hiện vật',
            ]);
        } else {

            $infohienvat = Hienvat::find($request->id);

            return view('quanlyhienvat.themsuahienvat', [
                'tieude' => 'Sửa  thông tin hiện vật',
                'infohienvat' =>  $infohienvat,
            ]);
        }
    }
    public function duyetnhieuhienvat()
    {
        return view('duyetnhieuhienvat.index', []);
    }
    public function ajaxduyethienvat(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        $bosuutap =  $request->bosuutap;
        $hinhthucsuutam = $request->hinhthucsuutam;
        $vitrihienvat = $request->vitrihienvat;
        $chatlieu = $request->chatlieu;
        $loaihienvat = $request->loaihienvat;
        // $searchxa = $request->searchxa;
        // Query dữ liệu
        $quanlyhienvat = Hienvat::orderBy('id', 'desc')->where('kiemtra', 0);
        $quanlyhienvat = searchColum($quanlyhienvat, $searchcolum, $searchnow);
        // if ($searchxa) {
        //     $quanlyhienvat = $quanlyhienvat->where('xa_id', $searchxa);
        // }
        if ($hinhthucsuutam) {
            $quanlyhienvat->where('hinhthucst_id', $hinhthucsuutam);
            // return 1;
        }

        if ($vitrihienvat) {
            $quanlyhienvat->where('vitrihv_id', $vitrihienvat);
        }

        if ($chatlieu) {
            $quanlyhienvat->where('chatlieu_id', $chatlieu);
        }

        if ($loaihienvat) {
            $quanlyhienvat->where('loaihienvat_id', $loaihienvat);
        }


        if ($bosuutap) {
            $quanlyhienvat->where('bosuutap_id', $bosuutap);
        }

        $quanlyhienvat = $quanlyhienvat->get();
        foreach ($quanlyhienvat as $qlhv) {
            $qlhv->stt = ++$dem;
            if ($qlhv->loaihienvat_id) {
                $qlhv->tenloaihienvat =  $qlhv->loaihienvat->name;
            } else {
                $qlhv->tenloaihienvat = 'Chưa xác định';
            }
            if ($qlhv->bosuutap_id) {
                $qlhv->tenbosuutap =  $qlhv->bosuutap->name;
            } else {
                $qlhv->tenbosuutap = 'Chưa xác định';
            }
            if ($qlhv->hinhthucst_id) {
                $qlhv->hinhthucsuutam =  $qlhv->tenhinhthucsuutam->name;
            } else {
                $qlhv->hinhthucsuutam = 'Chưa xác định';
            }
            if ($qlhv->chatlieu_id) {
                $qlhv->chatlieu =  $qlhv->tenchatlieu->name;
            } else {
                $qlhv->chatlieu = 'Chưa xác định';
            }
            if ($qlhv->vitrihv_id) {

                $qlhv->vitrihienvat =  $qlhv->kho->name;
            } else {
                $qlhv->vitrihienvat = 'Chưa xác định';
            }
            if ($qlhv->ghichu) {
                $data =  $qlhv->ghichu;
                foreach ($qlhv->ghichu as $key => $gc) {
                    $time = new Carbon($gc['thoigian']);
                    $data[$key]['thoigian'] = $time->format('H:i d/m/Y');
                }
                $qlhv->ghichu =  $data;
            }
            $fileuploads = Fileuploads::where('tenbang', 'anhhienvat')->where('idtruong', $qlhv->id)->orderBy('id', 'desc')->get();
            if ($fileuploads == null) {
                $qlhv->fileuploads = null;
            } else {
                $qlhv->fileuploads =  $fileuploads;
            }
        }
        return DataTables::of($quanlyhienvat)->make(true);
    }
    public function savehienvats(Request $request)
    {
        $hienvats = $request->data;
        foreach ($hienvats as $hv) {
            $quanlyhienvat = Hienvat::where('id', $hv['id'])->first();
            $quanlyhienvat->kiemtra = 1;
            $quanlyhienvat->save();
            $infoBosuutap = Bosuutap::where('id', $hv['bosuutap_id'])->first();

            // chưa có thì tạo json rồi thêm vào    
            $hienvat_id = [];
            if ($infoBosuutap->hienvat_id == null) {
                $hienvat_id[] = $quanlyhienvat->id;
                $infoBosuutap->hienvat_id = $hienvat_id;
                $infoBosuutap->save();
            }
            // có thì thêm bổ sung vào json
            else {
                $hienvat_id[] = $quanlyhienvat->id;
                $hienvat_id = array_merge($infoBosuutap->hienvat_id,  $hienvat_id);
                $infoBosuutap->hienvat_id = $hienvat_id;
                $infoBosuutap->save();
            }
        }
    }
    public function checksokyhieu(Request $request)
    {
        $check = Hienvat::where('so_ky_hieu', $request->sokyhieu)->first();
        if ($check) {
            return 1;
        }
    }
}
