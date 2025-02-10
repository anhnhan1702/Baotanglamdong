@extends('../layout/layout')


@section('subhead')
<title>Danh mục hiện vật</title>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-if="datatable.loaixuatnhap == 1" v-bind:class="{ hidden: isActivemodal }" style="z-index: 100" class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-8/12 w-10/12 sm:h-1/2 h-4/5   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:80%">
                <div class="col-span-12 mb-4 text-center text-3xl text-red-500">
                    Thêm mới, chỉnh sửa
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                    <select v-model="kho_id" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn Kho --</option>
                        <option v-for="i in danhsachkho" :value="i.id">
                            @{{i.name}}
                        </option>
                    </select>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                    <select v-model='dataForm.vitri_id' @change="thaydoivitri($event)" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                        <option value="">-- Chọn vị trí --</option>
                        <option v-for="i in danhsachvitri" v-if="i.hienvat" :value="i.id">
                            @{{i.name}}(@{{i.hienvat.name}})
                        </option>
                    </select>
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('vitri_id')">
                        @{{ dataForm.errors().get('vitri_id') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                    <label class="block text-sm font-medium text-gray-700">Tên hiện vật</label>
                    <input disabled v-model="tenhienvat" name=" soluong" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                </div>
                <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                    <label class="block text-sm font-medium text-gray-700">Số lượng</label>
                    <input v-model="dataForm.soluong" name=" soluong" type="number" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('soluong')">
                        @{{ dataForm.errors().get('soluong') }}
                    </span>
                </div>
                <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                    <label class="block text-sm font-medium text-gray-700">Tình trạng</label>
                    <input v-model="dataForm.tinhtrang" name=" tinhtrang" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('tinhtrang')">
                        @{{ dataForm.errors().get('tinhtrang') }}
                    </span>
                </div>
            </div>

            <!--footer-->
            <div class=" text-center space-x-4 md:block">
                <button @click="submithienvat()" class="inline-flex mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Lưu báo cáo
                </button>
                <button @click="closemodal()" class="inline-flex items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>
    </div>
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý hiện vật/ </h1>
        <h1 class="text-base sm:text-xl mt-1  text-gray-900 dark:text-light">&nbsp; Quản lý xuất nhập/ @{{datatable.name}} (@{{datatable.loaixuatnhap == 1 ? 'phiếu xuất' : 'phiếu nhập'}}) </h1>
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
                                            <button @click="saveform()" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
                                                mới hiện vật </button>

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
                                <el-table :data="datatable.danhmuchienvat" style="width: 100%">
                                    <el-table-column label="Vị trí" width="180" align="center">
                                        <template slot-scope="scope">
                                            <span style="margin-left: 10px">@{{ scope.row.name }}</span>

                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Hiện vật" align="center">
                                        <template slot-scope="scope">
                                            <span style="margin-left: 10px">@{{ scope.row.tenhienvat }}</span>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Số lượng" width="180" align="center">
                                        <template slot-scope="scope">
                                            <span style="margin-left: 10px">@{{ scope.row.soluong }}</span>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Tình trạng" width="180" align="center">
                                        <template slot-scope="scope">
                                            <span style="margin-left: 10px">@{{ scope.row.trinhtrang }}</span>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Hình ảnh" width="180" align="center">
                                        <template slot-scope="scope">
                                            <span style="margin-left: 10px" align="center">@{{ scope.row.hinhanh }}</span>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Chức năng" width="180" align="center">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="Chỉnh sửa" placement="top-start">
                                                <el-button size="mini"  @click="doAlertEdit(scope.row)">
                                                    <i class="el-icon-edit-outline text-lg"></i>
                                                </el-button>
                                            </el-tooltip>
                                        </template>
                                    </el-table-column>
                                </el-table>
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
    window.soluongtoida = 0;
    var vm = new Vue({
        el: '#demo',
        data: {
            rowId: '',
            statusForm: '',
            dataForm: form({
                    vitri_id: '',
                    hienvat_id: '',
                    soluong: '',
                    tinhtrang: '',
                })
                .rules({
                    vitri_id: 'required',
                    hienvat_id: 'required',
                    soluong: 'required',

                })
                .messages({
                    'vitri_id.required': 'Trường bắt buộc nhập',
                    'hienvat_id.required': 'Trường bắt buộc nhập',
                    'soluong.required': 'Trường bắt buộc nhập',

                }),

            isActivemodal: true,
            datatable: <?php
                        echo json_encode($phieu, JSON_HEX_TAG);
                        ?>,
            danhsachkho: [],
            kho_id: '',
            danhsachvitri: [],
            tenhienvat: '',
            soluong: '',
            soluongtoida: '',
            hienvatdachon: '',
        },
        watch: {
            kho_id(data) {
                const self = this;
                axios.get("/xem-kho?kho_id=" + data).then(function(response) {
                    self.danhsachvitri = response.data;
                    self.dataForm.data.vitri_id = '';
                    self.dataForm.kho_id= data;
                    self.tenhienvat = '';
                    self.soluong = 0;
                })
            },

        },
        mounted: function() {
            const self = this;
            axios.get("/danh-muc/khos").then(function(response) {
                self.danhsachkho = response.data;
            })
            this.loadData();
        },
        methods: {
            thaydoivitri(event) {
                this.dataForm.data.vitri_id = event.target.value;
                for (var i = 0; i <= this.danhsachvitri.length; i++) {
                    if (this.danhsachvitri[i].id == this.dataForm.data.vitri_id) {
                        this.dataForm.name = this.danhsachvitri[i].name;
                        this.dataForm.tenhienvat = this.danhsachvitri[i].tenhienvat;
                        this.hienvatdachon = this.danhsachvitri[i].hienvat;
                        this.tenhienvat = this.danhsachvitri[i].tenhienvat;
                        this.dataForm.data.soluong = this.danhsachvitri[i].soluong;
                        this.dataForm.hienvat_id = this.danhsachvitri[i].hienvat.id;
                        window.soluongtoida = this.danhsachvitri[i].soluong;
                        console.log(window.soluongtoida);
                    }
                }


            },
            openmodal() {
                this.isActivemodal = false;
                this.kho_id = '';
            },
            closemodal() {
                this.isActivemodal = true;
                this.dataForm.errors().messages = {};
            },
            saveform() {
                this.dataForm.data.vitri_id = '';
                this.dataForm.data.hienvat_id = '';
                this.dataForm.data.soluong = '';
                this.dataForm.data.tinhtrang = '';
                this.statusForm = "insert";
                this.openmodal();
            },
            submithienvat() {
                if (this.dataForm.validate().errors().any()) {
                    return;
                }
                this.datatable.danhmuchienvat.push(this.dataForm.data);
                this.isActivemodal = true;
            },
            submitform() {
                if (this.dataForm.validate().errors().any()) {
                    return;
                }
                const self = this;
                this.closemodal()
                console.log(self.dataForm.data);
                if (this.statusForm == "insert") {
                    axios.post("/save-hien-vat-vao-danh-muc", self.dataForm.data).then(function(response) {
                            self.thongbaothanhcong('Lưu thành công')
                            self.loadData();
                        })
                        .catch(error => {
                            self.thongbaothatbai(error);
                        });
                } else {
                    axios.post("/update-hien-vat-vao-danh-muc", {
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
                console.log( data);
                this.dataForm.kho_id = data.kho_id;
                this.dataForm.vitri_id = data.vitri_id;
                this.dataForm.data.hienvat_id = data.hienvat_id;
                this.dataForm.data.soluong = data.soluong;
                this.dataForm.data.tinhtrang = data.tinhtrang;
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
                    axios.delete("/delete-hien-vat-vao-danh-muc?id=" + data.id)
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