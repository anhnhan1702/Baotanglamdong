<?php

namespace App\Http\Controllers;

use App\Models\Chatlieu;
use App\Models\Databackup;
use App\Models\Fileuploads;
use App\Models\Hienvat;
use App\Models\Hinhthucsuutam;
use App\Models\Loaihienvat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DOMDocument;
use App\Console\Commands\DatabaseBackup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Yajra\Datatables\Datatables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

class DatabackupController extends Controller
{
    //
    public function backup()
    {
        return view('backup.backup');
    }
    public function backupDataNow(){
        try {
            \Artisan::call('backup:run');
            return response()->json(['message' => 'backup thành công.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroy($id){
        $status = 0;
        $message = 'Xóa thành công!';
        try{
            $recordBackup = Databackup::findOrFail($id);
            $path = date('Y',strtotime($recordBackup->created_at)).'/'.date('m',strtotime($recordBackup->created_at)).'/';
            $name = $recordBackup->name;
            $backupPath = storage_path('app/backup').'/'.$path;
            \File::delete("{$backupPath}/{$name}");
            Databackup::destroy($id);
            $status = 1;
            $message = 'Xóa thành công!';
        }catch(\Exception $e){
            $status = 0;
            $message = 'Xóa thất bại!';
        }
        return compact('status', 'message');
    }
    public function ajaxdatabackup(Request $request)
    {
        $dem = 0;
        $searchnow = $request->searchnow;
        $searchcolum =  $request->searchcolum;
        // Query dữ liệu
        $Databackup = Databackup::orderBy('id', 'desc');
        $Databackup = searchColum($Databackup, $searchcolum, $searchnow);

        $Databackup = $Databackup->get();
        return DataTables::of($Databackup)->make(true);
    }
    public function restoreDataNow(Request $request){
        $recordBackup = Databackup::findOrFail($request->id);
        if(!empty($recordBackup)){
            $path = date('Y',strtotime($recordBackup->created_at)).'/'.date('m',strtotime($recordBackup->created_at)).'/';
            $name = $recordBackup->name;
            $backupPath = storage_path('app/backup').'/'.$path;
            $filePath = "{$backupPath}/{$name}";
            if(!file_exists($filePath)){
                return ['status'=>0, 'message' => 'File Dữ liệu này không tồn tại'];
            }
            try {
                \Artisan::call('Import:Data-backup', [
                    'path' => $filePath
                ]);
                return ['status'=>1, 'message' => 'backup thành công.'];
            } catch (\Exception $e) {
                return ['status'=>0, 'message' => $e->getMessage()];
            }
        }else{
            return ['status'=>0, 'message' => 'File Dữ liệu này không tồn tại'];
        }
    }
    // export word 
    public function exportword(Request $request)
    {

        if ($request->kieuxuat === 'phieuhienvat') {
            // Tạo mã QR
            $qrcode = QrCode::format('png')->size(150)->generate('http://quanly.baotanglamdong.com.vn/thong-tin-hien-vat/' . $request->data);

            // Chuyển đổi mã QR thành hình ảnh
            $image = $qrcode;
            $Infohienvat = Hienvat::where('id', $request->data)->first();

            if ($Infohienvat->hinhthucst_id != null) {
                $Infohienvat->hinhthucst_id = Hinhthucsuutam::find($Infohienvat->hinhthucst_id)->name;
            }

            if ($Infohienvat->chatlieu_id != null) {

                $Infohienvat->chatlieu_id = Chatlieu::find($Infohienvat->chatlieu_id)->name;
            }

            if ($Infohienvat->loaihienvat_id != null) {

                $Infohienvat->loaihienvat_id = Loaihienvat::find($Infohienvat->loaihienvat_id)->name;
            }

            $Fileuploads = Fileuploads::where('tenbang', 'anhhienvat')->where('idtruong', $Infohienvat->id)->orderBy('id', 'desc')->get();

            if (Count($Fileuploads) < 1) {
                $Infohienvat->fileuploads = null;
            } elseif (Count($Fileuploads) == 1) {
                $Infohienvat->anh1 =  $Fileuploads[0]['link'];
                $Infohienvat->anh2 =  null;
            } else {
                $Infohienvat->anh1 =  $Fileuploads[0]['link'];
                $Infohienvat->anh2 =   $Fileuploads[1]['link'];
            }
            if ($Infohienvat->thoi_gian_st) {
                $time = strtotime($Infohienvat->thoi_gian_st);
                $Infohienvat->thoi_gian_st =  date('d/m/Y ', $time);
            }

            // $src = base_url() . "/public/images/bg-login.jpg";
            // $path = realpath(__DIR__ . '/'.$Infohienvat->anh1);
            // return $src;

            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $sectionStyle = array(
                'orientation' => 'portrait',
                'marginTop' => 850,
                'marginRight' => 900,
                'marginBottom' => 1440,
                'marginLeft' => 1440,

            );
            $section = $phpWord->addSection($sectionStyle);

            $table = $section->addTable('myTable');
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'SỞ VĂN HÓA, THỂ THAO &amp; DU LỊCH',
                ['name' => 'Times New Roman', 'size' => 11, 'width' => 200],
                array('align' => 'center', 'spacingBottom' => 10, 'spacingTop' => 10)
            );
            $cell = $table->addCell(7000)->addText(
                'CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM',
                array(
                    'name' => 'Times New Roman', 'size' => 11,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'BẢO TÀNG LÂM ĐỒNG',
                array(
                    'name' => 'Times New Roman', 'size' => 11, 'width' => 200,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                'Độc lập - Tự do - Hạnh phúc',
                array(
                    'name' => 'Times New Roman', 'size' => 11,
                    'bold' => true,
                    'align' => 'center',
                    'valign' => 'center'
                ),
                array('align' => 'center')
            );

            $section->addText(
                'PHIẾU THÔNG TIN HIỆN VẬT',
                array('name' => 'Times New Roman', 'bold' => true, 'size' => 12,),
                array(
                    'align' => 'center', 'space' => array('before' => 360, 'after' => 280),
                    'indentation' => array('left' => 540, 'right' => 120)
                ),
            );

            $tableStyle = array(
                'borderSize'  => 6,
                'cellMargin'  => 100,

            );
            $table = $section->addTable('myTable2');
            $phpWord->addTableStyle('myTable2', $tableStyle);
            $cellRowSpan = array('vMerge' => 'restart');
            $cellColSpan = array('gridSpan' => 2);
            $cellColSpan3 = array('gridSpan' => 3);

            $cellRowContinue = array('vMerge' => 'continue');
            $table->addRow();
            $table->addCell(500, $cellColSpan3)->addText("STT", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(3000, $cellRowSpan)->addImage($image);
            $table->addRow();

            $table->addCell(500)->addText("01", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Tên gọi", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->name, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4000, $cellRowContinue)->addText('$image');
            $table->addRow();
            $table->addCell(500)->addText("02", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Tên gọi khác (nếu có)", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->ten_khac, array('size' => 12, 'name' => 'Times New Roman'));
            if ($Infohienvat->anh1) {
                $table->addCell(4000, $cellRowSpan)->addImage(
                    $Infohienvat->anh1,
                    array(
                        'width'         => 200,
                        'height'        => 200,


                    )
                );
            } else {
                $table->addCell(3000, $cellRowSpan);
            }
            $table->addRow();
            $table->addCell(500)->addText("03", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Số ký hiệu", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->so_ky_hieu, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("04", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Số lượng", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->soluong, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("05", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Số thành phần hợp thành (đơn vị hiện vật)", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->sothanhphan, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("06", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Chủ nhân hiện vật:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->chu_nhan, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("07", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Địa điểm sưu tầm:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->dia_diem_st, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("08", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Hình thức sưu tầm:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->hinhthucst_id, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("09", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Thời gian sưu tầm", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->thoi_gian_st, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();

            $table->addCell(500)->addText("10", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Chất liệu:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->chatlieu_id, array('size' => 12, 'name' => 'Times New Roman'));
            // $table->addCell(3000, $cellRowSpan)->addImage($Infohienvat->anh2);
            if ($Infohienvat->anh2) {
                $table->addCell(4000, $cellRowSpan)->addImage(
                    $Infohienvat->anh2,
                    array(
                        'width'         => 200,
                        'height'        => 200,


                    )
                );
            } else {
                $table->addCell(3000, $cellRowSpan);
            }
            $table->addRow();
            $table->addCell(500)->addText("11", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Màu sắc:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->mau_sac, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("11", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Màu sắc:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->mau_sac, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("12", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Kích thước (cm):", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->kich_thuoc, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("13", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Trọng lượng", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->trong_luong, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("14", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Hình dạng:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->hinh_dang, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("15", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Kỹ thuật chế tác:", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->ky_thuat_ct, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("16", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Tình trạng hiện vật", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->tinh_trang_hv, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("17", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Thời gian nhập kho", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->tg_nhap_kho, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("18", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Loại hiện vật", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText($Infohienvat->loaihienvat_id, array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(null, $cellRowContinue);
            $table->addRow();
            $table->addCell(500)->addText("19", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Nguồn gốc, xuất xứ", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(3000, $cellColSpan)->addText(strip_tags(html_entity_decode($Infohienvat->nguon_goc)), array('size' => 12, 'name' => 'Times New Roman'));

            $table->addRow();
            $table->addCell(500,)->addText("20", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(4500)->addText("Dự đoán niên đại", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(3000, $cellColSpan)->addText($Infohienvat->dudoan_niendai, array('size' => 12, 'name' => 'Times New Roman'));

            $section->addText(
                'Lâm đồng, ngày ' . ' ' . ' tháng ' . ' '  . ' năm ' . ' ',
                array('name' => 'Times New Roman', 'italic' => true, 'size' => 15),
                array(
                    'align' => 'right', 'space' => array('before' => 360, 'after' => 280),
                    'indentation' => array('left' => 540, 'right' => 120)
                )
            );

            $table = $section->addTable('myTable3');
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'Người lập',
                ['name' => 'Times New Roman', 'size' => 11, 'width' => 200, 'bold' => true,],
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                'Người kiểm tra',
                array(
                    'name' => 'Times New Roman', 'size' => 11,

                ),
                array('align' => 'center')
            );
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                '(Ký, họ tên)',
                ['name' => 'Times New Roman', 'italic', 'size' => 11, 'width' => 200],
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                '(Ký, họ tên)',
                array(
                    'name' => 'Times New Roman', 'italic', 'size' => 11,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $file = $Infohienvat->name . '.docx';
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename="' . $file . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $xmlWriter->save("php://output");
        } else {

            $explode_fullname = explode(',', $request->data);
            $idhienvats = [];
            foreach ($explode_fullname as $id) {
                $idhienvats[] = intval($id);
            }



            $dshienvats = Hienvat::whereIn('id', $idhienvats)->orderBy('id', 'desc')->get();

            foreach ($dshienvats as $dshv) {

                if ($dshv->vitrihv_id) {

                    $dshv->vitrihienvat =  $dshv->kho->name;
                } else {
                    $dshv->vitrihienvat = 'Chưa xác định';
                }

                $Fileuploads = Fileuploads::where('tenbang', 'anhhienvat')->where('idtruong', $dshv->id)->orderBy('id', 'desc')->get();

                if (Count($Fileuploads) < 1) {
                    $dshv->fileuploads = null;
                } else {
                    if (in_array($Fileuploads[0]['duoifile'], ['png', 'jpg', 'jpeg', 'webp','PNG', 'JPG', 'JPEG', 'WEBP'])) {
                        $pos = strpos($Fileuploads[0]['link'], '(1)');
                        if ($pos) {
                            $dshv->anh1 = null;
                        } else {
                            $dshv->anh1 =  $Fileuploads[0]['link'];
    
                            if ($Fileuploads[0]['link'] != null) {
                                if (file_exists($dshv->anh1)) {
                                    // Kiểm tra loại MIME của tệp
                                    $imageType = exif_imagetype($dshv->anh1);
    
                                    // Mảng các loại hình ảnh được hỗ trợ
                                    $supportedImageTypes = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_WEBP];
                                    $fileExtension = strtolower(pathinfo($dshv->anh1, PATHINFO_EXTENSION));
                                    // Chỉ xử lý nếu tệp là hình ảnh và có định dạng PNG, JPG hoặc WEBP
                                    if ($imageType !== false && in_array($imageType, $supportedImageTypes) && in_array($fileExtension, ['png', 'jpg', 'jpeg', 'webp'])) {
                                        $image = Image::make($dshv->anh1)->resize(200, 200);
                                        $image->encode('jpg', 80)->save(public_path($dshv->anh1));
                                    } else {
                                        // Nếu tệp không phải là PNG, JPG hoặc WEBP, gán null cho link
                                        $Fileuploads[0]['link'] = null;
                                    }
                                } else {
                                    $Fileuploads[0]['link'] = null;
                                }
                                
                            }
                        }
                    }else{
                        $Fileuploads[0]['link'] = null;
                    }
                    
                }
                if ($dshv->thoi_gian_st) {
                    $time = strtotime($dshv->thoi_gian_st);
                    $dshv->thoi_gian_st =  date('d/m/Y ', $time);
                }
            }
       
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $sectionStyle = array(
                'orientation' => 'landscape',
                'marginTop' => 850,
                'marginRight' => 900,
                'marginBottom' => 1440,
                'marginLeft' => 1440,

            );
            $section = $phpWord->addSection($sectionStyle);

            $table = $section->addTable('myTable');
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'SỞ VĂN HÓA, THỂ THAO &amp; DU LỊCH',
                ['name' => 'Times New Roman', 'size' => 11, 'width' => 200],
                array('align' => 'center', 'spacingBottom' => 10, 'spacingTop' => 10)
            );
            $cell = $table->addCell(7000)->addText(
                'CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM',
                array(
                    'name' => 'Times New Roman', 'size' => 11,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'BẢO TÀNG LÂM ĐỒNG',
                array(
                    'name' => 'Times New Roman', 'size' => 11, 'width' => 200,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                'Độc lập - Tự do - Hạnh phúc',
                array(
                    'name' => 'Times New Roman', 'size' => 11,
                    'bold' => true,
                    'align' => 'center',
                    'valign' => 'center'
                ),
                array('align' => 'center')
            );

            $section->addText(
                'DANH SÁCH HIỆN VẬT',
                array('name' => 'Times New Roman', 'bold' => true, 'size' => 12,),
                array(
                    'align' => 'center', 'space' => array('before' => 360, 'after' => 280),
                    'indentation' => array('left' => 540, 'right' => 120)
                ),
            );

            $tableStyle = array(
                'borderSize'  => 6,
                'cellMargin'  => 100,

            );
            $table = $section->addTable('myTable2');
            $phpWord->addTableStyle('myTable2', $tableStyle);
            $cellRowSpan = array('vMerge' => 'restart');
            $cellColSpan = array('gridSpan' => 2);
            $cellColSpan3 = array('gridSpan' => 3);

            $cellRowContinue = array('vMerge' => 'continue');
            $table->addRow();
            $table->addCell(1000)->addText("STT", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(2000)->addText("Tên hiện vật", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Số ký hiệu", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Số lượng", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Kích thước", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(2000)->addText("Trọng lượng", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Tình trạng", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Hình ảnh", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(3000)->addText("Vị trí hiện vật", array('size' => 12, 'name' => 'Times New Roman'));
            $table->addCell(1500)->addText("Ghi chú", array('size' => 12, 'name' => 'Times New Roman'));
            $dem = 0;
            foreach ($dshienvats as  $hv) {

                $table->addRow();
                $table->addCell(1000)->addText(++$dem, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(2000)->addText($hv->name, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(1500)->addText($hv->so_ky_hieu, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(1500)->addText($hv->soluong, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(1500)->addText($hv->kich_thuoc, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(2000)->addText($hv->trong_luong, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(1500)->addText($hv->tinh_trang_hv, array('size' => 12, 'name' => 'Times New Roman'));
                if (file_exists($hv->anh1)) {
                    $table->addCell(1500, $cellRowSpan)->addImage(
                        $hv->anh1,
                        array(
                            'width' => 100,
                            'height' => 100,
                        )
                    );
                } else {
                    $table->addCell(1500, $cellRowSpan);
                }

                $table->addCell(3000)->addText($hv->vitrihienvat, array('size' => 12, 'name' => 'Times New Roman'));
                $table->addCell(1500)->addText($hv->ghinho, array('size' => 12, 'name' => 'Times New Roman'));
            }


            $section->addText(
                'Lâm đồng, ngày ' . ' ' . ' tháng ' . ' '  . ' năm ' . ' ',
                array('name' => 'Times New Roman', 'italic' => true, 'size' => 15),
                array(
                    'align' => 'right', 'space' => array('before' => 360, 'after' => 280),
                    'indentation' => array('left' => 540, 'right' => 120)
                )
            );

            $table = $section->addTable('myTable3');
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                'Người lập',
                ['name' => 'Times New Roman', 'size' => 11, 'width' => 200, 'bold' => true,],
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                'Người kiểm tra',
                array(
                    'name' => 'Times New Roman', 'size' => 11,

                ),
                array('align' => 'center')
            );
            $table->addRow();
            $cell = $table->addCell(7000)->addText(
                '(Ký, họ tên)',
                ['name' => 'Times New Roman', 'italic', 'size' => 11, 'width' => 200],
                array('align' => 'center')
            );
            $cell = $table->addCell(7000)->addText(
                '(Ký, họ tên)',
                array(
                    'name' => 'Times New Roman', 'italic', 'size' => 11,
                    'bold' => true,
                ),
                array('align' => 'center')
            );
            $file = 'danhsachhienvat.docx';
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename="' . $file . '"');
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $xmlWriter->save("php://output");
        }
    }
}
