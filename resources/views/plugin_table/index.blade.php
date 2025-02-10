@extends('../layout/layout')


@section('subhead')
<title>Quản lý <?php echo $table ?></title>
<style>
    [v-cloak] {
        display: none;
    }

    /* Removes the clear button from date inputs */
    input[type="date"]::-webkit-clear-button {
        display: none;
    }

    /* Removes the spin button */
    input[type="date"]::-webkit-inner-spin-button {
        display: none;
    }

    /* Always display the drop down caret */
    input[type="date"]::-webkit-calendar-picker-indicator {
        color: #2c3e50;
    }

    /* A few custom styles for date inputs */
    input[type="date"] {
        appearance: none;
        -webkit-appearance: none;
        color: #95a5a6;
        font-family: "Helvetica", arial, sans-serif;
        font-size: 18px;
        border: 1px solid #ecf0f1;
        background: #ecf0f1;
        padding: 5px;
        display: inline-block !important;
        visibility: visible !important;
    }

    input[type="date"],
    focus {
        color: #95a5a6;
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
    }

    select {
        --tw-border-opacity: 1;
        border-color: rgb(203 213 224 / var(--tw-border-opacity));
        border-width: 1px;
        border-radius: 0.375rem;
    }
</style>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-if="isActivemodal == false" style="z-index: 100" class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-6/12 w-10/12  p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:50%">
                <div class="col-span-12 mb-4 text-center text-3xl text-red-500">
                    Thêm mới, chỉnh sửa
                </div>
                <div v-for="(i,key) in datatb.data_colum" :class="i.type == 'ckeditor' ?'col-span-12 mr-8 mt-6' :'sm:col-span-6 col-span-12 mr-8 mt-6'">
                    <!-- kiểu chữ -->
                    <div v-if="i.type == 'string'" class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">@{{i.label}} </label>
                        <input v-model="i.value" type="text" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                    </div>
                    <!-- kiểu ckeditor -->
                    <div v-if="i.type == 'ckeditor'" class="relative shadow-sm ">
                        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">@{{i.label}} </label>
                        <ckeditor v-model="i.value" :config="config"></ckeditor>
                    </div>
                    <!-- kiểu số -->
                    <div v-else-if="i.type == 'number'" class="relative border border-gray-400 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
                        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white  font-medium text-gray-900">@{{i.label}} </label>
                        <input v-model="i.value" type="number" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 py-1 text-base focus:ring-0" placeholder="">
                    </div>
                    <!-- kiểu radio -->
                    <div v-else-if="i.type == 'checkbox'" class="-mt-1">
                        <div>
                            <label class="text-base font-medium text-gray-900"> @{{i.label}}</label>
                            <fieldset class="mt-2">
                                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                    <div v-for="(k,key) in i.datacheckbox" class="flex items-center">
                                        <input v-model="i.value" :value="k" type="radio" :name="'datacheckbox'+i.name" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label class="ml-3 block text-sm font-medium text-gray-700">@{{k}}</label>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <!-- kiểu select 1 bảng-->
                    <div v-else-if="i.type == 'select'" class="xl:col-span-6 col-span-12 ">
                        <select v-model="i.value" class="rounded-md border-1 p-2 mt-2 form-control form-select px-3 w-full">
                            <option value="">-- Chọn @{{i.label}} --</option>
                            <option v-for="a in listtable[i.name]" :value="a.id"> @{{ i.labelselect ? a[i.labelselect] : a.name}}</option>
                        </select>
                    </div>
                    <!-- kiểu select có search -->
                    <div v-else-if="i.type == 'selectsearch'" class="xl:col-span-6 col-span-12 ">
                        <!-- <select v-model="i.value" class="rounded-md border-1 p-2 mt-2 form-control form-select px-3 w-full">
                            <option value="">-- Chọn @{{i.label}} --</option>
                            <option v-for="a in listtable[i.name]" :value="a.id"> @{{ a.name}}</option>
                        </select> -->
                        <el-select class="rounded-md border-1  mt-8 form-control form-select  w-full" v-model="i.value" multiple filterable allow-create default-first-option :placeholder="'-- Chọn '+i.label+' --'">
                            <el-option v-for="a in listtable[i.name]" :label="i.labelselect ? a[i.labelselect] : a.name" :value="a.id">
                            </el-option>
                        </el-select>
                    </div>
                    <!-- <div v-else-if="i.type == 'selectdependent'" class="xl:col-span-6 col-span-12 ">
                        <select v-model="i.value" class="rounded-md border-1 p-2 mt-2 form-control form-select px-3 w-full">
                            <option value="">-- Chọn @{{i.label}} --</option>
                            <option v-for="a in listtable[i.name][i.dependentfield]" :value="a.id"> @{{ a.name}}</option>
                        </select>
                    </div> -->
                    <!-- kiểu select 1 mảng đã cho -->
                    <div v-else-if="i.type == 'selectarray'" class="xl:col-span-6 col-span-12 ">
                        <select v-model="i.value" class="rounded-md border-1 p-2 mt-2 form-control form-select px-3 w-full">
                            <option value="">-- Chọn @{{i.label}} --</option>
                            <option v-for="a in i.dataselect" :value="a"> @{{ a}}</option>
                        </select>
                    </div>
                    <!-- kiểu thời gian -->
                    <div v-else-if="i.type == 'date'" class="xl:col-span-6 col-span-12 ">
                        <div class=" rounded-md border-1 p-2 form-control form-select  w-full">
                            <label class="text-base font-medium text-gray-900"> @{{i.label}}</label>
                            <input type="date" class="w-full" v-model="i.value">
                        </div>
                    </div>
                    <div v-else-if="i.type == 'fileupload'" class="xl:col-span-6 col-span-12 ">
                        <uploadfile2 :tenbang="table" :truong_id="uuid"></uploadfile2>
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
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý cấu hình hệ thống </h1>
        <!-- <h1 class="text-base sm:text-xl mt-1  text-gray-900 dark:text-light">&nbsp; Quản lý danh mục/ Quản lý niên đại</h1> -->
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
                                            <button v-if="noAdd == false" @click="saveform()" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
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
                                <datatable v-if="check ==1" v-cloak :datatb="datatb" namePaging="pagination" @pagination="pagination">
                                    <template>
                                        <el-table-column label="STT" width="100" align="center">
                                            <template slot-scope="scope">
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column v-for="i in datatb.data_colum" v-if="i.hiden" :prop="i.name" :label="i.label" :align="i.center ? 'center' :''">
                                            <template slot-scope="scope" v-cloak>
                                                <div v-if="i.type != 'select'">
                                                    <span style="margin-left: 10px"> @{{ scope.row[i.name] }}</span>
                                                </div>
                                                <div v-else>
                                                    @{{ getdata(i.name,scope.row[i.name])}}
                                                </div>
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
                                                <!-- <el-tooltip class="item" effect="dark" content="Xóa" placement="top-start">
                                                    <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                        <i class="  el-icon-delete text-lg"></i>
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
<script type="module">
    import {
        v4 as uuidv4
    } from 'https://jspm.dev/uuid';

    var vm = new Vue({
        el: '#demo',
        data() {
            return {
                value: '',
                datatb: {
                    // Tên các cột có thẻ search
                    searchcolum: [
                        'name'
                    ],
                    // đường dẫn đến ajax
                    url: '/get_plugin_table?table=<?php echo $table ?>',
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
                noAdd: false,
                rowId: '',
                statusForm: '',
                dataForm: form({
                        // name: '123213',
                    })
                    .rules({
                        // name: 'required',
                    })
                    .messages({
                        // 'name.required': 'Trường bắt buộc nhập',
                    }),

                isActivemodal: true,
                table: '',
                // keydatatable: null,
                listtable: [],
                check: 0,
                uuid: '',
                config: {
                // toolbar: [
                //     { name: 'styles', items : [ 'Styles','Format', 'FontSize' ] },
                //     { name: 'clipboard', items : ['Undo','Redo' ] },
                //     { name: 'editing', items : [ 'Scayt' ] },
                //     { name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','Iframe' ] },
                //     { name: 'tools', items : [ 'Maximize' ] },
                //     '/',
                //     { name: 'basicstyles', items : [ 'Bold','Italic','Strike','RemoveFormat' ] },
                //     { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
                //     { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                // ],
                height: 400,
                extraPlugins: 'autogrow,uploadimage',
                filebrowserBrowseUrl: '/filemanager_storage?type=Files',
                filebrowserUploadUrl: '/api/uploads-ckeditor',
            },
            }
        },
        watch: {

        },
        mounted: function() {
            let uri = window.location.search.substring(1);
            let params = new URLSearchParams(uri);
            this.table = params.get("table");
            window.url = '/plugin_table?table=' + this.table;
            this.loadData();


        },
        methods: {
            getdata(colum, id) {
                //    var data = this.listtable;
                for (var i = 0; i < this.listtable[colum].length; i++) {
                    if (this.listtable[colum][i].id == id) {
                        return this.listtable[colum][i].name;
                    }
                }
            },
            openmodal() {
                this.isActivemodal = false;
            },
            closemodal() {
                this.isActivemodal = true;
                this.dataForm.errors().messages = {};
                this.uuid = '';
            },
            saveform() {
                for (var i = 0; i < this.datatb.data_colum.length; i++) {
                    this.dataForm.data[this.datatb.data_colum[i]['name']] = '';
                    this.datatb.data_colum[i]['value'] = '';
                }
                this.statusForm = "insert";
                this.uuid = uuidv4();
                this.openmodal();
            },
            submitform() {

                // lấy dữ liệu vào dataform
                for (var i = 0; i < this.datatb.data_colum.length; i++) {
                    this.dataForm.data[this.datatb.data_colum[i]['name']] = this.datatb.data_colum[i]['value'];
                }

                if (this.dataForm.validate().errors().any()) {
                    return;
                }

                const self = this;
                this.closemodal()
                if (this.statusForm == "insert") {
                    axios.post("/save_plugin_table", {
                            data: self.dataForm.data,
                            table: self.table,
                            uuid: this.uuid
                        }).then(function(response) {
                            self.thongbaothanhcong('Lưu thành công')
                            self.loadData();
                        })
                        .catch(error => {
                            self.thongbaothatbai(error);
                        });
                } else {
                    axios.post("/update_plugin_table", {
                            id: self.rowId,
                            data: self.dataForm.data,
                            table: self.table,
                            uuid: this.uuid
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

                            // start: 20,
                            searchcolum: this.datatb.searchcolum,
                            length: this.datatb.length,
                            searchnow: this.searchnow,
                            pagenow: this.datatb.paginatenow
                        },
                    })
                    .then(function(response) {
                        self.noAdd = response.data.noAdd
                        
                        // Tổng số trang hiện có
                        // self.keydatatable = Object.keys(response.data.data.data[0]);
                        self.datatb.total = response.data.data.recordsTotal;
                        // console.log( response.data.recordsTotal);
                        // Dữ liệu bảng
                        self.datatb.tableData = response.data.data.data;
                        self.datatb.data_colum = response.data.data_colum;
                        // lấy dữ liệu các cột kiểu select
                        if (self.check == 0) {
                            self.listtable = response.data.data.dataselect;
                            // for (var i = 0; i < self.datatb.data_colum.length; i++) {
                            //     if (self.datatb.data_colum[i]['type'] == 'select') {
                            //         var tablename = self.datatb.data_colum[i]['name'];
                            //         axios.get("/danh-muc/" + tablename.replace('_id', 's')).then(function(response1) {
                            //             self.listtable[tablename] = response1.data;
                            //         })
                            //     }
                            // }
                            self.check++;
                            console.log(self.check);
                        }
                    });
            },
            //data table
            doAlertEdit(data) {
                console.log(data);
                this.uuid = data.id;
                const self = this;
                // Gán giá trị cho form
                for (var i = 0; i < this.datatb.data_colum.length; i++) {
                    // this.dataForm.data[this.datatb.data_colum[i]['name']] = '';
                    this.datatb.data_colum[i]['value'] = data[this.datatb.data_colum[i]['name']];
                }
                // this.dataForm.data.name = data.name;
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
                    axios.post("/delete_plugin_table", {
                            id: data.id,
                            table: self.table
                        })
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