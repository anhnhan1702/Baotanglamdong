@extends('../layout/layout')


@section('subhead')
<script src="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.min.css">
<title>{{$tieude}}</title>
@endsection
@section('subcontent')
<div id="demo" class="bg-white min-h-screen">
    <div class="col-span-12  md:block flex p-2 justify-center">
        <button @click="Back()"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            <span>Quản lý xuất</span>
        </button>
        <div class="grid grid-cols-12 mt-4">
            <div class="sm:col-span-5 col-span-12  bg-white mr-2 mt-4 sm:mt-0">
                <treeselect v-model="bosuutapxuat_id" value-consists-of="LEAF_PRIORITY" :options="bosuutapxuat"
                    :multiple="true" placeholder="Chọn bộ sưu tập" :normalizer="normalizer" />
            
            </div>

            <div class="col-span-4">
                <input class="effect-7 py-1.5 rounded" type="text" placeholder="Tìm kiếm" v-model="searchnow" />

            </div>
            <div class="col-span-3 sm:ml-2">
                <button @click="tratatcahienvat()"
                    class=" sm:w-2/3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded">
                    Trả hiện vật
                </button>

            </div>
        </div>
        <div class="px-4 sm:px-4 md:px-4 grid grid-cols-10">


        </div>
        <div class="mx-auto  ">
            <!-- Replace with your content -->

            <template>
                <div id="app" class="col-12">
                    <div class="row">

                        <!-- Using the VdtnetTable component -->
                        <datatable :datatb="datatb" namePaging="pagination" @pagination="pagination">
                            <template>
                                <el-table-column label="STT" width="100" align="center">
                                    <template slot-scope="scope">
                                        <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="name" width="" label="Tên">
                                </el-table-column>
                                <el-table-column prop="so_ky_hieu" width="" label="Số ký hiệu">
                                </el-table-column>


                                <el-table-column align="center" width="">
                                    <template slot="header" slot-scope="scope">
                                        Chức năng
                                    </template>
                                    <template slot-scope="scope">

                                        <el-tooltip v-if="scope.row.checkxuatnhap == 2" class="item" effect="dark"
                                            content="Trả hiện vật" placement="top-start">
                                            <el-button size="mini" @click="trahienvat(scope.row)">
                                                <i class="el-icon-upload2 text-lg"></i>
                                            </el-button>
                                        </el-tooltip>
                                        <!-- <el-tooltip v-if="scope.row.checkxuatnhap == 1" class="item" effect="dark"
                                            content="Hủy trả hiện vật" placement="top-start">
                                            <el-button size="mini" @click="huytrahienvat(scope.row)">
                                                <i class="el-icon-error text-lg"></i>
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



            <!-- /End replace -->
        </div>
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
            url: 'ajax-hien-vat-da-xuat',
            // Số bản ghi trên 1 trang
            length: 20,

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
        dataForm: form({})
            .rules({

            })
            .messages({

            }),

        tableDataView: {},
        bosuutapxuat: [],
        bosuutapxuat_id: [],
        bosuutaps_id: [],
        searchnow: '',
        normalizer(node) {
            return {
                id: node.id,
                label: node.name,
                children: node.children,
            }
        },
    },
    watch: {
        searchnow() {
            const self = this;
            this.loadData();
        },
        bosuutapxuat_id() {
            const self = this;
            this.loadData();
        }
    },
    mounted: function() {
        let uri = window.location.search.substring(1);
        let params = new URLSearchParams(uri);
        this.id = params.get("id");

        this.loadData();
        const self = this;
        axios.get("/info-bo-suu-tap-da-xuat?id=" + this.id).then(function(response) {
            self.bosuutapxuat = response.data;
        })


    },
    methods: {
        searchinfohienvat() {
            const self = this;
            this.loadData();
        },

        Back() {
            window.location.href = "/xuat";
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

            if (this.bosuutapxuat_id.length > 0) {
                var bosuutaps_id = new Array();

                for (let index = 0; index < this.bosuutapxuat_id.length; index++) {

                    bosuutaps_id.push(this.bosuutapxuat_id[index]);
                }
            }
            // Ajax dữ liệu
            axios
                .get(self.datatb.url, {

                    params: {
                        id: this.id,
                        bosuutap_id: bosuutaps_id,
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


        doAfterReload(data, table) {
            window.alert('data reloaded')
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
        trahienvat(data) {
            const self = this;


            this.$confirm('Bạn có chắc chắc muốn trả hiện vật?', 'Cảnh báo', {
                confirmButtonText: 'Vâng!',
                cancelButtonText: 'Không!',
                type: 'warning',
                center: true
            }).then(() => {
                const self = this;
                axios.post("/tra-hien-vat", {
                        id: self.id,
                        data: data
                    }).then(function(response) {
                        self.thongbaothanhcong('Trả hiện vật thành công');
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai('Trả hiện vật thất bại!!');
                    });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy '
                });
            });


        },
        huytrahienvat(data) {
            const self = this;
            this.$confirm('Bạn có chắc chắc muốn Hủy hiện vật?', 'Cảnh báo', {
                confirmButtonText: 'Vâng!',
                cancelButtonText: 'Không!',
                type: 'warning',
                center: true
            }).then(() => {
                const self = this;
                axios.post("/huy-tra-hien-vat", {
                        id: self.id,
                        data: data
                    }).then(function(response) {
                        if (response.data == 1) {
                            self.thongbaothanhcong('Hủy hiện vật thành công');
                            self.loadData();
                        } else {
                            self.thongbaothatbai('Hiện vật đã được xuất không thể hủy!!');
                        }


                    })
                    .catch(error => {
                        self.thongbaothatbai('Hủy hiện vật thất bại!!');
                    });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy '
                });
            });
        },
        tratatcahienvat() {
            this.$confirm('Bạn có chắc chắc muốn Hủy hiện vật?', 'Cảnh báo', {
                confirmButtonText: 'Vâng!',
                cancelButtonText: 'Không!',
                type: 'warning',
                center: true
            }).then(() => {
                const self = this;
                axios.post("/tra-het-hien-vat", {
                        id: self.id,
                    }).then(function(response) {
                        self.thongbaothanhcong('Hủy hiện vật thành công');
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai('Hủy hiện vật thất bại!!');
                    });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy '
                });
            });
        }
    }
})
</script>
@endsection