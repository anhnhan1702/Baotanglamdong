@extends('../layout/layout')


@section('subhead')
<title>Quản lý trưng bày ảo</title>

@endsection
<style>
#printMe {
    font-family: "Times New Roman", Times, serif;
    width: 210mm;
    margin: 0 auto;
}
</style>
@section('subcontent')
<div id="demo" class="py-6  h-full ">
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
                                <td class="p-1 border border border-black" v-html='tableDataView.chu_nhan'>
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
    <div v-cloak v-bind:class="{ hidden: isActivemodal_2 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal_2()" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class="sm:h-11/12 h-4/5 p-5 w-10/12  relative mx-auto my-auto rounded-xl shadow-lg  bg-gray-50">
            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div class="col-span-12  text-left sm:text-3xl font-normal py-2  font-normal">
                    Hình ảnh hiện vật
                </div>
                <div v-for="item in anhhienvat" class="col-span-3 m-2 p-2 rounded-md bg-white">
                    <a :href="item.link" download="">
                        <img class=" p-2 w-full" style="height: 200px;" :src="item.link" alt="">
                    </a>
                    <div class="px-2 font-medium text-center">
                        @{{item.tenfile}}
                    </div>
                </div>
                <div class="col-span-12  text-left sm:text-3xl font-normal py-2  font-normal">
                    Tài liệu hiện vật
                </div>
                <div v-for="file in tailieuhienvat" class="col-span-2 m-2 p-2 rounded-md bg-white">
                    <a data-fancybox data-type="iframe" target="_blank" :href="file.linkview" data-small-btn="true"
                        data-iframe='{"preload":false}'>
                        <img class="w-28 mx-auto  p-2"
                            v-if="file.duoifile == 'xlsm' || file.duoifile == 'xls' || file.duoifile == 'xlsx'"
                            src="/images/xls.png">
                        <img class="w-28 mx-auto  p-2"
                            v-if="file.duoifile == 'doc' || file.duoifile == 'docm' || file.duoifile == 'docx'"
                            src="/images/doc.png">
                        <img class="w-28 mx-auto  p-2" v-if="file.duoifile == 'PDF' || file.duoifile == 'pdf'"
                            src="/images/pdf.png">

                    </a>


                    <div class="px-2 font-medium text-center">
                        @{{file.tenfile}}
                    </div>
                </div>


            </div>


            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">

                <button @click="closemodal_2()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>
    <div class="px-4 sm:px-4 md:px-4 grid grid-cols-10">

        <div class=" col-span-10 grid grid-cols-12">
            <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                <select v-model="hinhthucsuutam"
                    class="rounded-md w-full border border-gray-400 p-2 form-control form-select">
                    <option value="">-- Hình thức sưu tầm --</option>
                    <option v-for="i in danhsachhinhthucsuutam" :value="i.id">
                        @{{i.name}}</option>
                </select>

            </div>
            <div class="col-span-12 xl:col-span-3 sm:col-span-6 sm:pr-4 mt-1">
                <select v-model="chatlieu"
                    class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                    <option value="">-- Chất liệu --</option>
                    <option v-for="i in danhsachchatlieu" :value="i.id"> @{{i.name}}
                    </option>
                </select>
            </div>

            <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                <select v-model="loaihienvat"
                    class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                    <option value="">-- Loại hiện vật --</option>
                    <option v-for="i in danhsachloaihienvat" :value="i.id"> @{{i.name}}
                    </option>
                </select>
            </div>
            <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                <treeselect v-model="vitrihienvat" required value-consists-of="LEAF_PRIORITY" :multiple="false"
                    :options="datakho" placeholder="Chọn kho" :normalizer="normalizer" />
            </div>
            <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                <treeselect v-model="bosuutap" required value-consists-of="LEAF_PRIORITY" :multiple="false"
                    :options="danhsachbosuutap" placeholder="Bộ sưu tập" :normalizer="normalizer" />
            </div>

        </div>
        <div class="relative col-span-12 md:col-span-8 mt-2">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" v-model="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nhập hiện vật, số ký hiệu" required>

        </div>
        <button type="submit" @click="searchinfohienvat"
            class="mt-2 col-span-12 md:col-span-2 inline-flex items-center py-1 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                class="mr-2 -ml-1 w-5 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>TÌM KIẾM
        </button>

    </div>
    <div class="mx-auto  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">
            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row">

                                <!-- Using the VdtnetTable component -->
                                <datatable :datatb="datatb" namePaging="pagination" @pagination="pagination">
                                    <template>
                                        <el-table-column align="center" width="170">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">

                                                <el-tooltip class="item" effect="dark" content="In"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="openmodalView(scope.row)">


                                                        <i class="el-icon-view text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip class="item" effect="dark" content="Xem file"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="openmodalXemfile(scope.row)">
                                                        <i class="el-icon-files text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="STT" width="100" align="center">
                                            <template slot-scope="scope">
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="name" width="150" label="Tên">
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

                                        <el-table-column prop="dudoan_niendai" width="150" label="Dự đoán niên đại">
                                        </el-table-column>
                                        <el-table-column prop="baoquan_phucche" width="100"
                                            label="Bảo quản, phục chế">
                                        </el-table-column>
                                        <el-table-column prop="vitrihienvat" width="150" label="Vị trí hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="tenbosuutap" width="150" label="Bộ sưu tập">
                                        </el-table-column>
                                        <el-table-column label="Trạng thái" width="150" align="center">
                                            <template slot-scope="scope">
                                                <span
                                                    class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-if="!scope.row.checkxuatnhap"> Chưa nhập kho</span>
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

<script type="module" src="./js/timkiem/timkiem.js"></script>
@endsection