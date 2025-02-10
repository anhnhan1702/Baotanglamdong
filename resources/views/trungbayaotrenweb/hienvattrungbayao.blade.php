@extends('../layout/layout')


@section('subhead')
    <title>Sổ Bảo Quản Hiện Vật, Cần Bảo Quản</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">
        <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
            class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="sm:w-6/12 w-10/12  p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
                <div class=" w-full  overflow-auto ">

                    <div class=" flex justify-between items-center  rounded-t border-b mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                            @{{ tieude }}
                        </h3>
                        <button type="button" @click="closemodal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>



                    <div class="grid grid-cols-12 ">
                        <div class="col-span-12 mt-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hiện
                                Vật:</label>
                            <el-select :disabled="statusForm == 'update'" @change="handleThanhvien($event)" class="w-full !rounded-lg"
                                v-model="dataForm.hienvat_id" filterable allow-create default-first-option
                                placeholder="Chọn hiện vật">
                                <el-option v-for="item in listHienvat" :key="item.id"
                                    :label="item.so_ky_hieu + ' - ' + item.name" :value="item.id">
                                </el-option>
                            </el-select>
                            </span>
                        </div>

                        <div class="col-span-12">
                            <label for="mota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên
                                Hiện Vật 3D:</label>
                            <input v-model="dataForm.mota" type="text" name="mota" id="mota"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required="">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('mota')">
                                @{{ dataForm.errors().get('mota') }}
                            </span>
                        </div>
                        <div class="col-span-12">
                            <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Đường
                                dẫn:</label>
                            <input v-model="dataForm.link" type="text" name="link" id="link"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required="">

                        </div>


                    </div>

                </div>

                <!--footer-->
                <div class=" text-center  md:block pt-10">
                    <button @click="submitform()"
                        class="inline-flex mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        @{{ tieude }}
                    </button>
                    <button @click="closemodal()"
                        class="inline-flex items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
                </div>

            </div>
        </div>
        {{-- modal xem thông tin hiện vật --}}
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
                                            :text="'http://quanly.baotanglamdong.com.vn/thong-tin-hien-vat/' + tableDataView.id"
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
                                    <td class="p-1 border border border-black"> @{{ tableDataView.name }} </td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        02
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Tên gọi khác (nếu có):
                                    </td>
                                    <td class="p-1 border border border-black">
                                        @{{ tableDataView.ten_khac }} </td>

                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        03
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Số ký hiệu:
                                    </td>
                                    <td class="p-1 border border border-black">@{{ tableDataView.so_ky_hieu }}
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
                                    <td class="p-1 border border border-black">@{{ tableDataView.soluong }}</td>

                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        05
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Số thành phần hợp thành (đơn vị hiện vật)
                                    </td>
                                    <td class="p-1 border border border-black">@{{ tableDataView.sothanhphan }}</td>

                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        06
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Chủ nhân hiện
                                        vật:
                                    </td>
                                    <td class="p-1 border border border-black">@{{ tableDataView.chu_nhan }}
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
                                    <td class="p-1 border border border-black">@{{ tableDataView.dia_diem_st }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        08
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Hình thức sưu
                                        tầm:
                                    </td>
                                    <td class="p-1 border border border-black">@{{ tableDataView.hinhthucst_id }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        09
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Thời gian sưu
                                        tầm:
                                    </td>
                                    <td class="p-1 border border border-black">@{{ tableDataView.thoi_gian_st }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        10
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Chất liệu:
                                    </td>
                                    <td class="p-1 border border border-black"> @{{ tableDataView.chatlieu_id }}
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
                                    <td class="p-1 border border border-black">@{{ tableDataView.mau_sac }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        12
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Kích thước:
                                    </td>
                                    <td class="p-1 border border border-black"> @{{ tableDataView.kich_thuoc }}
                                    </td>



                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        13
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Trọng lượng:
                                    </td>
                                    <td class="p-1 border border border-black"> @{{ tableDataView.trong_luong }}
                                    </td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        14
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Hình dạng:
                                    </td>
                                    <td class="p-1 border border border-black"> @{{ tableDataView.hinh_dang }}
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
                                        @{{ tableDataView.ky_thuat_ct }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        16
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Tình trạng hiện vật:
                                    </td>
                                    <td class="p-1 border border border-black">
                                        @{{ tableDataView.tinh_trang_hv }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        17
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Thời gian nhập kho:
                                    </td>
                                    <td class="p-1 border border border-black">
                                        @{{ tableDataView.tg_nhap_kho }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        18
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Loại hiện vật:
                                    </td>
                                    <td class="p-1 border border border-black">
                                        @{{ tableDataView.loaihienvat_id }}</td>


                                </tr>
                                <tr>
                                    <td class="p-1 border border border-black text-center">
                                        19
                                    </td>
                                    <td class="p-1 border border border-black text-center" style="width: 22%;">
                                        Nội dung hiện vật:
                                    </td>
                                    <td class="p-1 border border border-black" colspan="2"
                                        v-html="tableDataView.nguon_goc">

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
                                        @{{ tableDataView.dudoan_niendai }}</td>


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
            </div>
        </div>
        {{-- end modal xem hiện vật --}}
        <div class="mx-auto max-w-8xl flex">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý trưng bày ảo trên web /
            </h1>
            <h1 class="text-base sm:text-xl mt-1 text-gray-900 dark:text-light">&nbsp; Quản lý hiện vật trưng bày ảo
            </h1>
        </div>
        <div class="mx-auto max-w-8xl ">
            <!-- Replace with your content -->
            <div class="py-4 datatable">
                <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white     " style="min-height:80vh ;">
                    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
                        <template>
                            <div id="app" class="col-12">
                                <div class="row">
                                    <div class="py-4">
                                        <div class="sm:flex sm:items-center mb-4">
                                            <div class="sm:flex-auto">
                                                <button @click="saveform()" type="button"
                                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
                                                    mới</button>
                                            </div>
                                        </div>

                                        <!-- Using the VdtnetTable component -->
                                        <datatable :datatb="datatb" namePaging="pagination"
                                            @pagination="pagination">
                                            <template>
                                                <el-table-column label="STT" width="100" align="center">
                                                    <template slot-scope="scope">
                                                        <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="mota" label="Tên hiện vật trưng bày ảo ">
                                                    <template slot-scope="scope">
                                                        <a>@{{ scope.row.mota }}</a>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="namehienvat" label="Tên hiện vật hệ thống ">
                                                    <template slot-scope="scope">
                                                        <a>@{{ scope.row.namehienvat }}</a>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column align="center" width="270">
                                                    <template slot="header" slot-scope="scope">
                                                        Chức năng
                                                    </template>
                                                    <template slot-scope="scope">
                                                        <el-tooltip class="item" effect="dark" content="Chỉnh sửa"
                                                            placement="top-start">
                                                            <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                                <i class="el-icon-edit-outline text-lg"></i>
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark" content="Xóa"
                                                            placement="top-start">
                                                            <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                                <i class="  el-icon-delete text-lg"></i>
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark" content="Xem hiện vật "
                                                            placement="top-start">
                                                            <el-button size="mini" @click="doAlertRedirect(scope.row)">
                                                                <i class=" el-icon-view text-lg"></i>
                                                            </el-button>
                                                        </el-tooltip>
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
        var vm = new Vue({
            el: '#demo',
            data: {
                datatb: {
                    // Tên các cột có thẻ search
                    searchcolum: [
                        'name'
                    ],
                    // đường dẫn đến ajax
                    url: '/ajax-hien-vat-trung-bay-ao',
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
                listHienvat: [],
                previousHienvats: [],
                rowId: '',
                statusForm: '',
                hienvats: [],
                dataForm: form({
                        mota: '',
                        hienvat_id: 0,
                        link: '',
                    })
                    .rules({
                        mota: 'required',
                    })
                    .messages({
                        'mota.required': 'Trường bắt buộc nhập',
                    }),

                isActivemodal: true,
                isActivemodal_1: true,
                tieude: '',
                tableDataView: {},
            },
            watch: {

            },
            mounted: function() {


                this.loadData();
                this.getHienvat();
            },
            methods: {
                getHienvat() {
                    const self = this;
                    axios.get("/ajax-hien-vat").then(function(response) {
                        self.listHienvat = response.data;
                    })
                },

                openmodal() {

                    this.isActivemodal = false;
                },
                closemodal() {
                    this.isActivemodal = true;
                    this.dataForm.errors().messages = {};
                },
                saveform() {
                    this.tieude = 'Thêm mới hiện vật trưng bày ảo'
                    this.dataForm.data.mota = '';
                    this.dataForm.data.hienvat_id = '';
                    this.dataForm.data.link = '';

                    this.statusForm = "insert";
                    this.openmodal();
                },
                submitform() {
                    if (this.dataForm.validate().errors().any()) {
                        return;
                    }
                    const self = this;
                    this.closemodal()
                    if (this.statusForm == "insert") {
                        axios.post("/save-hien-vat-trung-bay-ao", self.dataForm.data).then(function(response) {
                                self.thongbaothanhcong('Lưu thành công')
                                self.loadData();
                            })
                            .catch(error => {
                                self.thongbaothatbai(error);
                            });
                    } else {
                        axios.post("/update-hien-vat-trung-bay-ao", {
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
                    console.log('data', data);

                    const self = this;
                    // Gán giá trị cho form
                    this.tieude = 'Lưu'
                    this.dataForm.data.mota = data.mota;
                    this.dataForm.data.hienvat_id = data.hienvat_id;
                    this.dataForm.data.link = data.link;
                    // Sửa tình trạng form
                    this.statusForm = "update";
                    this.rowId = data.id;
                    this.openmodal('sua');
                    this.previousHienvats = [...this.hienvats];

                },
                doAlertDelete(data, row, tr, target) {
                    const self = this;
                    this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                        confirmButtonText: 'Vâng, xóa nó!',
                        cancelButtonText: 'Không xóa!',
                        type: 'warning',
                        center: true
                    }).then(() => {
                        axios.delete("/delete-hien-vat-trung-bay-ao?id=" + data.id)
                            .then(function(response) {
                                self.loadData();
                                self.$message({
                                    type: 'success',
                                    message: 'Xóa thành công'
                                });
                            })
                            .catch(function(error) {
                                // Thông báo xóa thất bại
                                self.thongbaothatbai(error)
                            });

                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Đã hủy xóa'
                        });
                    });


                },
                handleThanhvien(selectedId) {
                    const selectedItem = this.listHienvat.find(item => item.id === selectedId);
                    if (selectedItem) {
                        this.dataForm.hienvat_label = `${selectedItem.so_ky_hieu} - ${selectedItem.name}`;
                    }
                },
                doAlertRedirect(data) {
                    const self = this;


                    axios.get("/get-hien-vat?hienvat_id=" + data.hienvat_id).then(function(response) {
                        self.tableDataView = {
                            id: response.data.id,
                            name: response.data.name,
                            ten_khac: response.data.ten_khac,
                            so_ky_hieu: response.data.so_ky_hieu,
                            soluong: response.data.soluong,
                            sothanhphan: response.data.sothanhphan,
                            chu_nhan: response.data.chu_nhan,
                            dia_diem_st: response.data.dia_diem_st,
                            hinhthucst_id: response.data.namehinhthucsuutam,
                            thoi_gian_st: response.data.thoi_gian_st,
                            chatlieu_id: response.data.namechatlieu,
                            mau_sac: response.data.mau_sac,
                            kich_thuoc: response.data.kich_thuoc,
                            trong_luong: response.data.trong_luong,
                            hinh_dang: response.data.hinh_dang,
                            ky_thuat_ct: response.data.ky_thuat_ct,
                            tinh_trang_hv: response.data.tinh_trang_hv,
                            tg_nhap_kho: response.data.tg_nhap_kho,
                            loaihienvat_id: response.data.nameloaihienvat,
                            nguon_goc: self.decodeHtml(response.data.nguon_goc),
                            dudoan_niendai: response.data.dudoan_niendai,
                            baoquan_phucche: response.data.baoquan_phucche,
                            vitrihv_id: response.data.vitrihv_id,
                            vitrihienvat: response.data.namevitrihienvat,
                            bosuutap_id: response.data.namebosuutap,
                            anh1: '',
                            anh2: '',
                            tailieu: response.data.fileuploadstailieu,
                            ghinho: response.data.ghinho,
                        }

                        self.isActivemodal_1 = false;
                    })
                },
                decodeHtml(html) {
                    var txt = document.createElement("textarea");
                    txt.innerHTML = html;
                    return txt.value;
                },
                closemodal_1() {
                    this.isActivemodal_1 = true;

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
