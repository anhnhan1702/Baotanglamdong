@extends('../layout/layout')


@section('subhead')
<script src="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.min.css">
<title>Quản lý hiện vật</title>
@endsection
@section('subcontent')
<style>
.shadow.sm\:overflow-hidden.sm\:rounded-md.grid.grid-cols-12 {
    min-height: 300px !important;
}

#hiddenScroll::-webkit-scrollbar {
    display: none;
}

#dshv {
    width: 100%;
    margin: 0 auto;
}

#printMe {
    font-family: "Times New Roman", Times, serif;
    width: 210mm;
    margin: 0 auto;
}

#printMe2 {
    font-family: "Times New Roman", Times, serif;
    width: 210mm;
    margin: 0 auto;
}
</style>
<div id="demo" class="py-6  h-full ">
    <!-- ------------------modal 1------------------ -->
    <div v-cloak v-bind:class="{ hidden: isActivemodal_1 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal_1()" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class="sm:h-11/12 h-4/5 p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div id="printMe" class=" col-span-12 grid grid-cols-12">
                    <div class="col-span-12 flex justify-around text-sm">
                        <div class="text-center">
                            <p class="font-normal">SỞ VĂN HÓA, THỂ THAO & DU LỊCH</p>
                            <p class="font-semibold">
                                <u class="p-2">
                                    BẢO TÀNG LÂM ĐỒNG
                                </u>

                            </p>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                            <p class="font-semibold">
                                <u class="p-2">
                                    Độc Lập - Tự do - Hạnh phúc
                                </u>

                            </p>
                        </div>
                    </div>
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
                                <td class="border border border-black text-center w-40 p-1" rowspan="3"
                                    style="width: 35%;">
                                    <qr-code
                                        :text="'http://quanly.baotanglamdong.com.vn/thong-tin-hien-vat/'+tableDataView.id"
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
                                <td class="p-1 border border border-black"> @{{tableDataView.name}} </td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    02
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Tên gọi khác (nếu có):
                                </td>
                                <td class="p-1 border border border-black">
                                    @{{tableDataView.ten_khac}} </td>

                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    03
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Số ký hiệu:
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.so_ky_hieu}}
                                    </th>

                                <td class="p-1 border border border-black text-center" rowspan="8">
                                    <img class="p-2 w-full w-40" :src='tableDataView.anh1' alt="">
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
                                <td class="p-1 border border border-black">@{{tableDataView.soluong}}</td>

                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    05
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Số thành phần hợp thành (đơn vị hiện vật)
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.sothanhphan}}</td>

                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    06
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Chủ nhân hiện
                                    vật:
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.chu_nhan}}
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
                                <td class="p-1 border border border-black">@{{tableDataView.dia_diem_st}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    08
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Hình thức sưu
                                    tầm:
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.hinhthucst_id}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    09
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Thời gian sưu
                                    tầm:
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.thoi_gian_st}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    10
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Chất liệu:
                                </td>
                                <td class="p-1 border border border-black"> @{{tableDataView.chatlieu_id}}
                                </td>
                                <td class="p-1 border border border-black text-center w-40" rowspan="9">
                                    <img class="p-2 w-full w-40" :src='tableDataView.anh2' alt="">
                                </td>

                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    11
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Màu sắc:
                                </td>
                                <td class="p-1 border border border-black">@{{tableDataView.mau_sac}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    12
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Kích thước:
                                </td>
                                <td class="p-1 border border border-black"> @{{tableDataView.kich_thuoc}}
                                </td>



                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    13
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Trọng lượng:
                                </td>
                                <td class="p-1 border border border-black"> @{{tableDataView.trong_luong}}
                                </td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    14
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Hình dạng:
                                </td>
                                <td class="p-1 border border border-black"> @{{tableDataView.hinh_dang}}
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
                                    @{{tableDataView.ky_thuat_ct}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    16
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Tình trạng hiện vật:
                                </td>
                                <td class="p-1 border border border-black">
                                    @{{tableDataView.tinh_trang_hv}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    17
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Thời gian nhập kho:
                                </td>
                                <td class="p-1 border border border-black">
                                    @{{tableDataView.tg_nhap_kho}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    18
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Loại hiện vật:
                                </td>
                                <td class="p-1 border border border-black">
                                    @{{tableDataView.loaihienvat_id}}</td>


                            </tr>
                            <tr>
                                <td class="p-1 border border border-black text-center">
                                    19
                                </td>
                                <td class="p-1 border border border-black text-center" style="width: 22%;">
                                    Nội dung hiện vật:
                                </td>
                                <td class="p-1 border border border-black" colspan="2" v-html="tableDataView.nguon_goc">

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
                                    @{{tableDataView.dudoan_niendai}}</td>


                            </tr>


                        </table>

                    </div>
                    <div class="col-span-12 text-base py-2 text-right">
                        <i>
                            Lâm Đồng, ngày<span class="px-2 w-1"></span> tháng<span class="px-2 w-1"></span> năm <span
                                class="px-4 w-1"></span>
                        </i>
                    </div>
                    <div class="col-span-12 flex justify-around text-sm">
                        <div class="text-center">
                            <p class="font-semibold">Người lập</p>
                            <i>
                                (Ký, họ tên)
                            </i>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold">Người kiểm tra</p>
                            <i>
                                (Ký, họ tên)
                            </i>
                        </div>
                    </div>
                </div>


            </div>


            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                <button
                    class="items-center px-4 py-2 border border-green-700   text-sm font-medium rounded-md shadow-sm text-green-700 bg-white hover:text-white hover:bg-green-700"
                    @click="exportword(tableDataView)">Xuất word</button>
                <button
                    class="items-center px-4 py-2 border border-blue-700   text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:text-white hover:bg-blue-700"
                    @click="print">Print</button>
                <button @click="closemodal_1()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>


    <!-- --------------------danh sách hiện vật------------------------ -->
    <div v-cloak v-bind:class="{ hidden: isActivemodal_2 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal_2()" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class=" sm:h-11/12 h-4/5 p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-y-auto">

            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto ">
                <div id="printMe2" class=" col-span-12 grid grid-cols-12">
                    <div class="col-span-12  flex justify-around text-base">
                        <h1 class="text-center">SỞ VHTT&DL LÂM ĐỒNG <br>
                            <span class="font-semibold" style="border-bottom: 1px solid gray;">BẢO TÀNG LÂM ĐỒNG </span>
                        </h1>
                        <h1 class="text-center font-semibold">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br>
                            <span class="font-semibold" style="border-bottom: 1px solid gray;">Độc lập – Tự do – Hạnh
                                phúc</span>

                        </h1>
                    </div>
                    <div class="col-span-12  text-center  text-base py-2  font-semibold">
                        DANH SÁCH HIỆN VẬT
                    </div>
                    <div class="sm:col-span-12 col-span-12 ">

                        <table class="w-full">
                            <tr>
                                <th class="border border-black text-center">STT</th>
                                <th class="border border-black">Tên hiện vật</th>
                                <th class="border border-black">Số ký hiệu</th>
                                <th class="border border-black">Số lượng</th>
                                <th class="border border-black">Kích thước</th>
                                <th class="border border-black">Trọng lượng</th>
                                <th class="border border-black">Tình trạng</th>
                                <th class="border border-black">Hình ảnh</th>
                                <th class="border border-black">Vị trí hiện vật</th>
                                <th class="border border-black">Ghi chú</th>
                            </tr>
                            <tr v-for="(item, index) in danhsachhienvat">
                                <td class="border border-black text-center">@{{index + 1}}</td>
                                <td class="border border-black">@{{item.name}}</td>
                                <td class="border border-black">@{{item.so_ky_hieu}}</td>
                                <td class="border border-black">@{{item.soluong}}</td>
                                <td class="border border-black">@{{item.kich_thuoc}}</td>
                                <td class="border border-black">@{{item.trong_luong}}</td>
                                <td class="border border-black">@{{item.tinh_trang_hv}}</td>
                                <td class="border border-black w-16"> <img class="p-1 w-full" :src='item.anh' alt="">
                                </td>

                                <td class="border border-black">
                                    @{{item.vitrihienvat}}

                                </td>
                                <td class="border border-black">@{{item.ghinho}}</td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-span-12 text-base text-right">
                        <i> Lâm Đồng, ngày <span class="px-2 w-1"></span> tháng<span class="px-2 w-1"></span> năm <span
                                class="px-4 w-1"></span></i>
                    </div>
                    <div class="col-span-12  flex justify-around mt-5 text-base">
                        <h1 class="text-center font-bold">Người lập <br>
                            <em class="font-light">(Ký tên)</em>
                        </h1>
                        <span class="font-bold">Người kiểm tra <br>
                            <em class="font-light">
                                (Ký, họ tên)
                            </em>
                        </span>

                    </div>
                </div>

            </div>


            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                <button
                    class="items-center px-4 py-2 border border-green-700   text-sm font-medium rounded-md shadow-sm text-green-700 bg-white hover:text-white hover:bg-green-700"
                    @click="exportworddanhsachhienvat(danhsachhienvat)">Xuất word</button>
                <button
                    class="items-center px-4 py-2 border border-blue-700   text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:text-white hover:bg-blue-700"
                    @click="print2">In phiếu</button>
                <button @click="closemodal_2()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>
    <div v-cloak v-bind:class="{ hidden: isActivemodal_3 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="isActivemodal_3 = true" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class="sm:w-8/12 w-10/12 sm:h-11/12 h-4/5 p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">

            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto p-12" style="height:90%">
                <div class="col-span-12 text-center text-red-500 text-2xl ">
                    LỊCH SỬ XUẤT NHẬP
                </div>
                <template class="col-span-12">
                    <el-table :data="lichsu" class="col-span-12" border style="width: 100%">
                        <el-table-column prop="thoigian" label="Thời gian" align="center" width="400">
                        </el-table-column>
                        <el-table-column prop="noidung" label="Nội dung">
                        </el-table-column>

                    </el-table>
                </template>

            </div>

            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">

                <button @click="isActivemodal_3 = true"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>
    <!-- ----------------------------------------------------- -->

    <!-- ---------modal 2-------------------------- -->

    <!-- ------------------------------------------ -->
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý hiện vật/ </h1>
        <h1 class="text-base sm:text-xl mt-1  text-gray-900 dark:text-light">&nbsp; Danh sách hiện vật
        </h1>
    </div>

    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">

            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 mt-4">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row ">
                                <div class="py-4">

                                    <div class="grid grid-cols-12">
                                        @if(auth()->user()->chucvu_id == 1 || auth()->user()->chucvu_id == 2 ||
                                        auth()->user()->chucvu_id == 3)
                                        <button type="submit" @click="creatHienvat"
                                            class="  col-span-12  sm:col-span-4 sm:mr-4 sm:mb-0 mb-1  px-4 py-2 text-sm  text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                            <i class="ri-stack-line pr-2"></i>
                                            THÊM HIỆN VẬT

                                        </button>
                                        @endif
                                        <button @click="openmodalDshienvat()" type="button"
                                            class="  col-span-12  sm:col-span-4 sm:mr-4  px-4 py-2 text-sm  text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                            <i class="ri-printer-line pr-2"></i>
                                            IN DANH SÁCH HIỆN VẬT

                                        </button>
                                        @if(auth()->user()->chucvu_id == 1)
                                        <button @click="Duyetnhieuhienvat()" type="button"
                                            class="  col-span-12  sm:col-span-4 sm:mr-4  px-4 py-2 text-sm  text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <i class="el-icon-check pr-2"></i>
                                            Duyệt hiện vật
                                        </button>
                                        @endif
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="hinhthucsuutam"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select">
                                                <option value="">-- Hình thức sưu tầm --</option>
                                                <option v-for="i in danhsachhinhthucsuutam" :value="i.id">
                                                    @{{i.name}}</option>
                                            </select>

                                        </div>
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="chatlieu"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                                                <option value="">-- Chất liệu --</option>
                                                <option v-for="i in danhsachchatlieu" :value="i.id"> @{{i.name}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="loaihienvat"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                                                <option value="">-- Loại hiện vật --</option>
                                                <option v-for="i in danhsachloaihienvat" :value="i.id"> @{{i.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">
                                            <treeselect v-model="kho" required value-consists-of="LEAF_PRIORITY"
                                                :multiple="false" :options="datakho" placeholder="Chọn kho"
                                                :normalizer="normalizer" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">
                                            <treeselect v-model="bosuutap" required value-consists-of="LEAF_PRIORITY"
                                                :multiple="false" :options="danhsachbosuutap" placeholder="Bộ sưu tập"
                                                :normalizer="normalizer" />
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">

                                            <input class="effect-7" type="text" placeholder="Tìm kiếm"
                                                @blur="searchnow1($event)" />

                                        </div>
                                    </div>
                                </div>
                                <!-- Using the VdtnetTable component -->
                                <datatable :datatb="datatb" namePaging="pagination" @pagination="pagination">
                                    <template>
                                        <el-table-column align="center" width="270">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
                                                @if(auth()->user()->chucvu_id == 1 || auth()->user()->chucvu_id == 2 ||
                                                auth()->user()->chucvu_id == 4)

                                                <el-tooltip v-if="scope.row.kiemtra == 0" class="item" effect="dark"
                                                    content="Chỉnh sửa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                        <i class="el-icon-edit-outline text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                @endif
                                                @if(auth()->user()->chucvu_id == 1 || auth()->user()->chucvu_id == 3)
                                                <el-tooltip v-if="scope.row.kiemtra == 1" class="item" effect="dark"
                                                    content="Chỉnh sửa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                        <i class="el-icon-edit-outline text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip class="item" effect="dark" content="Xóa"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                        <i class="el-icon-delete text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                @endif
                                                <el-tooltip class="item" effect="dark" content="In"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="openmodalView(scope.row)">

                                                        <i class="el-icon-view text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>

                                                <el-tooltip class="item" effect="dark" content="Lịch sử xuất nhập"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="openmodallichsu(scope.row)">
                                                        <i class="el-icon-tickets text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>



                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Duyệt hiện vật" width="200" align="center">
                                            <template slot-scope="scope">

                                                @if(auth()->user()->chucvu_id == 1)
                                                <button
                                                    class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-if="scope.row.kiemtra== 0" @click="duyethienvat(scope.row)"> Chưa
                                                    Duyệt</button>
                                                @else
                                                <span
                                                    class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-if="scope.row.kiemtra == 0"> Chưa
                                                    Duyệt</span>
                                                @endif
                                                <span
                                                    class="inline-flex rounded-full bg-green-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.kiemtra == 1"> Đã Duyệt</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="STT" width="100" align="center">
                                            <template slot-scope="scope">
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column width="150" label="Tên">
                                            <template slot-scope="scope">
                                                @if(auth()->user()->chucvu_id == 1)
                                                <button @click="doAlertEdit(scope.row)">
                                                    @{{scope.row.name}}
                                                </button>
                                                @else
                                                <button v-if="scope.row.kiemtra == 0" @click="doAlertEdit(scope.row)">
                                                    @{{scope.row.name}}
                                                </button>
                                                <button v-else-if="scope.row.kiemtra == 1">
                                                    @{{scope.row.name}}
                                                </button>
                                                @endif
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="so_ky_hieu" width="150" label="Số ký hiệu">
                                        </el-table-column>
                                        <el-table-column prop="ten_khac" width="150" label="Tên khác">
                                        </el-table-column>
                                        <el-table-column prop="chu_nhan" width="200" label="Chủ nhân hiện vật">
                                            <template slot-scope="scope">
                                                <p v-html="scope.row.chu_nhan"></p>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="dia_diem_st" width="200" label="Địa điểm sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="hinhthucsuutam" width="200" label="Hình thức sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="thoi_gian_st" width="160" label="Thời gian sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="tinh_trang_hv" width="160"
                                            label="Tình trạng hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="tenloaihienvat" width="150" label="Loại hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="chatlieu" width="150" label="Chất liệu">
                                        </el-table-column>

                                        <el-table-column prop="dudoan_niendai" width="200" label="Dự đoán niên đại">
                                        </el-table-column>
                                        <el-table-column prop="baoquan_phucche" width="200"
                                            label="Bảo quản, phục chế">
                                        </el-table-column>
                                        <el-table-column prop="vitrihienvat" width="200" label="Vị trí hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="tenbosuutap" width="200" label="Bộ sưu tập">
                                        </el-table-column>
                                        <el-table-column label="Trạng thái" width="200" align="center">
                                            <template slot-scope="scope">
                                                <span
                                                    class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-if="scope.row.checkxuatnhap==0"> Chưa nhập kho</span>
                                                <span
                                                    class="inline-flex rounded-full bg-red-300 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.checkxuatnhap == 4"> Hiên vật đang hàng chờ
                                                    nhập</span>
                                                <span
                                                    class="inline-flex rounded-full bg-green-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.checkxuatnhap == 1"> Đã nhập kho</span>
                                                <span
                                                    class="inline-flex rounded-full bg-gray-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.checkxuatnhap == 2"> Đã xuất kho</span>
                                                <span
                                                    class="inline-flex rounded-full bg-yellow-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.checkxuatnhap == 3"> Bảo dưỡng</span>
                                                <span
                                                    class="inline-flex rounded-full bg-red-700 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.checkxuatnhap == 5"> Hiên vật đang hàng chờ
                                                    xuất</span>
                                                <span
                                                    class="inline-flex rounded-full bg-blue-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else>Trưng bày </span>
                                            </template>
                                        </el-table-column>


                                    </template>
                                    <!--End Colum -->
                                </datatable>
                                <!-- kết thúc modal hàm openmodal-chontruong -->
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</div>

<script type="module">
import {
    v4 as uuidv4
} from 'https://jspm.dev/uuid';

Vue.component('treeselect', VueTreeselect.Treeselect)
var vm = new Vue({
    el: '#demo',
    data: {

        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name', 'so_ky_hieu'
            ],
            // đường dẫn đến ajax
            url: '/ajax-quan-ly-hien-vat',
            // Số bản ghi trên 1 trang
            length: 200,

            // Biến tìm kiếm
            searchnow: '',
            // Số trang
            total: '',
            // Dữ liệu danh sách bảng
            tableData: [],
            // Trang hiện tại đang ở
            paginatenow: 1,

            activeName: 'first'
        },
        rowId: '',
        statusForm: '',
        dataForm: form({
                uuid: '',
                name: '',
                ten_khac: '',
                so_ky_hieu: '',
                soluong: '',
                sothanhphan: '',
                dia_diem_st: '',
                hinhthucst_id: '',
                thoi_gian_st: '',
                chatlieu_id: '',
                mau_sac: '',
                kich_thuoc: '',
                trong_luong: '',
                hinh_dang: '',
                ky_thuat_ct: '',
                tinh_trang_hv: '',
                tg_nhap_kho: '',
                loaihienvat_id: '',
                nguon_goc: '',
                dudoan_niendai: '',
                baoquan_phucche: '',
                vitrihv_id: '',
                bosuutap_id: null,
                ghinho: '',
            })
            .rules({
                name: 'required',
                so_ky_hieu: 'required',
                bosuutap_id: 'required',
                loaihienvat_id: 'required',
            })
            .messages({
                'name.required': 'Trường bắt buộc nhập',
                'so_ky_hieu.required': 'Trường bắt buộc nhập',
                'bosuutap_id.required': 'Trường bắt buộc nhập',
                'loaihienvat_id.required': 'Trường bắt buộc nhập',
            }),


        isActivemodal_1: true,
        isActivemodal_2: true,
        isActivemodal_3: true,
        // danhmuc
        danhsachchatlieu: [],
        danhsachhinhthucsuutam: [],
        danhsachloaihienvat: [],
        // kho
        danhsachvitrihienvat: [],
        danhsachbosuutap: null,
        danhsachhienvat: [],
        datakho: [],
        tieude: '',
        hinhthucsuutam: '',
        chatlieu: '',
        loaihienvat: '',
        kho: null,
        bosuutap: null,
        searchnow: '',
        tableDataView: {},
        lichsu: [],
        normalizer(node) {
            return {
                // id: node.id,
                label: node.name,
                children: node.children,
            }
        },
    },

    watch: {
        // searchnow() {
        //     const self = this;
        //     this.loadData();
        // },
        hinhthucsuutam() {
            this.loadData()

        },
        chatlieu() {
            this.loadData()
        },
        loaihienvat() {
            this.loadData()
        },
        kho() {
            this.loadData()

        },
        bosuutap() {
            this.loadData()
        }
    },
    mounted: function() {
        this.loadData();
        const self = this;
        axios.get("/danh-muc/chatlieus").then(function(response) {
            self.danhsachchatlieu = response.data;
        })
        axios.get("/danh-muc/hinhthucsuutams").then(function(response) {
            self.danhsachhinhthucsuutam = response.data;
        })
        axios.get("/danh-muc/loaihienvats").then(function(response) {
            self.danhsachloaihienvat = response.data; //ok
        })
        axios.get("/data-kho").then(function(response) {
            self.datakho = response.data;
        })

        axios.get("/ajax-bo-suu-tap-1").then(function(response) {
            self.danhsachbosuutap = response.data;
        })





    },
    methods: {
        exportworddanhsachhienvat(data) {
            const self = this;

            if (data.length > 0) {
                const idhienvats = [];
                for (let index = 0; index < data.length; index++) {
                    idhienvats.push(data[index].id);

                }
                // axios.get('/export-word?data=' + idhienvats + '&kieuxuat=danhsachhienvat', {
                //     responseType: 'blob'
                // }).then(response => {
                //     // Tạo đường dẫn đến tập tin Word và bật cửa sổ tải xuống
                //     const url = window.URL.createObjectURL(new Blob([response.data], {
                //         type: 'application/vnd.ms-word'
                //     }))
                //     const link = document.createElement('a')
                //     link.href = url
                //     link.download = 'exported_data.doc'
                //     link.click()
                // })
                window.open('/export-word?data=' + idhienvats + '&kieuxuat=danhsachhienvat')
            } else {
                self.thongbaothatbai('bạn chưa chọn hiện vật');
            }

        },
        exportword(data) {
            const self = this;
            window.open('/export-word?data=' + data.id + '&kieuxuat=phieuhienvat', '_blank')
        },
        searchnow1(event) {
            this.searchnow = event.target.value;
            console.log(this.searchnow);
            this.loadData();
        },
        decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        creatHienvat() {
            const self = this;
            window.location.href = "/view-them-sua-hien-vat";
        },
        print() {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },
        print2() {
            // Pass the element id here
            this.$htmlToPaper('printMe2');
        },
        openmodallichsu(row) {
            this.lichsu = row.ghichu;
            this.isActivemodal_3 = false;
        },
        handleClick(tab, event) {
            // console.log(event);
        },
        openmodalView(data) {
            this.isActivemodal_1 = false;
            const self = this;


            if (data.bosuutap_id == null) {
                self.infomodalView(data, null);

            } else {
                axios.get("/info-bo-suu-tap?bosuutap_id=" + data.bosuutap_id).then(function(response) {
                    self.namebosuutap = response.data;

                    self.infomodalView(data, self.namebosuutap);
                })

            }


        },
        infomodalView(data, namebosuutap) {

            var namehinhthucsuutam = '';
            for (let i = 0; i < this.danhsachhinhthucsuutam.length; i++) {
                if (this.danhsachhinhthucsuutam[i]['id'] == data.hinhthucst_id) {
                    namehinhthucsuutam = this.danhsachhinhthucsuutam[i]['name'];
                }
            }
            var namechatlieu = '';
            for (let i = 0; i < this.danhsachchatlieu.length; i++) {
                if (this.danhsachchatlieu[i]['id'] == data.chatlieu_id) {
                    namechatlieu = this.danhsachchatlieu[i]['name'];
                }
            }
            var nameloaihienvat = '';
            for (let i = 0; i < this.danhsachloaihienvat.length; i++) {
                if (this.danhsachloaihienvat[i]['id'] == data.loaihienvat_id) {
                    nameloaihienvat = this.danhsachloaihienvat[i]['name'];
                }
            }
            var namevitrihienvat = '';
            for (let i = 0; i < this.danhsachvitrihienvat.length; i++) {
                if (this.danhsachvitrihienvat[i]['id'] == data.vitrihv_id) {
                    namevitrihienvat = this.danhsachvitrihienvat[i]['name'];
                }
            }
            var anh1 = null;
            var anh2 = null;
            if (data.fileuploads.length >= 2) {
                anh1 = data.fileuploads[0]['link'];
                anh2 = data.fileuploads[1]['link'];
            } else if (data.fileuploads.length > 0) {
                anh1 = data.fileuploads[0]['link'];
            }
            this.tableDataView = {
                id: data.id,
                name: data.name,
                ten_khac: data.ten_khac,
                so_ky_hieu: data.so_ky_hieu,
                soluong: data.soluong,
                sothanhphan: data.sothanhphan,
                chu_nhan: data.chu_nhan,
                dia_diem_st: data.dia_diem_st,
                hinhthucst_id: namehinhthucsuutam,
                thoi_gian_st: data.thoi_gian_st,
                chatlieu_id: namechatlieu,
                mau_sac: data.mau_sac,
                kich_thuoc: data.kich_thuoc,
                trong_luong: data.trong_luong,
                hinh_dang: data.hinh_dang,
                ky_thuat_ct: data.ky_thuat_ct,
                tinh_trang_hv: data.tinh_trang_hv,
                tg_nhap_kho: data.tg_nhap_kho,
                loaihienvat_id: nameloaihienvat,
                nguon_goc: this.decodeHtml(data.nguon_goc),
                dudoan_niendai: data.dudoan_niendai,
                baoquan_phucche: data.baoquan_phucche,
                vitrihv_id: data.vitrihv_id,
                vitrihienvat: namevitrihienvat,
                bosuutap_id: namebosuutap,
                anh1: anh1,
                anh2: anh2,
                tailieu: data.fileuploadstailieu,
                ghinho: data.ghinho,
            }


        },

        openmodalDshienvat() {

            const self = this;


            for (let index = 0; index < self.danhsachhienvat.length; index++) {
               
                if (self.danhsachhienvat[index].fileuploads.length > 0) {
                    self.danhsachhienvat[index].anh = self.danhsachhienvat[index].fileuploads[0]['link'];
                }

            }

            this.isActivemodal_2 = false;
        },

        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },
        closemodal_1() {
            this.isActivemodal_1 = true;
            this.dataForm.errors().messages = {};

        },
        closemodal_2() {
            this.isActivemodal_2 = true;
            this.dataForm.errors().messages = {};

        },
        pagination(data) {
            // Gán lại giá trị paginatenow
            this.datatb.paginatenow = data;
            // Load lại bảng
            this.loadData();
        },
        // load lại dữ liệu
        loadData() {
            const self = this;
            // Lấy index bản ghi bắt đầu
            var start = this.datatb.length * (this.datatb.paginatenow - 1);
            self.datatb.start = start;
            // Ajax dữ liệu
            axios
                .get(self.datatb.url, {
                    // Đẩy dữ liệu lên controller
                    params: {
                        // Giá trị mặc định phải có
                        // start:index bản ghi bắt đầu
                        // length:số lượng bản ghi trên 1 trang
                        // searchcolum:Các cột được phép tìm kiếm
                        // searchnow: Giá trị tìm kiêm hiện tại

                        start: this.datatb.start,
                        searchcolum: this.datatb.searchcolum,
                        length: this.datatb.length,
                        searchnow: this.searchnow,
                        hinhthucsuutam: self.hinhthucsuutam,
                        chatlieu: self.chatlieu,
                        loaihienvat: self.loaihienvat,
                        kho: self.kho,
                        bosuutap: self.bosuutap,
                    },
                })
                .then(function(response) {
                    // Tổng số trang hiện có
                    self.datatb.total = Math.ceil(
                        response.data.recordsTotal / self.datatb.length
                    );
                    // Dữ liệu bảng
                    self.datatb.tableData = response.data.data;
                    self.danhsachhienvat = response.data.data;


                });
        },
        // 
        duyethienvat(data) {

            const self = this;
            self.dataForm.data = data;
            self.dataForm.data.bosuutap_idbefore = self.dataForm.data.bosuutap_id;
            self.dataForm.data.vitrihv_idbefore = self.dataForm.data.vitrihv_id;
            axios.post("/update-quan-ly-hien-vat", {
                    id: self.dataForm.data.id,
                    data: self.dataForm.data
                }).then(function(response) {
                    self.loadData();
                    self.thongbaothanhcong('Duyệt thành công')
                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });
        },
        Duyetnhieuhienvat() {
            const self = this;
            window.location.href = "/duyet-nhieu-hien-vat";
        },
        //data table
        doAlertEdit(data) {
            const self = this;
            window.location.href = "/view-them-sua-hien-vat?id=" + data.id;

        },
        doAlertDelete(data, row, tr, target) {
            const self = this;
            this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                type: 'warning',
                center: true
            }).then(() => {
                axios.delete("/delete-quan-ly-hien-vat?id=" + data.id)
                    .then(function(response) {
                        self.loadData();
                    })
                    .catch(function(error) {
                        // Thông báo xóa thất bại
                        self.thongbaothatbai(error)
                    });
                this.$message({
                    type: 'success',
                    message: 'Xóa thành công'
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy xóa'
                });
            });


        },
        doAfterReload(data, table) {
            window.alert('data reloaded')
        },
        doCreating(comp, el) {
            console.log('creating')
        },
        doCreated(comp) {
            console.log('created')
        },
        doExport(type) {

            const parms = this.$refs.table.getServerParams()
            parms.export = type
            window.alert('GET /api/v1/export?' + jQuery.param(parms))
        },
        thongbaothanhcong(text) {
            this.$notify({
                title: 'Success',
                message: text,
                type: 'success'
            });
        },
        thongbaothatbai(text) {
            this.$notify.error({
                title: 'Error',
                message: text
            });

        },
    }
})
</script>
@endsection