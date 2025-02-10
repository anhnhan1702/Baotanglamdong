<?php

use App\Helper;
use App\Http\Controllers\GiaodienController;
use App\Http\Controllers\PagenewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaoquanController;
use App\Http\Controllers\BosuutapController;
use App\Http\Controllers\BosuutaphinhanhController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\FileuploadsController;
use App\Http\Controllers\HienvatController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\LoaihienvatController;
use App\Http\Controllers\NiendaiController;
use App\Http\Controllers\ThoikyController;
use App\Http\Controllers\HinhthucsuutamController;
use App\Http\Controllers\ChatlieuController;
use App\Http\Controllers\ChucvuController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatabackupController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PhongbanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuanlyhinhanhController;
use App\Http\Controllers\Quanlynhap;
use App\Http\Controllers\QuanlynhapController;
use App\Http\Controllers\QuanlytrungbayController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\DottrunbayaoController;
use App\Http\Controllers\DottrungbayaoController;
use App\Http\Controllers\DottrungbayController;
use App\Http\Controllers\HienvattrungbayaoController;
use App\Http\Controllers\HienvattrungbayController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PhieubaoquanController;
use App\Http\Controllers\QuanlyxuatController;
use App\Http\Controllers\ThongkeController;
use App\Http\Controllers\TimkiemController;
use App\Http\Controllers\TrungbayaoController;
use App\Http\Controllers\XuatexcellController;
use App\Http\Controllers\XuatnhapController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\SodichuyenhienvatController;
use App\Http\Controllers\SohoadulieuhienvatController;
use App\Http\Controllers\SystemController;

use App\Http\Controllers\VitritrungbayaoController;
use App\Http\Controllers\VitritrungbayController;

use App\Http\Controllers\XuLyAnhController;


use App\Http\Controllers\XulyhinhanhController;
use App\Models\Hienvattrungbayao;
// use App\Models\;
use App\Models\Loaihienvat;
use App\Models\Thoiky;
use App\Models\Vitritrunbayao;
use App\Models\Xuatnhap;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('thong-tin-hien-vat/{id}', [DarkModeController::class, 'thongtinhienvat'])->name('thongtinhienvat');
Route::middleware('loggedin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});
// Quản lý view hiện thị và giao diện bên ngoài và bài viết
Route::get('/trang-tin', [PostController::class, 'trangTin'])->name('trangTin');
Route::get('/danh-muc-trang-tin', [PostController::class, 'danhMucTrangTin'])->name('danhMucTrangTin');
Route::get('/chi-tiet-trang-tin', [PostController::class, 'chiTietTrangTin'])->name('chiTietTrangTin');

Route::middleware(['auth', 'updatelastseen'])->group(function () {
    Route::get('/nova', function () {
        return redirect('/nova');
    })->name('tonova');

    //   plugin_table
    Route::get('/plugin_table', [Controller::class, 'plugin_table'])->name('plugin_table');
    Route::get('/get_plugin_table', [Controller::class, 'get_plugin_table'])->name('get_plugin_table');
    Route::post('/save_plugin_table', [Controller::class, 'save_plugin_table'])->name('save_plugin_table');
    Route::post('/update_plugin_table', [Controller::class, 'update_plugin_table'])->name('update_plugin_table');
    Route::post('/delete_plugin_table', [Controller::class, 'delete_plugin_table'])->name('delete_plugin_table');
    Route::post('/du-lieu-danh-muc', [Controller::class, 'dulieudanhmuc'])->name('dulieudanhmuc');
    // link file upload

    Route::get('/', [HienvatController::class, 'bieudo'])->name('bieudo');
    Route::get('/xuat-hien-vat', [XuatexcellController::class, 'export'])->name('export');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // danh muc
    Route::get('/danh-muc/{table}', [HienvatController::class, 'danhmuc'])->name('danhmuc');
    // quản lý kho
    Route::get('/quan-ly-kho', [KhoController::class, 'layout'])->name('layout');
    Route::post('/save-kho', [KhoController::class, 'savekho'])->name('savekho');
    Route::post('/update-kho', [KhoController::class, 'updatekho'])->name('updatekho');
    Route::delete('/delete-kho', [KhoController::class, 'deletekho'])->name('deletekho');
    Route::get('/ajax-kho', [KhoController::class, 'ajaxkho'])->name('ajaxkho');
    Route::get('/xem-kho', [KhoController::class, 'xemkho'])->name('xemkho');
    Route::get('/data-kho', [KhoController::class, 'datakho'])->name('datakho');
    // quản thời kỳ
    Route::get('/thoi-ky', [ThoikyController::class, 'thoiky'])->name('thoiky');
    Route::post('/save-thoi-ky', [ThoikyController::class, 'savethoiky'])->name('savethoiky');
    Route::post('/update-thoi-ky', [ThoikyController::class, 'updatethoiky'])->name('updatethoiky');
    Route::delete('/delete-thoi-ky', [ThoikyController::class, 'deletethoiky'])->name('deletethoiky');
    Route::get('/ajax-thoi-ky', [ThoikyController::class, 'ajaxthoiky'])->name('ajaxthoiky');


    // phòng ban
    Route::get('/phong-ban', [PhongbanController::class, 'phongban'])->name('phongban');
    Route::post('/save-phong-ban', [PhongbanController::class, 'savephongban'])->name('savephongban');
    Route::post('/update-phong-ban', [PhongbanController::class, 'updatephongban'])->name('updatephongban');
    Route::delete('/delete-phong-ban', [PhongbanController::class, 'deletephongban'])->name('deletephongban');
    Route::get('/ajax-phong-ban', [PhongbanController::class, 'ajaxphongban'])->name('ajaxphongban');
    // user
    Route::get('/nguoi-dung', [UserController::class, 'nguoidung'])->name('nguoidung');
    Route::post('/save-nguoi-dung', [UserController::class, 'savenguoidung'])->name('savenguoidung');
    Route::post('/update-nguoi-dung', [UserController::class, 'updatenguoidung'])->name('updatenguoidung');
    Route::delete('/delete-nguoi-dung', [UserController::class, 'deletenguoidung'])->name('deletenguoidung');
    Route::get('/ajax-nguoi-dung', [UserController::class, 'ajaxnguoidung'])->name('ajaxnguoidung');
    Route::get('/change-password', [UserController::class, 'changepassword'])->name('changepassword');
    Route::post('/changepw', [UserController::class, 'changepw'])->name('changepw');
    // quản lý niên đại
    Route::get('/nien-dai-tuong-doi', [NiendaiController::class, 'niendaituongdoi'])->name('niendaituongdoi');
    Route::post('/save-nien-dai-tuong-doi', [NiendaiController::class, 'saveniendaituongdoi'])->name('saveniendaituongdoi');
    Route::post('/update-nien-dai-tuong-doi', [NiendaiController::class, 'updateniendaituongdoi'])->name('updateniendaituongdoi');
    Route::delete('/delete-nien-dai-tuong-doi', [NiendaiController::class, 'deleteniendaituongdoi'])->name('deleteniendaituongdoi');
    Route::get('/ajax-nien-dai-tuong-doi', [NiendaiController::class, 'ajaxniendaituongdoi'])->name('ajaxniendaituongdoi');
    // quản lý loại hiện vật
    Route::get('/loai-hien-vat', [LoaihienvatController::class, 'loaihienvat'])->name('loaihienvat');
    Route::post('/save-loai-hien-vat', [LoaihienvatController::class, 'saveloaihienvat'])->name('saveloaihienvat');
    Route::post('/update-loai-hien-vat', [LoaihienvatController::class, 'updateloaihienvat'])->name('updateloaihienvat');
    Route::delete('/delete-loai-hien-vat', [LoaihienvatController::class, 'deleteloaihienvat'])->name('deleteloaihienvat');
    Route::get('/ajax-loai-hien-vat', [LoaihienvatController::class, 'ajaxloaihienvat'])->name('ajaxloaihienvat');
    //quản lý hiện vật
    Route::get('/quan-ly-hien-vat', [HienvatController::class, 'quanlyhienvat'])->name('quanlyhienvat');
    Route::get('/ajax-bo-suu-tap-1', [HienvatController::class, 'ajaxbosuutap1'])->name('ajaxbosuutap1');
    Route::post('/save-quan-ly-hien-vat', [HienvatController::class, 'savequanlyhienvat'])->name('savequanquanlyhienvat');
    Route::post('/update-quan-ly-hien-vat', [HienvatController::class, 'updatequanlyhienvat'])->name('updatequanlyhienvat');
    Route::delete('/delete-quan-ly-hien-vat', [HienvatController::class, 'deletequanlyhienvat'])->name('deletequanlyhienvat');

    Route::get('/ajax-hien-vat', [HienvatController::class, 'listhienvat'])->name('listhienvat');
    Route::get('/ajax-quan-ly-hien-vat', [HienvatController::class, 'ajaxquanlyhienvat'])->name('ajaxquanlyhienvat');
    Route::get('/view-them-sua-hien-vat', [HienvatController::class, 'viewthemsuahienvat'])->name('viewthemsuahienvat');
    // Route::get('/vi-tri-hien-vat', [HienvatController::class, 'vitrihienvat'])->name('vitrihienvat');
    Route::post('/check-so-ky-hieu', [HienvatController::class, 'checksokyhieu'])->name('checksokyhieu');
    //hinh thuc suu tam
    Route::get('/hinh-thuc-suu-tam', [HinhthucsuutamController::class, 'hinhthucsuutam'])->name('hinhthucsuutam');
    Route::post('/save-hinh-thuc-suu-tam', [HinhthucsuutamController::class, 'savehinhthucsuutam'])->name('savehinhthucsuutam');
    Route::post('/update-hinh-thuc-suu-tam', [HinhthucsuutamController::class, 'updatehinhthucsuutam'])->name('updatehinhthucsuutam');
    Route::delete('/delete-hinh-thuc-suu-tam', [HinhthucsuutamController::class, 'deletehinhthucsuutam'])->name('deletehinhthucsuutam');
    Route::get('/ajax-hinh-thuc-suu-tam', [HinhthucsuutamController::class, 'ajaxhinhthucsuutam'])->name('ajaxhinhthucsuutam');

    // chất liệu
    Route::get('/chat-lieu', [ChatlieuController::class, 'chatlieu'])->name('chatlieu');
    Route::post('/save-chat-lieu', [ChatlieuController::class, 'savechatlieu'])->name('savechatlieu');
    Route::post('/update-chat-lieu', [ChatlieuController::class, 'updatechatlieu'])->name('updatechatlieu');
    Route::delete('/delete-chat-lieu', [ChatlieuController::class, 'deletechatlieu'])->name('deletechatlieu');
    Route::get('/ajax-chat-lieu', [ChatlieuController::class, 'ajaxchatlieu'])->name('ajaxchatlieu');
    Route::get('/danh-sach-hien-vat', [KhoController::class, 'danhsachhienvat'])->name('danhsachhienvat');
    Route::get('/danh-sach-hien-vat-trung-bay', [KhoController::class, 'danhsachhienvattrungbay'])->name('danhsachhienvattrungbay');
    Route::get('/danh-sach-hien-vat-trung-bay-ao', [KhoController::class, 'danhsachhienvattrungbayao'])->name('danhsachhienvattrungbayao');

    // file upload
    Route::get('/xoa-file', [FileuploadsController::class, 'xoafile'])->name('upload.xoafile');
    Route::get('/xoa-uuid', [FileuploadsController::class, 'xoauuid'])->name('upload.xoauuid');
    Route::get('/load-file', [FileuploadsController::class, 'loadfile'])->name('upload.loadfile');
    Route::post('/uploads', [FileuploadsController::class, 'fileupload'])->name('upload.fileupload');
    Route::get('/config', [FileuploadsController::class, 'config'])->name('upload.config');
    Route::post('/save-ghi-chu', [FileuploadsController::class, 'saveghichu'])->name('saveghichu');
    // quản lý xuất nhập
    // Route::get('/xuat', [XuatnhapController::class, 'xuatnhap'])->name('xuatnhap');
    Route::post('/save-xuat-nhap', [XuatnhapController::class, 'savexuatnhap'])->name('savexuatnhap');
    Route::post('/update-xuat-nhap', [XuatnhapController::class, 'updatexuatnhap'])->name('updatexuatnhap');
    Route::delete('/delete-xuat-nhap', [XuatnhapController::class, 'deletexuatnhap'])->name('deletexuatnhap');
    Route::get('/ajax-xuat-nhap', [XuatnhapController::class, 'ajaxxuatnhap'])->name('ajaxxuatnhap3');
    Route::get('/ajax-xuat-nhap2', [XuatnhapController::class, 'ajaxxuatnhap2'])->name('ajaxxuatnhap2');
    Route::get('/bo-su-tap', [XuatnhapController::class, 'bosutap'])->name('bosutap');
    Route::get('/lay-vi-tri', [XuatnhapController::class, 'layvitri2'])->name('layvitri2');
    Route::get('/lay-nguoi-nhap', [XuatnhapController::class, 'laynguoinhap'])->name('laynguoinhap');
    Route::post('/hien-vat', [XuatnhapController::class, 'hienvat'])->name('hienvat');
    Route::get('/get-hien-vat', [XuatnhapController::class, 'gethienvat'])->name('gethienvat');
    Route::post('/hien-vat-ton-tai', [XuatnhapController::class, 'hienvattontai'])->name('hienvattontai');
    Route::post('/info-hien-vat-vi-tri-kho', [XuatnhapController::class, 'infohienvatvitrikho'])->name('infohienvatvitrikho');
    Route::get('/info-bo-suu-tap-da-xuat', [XuatnhapController::class, 'infobosuutapdaxuat'])->name('infobosuutapdaxuat');
    Route::get('/view-tra-hien-vat', [XuatnhapController::class, 'viewtrahienvat'])->name('viewtrahienvat');
    Route::get('/ajax-hien-vat-da-xuat', [XuatnhapController::class, 'ajaxhienvatdaxuat'])->name('ajaxhienvatdaxuat');
    Route::post('/tra-hien-vat', [XuatnhapController::class, 'trahienvat'])->name('trahienvat');
    Route::post('/huy-tra-hien-vat', [XuatnhapController::class, 'huytrahienvat'])->name('huytrahienvat');
    Route::post('/tra-het-hien-vat', [XuatnhapController::class, 'trahethienvat'])->name('trahethienvat');
    // làm lại tìm kiếm và lấy hiện vật xuất nhập
    Route::post('/get-tim-kiem-hien-vat-xuat-nhap', [XuatnhapController::class, 'gettimkiemhienvatxuatnhap'])->name('gettimkiemhienvatxuatnhap');
    // duyệt phiếu 
    Route::post('/duyet-phieu', [XuatnhapController::class, 'duyetphieu'])->name('duyetphieu');
    Route::post('/duyet-phieu-xuat', [XuatnhapController::class, 'duyetphieuxuat'])->name('duyetphieuxuat');







    Route::get('/get-dang-dang-nhap', [QuanlynhapController::class, 'getdangnhap'])->name('getdangnhap');
    // em Hùng làm quản lý nhập
    Route::get('/nhap', [QuanlynhapController::class, 'nhap'])->name('nhap');
    Route::post('/save-nhap', [QuanlynhapController::class, 'savenhap'])->name('savenhap');
    Route::post('/update-nhap', [QuanlynhapController::class, 'updatenhap'])->name('updatenhap');
    // Route::delete('/delete-xuat-nhap', [QuanlynhapController::class, 'deletexuatnhap'])->name('deletenhap');
    Route::get('/ajax-nhap', [QuanlynhapController::class, 'ajaxnhap'])->name('ajaxxuatnhap');
    // quản lý trưng bày
    Route::get('/quan-ly-trung-bay', [QuanlytrungbayController::class, 'quanlytrungbay'])->name('quanlytrungbay');
    Route::get('/ajax-quan-ly-trung-bay', [QuanlytrungbayController::class, 'ajaxquanlytrungbay'])->name('ajaxquanlytrungbay');
    Route::post('/save-quan-ly-trung-bay', [QuanlytrungbayController::class, 'savequanlytrungbay'])->name('savequanlytrungbay');
    Route::post('/update-quan-ly-trung-bay', [QuanlytrungbayController::class, 'updatequanlytrungbay'])->name('updatequanlytrungbay');
    Route::delete('/delete-quan-ly-trung-bay', [QuanlytrungbayController::class, 'deletequanlytrungbay'])->name('deletequanlytrungbay');
    Route::get('/trung-bay-hien-vat', [QuanlytrungbayController::class, 'trungbayhienvat'])->name('trungbayhienvat');
    Route::get('/ajax-trung-bay-hien-vat', [QuanlytrungbayController::class, 'ajaxtrungbayhienvat'])->name('ajaxtrungbayhienvat');
    Route::get('/showhienvats', [QuanlytrungbayController::class, 'showhienvats'])->name('showhienvats');

    Route::get('/quan-ly-hien-vat-trung-bay', [HienvattrungbayController::class, 'quanlyhienvattrungbay'])->name('quanlyhienvattrungbay');
    Route::get('/ajax-quan-ly-hien-vat-trung-bay', [HienvattrungbayController::class, 'ajaxquanlyhienvattrungbay'])->name('ajaxquanlyhienvattrungbay');
    Route::post('/save-quan-ly-hien-vat-trung-bay', [HienvattrungbayController::class, 'savequanlyhienvattrungbay'])->name('savequanlyhienvattrungbay');
    Route::post('/update-quan-ly-hien-vat-trung-bay', [HienvattrungbayController::class, 'updatequanlyhienvattrungbay'])->name('updatequanlyhienvattrungbay');
    Route::delete('/delete-quan-ly-hien-vat-trung-bay', [HienvattrungbayController::class, 'deletequanlyhienvattrungbay'])->name('deletequanlyhienvattrungbay');

    Route::get('/vi-tri-trung-bay', [VitritrungbayController::class, 'vitritrungbay'])->name('vitritrungbay');
    Route::get('/ajax-vi-tri-trung-bay', [VitritrungbayController::class, 'ajaxvitritrungbay'])->name('ajaxvitritrungbay');
    Route::post('/save-vi-tri-trung-bay', [VitritrungbayController::class, 'savevitritrungbay'])->name('savevitritrungbay');
    Route::post('/update-vi-tri-trung-bay', [VitritrungbayController::class, 'updatevitritrungbay'])->name('updatevitritrungbay');
    Route::delete('/delete-vi-tri-trung-bay', [VitritrungbayController::class, 'deletevitritrungbay'])->name('deletevitritrungbay');

    Route::get('/dot-trung-bay', [DottrungbayController::class, 'dottrungbay'])->name('dottrungbay');
    Route::get('/ajax-dot-trung-bay', [DottrungbayController::class, 'ajaxdottrungbay'])->name('ajaxdottrungbay');
    Route::post('/save-dot-trung-bay', [DottrungbayController::class, 'savedottrungbay'])->name('savedottrungbay');
    Route::post('/update-dot-trung-bay', [DottrungbayController::class, 'updatedottrungbay'])->name('updatedottrungbay');
    Route::delete('/delete-dot-trung-bay', [DottrungbayController::class, 'deletedottrungbay'])->name('deletedottrungbay');
    // bộ sưu tập
    Route::get('/info-bo-suu-tap', [BosuutapController::class, 'infobosuutap'])->name('infobosuutap');
    Route::get('/bo-suu-tap', [BosuutapController::class, 'bosuutap'])->name('bosuutap');
    Route::get('/ajax-bo-suu-tap', [BosuutapController::class, 'ajaxbosuutap'])->name('ajaxbosuutap');
    Route::post('/save-bo-suu-tap', [BosuutapController::class, 'savebosuutap'])->name('savebosuutap');
    Route::post('/update-bo-suu-tap', [BosuutapController::class, 'updatebosuutap'])->name('updatebosuutap');
    Route::delete('/delete-bo-suu-tap', [BosuutapController::class, 'deletebosuutap'])->name('deletebosuutap');
    Route::get('/hien-vat-bo-suu-tap', [BosuutapController::class, 'hienvatbosuutap'])->name('hienvatbosuutap');
    Route::get('/ajax-hien-vat-bo-suu-tap', [BosuutapController::class, 'ajaxhienvatbosuutap'])->name('ajaxhienvatbosuutap');
    Route::get('/hien-vat-thuoc-bo-suu-tap', [BosuutapController::class, 'hienvatthuocbosuutap'])->name('hienvatthuocbosuutap');

    // trưng bày ảo
    Route::get('/trung-bay-ao', [TrungbayaoController::class, 'trungbayao'])->name('trungbayao');
    Route::get('/ajax-trung-bay-ao', [TrungbayaoController::class, 'ajaxtrungbayao'])->name('ajaxtrungbayao');
    Route::post('/save-trung-bay-ao', [TrungbayaoController::class, 'savetrungbayao'])->name('savetrungbayao');
    Route::post('/update-trung-bay-ao', [TrungbayaoController::class, 'updatetrungbayao'])->name('updatetrungbayao');
    Route::delete('/delete-trung-bay-ao', [TrungbayaoController::class, 'deletetrungbayao'])->name('deletetrungbayao');
    Route::get('/trung-bay-ao-hien-vat', [TrungbayaoController::class, 'trungbayaohienvat'])->name('trungbayaohienvat');
    Route::get('/ajax-trung-bay-ao-hien-vat', [TrungbayaoController::class, 'ajaxtrungbayaohienvat'])->name('ajaxtrungbayaohienvat');

    // quản lý bảo quản
    Route::get('/bao-quan', [BaoquanController::class, 'baoquan'])->name('baoquan');
    Route::get('/phieu-bao-quan', [BaoquanController::class, 'phieubaoquan'])->name('phieubaoquan');
    Route::post('/save-phieu-bao-quan', [BaoquanController::class, 'savephieubaoquan'])->name('savephieubaoquan');
    Route::post('/update-phieu-bao-quan', [BaoquanController::class, 'updatephieubaoquan'])->name('updatephieubaoquan');
    Route::delete('/delete-phieu-bao-quan', [BaoquanController::class, 'deletephieubaoquan'])->name('deletephieubaoquan');
    Route::get('/ajax-phieu-bao-quan', [BaoquanController::class, 'ajaxphieubaoquan'])->name('ajaxphieubaoquan');
    Route::post('/hien-vat-trong-kho', [BaoquanController::class, 'hienvattrongkho'])->name('hienvattrongkho');
    Route::post('/update-phieu', [BaoquanController::class, 'updatephieu'])->name('updatephieu');

    Route::post('/save-bao-quan', [BaoquanController::class, 'savebaoquan'])->name('savebaoquan');
    Route::post('/update-bao-quan', [BaoquanController::class, 'updatebaoquan'])->name('updatebaoquan');
    Route::delete('/delete-bao-quan', [BaoquanController::class, 'deletebaoquan'])->name('deletebaoquan');
    Route::get('/ajax-bao-quan', [BaoquanController::class, 'ajaxbaoquan'])->name('ajaxbaoquan');
    Route::post('/duyet-bao-quan', [BaoquanController::class, 'duyetbaoquan'])->name('duyetbaoquan');
    Route::post('/tra-hien-vat-bao-quan', [BaoquanController::class, 'trahienvatbaoquan'])->name('trahienvatbaoquan');
    //báo cáo thống kê
    Route::get('/bao-cao-thong-ke', [ThongkeController::class, 'baocaothongke'])->name('baocaothongke');
    Route::post('/save-bao-cao-thong-ke', [ThongkeController::class, 'savebaocaothongke'])->name('savequanbaocaothongke');
    Route::post('/update-bao-cao-thong-ke', [ThongkeController::class, 'updatebaocaothongke'])->name('updatebaocaothongke');
    Route::delete('/delete-bao-cao-thong-ke', [ThongkeController::class, 'deletebaocaothongke'])->name('deletebaocaothongke');
    Route::get('/ajax-bao-cao-thong-ke', [ThongkeController::class, 'ajaxbaocaothongke'])->name('ajaxbaocaothongke');

    //quản lý hình ảnh
    Route::get('/quan-ly-hinh-anh', [QuanlyhinhanhController::class, 'quanlyhinhanh'])->name('quanlyhinhanh');
    Route::post('/save-quan-ly-hinh-anh', [QuanlyhinhanhController::class, 'savequanlyhinhanh'])->name('savequanquanlyhinhanh');
    Route::post('/update-quan-ly-hinh-anh', [QuanlyhinhanhController::class, 'updatequanlyhinhanh'])->name('updatequanlyhinhanh');
    Route::delete('/delete-quan-ly-hinh-anh', [QuanlyhinhanhController::class, 'deletequanlyhinhanh'])->name('deletequanlyhinhanh');
    Route::get('/ajax-quan-ly-hinh-anh', [QuanlyhinhanhController::class, 'ajaxquanlyhinhanh'])->name('ajaxquanlyhinhanh');

    // quản lí bộ sưu tập hình ảnh

    Route::get('/quan-ly-bo-suu-tap-hinh-anh', [BosuutaphinhanhController::class, 'bosuutaphinhanh'])->name('bosuutaphinhanh');
    Route::post('/save-quan-ly-bo-suu-tap-hinh-anh', [BosuutaphinhanhController::class, 'savebosuutaphinhanh'])->name('savequanbosuutaphinhanh');
    Route::post('/update-quan-ly-bo-suu-tap-hinh-anh', [BosuutaphinhanhController::class, 'updatebosuutaphinhanh'])->name('updatebosuutaphinhanh');
    Route::delete('/delete-quan-ly-bo-suu-tap-hinh-anh', [BosuutaphinhanhController::class, 'deletebosuutaphinhanh'])->name('deletebosuutaphinhanh');
    Route::get('/ajax-quan-ly-bo-suu-tap-hinh-anh', [BosuutaphinhanhController::class, 'ajaxbosuutaphinhanh'])->name('ajaxbosuutaphinhanh');

    // quan lý media

    Route::get('/quan-ly-media', [MediaController::class, 'media'])->name('media');
    Route::post('/save-quan-ly-media', [MediaController::class, 'savemedia'])->name('savequanmedia');
    Route::post('/update-quan-ly-media', [MediaController::class, 'updatemedia'])->name('updatemedia');
    Route::delete('/delete-quan-ly-media', [MediaController::class, 'deletemedia'])->name('deletemedia');
    Route::get('/ajax-quan-ly-media', [MediaController::class, 'ajaxmedia'])->name('ajaxmedia');
    Route::get('/testscss', [MediaController::class, 'testscss'])->name('testscss');

    //quản lý xuất
    Route::get('/xuat', [QuanlyxuatController::class, 'xuat'])->name('xuat');
    Route::post('/save-xuat', [QuanlyxuatController::class, 'savexuat'])->name('savexuat');
    Route::post('/update-xuat', [QuanlyxuatController::class, 'updatexuat'])->name('updatexuat');
    Route::delete('/delete-xuat', [QuanlyxuatController::class, 'deletexuat'])->name('deletexuat');
    Route::get('/ajax-xuat', [QuanlyxuatController::class, 'ajaxxuat'])->name('ajaxxuat');
    // gallery hiện vật
    Route::get('/gallery-hien-vat', [ThongkeController::class, 'galleryhienvat'])->name('galleryhienvat');
    Route::get('/ajax-gallery-hien-vat', [ThongkeController::class, 'ajaxgalleryhienvat'])->name('ajaxgalleryhienvat');
    // tim kiếm hiện vật
    Route::get('/tim-kiem-hien-vat', [TimkiemController::class, 'timkiemhienvat'])->name('timkiemhienvat');
    Route::get('/ajax-tim-kiem-hien-vat', [TimkiemController::class, 'ajaxtimkiemhienvat'])->name('ajaxtimkiemhienvat');
    Route::get('/info-file-hien-vat', [TimkiemController::class, 'infofilehienvat'])->name('infofilehienvat');
    // hỗ trợ
    Route::get('/ho-tro', [TimkiemController::class, 'hotro'])->name('hotro');
    //
    Route::get('/duyet-nhieu-hien-vat', [HienvatController::class, 'duyetnhieuhienvat'])->name('duyetnhieuhienvat');
    Route::get('/ajax-duyet-nhieu-hien-vat', [HienvatController::class, 'ajaxduyethienvat'])->name('ajaxduyethienvat');
    Route::post('/save-duyet-hien-vats', [HienvatController::class, 'savehienvats'])->name('savehienvats');
    // database backup
    Route::get('/backup-data', [DatabackupController::class, 'backup'])->name('backup');
    Route::delete('/backup-data/{id}', [DatabackupController::class, 'destroy'])->name('backup.destroy');
    Route::post('/ajax/backup-data-now', [DatabackupController::class, 'backupDataNow'])->name('backupDataNow');
    Route::post('/ajax/restore-data', [DatabackupController::class, 'restoreDataNow'])->name('restoreDataNow');
    Route::get('/ajax-backup', [DatabackupController::class, 'ajaxdatabackup'])->name('ajaxdatabackup');
    // Xuất word 
    Route::get('/export-word', [DatabackupController::class, 'exportword'])->name('exportword');

    // báo cáo thống kê
    Route::get('/bao-cao-user', [ThongkeController::class, 'baocaouser'])->name('baocaouser');
    Route::get('/ajax-bao-cao-user', [ThongkeController::class, 'ajaxbaocaouser'])->name('ajaxbaocaouser');

    // quản lý portal
    Route::get('/post', [PostController::class, 'post'])->name('post');
    Route::post('/save-post', [PostController::class, 'savePost'])->name('savePost');
    Route::post('/update-post', [PostController::class, 'updatePost'])->name('updatePost');
    Route::delete('/delete-post', [PostController::class, 'deletePost'])->name('deletePost');
    Route::get('/ajax-post', [PostController::class, 'ajaxPost'])->name('ajaxPost');



    Route::get('/giao-dien', [PostController::class, 'giaoDien'])->name('giaoDien');


    Route::get('/portal', [PortalController::class, 'portal'])->name('portal');
    Route::post('/save-portal', [PortalController::class, 'savePortal'])->name('savePortal');
    Route::post('/update-portal', [PortalController::class, 'updatePortal'])->name('updatePortal');
    Route::delete('/delete-portal', [PortalController::class, 'deletePortal'])->name('deletePortal');
    Route::get('/ajax-portal', [PortalController::class, 'ajaxPortal'])->name('ajaxPortal');

    Route::get('/nhomquyen', [ChucvuController::class, 'nhomquyen'])->name('nhomquyen');
    Route::post('/save-nhomquyen', [ChucvuController::class, 'savenhomquyen'])->name('savenhomquyen');
    Route::post('/update-nhomquyen', [ChucvuController::class, 'updatenhomquyen'])->name('updatenhomquyen');
    Route::delete('/delete-nhomquyen', [ChucvuController::class, 'deletenhomquyen'])->name('deletenhomquyen');
    Route::get('/ajax-nhomquyen', [ChucvuController::class, 'ajaxnhomquyen'])->name('ajaxnhomquyen');

    Route::get('/pagenew', [PagenewController::class, 'pagenew'])->name('pagenew');
    Route::post('/save-pagenew', [PagenewController::class, 'savepagenew'])->name('savepagenew');
    Route::post('/update-pagenew', [PagenewController::class, 'updatepagenew'])->name('updatepagenew');
    Route::delete('/delete-pagenew', [PagenewController::class, 'deletepagenew'])->name('deletepagenew');
    Route::get('/ajax-pagenew', [PagenewController::class, 'ajaxpagenew'])->name('ajaxpagenew');

    Route::get('/category', [DanhmucController::class, 'Category'])->name('Category');
    Route::post('/save-category', [DanhmucController::class, 'saveCategory'])->name('saveCategory');
    Route::post('/update-category', [DanhmucController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('/delete-category', [DanhmucController::class, 'deleteCategory'])->name('deleteCategory');
    Route::get('/ajax-category', [DanhmucController::class, 'ajaxCategory'])->name('ajaxCategory');

    Route::get('/so-di-chuyen-hien-vat', [SodichuyenhienvatController::class, 'SoDiChuyen'])->name('SoDiChuyen');
    Route::post('/save-so-di-chuyen', [SodichuyenhienvatController::class, 'saveSoDiChuyen'])->name('saveSoDiChuyen');
    Route::post('/update-so-di-chuyen', [SodichuyenhienvatController::class, 'updateSoDiChuyen'])->name('updateSoDiChuyen');
    Route::delete('/delete-so-di-chuyen', [SodichuyenhienvatController::class, 'deleteSoDiChuyen'])->name('deleteSoDiChuyen');
    Route::get('/ajax-so-di-chuyen', [SodichuyenhienvatController::class, 'ajaxSoDiChuyen'])->name('ajaxSoDiChuyen');


    Route::get('/module', [ModuleController::class, 'Module'])->name('Module');
    Route::get('/ajax-module', [ModuleController::class, 'ajaxModule'])->name('ajaxModule');
    Route::get('/change-status-module/{id}', [ModuleController::class, 'statusModule'])->name('statusModule');


    Route::get('/nhatky', [SystemController::class, 'hethong'])->name('hethong');
    Route::post('/save-hethong', [SystemController::class, 'savehethong'])->name('savehethong');
    Route::get('/ajax-hethong', [SystemController::class, 'ajaxhethong'])->name('ajaxhethong');
    // module cập nhật dữ liệu số hóa hiện vật
    Route::get('/du-lieu-so-hoa-hien-vat', [SohoadulieuhienvatController::class, 'duLieuSoHoaHienVat'])->name('duLieuSoHoaHienVat');
    Route::post('/save-du-lieu-so-hoa-hien-vat', [SohoadulieuhienvatController::class, 'saveduLieuSoHoaHienVat'])->name('saveduLieuSoHoaHienVat');
    Route::post('/update-du-lieu-so-hoa-hien-vat', [SohoadulieuhienvatController::class, 'updateduLieuSoHoaHienVat'])->name('updateduLieuSoHoaHienVat');
    Route::delete('/delete-du-lieu-so-hoa-hien-vat', [SohoadulieuhienvatController::class, 'deleteduLieuSoHoaHienVat'])->name('deleteduLieuSoHoaHienVat');
    Route::get('/ajax-du-lieu-so-hoa-hien-vat', [SohoadulieuhienvatController::class, 'ajaxduLieuSoHoaHienVat'])->name('ajaxduLieuSoHoaHienVat');

    // Bảo quản hiện vật đang bảo quản và cần bảo quản
    Route::get('/so-bao-quan-hien-vat', [BaoquanController::class, 'SoBaoQuanHienVat'])->name('SoBaoQuanHienVat');
    Route::post('/save-so-bao-quan-hien-vat', [BaoquanController::class, 'saveSoBaoQuanHienVat'])->name('saveSoBaoQuanHienVat');
    Route::post('/update-so-bao-quan-hien-vat', [BaoquanController::class, 'updateSoBaoQuanHienVat'])->name('updateSoBaoQuanHienVat');
    Route::delete('/delete-so-bao-quan-hien-vat', [BaoquanController::class, 'deleteSoBaoQuanHienVat'])->name('deleteSoBaoQuanHienVat');
    Route::get('/ajax-so-bao-quan-hien-vat', [BaoquanController::class, 'ajaxSoBaoQuanHienVat'])->name('ajaxSoBaoQuanHienVat');

    // Danh sách hiện vật đang bảo quản 
    Route::get('/danh-sach-hien-vat-so-bao-quan', [PhieubaoquanController::class, 'DanhSachHienVatSoBaoQuan'])->name('DanhSachHienVatSoBaoQuan');
    Route::post('/save-danh-sach-hien-vat-so-bao-quan', [PhieubaoquanController::class, 'saveDanhSachHienVatSoBaoQuan'])->name('saveDanhSachHienVatSoBaoQuan');
    Route::post('/update-danh-sach-hien-vat-so-bao-quan', [PhieubaoquanController::class, 'updateDanhSachHienVatSoBaoQuan'])->name('updateDanhSachHienVatSoBaoQuan');
    Route::delete('/delete-danh-sach-hien-vat-so-bao-quan', [PhieubaoquanController::class, 'deleteDanhSachHienVatSoBaoQuan'])->name('deleteDanhSachHienVatSoBaoQuan');
    Route::get('/ajax-danh-sach-hien-vat-so-bao-quan', [PhieubaoquanController::class, 'ajaxDanhSachHienVatSoBaoQuan'])->name('ajaxDanhSachHienVatSoBaoQuan');
    // quản lý vị trí trưng bày ảo
    Route::get('/vi-tri-trung-bay-ao', [VitritrungbayaoController::class, 'ViTriTrungBayAo'])->name('ViTriTrungBayAo');
    Route::post('/save-vi-tri-trung-bay-ao', [VitritrungbayaoController::class, 'saveViTriTrungBayAo'])->name('saveViTriTrungBayAo');
    Route::post('/update-vi-tri-trung-bay-ao', [VitritrungbayaoController::class, 'updateViTriTrungBayAo'])->name('updateViTriTrungBayAo');
    Route::delete('/delete-vi-tri-trung-bay-ao', [VitritrungbayaoController::class, 'deleteViTriTrungBayAo'])->name('deleteViTriTrungBayAo');
    Route::get('/ajax-vi-tri-trung-bay-ao', [VitritrungbayaoController::class, 'ajaxViTriTrungBayAo'])->name('ajaxViTriTrungBayAo');
    // quản lý đợt trưng bày ảo
    Route::get('/quan-ly-dot-trung-bay-ao', [DottrungbayaoController::class, 'QuanLyDotTruongBayAo'])->name('QuanLyDotTruongBayAo');
    Route::post('/save-quan-ly-dot-trung-bay-ao', [DottrungbayaoController::class, 'saveQuanLyDotTruongBayAo'])->name('saveQuanLyDotTruongBayAo');
    Route::post('/update-quan-ly-dot-trung-bay-ao', [DottrungbayaoController::class, 'updateQuanLyDotTruongBayAo'])->name('updateQuanLyDotTruongBayAo');
    Route::delete('/delete-quan-ly-dot-trung-bay-ao', [DottrungbayaoController::class, 'deleteQuanLyDotTruongBayAo'])->name('deleteQuanLyDotTruongBayAo');
    Route::get('/ajax-quan-ly-dot-trung-bay-ao', [DottrungbayaoController::class, 'ajaxQuanLyDotTruongBayAo'])->name('ajaxQuanLyDotTruongBayAo');
    // quản lý hiện vật trưng bày ảo
    Route::get('/hien-vat-trung-bay-ao', [HienvattrungbayaoController::class, 'HienVatTrungBayAo'])->name('HienVatTrungBayAo');
    Route::post('/save-hien-vat-trung-bay-ao', [HienvattrungbayaoController::class, 'saveHienVatTrungBayAo'])->name('saveHienVatTrungBayAo');
    Route::post('/update-hien-vat-trung-bay-ao', [HienvattrungbayaoController::class, 'updateHienVatTrungBayAo'])->name('updateHienVatTrungBayAo');
    Route::delete('/delete-hien-vat-trung-bay-ao', [HienvattrungbayaoController::class, 'deleteHienVatTrungBayAo'])->name('deleteHienVatTrungBayAo');
    Route::get('/ajax-hien-vat-trung-bay-ao', [HienvattrungbayaoController::class, 'ajaxHienVatTrungBayAo'])->name('ajaxHienVatTrungBayAo');


    Route::get('/lam-net-anh', [XuLyAnhController::class, 'index'])->name('lamnetanh.index');
});
Route::get('/test-api', [XuatexcellController::class, 'testapi'])->name('testapi');
Route::post('/api-luu', [XuatexcellController::class, 'apiluu'])->name('apiluu');
Route::get('/api-lay', [XuatexcellController::class, 'apilay'])->name('apilay');


Route::get('/giao-dien-2', [GiaodienController::class, 'index'])->name('giaodien2.index');
Route::get('/giao-dien-2/tin-tuc', [GiaodienController::class, 'tintuc'])->name('giaodien2.tintuc');
Route::get('/giao-dien-2/lien-he', [GiaodienController::class, 'lienhe'])->name('giaodien2.lienhe');
Route::get('/giao-dien-2/chi-tiet-tin-tuc', [GiaodienController::class, 'chitiettintuc'])->name('giaodien2.chitiettintuc');
