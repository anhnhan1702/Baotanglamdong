<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src='https://unpkg.com/vuejs-form@latest/build/vuejs-form.min.js'></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css">
    <link rel="stylesheet" href="/css/thongtinhienvat.css">
    <title>Thông tin hiên vật</title>

</head>

<body>
    <div id="printMe" class=" col-span-12 grid grid-cols-12 p-10">

        <div class="col-span-12  text-center text-base py-4 font-semibold ">
            PHIẾU THÔNG TIN HIỆN VẬT
        </div>
        <div class="sm:col-span-12 col-span-12 ">

            <table class="w-full border-collapse border border-black">
                <tr>
                    <td class="border border-l-0 border-black text-center p-1">
                        STT
                    </td>

                    <td class="border border-black p-1">

                    </td>

                    <td class="border border-black p-1">

                    </td>
                    <td class="border border border-black text-center w-40 p-1" rowspan="3" style="width: 30%;">
                        <qr-code :text="'http://quanly.baotanglamdong.com.vn/thong-tin-hien-vat/'+tableDataView.id"
                            :value="tableDataView.id" class="flex justify-center p-2" size="100">

                        </qr-code>
                    </td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        01
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Tên gọi:
                    </td>
                    <td class="p-1 border border border-black"> {{$infoThongtinhienvat->name}} </td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        02
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Tên gọi khác (nếu có):
                    </td>
                    <td class="p-1 border border border-black">
                        {{$infoThongtinhienvat->ten_khac}} </td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        03
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Số ký hiệu:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->so_ky_hieu}}
                        </th>

                    <td class="p-1 border border border-black text-center" rowspan="8">
                        <img class="p-2 w-full w-40" src="/{{$infoThongtinhienvat->anh1}}" alt="">
                    </td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        04
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Số lượng:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->soluong}}</td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        05
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Số thành phần hợp thành (đơn vị hiện vật)
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->sothanhphan}}</td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        06
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Chủ nhân hiện
                        vật:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->chu_nhan}}
                    </td>
                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        07
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Địa điểm sưu
                        tầm:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->dia_diem_st}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        08
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Hình thức sưu
                        tầm:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->hinhthucsuutam}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        09
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Thời gian sưu
                        tầm:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->thoi_gian_st}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        10
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Chất liệu:
                    </td>
                    <td class="p-1 border border border-black"> {{$infoThongtinhienvat->chatlieu}}
                    </td>
                    <td class="p-1 border border border-black text-center w-40" rowspan="9">
                        <img class="p-2 w-full w-40" src="/{{$infoThongtinhienvat->anh2}}" alt="">
                    </td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        11
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Màu sắc:
                    </td>
                    <td class="p-1 border border border-black">{{$infoThongtinhienvat->mau_sac}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        12
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Kích thước:
                    </td>
                    <td class="p-1 border border border-black"> {{$infoThongtinhienvat->kich_thuoc}}
                    </td>



                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        13
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Trọng lượng:
                    </td>
                    <td class="p-1 border border border-black"> {{$infoThongtinhienvat->trong_luong}}
                    </td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        14
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Hình dạng:
                    </td>
                    <td class="p-1 border border border-black"> {{$infoThongtinhienvat->hinh_dang}}
                    </td>



                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        15
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Kỹ thuật chế tác:
                    </td>
                    <td class="p-1 border border border-black">
                        {{$infoThongtinhienvat->ky_thuat_ct}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        16
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Tình trạng hiện vật:
                    </td>
                    <td class="p-1 border border border-black">
                        {{$infoThongtinhienvat->tinh_trang_hv}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        17
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Thời gian nhập kho:
                    </td>
                    <td class="p-1 border border border-black">
                        {{$infoThongtinhienvat->tg_nhap_kho}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        18
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Loại hiện vật:
                    </td>
                    <td class="p-1 border border border-black">
                        {{$infoThongtinhienvat->tenloaihienvat}}</td>


                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        19
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Nguồn gốc, xuất xứ:
                    </td>
                    <td class="p-1 border border border-black" colspan="2">
                        {!!$infoThongtinhienvat->nguon_goc!!}
                    </td>

                </tr>
                <tr>
                    <td class="p-1 border border border-black text-center">
                        20
                    </td>
                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                        Dự đoán niên đại:
                    </td>
                    <td class="p-1 border border border-black" colspan="2">
                        {{$infoThongtinhienvat->dudoan_niendai}}</td>


                </tr>


            </table>

        </div>

    </div>

</body>

</html>