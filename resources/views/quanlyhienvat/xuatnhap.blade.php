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





    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #2d7b93;
        color: white;
    }
</style>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100" class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-10/12 w-10/12 sm:h-4/5 h-4/5   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div class="col-span-12 mb-4 text-center text-3xl text-red-500">
                    Thêm mới, chỉnh sửa
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Tên </label>
                        <input v-model="dataForm.name" type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                            @{{ dataForm.errors().get('name') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <select disabled v-model="dataForm.loaixuatnhap" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
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
                    <div class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="diadiem" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Địa điểm </label>
                        <input v-model="dataForm.diadiem" type="text" diadiem="diadiem" id="diadiem" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('diadiem')">
                            @{{ dataForm.errors().get('diadiem') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="mucdichxuat" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Mục đích </label>
                        <input v-model="dataForm.mucdichxuat" type="text" mucdichxuat="mucdichxuat" id="mucdichxuat" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('mucdichxuat')">
                            @{{ dataForm.errors().get('mucdichxuat') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12 mr-8 mt-4">
                    <div class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="cancuxuat" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Căn cứ </label>
                        <input v-model="dataForm.cancuxuat" type="text" cancuxuat="cancuxuat" id="cancuxuat" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('cancuxuat')">
                            @{{ dataForm.errors().get('cancuxuat') }}
                        </span>
                    </div>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4 ">
                    <select v-model="dataForm.donvixuat" @change="laynguoinhap($event)" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn phòng ban --</option>
                        <option v-for="i in danhsachphongban" :value="i.id">
                            @{{i.name}}
                        </option>

                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('donvixuat')">
                        @{{ dataForm.errors().get('donvixuat') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <select v-model="dataForm.nguoixuat" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn người --</option>
                        <option v-for="i in danhsachnguoinhap" :value="i.id">
                            @{{i.name}}
                        </option>

                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('nguoixuat')">
                        @{{ dataForm.errors().get('nguoixuat') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <select v-model="dataForm.donvinhan" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn đơn vị nhận --</option>
                        <option v-for="i in danhsachphongban" :value="i.id">
                            @{{i.name}}
                        </option>

                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('donvinhan')">
                        @{{ dataForm.errors().get('donvinhan') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white mr-8 mt-4">
                    <select v-model="dataForm.nguoinhan" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn người nhận --</option>
                        <option v-for="i in danhsachnguoinhap" :value="i.id">
                            @{{i.name}}
                        </option>

                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('nguoinhan')">
                        @{{ dataForm.errors().get('nguoinhan') }}
                    </span>
                </div>
                <div class="col-span-12  bg-white mr-8 mt-4">
                    <table id="customers">
                        <tr class="">
                            <th class="w-2/12">Chọn kho</th>
                            <th class="w-2/12">Chọn vị trí</th>
                            <th class="w-2/12">Hiện vật</th>
                            <th class="w-1/12">Tồn kho</th>
                            <th class="w-1/12">Số lượng</th>
                            <th class="w-1/12">Kích thước</th>
                            <th class="w-2/12">Tình trạng</th>
                            <th class="w-1/12">Chức năng</th>

                        </tr>
                        <tr v-for="(i,key) in  dataForm.danhmuchienvat">
                            <td>
                                <select v-model="i.kho_id" @change="layvitri($event)" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                                    <option value="">-- Chọn kho --</option>
                                    <option v-for="i in danhsachkho" :value="i.id">
                                        @{{i.name}}
                                    </option>

                                </select>
                            </td>
                            <td>
                                <select v-model="i.vitri_id" @change="i.hienvat_id = layhienvat($event,i.kho_id,i.vitri_id)['hienvat_id']; i.soluong = i.tonkho= layhienvat($event,i.kho_id,i.vitri_id)['soluong']" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                                    <option value="">-- Chọn vị trí --</option>
                                    <option v-for="i in danhsachvitri" :value="i.id">
                                        @{{i.name}}
                                    </option>

                                </select>
                            </td>
                            <td>
                                <treeselect disabled="true" v-model="i.hienvat_id" :multiple="false" :options="danhsachhienvat" placeholder="Chọn hiện vật" :normalizer="normalizer" />
                            </td>
                            <td>
                                @{{i.tonkho}}
                            </td>
                            <td>
                                <el-input class="mt-2" @change="parseInt(i.soluong)>parseInt(i.tonkho) ? i.soluong = i.tonkho:''" :max="i.tonkho" placeholder="Số lượng" type="number" v-model="i.soluong"></el-input>
                            </td>
                            <td>
                                <el-input placeholder="kích thước" type="number" v-model="i.kichthuoc"></el-input>
                            </td>
                            <td>
                                <el-input placeholder="Tình trạng" v-model="i.tinhtrang"></el-input>
                            </td>
                            <td>
                                <el-tooltip class="item" effect="dark" content="Chỉnh sửa" placement="top-start">
                                    <el-button size="mini" @click="deletehv(key)">
                                        <i class=" el-icon-delete text-lg"></i>
                                    </el-button>
                                </el-tooltip>
                            </td>
                        </tr>
                    </table>

                    <el-button type="primary" @click="themhienvat()">Thêm hiện vật</el-button>
                </div>

            </div>

            <!--footer-->
            <div class=" text-center space-x-4 md:block">
                <button @click="submitform()" class="inline-flex mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Lưu báo cáo
                </button>
                <button @click="closemodal()" class="inline-flex items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>
    </div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8 flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý hiện vật/ </h1>
        <h1 class="text-base sm:text-xl mt-1 text-gray-900 dark:text-light">&nbsp; Xuất hiện vật</h1>
    </div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8 ">
        <!-- Replace with your content -->

        <div class="py-4 datatable">
            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white     " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row p-4">
                                <div class="py-4">
                                    <div class="sm:flex sm:items-center">
                                        <div class="sm:flex-auto">
                                            <button @click="saveform()" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
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
                                        <el-table-column prop="loaixuatnhap" label="Loại phiêu" align="center">
                                            <template slot-scope="scope">
                                                <div v-if="scope.row.loaixuatnhap == 1">Loại xuất</div>
                                                <div v-if="scope.row.loaixuatnhap == 2">Loại nhập</div>

                                            </template>
                                        </el-table-column>
                                        <el-table-column align="center" width="270">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
                                                <el-tooltip class="item" effect="dark" content="Chỉnh sửa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                        <i class="el-icon-edit-outline text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip class="item" effect="dark" content="Xóa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                        <i class="  el-icon-delete text-lg"></i>
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
                    danhmuchienvat: [{
                        kho_id: '',
                        tinhtrang: '',
                        soluong: '',
                        kichthuoc: '',
                        vitri_id: '',
                        hienvat_id: null,
                        check: false,
                    }],
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
            rowid: 0,
            danhsachkho: [],
            danhsachvitri: [],
            danhsachhienvat: [],
            validatevitri: false,
            validatehienvat: false,
            validatesoluong: false,
            danhsachvitrikho: [],
            valuevitri: null,
            valuehienvat: null,
            rowdanhmuc: '',
            danhsachphongban: [],
            danhsachnguoinhap: [],
            disabled: true,
            normalizer(node) {
                return {
                    id: node.id,
                    label: node.name,
                    children: node.children,
                }
            },
        },
        watch: {
            valuevitri() {
                // console.log(this.valuevitri);
            }
        },
        mounted: function() {
            const self = this;
            axios.get("/danh-muc/khos").then(function(response) {
                self.danhsachkho = response.data;
            })
            axios.get("/danh-muc/phongbans").then(function(response) {
                self.danhsachphongban = response.data;
            })
            axios.get("/danh-muc/hienvats").then(function(response) {
                for (var i = 0; i < response.data.length; i++) {
                    // response.data[i].label = response.data[i].name;
                    // self.danhsachhienvat.push(response.data[i])
                    self.danhsachhienvat = response.data;
                }
            })
            this.loadData();
        },
        methods: {
            layhienvat(event, kho_id, vitri_id) {
                for (var i = 0; i < this.danhsachvitri.length; i++) {
                    if (this.danhsachvitri[i]['id'] == vitri_id) {
                        return this.danhsachvitri[i];
                    }
                }
            },
            layvitri(event) {
                const self = this;
                axios.get("/lay-vi-tri?kho_id=" + event.target.value).then(function(response) {
                    self.danhsachvitri = response.data;
                })
            },
            laynguoinhap(event) {
                const self = this;
                axios.get("/lay-nguoi-nhap?phongban_id=" + event.target.value).then(function(response) {
                    self.danhsachnguoinhap = response.data;
                })
                console.log(event.target.value);

            },
            deletehv(key) {
                this.dataForm.data.danhmuchienvat.splice(key, 1)
            },
            // changeselecthienvat(event, key) {
            //     row = this.dataForm.data.danhmuchienvat.length - 1;
            //     this.dataForm.data.danhmuchienvat[row]['hienvat_id'] = data;
            // },
            // changeselectvitri(data) {
            //     row = this.dataForm.data.danhmuchienvat.length - 1;
            //     this.dataForm.data.danhmuchienvat[row]['vitri_id'] = data;
            // },
            laydanhsachvitri(event) {
                const self = this;
                axios.get("/xem-kho?kho_id=" + event.target.value).then(function(response) {
                    self.danhsachvitri = response.data;
                })
            },
            themhienvat() {
                // dem = this.dataForm.data.danhmuchienvat.length;
                // console.log(this.dataForm.data.danhmuchienvat[dem - 1]);
                // if (!this.dataForm.data.danhmuchienvat[dem - 1].vitri_id) {
                //     this.validatevitri = true;
                // } else if (!this.dataForm.data.danhmuchienvat[dem - 1].hienvat_id) {
                //     this.validatehienvat = true;

                // } else if (this.dataForm.data.danhmuchienvat[dem - 1].soluong > 0) {
                //     {
                //         this.validatesoluong = true;

                //     }
                // }
                for (var i = 0; i < this.dataForm.data.danhmuchienvat.length; i++) {
                    this.dataForm.data.danhmuchienvat[i]['check'] = true
                }
                this.dataForm.data.danhmuchienvat.push({
                    kho_id: '',
                    tinhtrang: '',
                    soluong: '',
                    kichthuoc: '',
                    vitri_id: '',
                    hienvat_id: null,
                    check: false,

                });
                this.rowid++;
            },
            openmodal() {
                // const self = this;
                // axios.get("/ajax-vi-tri-kho2").then(function(response) {
                //     self.danhsachvitrikho = response.data;
                // })
                this.isActivemodal = false;
                this.rowid = 0;
            },
            closemodal() {
                this.isActivemodal = true;
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
                this.dataForm.data.danhmuchienvat = [{
                    kho_id: '',
                    tinhtrang: '',
                    soluong: '',
                    kichthuoc: '',
                    vitri_id: '',
                    hienvat_id: null,
                    check: false,
                }];

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