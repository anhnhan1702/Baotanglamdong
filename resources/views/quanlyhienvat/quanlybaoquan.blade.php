@extends('../layout/layout')

@section('subhead')
<title>Quản lý bảo quản</title>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-6/12 w-10/12   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="w-full  overflow-auto ">
                <div class=" flex justify-between items-center  rounded-t border-b mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                        @{{tieude}}
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
                    <div class="col-span-12 sm:col-span-6 px-4 py-5 sm:p-4">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                        <input v-model="dataForm.name" type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="name" required="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                            @{{ dataForm.errors().get('name') }}
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6 px-4 py-5 sm:p-4">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tóm tắt:</label>
                        <input v-model="dataForm.description" type="text" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tóm tắt" required="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('description')">
                            @{{ dataForm.errors().get('description') }}
                        </span>
                    </div>
                </div>
            </div>

            <!--footer-->
            <div class="col-span-12 text-center  md:block flex pt-4 justify-center">
                <button @click="submitform()"
                    class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    @{{tieude}}
                </button>
                <button @click="closemodal()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>
    </div>
    <div v-cloak v-bind:class="{ hidden: isActivemodalhienvat }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodalhienvat()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="w-6/12   relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
            <div class="px-8 py-4 w-full grid grid-cols-12 " style="min-width: 600px;">
                <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                    Thêm hiện vật vào trưng bày
                </div>


                <el-transfer filterable :filter-method="filterMethod" filter-placeholder="State Abbreviations"
                    class="col-span-12 flex justify-center items-center py-2"
                    :props="{key:'id', label:'name', initial:'name'}" v-model="dataForm.hienvat_id" :data="hienvat">
                </el-transfer>

                <!--footer-->
                <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                    <button @click="submitformHienvat()"
                        class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Lưu hiện vật
                    </button>
                    <button @click="closemodalhienvat()"
                        class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
                </div>

            </div>
        </div>

    </div>
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900">Quản lý hiện vật / Quản lý loại bảo quản</h1>
    </div>
    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">
            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white     " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row ">
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
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="name" label="Tên ">
                                            <template slot-scope="scope">
                                                <a>@{{ scope.row.name }}</a>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="description" label="Mô tả">
                                        </el-table-column>
                                        <!-- <el-table-column label="Trạng thái" align="center">
                                            <template slot-scope="scope">
                                                <span
                                                    class="inline-flex rounded-full bg-red-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-if="!scope.row.trangthai"> Chưa duyệt</span>
                                                <span
                                                    class="inline-flex rounded-full bg-green-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else-if="scope.row.trangthai == 1"> Đã duyệt</span>
                                                <span
                                                    class="inline-flex rounded-full bg-gray-500 px-2 text-xs font-semibold leading-5 text-white"
                                                    v-else> Đã trả hiện vật về kho </span>

                                            </template>
                                        </el-table-column> -->
                                        <el-table-column align="center" width="300">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
                                                <!-- <el-tooltip v-if="!scope.row.trangthai" class="item" effect="dark"
                                                    content="Duyệt phiếu" placement="top-start">
                                                    <el-button size="mini" @click="duyet(scope.row)">
                                                        <i class="  el-icon-check text-lg"></i>
                                                    </el-button>
                                                </el-tooltip> -->
                                                <el-tooltip v-if="scope.row.trangthai == 1" class="item" effect="dark"
                                                    content="Trả hiện vật" placement="top-start">
                                                    <el-button size="mini" @click="trahienvat(scope.row)">
                                                        <i class="el-icon-sell text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip v-if="!scope.row.trangthai" class="item" effect="dark"
                                                    content="Chỉnh sửa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                        <i class="el-icon-edit-outline text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <!-- <el-tooltip v-if="!scope.row.trangthai" class="item" effect="dark"
                                                    content="thêm hiện vật" placement="top-start">
                                                    <el-button size="mini" @click="openmodalhienvat(scope.row)">
                                                        <i class="  el-icon-star-off text-lg"></i>
                                                    </el-button>
                                                </el-tooltip> -->
                                                <el-tooltip v-if="!scope.row.trangthai" class="item" effect="dark"
                                                    content="Xóa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                        <i class="  el-icon-delete text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <!-- <el-tooltip v-if="scope.row.trangthai == 1" class="item" effect="dark"
                                                    content="Xem hiện vật" placement="top-start">
                                                    <el-button size="mini" @click="galleryhienvat(scope.row)">
                                                        <i class=" el-icon-view text-lg"></i>
                                                    </el-button>
                                                </el-tooltip> -->

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
            url: '/ajax-bao-quan',
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
                hienvat_id: '',
            })
            .rules({
                name: 'required',
            })
            .messages({
                'name.required': 'Trường bắt buộc nhập',
            }),
        hienvat: [],
        isActivemodal: true,
        isActivemodalhienvat: true,
        tieude: '',
    },
    watch: {

    },
    mounted: function() {
        this.loadData();
    },
    methods: {
        openmodal() {
            this.isActivemodal = false;
        },
        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },
        saveform() {
            this.tieude = 'Thêm mới thông tin',
                this.dataForm.data.name = '';
            this.statusForm = "insert";
            this.openmodal();
        },
        submitform() {
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            console.log(self.dataForm.data);
            if (this.statusForm == "insert") {
                axios.post("/save-bao-quan", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-bao-quan", {
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
            this.tieude = 'Sửa thông tin',
                this.dataForm.data.name = data.name;
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
                axios.delete("/delete-bao-quan?id=" + data.id)
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
        filterMethod(query, item) {
            return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1;
        },
        openmodalhienvat(data) {
            const self = this;
            axios.get("/showhienvats").then(function(response) {
                self.hienvat = response.data;

            })
            this.isActivemodalhienvat = false;
            this.statusForm = "update";
            if (data.hienvat_id == null) {
                this.dataForm.data.hienvat_id = [];
            } else {
                this.dataForm.data.hienvat_id = data.hienvat_id;
            }
            this.dataForm.data.name = data.name;
            this.dataForm.data.description = data.description;

            this.rowId = data.id;

        },
        closemodalhienvat() {
            this.isActivemodalhienvat = true;

        },
        submitformHienvat() {

            const self = this;
            this.closemodalhienvat();
            axios.post("/update-bao-quan", {
                    id: self.rowId,
                    data: self.dataForm.data
                }).then(function(response) {
                    self.thongbaothanhcong('Sửa thành công')
                    self.loadData();
                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });

        },
        // duyệt và trả laị hiện vật 
        trahienvat(row) {
            const self = this;
            axios.post("/tra-hien-vat-bao-quan", row).then(function(response) {
                    self.thongbaothanhcong('Trả hiện vật thành công')
                    self.loadData();
                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });
        },
        duyet(row) {
            const self = this;
   
            axios.post("/duyet-bao-quan", row).then(function(response) {
                    if (response.data == 1) {
                        self.thongbaothanhcong('Duyệt thành công')
                        self.loadData();
                    }else{
                        self.thongbaothatbai('Bảo quản chưa có hiện vật');
                    }

                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });
        },
        // show hiện vật bảo quản
        // trưng bày hiện vật
        galleryhienvat(data) {
            const self = this;
            window.location.href = "/gallery-hien-vat?id=" + data.id + "&table=baoquans";
        },
    }
})
</script>
@endsection