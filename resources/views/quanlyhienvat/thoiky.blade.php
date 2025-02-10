@extends('../layout/layout')


@section('subhead')
<title>Quản lý thời kỳ</title>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100" class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-6/12 w-10/12 sm:h-1/2 h-4/5   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:50%">
                <div class="col-span-12 mb-4 text-center text-3xl text-red-500">
                    Thêm mới, chỉnh sửa
                </div>
                <div class="sm:col-span-12 col-span-12 mr-8 mt-4">
                    <div class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">Tên </label>
                        <input v-model="dataForm.name" type="text" name="name" id="name" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                            @{{ dataForm.errors().get('name') }}
                        </span>
                    </div>
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
        <h1 class="text-base sm:text-xl mt-1 text-gray-900 dark:text-light">&nbsp; Quản lý danh mục/ Quản lý thời kỳ</h1>
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
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="name" label="Tên ">
                                            <template slot-scope="scope">
                                                <a>@{{ scope.row.name }}</a>
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
    var vm = new Vue({
        el: '#demo',
        data: {
            datatb: {
                // Tên các cột có thẻ search
                searchcolum: [
                    'name'
                ],
                // đường dẫn đến ajax
                url: '/ajax-thoi-ky',
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
                })
                .rules({
                    name: 'required',
                })
                .messages({
                    'name.required': 'Trường bắt buộc nhập',
                }),

            isActivemodal: true

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
                    axios.post("/save-thoi-ky", self.dataForm.data).then(function(response) {
                            self.thongbaothanhcong('Lưu thành công')
                            self.loadData();
                        })
                        .catch(error => {
                            self.thongbaothatbai(error);
                        });
                } else {
                    axios.post("/update-thoi-ky", {
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
                    axios.delete("/delete-thoi-ky?id=" + data.id)
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