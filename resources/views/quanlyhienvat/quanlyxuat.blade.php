@extends('../layout/layout')


@section('subhead')
<script src="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.min.css">

<title>Vị trí hiện vật</title>
<style>
#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td,
#customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#dshv {
    width: 100%;
    margin: 0 auto;
}

#dshv th,
#dshv td,
#watch_inf th,
#watch_inf td {
    border: 1px solid gray !important;
    padding: 0px 10px;
}

.transfer-footer {
    margin-left: 20px;
    padding: 6px 5px;
}

.el-transfer-panel {
    width: 40%;
    margin: auto;
}

.el-transfer-panel__item.el-checkbox .el-checkbox__label {
    overflow: auto;
    white-space: break-spaces;
    text-overflow: break-word;


}

.el-transfer-panel__item {
    height: max-content;
}


#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #2d7b93;
    color: white;
}

#printMe {
    font-family: "Times New Roman", Times, serif;
    width: 210mm;
    margin: 0 auto;
}
</style>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">


    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-10/12 w-10/12 sm:h-4/5 h-4/5   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div class="col-span-12 mb-4 text-center text-3xl text-red-500">
                    Thêm mới, chỉnh sửa
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="name"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Tên
                        </label>
                        <input v-model="dataForm.name" type="text" name="name" id="name"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                            @{{ dataForm.errors().get('name') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <select disabled v-model="dataForm.loaixuatnhap"
                        class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn Loại phiếu --</option>
                        <option value="1">
                            Phiếu xuất
                        </option>
                        <option value="2">
                            Phiếu Nhập
                        </option>
                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('loaixuatnhap')">
                        @{{ dataForm.errors().get('loaixuatnhap') }}
                    </span>

                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="diadiem"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Địa
                            điểm </label>
                        <input v-model="dataForm.diadiem" type="text" diadiem="diadiem" id="diadiem"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('diadiem')">
                            @{{ dataForm.errors().get('diadiem') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="mucdichxuat"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Mục
                            đích </label>
                        <input v-model="dataForm.mucdichxuat" type="text" mucdichxuat="mucdichxuat" id="mucdichxuat"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('mucdichxuat')">
                            @{{ dataForm.errors().get('mucdichxuat') }}
                        </span>
                    </div>
                </div>

                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4 ">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="nguoixuat"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Người
                            xuất </label>
                        <input v-model="dataForm.nguoixuat" type="text" nguoixuat="nguoixuat" id="nguoixuat"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('nguoixuat')">
                            @{{ dataForm.errors().get('nguoixuat') }}
                        </span>
                    </div>
                </div>

                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="donvixuat"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">
                            Đơn vị </label>
                        <input v-model="dataForm.donvixuat" type="text" donvixuat="donvixuat" id="donvixuat"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('donvixuat')">
                            @{{ dataForm.errors().get('donvixuat') }}
                        </span>
                    </div>
                </div>

                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="nguoinhan"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">
                            Người nhận</label>
                        <input v-model="dataForm.nguoinhan" type="text" nguoinhan="nguoinhan" id="nguoinhan"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('nguoinhan')">
                            @{{ dataForm.errors().get('nguoinhan') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="donvinhan"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Đơn
                            vị</label>
                        <input v-model="dataForm.donvinhan" type="text" donvinhan="donvinhan" id="donvinhan"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('donvinhan')">
                            @{{ dataForm.errors().get('donvinhan') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="cancuxuat"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Căn
                            cứ </label>
                        <input v-model="dataForm.cancuxuat" type="text" cancuxuat="cancuxuat" id="cancuxuat"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('cancuxuat')">
                            @{{ dataForm.errors().get('cancuxuat') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="thoigiantra"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Thời
                            gian trả</label>
                        <input v-model="dataForm.thoigiantra" type="date" thoigiantra="thoigiantra" id="thoigiantra"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('thoigiantra')">
                            @{{ dataForm.errors().get('thoigiantra') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="danhmucxuat"
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Danh
                            mục xuất</label>
                        <input v-model="dataForm.danhmucxuat" type="text" danhmucxuat="danhmucxuat" id="danhmucxuat"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('danhmucxuat')">
                            @{{ dataForm.errors().get('danhmucxuat') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4 ">
                    <select v-model="dataForm.trungbay_id"
                        class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn trưng bày --</option>
                        <option v-for="i in quanlytrungbays" :value="i.id">
                            @{{i.name}}
                        </option>

                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('donvixuat')">
                        @{{ dataForm.errors().get('donvixuat') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <div
                        class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label
                            class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Tìm
                            kiếm hiện vật</label>
                        <input v-model="valuetimkiemhienvat" @blur="timkiemhienvat($event)" type="text"
                            class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0"
                            placeholder="Nhập tên hoặc số ký hiệu">


                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <treeselect v-model="bosuutap" value-consists-of="LEAF_PRIORITY" :options="danhsachbosuutap"
                        :multiple="true" placeholder="Chọn bộ sưu tập" :normalizer="normalizer" />
                </div>
                <div class=" col-span-12  bg-white mr-8 mt-4">
                    <el-transfer filterable filter-placeholder="Chọn hiện vật"
                        class="col-span-12 flex justify-center items-center py-2" :props="{key:'id'}" v-model="hienvat"
                        :data="danhsachhienvat">
                    </el-transfer>
                </div>

                <div class="col-span-12  bg-white mr-8 mt-4">
                    <table id="customers">
                        <tr class="">

                            <th class="w-2/12">Chọn vị trí</th>
                            <th class="w-2/12">Hiện vật</th>
                            <th class="w-1/12">Số lượng</th>
                            <th class="w-1/12">Kích thước</th>
                            <th class="w-2/12">Tình trạng</th>
                        </tr>
                        <tr v-for="(i,key) in  dataForm.danhmuchienvat">
                            <td>
                                @{{i.vitri}}

                            </td>
                            <td>
                                @{{i.hienvat}}
                            </td>
                            <td class="text-center">
                                @{{i.soluong}}
                            </td>
                            <td class="text-center">
                                @{{i.kichthuoc}}
                            </td>
                            <td class="text-center">
                                @{{i.tinhtrang}}
                            </td>

                        </tr>
                    </table>


                </div>

            </div>

            <!--footer-->
            <div class=" text-center space-x-4 md:block">
                <button @click="submitform()"
                    class="inline-flex mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Lưu phiếu xuất
                </button>
                <button @click="closemodal()"
                    class="inline-flex items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>
    </div>


    <!-- phiếu xuất -->
    <div v-cloak v-bind:class="{ hidden: isActivemodal_2 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal_2()" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class="sm:h-11/12 h-4/5 p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">

            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div id="printMe" class=" col-span-12 grid grid-cols-12">
                    <div class="col-span-12  flex justify-around text-base">
                        <h1 class="text-center">SỞ VHTT&DL LÂM ĐỒNG <br>
                            <span class="font-bold" style="border-bottom: 1px solid gray;">BẢO TÀNG LÂM ĐỒNG </span>
                            <br>
                            <em>Số:&nbsp; &nbsp;&nbsp; /BBNHV-BTLĐ</em>
                        </h1>
                        <h1 class="text-center font-bold">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br>
                            <span style="border-bottom: 1px solid gray;">Độc lập – Tự do – Hạnh phúc</span> <br>
                            <em class="font-light">Lâm Đồng, ngày &nbsp;&nbsp;&nbsp; tháng &nbsp;&nbsp;&nbsp; năm</em>

                        </h1>
                    </div>
                    <div class="col-span-12  text-center  text-base py-2 mt-2 font-medium">
                        PHIẾU XUẤT HIỆN VẬT
                    </div>
                    <div class="sm:col-span-12 col-span-12 text-base">
                        <p class="mb-2">
                            - Thời gian nhập:  giờ &nbsp;&nbsp;&nbsp;, ngày &nbsp;&nbsp;&nbsp;, tháng &nbsp;&nbsp;&nbsp;,
                            năm  &nbsp;&nbsp;&nbsp; <br>
                            - Địa điểm: tại Bảo tàng Lâm Đồng, số 4 Hùng Vương, P.10, TP. Đà Lạt. <br>
                            - Mục đích xuất: @{{dataForm.mucdichxuat}}<br>
                            - Căn cứ xuất (nếu có): @{{dataForm.cancuxuat}}<br>
                            - Người nhập: @{{dataForm.nguoixuat}}<br>
                            - Đơn vị: @{{dataForm.cancuxuat}}<br>
                            - Người nhận: @{{dataForm.nguoinhan}}<br>
                            - Đơn vị: @{{dataForm.donvixuat}}<br>
                            - Thời gian trả: @{{dataForm.formatthoigiantra}} <br>
                            - Danh mục nhập:@{{dataForm.danhmucxuat}} <br>
                        </p>

                        <table class="w-full">
                            <tr>
                                <th class="border-collapse border border-black text-center">STT</th>
                                <th class="border-collapse border border-black">Tên hiện vật</th>
                                <th class="border-collapse border border-black">Số ký hiệu</th>
                                <th class="border-collapse border border-black">Số phân loại</th>
                                <th class="border-collapse border border-black">Số lượng</th>
                                <th class="border-collapse border border-black">Kích thước</th>
                                <th class="border-collapse border border-black">Trọng lượng</th>
                                <th class="border-collapse border border-black">Tình trạng</th>
                                <th class="border-collapse border border-black">Hình ảnh</th>
                                <th class="border-collapse border border-black">Ghi chú</th>
                            </tr>
                            <tr v-for="(item, index) in infohienvats">
                                <td class="border-collapse border border-black text-center">@{{index + 1}}</td>
                                <td class="border-collapse border border-black">@{{item.name}}</td>
                                <td class="border-collapse border border-black">@{{item.so_ky_hieu}}</td>
                                <td class="border-collapse border border-black">Số phân loại</td>
                                <!-- so phan loại -->
                                <td class="border-collapse border border-black">@{{item.soluong}}</td>
                                <td class="border-collapse border border-black">@{{item.kich_thuoc}}</td>
                                <td class="border-collapse border border-black">@{{item.trong_luong}}</td>
                                <td class="border-collapse border border-black">@{{item.tinh_trang_hv}}</td>
                                <td class="border-collapse border border-black w-16"><img class="p-1 w-full"
                                        :src='item.fileuploads' alt=""></td>
                                <td class="border-collapse border border-black">@{{item.ghinho}}</td>

                            </tr>

                        </table>
                        <p class="mt-1">
                            Tổng số hiện vật nhập: @{{danhsachhienvat_xuat.length}}<br>
                            Số hiện vật bằng chữ: @{{soluong_xuat}}<br>
                            Biên bản này được lập thành 02 bản (cho bên nhập và bên xuất) có giá trị như nhau. <br>
                        </p>


                    </div>
                    <div class="col-span-12  flex justify-around mt-5">
                        <h1 class="text-center font-bold">BÊN GIAO <br>
                            <em class="font-light">(Ký, họ tên)</em>
                        </h1>
                        <h1 class="text-center font-bold">PHÒNG SƯU TẦM, <br> QUẢN LÝ HIỆN VẬT <br>
                            <span>
                                <em class="font-light">
                                    (Ký, họ tên)
                                </em>
                            </span>

                        </h1>
                        <h1 class="text-center font-bold">BÊN NHẬN <br>
                            <em class="font-light">(Ký, họ tên)</em>
                        </h1>
                    </div>


                    <h1 class="col-span-12 text-center font-bold mt-28">GIÁM ĐỐC <br>
                        <em class="font-light">(Ký, đóng dấu và họ tên)</em>
                    </h1>

                </div>
            </div>



            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                <button
                    class="items-center px-4 py-2 border border-blue-700   text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:text-white hover:bg-blue-700"
                    @click="print">In phiếu</button>
                <button @click="closemodal_2()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>
    <!-- trả hiện vật -->


    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý hiện vật/ </h1>
        <h1 class="text-base sm:text-xl mt-1 text-gray-900 dark:text-light">&nbsp; Xuất hiện vật</h1>
    </div>
    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->

        <div class="py-4 datatable">
            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white     " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row">
                                <div class="py-4">
                                    <div class="sm:flex sm:items-center">
                                        <div class="sm:flex-auto">
                                            <button @click="saveform()" type="button"
                                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
                                                mới</button>

                                        </div>
                                        <!-- <div class="col-span-6 mr-8 mt-1">
                                            <select v-model="searchduong" class="rounded-md border border-gray-400 p-4 form-control form-select  w-full">
                                                <option value="">-- Chọn xã --</option>
                                                <option v-for="i in arrxa_id" :value="i.id"> @{{i.name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-3 col-span-4">
                                            <input class="effect-7" type="text" placeholder="Tìm kiếm" v-model="searchnow" />
                                            <span class="focus-border">
                                                <i></i>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Using the VdtnetTable component -->
                                <datatable :datatb="datatb" namePaging="pagination" @pagination="pagination">
                                    <template>
                                        <el-table-column label="STT" width="100" align="center">
                                            <template slot-scope="scope">
                                                <span style="margin-left: 10px">@{{ scope.$index  +1}}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="name" label="Tên phiếu">
                                            <template slot-scope="scope">
                                                <a>@{{ scope.row.name }}</a>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="loaixuatnhap" label="Loại phiếu" align="center">
                                            <template slot-scope="scope">
                                                <div v-if="scope.row.loaixuatnhap == 1">Loại xuất</div>
                                                <div v-if="scope.row.loaixuatnhap == 2">Loại nhập</div>

                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="trangthai" label="Trạng thái" align="center">
                                            <template slot-scope="scope">
                                                <div v-if="scope.row.trangthai == 0">
                                                    <span
                                                        class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white">Chưa
                                                        duyệt</span>
                                                </div>
                                                <div v-if="scope.row.trangthai == 1">
                                                    <span
                                                        class="inline-flex rounded-full bg-green-300 px-2 text-xs font-semibold leading-5 text-green-800">Đã
                                                        duyệt</span>

                                                </div>

                                            </template>
                                        </el-table-column>
                                        <el-table-column align="center" width="270">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
                                            @if(auth()->user()->chucvu_id == 1 || auth()->user()->chucvu_id == 3)
                                                <el-tooltip v-if="scope.row.trangthai == 0" class="item" effect="dark"
                                                    content="Duyệt phiếu" placement="top-start">
                                                    <el-button size="mini" @click="duyet(scope.row)">
                                                        <i class="  el-icon-check text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                            @endif
                                                <el-tooltip v-if="scope.row.trangthai == 0" class="item" effect="dark"
                                                    content="Chỉnh sửa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                        <i class="el-icon-edit-outline text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip v-if="scope.row.trangthai == 0" class="item" effect="dark"
                                                    content="Xóa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                        <i class="  el-icon-delete text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip v-if="scope.row.trangthai == 1" class="item" effect="dark"
                                                    content="Xuất phiếu nhập" placement="top-start">
                                                    <el-button size="mini" @click="openmodal_2(scope.row) ">
                                                        <i class="el-icon-download text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                @if(auth()->user()->chucvu_id == 1)
                                                <el-tooltip v-if="scope.row.trangthai == 1" class="item" effect="dark"
                                                    content="Trả hiện vật" placement="top-start">
                                                    <el-button size="mini" @click="openmodal_3(scope.row) ">
                                                        <i class="  el-icon-upload2 text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                @endif
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
<script>
Vue.component('treeselect', VueTreeselect.Treeselect)
var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name'
            ],
            // đường dẫn đến ajax
            url: '/ajax-xuat-nhap',
            // Số bản ghi trên 1 trang
            length: 10,

            // Biến tìm kiếm
            searchnow: '',
            // Số trang
            total: '',
            // Dữ liệu danh sách bảng
            tableData: [],
            // Trang hiện tại đang ở
            paginatenow: 1,
        },
        rowId: '',
        statusForm: '',
        dataForm: form({
                name: '',
                loaixuatnhap: '',
                diadiem: '',
                mucdichxuat: '',
                cancuxuat: '',
                nguoixuat: '',
                donvixuat: '',
                nguoinhan: '',
                donvinhan: '',
                thoigiantra: '',
                danhmucxuat: '',
                trungbay_id: null,
                danhmuchienvat: [],
                trangthai: 'xuat',
            })
            .rules({
                name: 'required',
                loaixuatnhap: 'required',
            })
            .messages({
                'name.required': 'Trường bắt buộc nhập',
                'loaixuatnhap.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodal_2: true,

        rowid: 0,
        danhsachkho: [],
        danhsachvitri: [],
        danhsachhienvat: [],
        validatevitri: false,
        validatehienvat: false,
        validatesoluong: false,

        valuevitri: null,
        valuehienvat: null,
        rowdanhmuc: '',

        bosuutap: null,

        hienvat: [],
        checkhienvat: [],
        valueConsistsOf: 'valueConsistsOf',
        disabled: true,
        checkdelete: 0,
        hienvatdaco: [],
        infohienvats: [],
        danhsachhienvat_xuat: [],
        soluong_xuat: '',
        mangso: ['không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'],
        quanlytrungbays: [],
        danhsachbosuutap: [],
        valuetimkiemhienvat: '',
        // bộ sưu tập đã xuất
        normalizer(node) {
            return {
                id: node.id,
                label: node.name,
                children: node.children,
            }
        },
    },
    watch: {

        hienvat() {
            const self = this;
            if (this.checkdelete != 0) {
                this.dataForm.data.danhmuchienvat = [];
                // let intersection = self.hienvat.filter(x => !this.checkhienvat.includes(x));
                // console.log(intersection);
                for (var i = 0; i < self.danhsachhienvat.length; i++) {
                    check = self.hienvat.includes(self.danhsachhienvat[i]['id']);
                    if (check == true) {
                        data = {};
                        data['tinhtrang'] = null;
                        data['kich_thuoc'] = null;
                        if (self.danhsachhienvat[i]['tinh_trang_hv'] != undefined) {
                            data['tinhtrang'] = self.danhsachhienvat[i]['tinh_trang_hv'];
                        }
                        if (self.danhsachhienvat[i]['kich_thuoc'] != undefined) {
                            data['kichthuoc'] = self.danhsachhienvat[i]['kich_thuoc'];
                        }
                        data['soluong'] = 1;
                        data['hienvat_id'] = self.danhsachhienvat[i]['id'];
                        data['hienvat'] = self.danhsachhienvat[i]['name'];
                        data['vitri_id'] = self.danhsachhienvat[i]['vitri_id'];
                        data['vitri'] = self.danhsachhienvat[i]['vitri'];
                        this.dataForm.data.danhmuchienvat.push(data);
                    }

                }


            }
            this.checkdelete++;
        },
        bosuutap() {
            const self = this;
            if (this.bosuutap != null) {
                if (this.bosuutap.length == 0) {
                    this.bosuutap = null;
                } else {
                    this.loadhienvat();
                }
            } else {
                this.loadhienvat();
            }

        },

    },
    mounted: function() {
        const self = this;

        this.loadData();
        axios.get("/bo-su-tap").then(function(response) {
            self.danhsachbosuutap = response.data;
        })
        axios.get("/danh-muc/quanlytrungbays").then(function(response) {
            self.quanlytrungbays = response.data;
        })
    },
    methods: {
        // tìm kiếm hiện vật trong thêm sửa 
        timkiemhienvat($event) {
            if (event.target.value == '') {
                this.valuetimkiemhienvat = null;
            } else {
                this.valuetimkiemhienvat = event.target.value;
            }
            this.loadhienvat();
        },
        loadhienvat() {
            const self = this;

            if (this.valuetimkiemhienvat != null || this.bosuutap != null) {

                axios.post("/get-tim-kiem-hien-vat-xuat-nhap", {
                        timkiemhienvat: self.valuetimkiemhienvat,
                        checkxuatnhap: 1,
                        hienvat_id: self.hienvat,
                        bosuutaps: self.bosuutap,
                    }).then(function(response) {
                        self.danhsachhienvat = response.data;
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else if (this.hienvat.length > 0) {

                axios.post("/get-tim-kiem-hien-vat-xuat-nhap", {
                        timkiemhienvat: self.valuetimkiemhienvat,
                        checkxuatnhap: 1,
                        hienvat_id: self.hienvat,
                        bosuutaps: self.bosuutap,
                    }).then(function(response) {
                        self.danhsachhienvat = response.data;
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                self.danhsachhienvat = [];

            }

        },
        print() {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },
        dochangchuc(so, daydu) {
            var chuoi = "";
            chuc = Math.floor(so / 10);
            donvi = so % 10;
            if (chuc > 1) {
                chuoi = " " + this.mangso[chuc] + " mươi";
                if (donvi == 1) {
                    chuoi += " mốt";
                }
            } else if (chuc == 1) {
                chuoi = " mười";
                if (donvi == 1) {
                    chuoi += " một";
                }
            } else if (daydu && donvi > 0) {
                chuoi = " lẻ";
            }
            if (donvi == 5 && chuc > 1) {
                chuoi += " lăm";
            } else if (donvi > 1 || (donvi == 1 && chuc == 0)) {
                chuoi += " " + this.mangso[donvi];
            }
            return chuoi;
        },

        docblock(so, daydu) {
            var chuoi = "";
            tram = Math.floor(so / 100);
            so = so % 100;
            if (daydu || tram > 0) {
                chuoi = " " + this.mangso[tram] + " trăm";
                chuoi += this.dochangchuc(so, true);
            } else {
                chuoi = this.dochangchuc(so, false);
            }
            return chuoi;
        },

        dochangtrieu(so, daydu) {
            var chuoi = "";
            trieu = Math.floor(so / 1000000);
            so = so % 1000000;
            if (trieu > 0) {
                chuoi = this.docblock(trieu, daydu) + " triệu";
                daydu = true;
            }
            nghin = Math.floor(so / 1000);
            so = so % 1000;
            if (nghin > 0) {
                chuoi += this.docblock(nghin, daydu) + " nghìn";
                daydu = true;
            }
            if (so > 0) {
                chuoi += this.docblock(so, daydu);
            }
            return chuoi;
        },

        docso(so) {
            if (so == 0) return mangso[0];
            var chuoi = "",
                hauto = "";
            do {
                ty = so % 1000000000;
                so = Math.floor(so / 1000000000);
                if (so > 0) {
                    chuoi = this.dochangtrieu(ty, true) + hauto + chuoi;
                } else {
                    chuoi = this.dochangtrieu(ty, false) + hauto + chuoi;
                }
                hauto = " tỷ";
            } while (so > 0);
            return chuoi;
        },
        duyet(row) {

            const self = this;
            axios.post("/duyet-phieu-xuat", row).then(function(response) {
                    if (response.data == 0) {
                        self.thongbaothanhcong('Duyệt thành công')
                        self.loadData();
                    } else {
                        self.thongbaothatbai("Phiếu chưa có hiện vật");
                    }
                    self.loadData();
                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });
        },




        openmodal() {
            const self = this;
            self.bosuutaps = null;
            self.valuetimkiemhienvat = null;
            this.isActivemodal = false;
            this.rowid = 0;
        },
        openmodal_2(data) {
            var danhmuchienvat = [];
            for (let index = 0; index < data.danhmuchienvat.length; index++) {

                danhmuchienvat.push(data.danhmuchienvat[index])
            }
            axios.post("/info-hien-vat-vi-tri-kho", danhmuchienvat).then(function(response) {
                self.infohienvats = response.data;

            })
            this.dataForm.loaixuatnhap = data.loaixuatnhap
            this.dataForm.diadiem = data.diadiem
            this.dataForm.mucdichxuat = data.mucdichxuat
            this.dataForm.cancuxuat = data.cancuxuat
            this.dataForm.nguoixuat = data.nguoixuat
            this.dataForm.donvixuat = data.donvixuat
            this.dataForm.nguoinhan = data.nguoinhan
            this.dataForm.donvinhan = data.donvinhan
            this.dataForm.thoigiantra = data.thoigiantra
            this.dataForm.danhmucxuat = data.danhmucxuat
            this.dataForm.trungbay_id = data.trungbay_id
            this.dataForm.formatthoigiantra = data.formatthoigiantra


            const self = this
            self.soluong_xuat = ''
            self.soluong_xuat += this.docso(data.danhmuchienvat.length)

            this.danhsachhienvat_xuat = data.danhmuchienvat
            this.isActivemodal_2 = false;
            // this.rowid = 0;
        },
        openmodal_3(data) {
            const self = this;
            window.location.href = "/view-tra-hien-vat?id=" + data.id;


        },
        closemodal() {
            this.isActivemodal = true;
            this.rowid = 0;

        },
        closemodal_2() {
            this.isActivemodal_2 = true;
            this.rowid = 0;

        },

        saveform() {
            this.dataForm.data.name = '';
            this.dataForm.data.loaixuatnhap = 1;
            this.dataForm.data.diadiem = '';
            this.dataForm.data.mucdichxuat = '';
            this.dataForm.data.cancuxuat = '';
            this.dataForm.data.nguoixuat = '';
            this.dataForm.data.donvixuat = '';
            this.dataForm.data.nguoinhan = '';
            this.dataForm.data.donvinhan = '';
            this.dataForm.data.thoigiantra = '';
            this.dataForm.data.danhmucxuat = '';
            this.dataForm.data.trungbay_id = [];
            
            this.dataForm.data.danhmuchienvat = [];
            
            this.dataForm.data.danhmucxuattrungbay_id = null;
            this.bosuutap = '';
            this.hienvat = [];
            this.statusForm = "insert";
            this.openmodal();
        },
        submitform() {
            console.log(this.dataForm.data.danhmuchienvat);
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            console.log(self.dataForm.data);
            if (this.statusForm == "insert") {
                axios.post("/save-xuat-nhap", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-xuat-nhap", {
                        id: self.rowId,
                        data: self.dataForm.data
                    }).then(function(response) {
                        self.thongbaothanhcong('Sửa thành công')
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            }

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
                    },
                })
                .then(function(response) {
                    // Tổng số trang hiện có
                    self.datatb.total = Math.ceil(
                        response.data.recordsTotal / self.datatb.length
                    );
                    // Dữ liệu bảng
                    self.datatb.tableData = response.data.data;
                });
        },
        //data table
        doAlertEdit(data) {
            const self = this;
            this.checkdelete = 0;
            // Gán giá trị cho form
            this.dataForm.data.name = data.name;
            this.dataForm.data.loaixuatnhap = data.loaixuatnhap;
            this.dataForm.data.diadiem = data.diadiem;
            this.dataForm.data.mucdichxuat = data.mucdichxuat;
            this.dataForm.data.cancuxuat = data.cancuxuat;
            this.dataForm.data.nguoixuat = data.nguoixuat;
            this.dataForm.data.donvixuat = data.donvixuat;
            this.dataForm.data.nguoinhan = data.nguoinhan;
            this.dataForm.data.donvinhan = data.donvinhan;
            this.dataForm.data.danhmuchienvat = data.danhmuchienvat;
            this.dataForm.thoigiantra = data.thoigiantra
            this.dataForm.danhmucxuat = data.danhmucxuat
            this.dataForm.trungbay_id = data.trungbay_id
            this.bosuutap = data.bosuutap;
            for (var i = 0; i < this.dataForm.data.danhmuchienvat.length; i++) {
                this.hienvat.push(this.dataForm.data.danhmuchienvat[i]['hienvat_id'])
            }

            this.hienvatdaco = data.danhmuchienvat;
            this.dataForm.data.hienvat_id_old = this.hienvat;
            self.bosuutaps = null;
            self.valuetimkiemhienvat = null;
            this.loadhienvat();
            // Sửa tình trạng form
            this.statusForm = "update";
            this.rowId = data.id;
            this.openmodal('sua');
        },
        doAlertDelete(data, row, tr, target) {
            const self = this;
            this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                type: 'warning',
                center: true
            }).then(() => {
                axios.delete("/delete-xuat-nhap?id=" + data.id)
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