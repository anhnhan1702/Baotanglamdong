@extends('../layout/layout')


@section('subhead')
    <title>Quản lý người dùng</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">
        <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
            class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-8/12 p-5  relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
                <div class="w-full  " style="min-width: 600px;">
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
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Tên
                                :</label>
                            <input v-model="dataForm.name" type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="name" required>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                                @{{ dataForm.errors().get('name') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Email
                                :</label>
                            <input v-model="dataForm.email" type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="email" required>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('email')">
                                @{{ dataForm.errors().get('email') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="gender"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Giới
                                tính :</label>
                            <select v-model="dataForm.gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">-- Giới tính: --</option>
                                <option value="1">nam</option>
                                <option value="2">nữ</option>
                                <option value="3">khác</option>
                            </select>

                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('gender')">
                                @{{ dataForm.errors().get('gender') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Password :</label>
                            <input v-model="dataForm.password" type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="password" required>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('password')">
                                @{{ dataForm.errors().get('password') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nhóm
                                quyền:</label>
                            <select v-model="dataForm.chucvu_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">-- Nhóm quyền: --</option>
                                <option v-for="i in danhsachchucvu" :value="i.id">
                                    @{{ i.name }}
                                </option>
                            </select>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('chucvu_id')">
                                @{{ dataForm.errors().get('chucvu_id') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12 px-4 py-5 sm:p-4">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phòng
                                ban:</label>
                            <select v-model="dataForm.phongban_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">-- Phòng ban: --</option>
                                <option v-for="i in danhsachphongban" :value="i.id">
                                    @{{ i.name }}
                                </option>
                            </select>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('chucvu_id')">
                                @{{ dataForm.errors().get('phongban_id') }}
                            </span>
                        </div>

                    </div>
                    <!--footer-->
                    <div class=" text-center  md:block flex pt-4 justify-center">
                        <button @click="submitform()"
                            class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            @{{ tieude }}
                        </button>
                        <button @click="closemodal()"
                            class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
                    </div>

                </div>
            </div>

        </div>

        <div class="mx-auto max-w-8xl flex">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Hệ thống/ </h1>
            <h1 class="text-base sm:text-xl mt-1 text-gray-900 dark:text-light">&nbsp; Người dùng</h1>
        </div>
        <div class="mx-auto max-w-8xl ">
            <!-- Replace with your content -->
            <div class="py-4 datatable">
                <div class=" rounded-lg border-4  border-gray-200 bg-white     " style="min-height:80vh ;">
                    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
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
                                            <el-table-column prop="name" label="Tên">
                                            </el-table-column>
                                            <el-table-column prop="email" label="Mô tả">
                                            </el-table-column>
                                            <el-table-column prop="online" label="Trạng thái" >
                                                <template slot-scope="scope" class="!text-center">
                                                    <div class="text-center">
                                                        <span v-if="scope.row.online" class="bg-blue-600 text-white px-2 py-1 rounded-lg">Online</span>
                                                        <span v-else class="bg-gray-200 px-2 py-1 rounded-lg">Offline</span>
                                                    </div>
                                                    
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
                    url: '/ajax-nguoi-dung',
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
                        email: '',
                        password: '',
                        photo: '',
                        gender: '',
                        donvi_ma: '',
                        chucvu_id: '',
                        phongban_id: '',
                    })
                    .rules({
                        name: 'required',
                        password: 'required',
                        email: 'required',
                    })
                    .messages({
                        'name.required': 'Trường bắt buộc nhập',
                        'password.required': 'Trường bắt buộc nhập',
                        'email.required': 'Trường bắt buộc nhập',
                    }),
                tieude: '',
                isActivemodal: true,
                danhsachchucvu: [],
                danhsachdonvi: [],
                danhsachphongban: [],

            },
            watch: {

            },
            mounted: function() {
                this.loadData();
                const self = this;
                axios.get("/danh-muc/chucvus").then(function(response) {
                    self.danhsachchucvu = response.data;
                })

                axios.get("/danh-muc/phongbans").then(function(response) {
                    self.danhsachphongban = response.data;
                })

                // console.log(self.danhsachdonvi )
            },
            methods: {

                initDataTable() {
                 
                },


                openmodal() {
                    this.isActivemodal = false;
                },
                closemodal() {
                    this.isActivemodal = true;
                    this.dataForm.errors().messages = {};
                },
                saveform() {
                    this.tieude = 'Thêm mới người dùng'
                    this.dataForm.data.name = '';
                    this.dataForm.data.email = '';
                    this.dataForm.data.password = '';
                    this.dataForm.data.photo = '';
                    this.dataForm.data.gender = '';
                    this.dataForm.data.chucvu_id = '';
                    this.dataForm.data.phongban_id = '';
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
                        axios.post("/save-nguoi-dung", self.dataForm.data).then(function(response) {
                                self.thongbaothanhcong('Lưu thành công')
                                self.loadData();
                            })
                            .catch(error => {
                                self.thongbaothatbai(error);
                            });
                    } else {
                        axios.post("/update-nguoi-dung", {
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
                    console.log('this.datatb', this.datatb);
                    
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
                    this.tieude = 'Sửa thông tin người dùng'
                    this.dataForm.data.name = data.name;
                    this.dataForm.data.email = data.email;
                    this.dataForm.data.password = data.password;
                    this.dataForm.data.photo = data.photo;
                    this.dataForm.data.gender = data.gender;
                    this.dataForm.data.chucvu_id = data.chucvu_id;
                    this.dataForm.data.phongban_id = data.phongban_id;
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
                        axios.delete("/delete-nguoi-dung?id=" + data.id)
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
