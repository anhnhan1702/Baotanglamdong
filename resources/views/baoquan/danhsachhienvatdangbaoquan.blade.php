@extends('../layout/layout')


@section('subhead')
    <title>Danh sách hiện vật thuộc phiếu bảo quản</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

        <div class="mx-auto max-w-8xl ">
            <!-- Replace with your content -->
            <div class="py-4 datatable">
                <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white     " style="min-height:80vh ;">
                    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
                        <template>
                            <div id="app" class="col-12">
                                <div class="row">
                                    <div class="py-4">
                                        <div class="sm:flex sm:items-center mb-4 sm:justify-between">

                                            <button @click="submitform()" type="button"
                                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                CẬP NHẬT
                                            </button>
                                            <div class="relative ">
                                                <div
                                                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <el-input placeholder="Nhập tên hiện vật, số ký hiệu"
                                                    v-model="datatb.searchnow" @blur="search($event)" clearable>
                                                </el-input>


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
                                                        <a>@{{ scope.row.name_hienvat + ' - ' + scope.row.so_ky_hieu_hienvat }}</a>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="baoquan_id" label="Loại bảo quản">
                                                    <template slot-scope="scope">
                                                        <el-select class="w-full !rounded-lg" v-model="scope.row.baoquan_id"
                                                            placeholder="Chọn thành viên">
                                                            <el-option v-for="item in listBaoQuan" :key="item.id"
                                                                :label="item.name" :value="item.id">
                                                            </el-option>
                                                        </el-select>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="trangthai" label="Trang thái ">
                                                    <template slot-scope="scope">
                                                        <el-select class="w-full !rounded-lg" v-model="scope.row.trangthai"
                                                            placeholder="Chọn thành viên">
                                                            <el-option value="Đang bảo quản">
                                                                Đang bảo quản
                                                            </el-option>
                                                            <el-option value="Cần bảo quản">
                                                                Cần bảo quản
                                                            </el-option>
                                                        </el-select>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ghichu" label="Ghi chú ">
                                                    <template slot-scope="scope">
                                                        <el-input class="w-full" placeholder="Nhập ghi chú"
                                                            v-model="scope.row.ghichu"></el-input>
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
                        'phieubaoquan_id'
                    ],
                    // đường dẫn đến ajax
                    url: '/ajax-danh-sach-hien-vat-so-bao-quan',
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
                phieuBaoQuan_Id: @json($id),
                listBaoQuan: [],
                rowId: '',
                statusForm: '',

                isActivemodal: true,
                tieude: '',
            },
            watch: {

            },
            mounted: function() {
                const self = this;
                axios.get("/danh-muc/baoquans").then(function(response) {
                    self.listBaoQuan = response.data;
                })
                this.loadData();

            },
            methods: {
                search() {

                    this.loadData();
                },
                submitform() {
                    const self = this;
                    this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                        confirmButtonText: 'Vâng, Gửi dũ liêu!',
                        cancelButtonText: 'Không gửi dữ liệu!',
                        type: 'warning',
                        center: true
                    }).then(() => {
                        axios.post("/save-danh-sach-hien-vat-so-bao-quan", this.datatb.tableData).then(
                                function(response) {
                                    self.thongbaothanhcong('Lưu thành công')
                                    self.loadData();
                                })
                            .catch(error => {
                                self.thongbaothatbai(error);
                            });

                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Đã hủy '
                        });
                    });


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
                                phieuBaoQuan_Id: this.phieuBaoQuan_Id,
                                searchcolum: this.datatb.searchcolum,
                                length: this.datatb.length,
                                searchnow: this.datatb.searchnow,
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
