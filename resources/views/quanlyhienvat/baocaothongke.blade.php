@extends('../layout/layout')


@section('subhead')
<title>Báo cáo thống kê</title>
@endsection
@section('subcontent')
<style>
#dshv {
    width: 100%;
    margin: 0 auto;
}

#dshv th,
#dshv td {
    border: 1px solid gray !important;
    padding: 0px 10px;
}

#printMe {
    font-family: "Times New Roman", Times, serif;
    width: 210mm;
    margin: 0 auto;
}
</style>
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-6/12 w-10/12 sm:h-1/2 h-4/5   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="px-8 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:50%">
                <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                    @{{tieude}}
                </div>
                <div class="sm:col-span-12 col-span-12 mr-8 mt-4">
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
            </div>

            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                <button @click="submitform()"
                    class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Lưu báo cáo
                </button>
                <button @click="closemodal()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>
    </div>

    <!-- --------------------hien vat ------------------- -->
    <div v-cloak v-bind:class="{ hidden: isActivemodal_2 }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal_2()" class="absolute bg-black opacity-80 inset-0 z-0"></div>

        <div class=" sm:h-11/12 h-4/5 p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">

            <div id="hiddenScroll" class="px-4 py-6 w-full grid grid-cols-12 overflow-y-auto " style="height:90%">
                <div id="printMe" class=" col-span-12 grid grid-cols-12">
                    <div class="col-span-12  flex justify-around text-base">
                        <h1 class="text-center ">SỞ VHTT&DL LÂM ĐỒNG <br>
                            <span class="font-bold" style="border-bottom: 1px solid gray;">BẢO TÀNG LÂM ĐỒNG </span>
                        </h1>
                        <h1 class="text-center font-bold">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br>
                            <span class="font-bold" style="border-bottom: 1px solid gray;">Độc lập – Tự do – Hạnh
                                phúc</span>

                        </h1>
                    </div>
                    <div class="col-span-12  text-center  text-base py-2  font-bold">
                        DANH SÁCH HIỆN VẬT
                    </div>
                    <div class="sm:col-span-12 col-span-12 text-base">

                        <table class="w-full">
                            <tr>
                                <th class="border-collapse border border-black text-center">STT</th>
                                <th class="border-collapse border border-black">Tên hiện vật</th>
                                <th class="border-collapse border border-black">Số ký hiệu</th>

                                <th class="border-collapse border border-black">Số lượng</th>
                                <th class="border-collapse border border-black">Kích thước</th>
                                <th class="border-collapse border border-black">Trọng lượng</th>
                                <th class="border-collapse border border-black">Tình trạng</th>
                                <th class="border-collapse border border-black">Hình ảnh</th>
                                <th class="border-collapse border border-black">Vị trí hiện vật</th>
                                <th class="border-collapse border border-black">Ghi chú</th>
                            </tr>
                            <tr v-for="(item, index) in danhsachhienvat">
                                <td class="border-collapse border border-black text-center">@{{index + 1}}</td>
                                <td class="border-collapse border border-black">@{{item.name}}</td>
                                <td class="border-collapse border border-black">@{{item.so_ky_hieu}}</td>


                                <td class="border-collapse border border-black">@{{item.soluong}}</td>
                                <td class="border-collapse border border-black">@{{item.kich_thuoc}}</td>
                                <td class="border-collapse border border-black">@{{item.trong_luong}}</td>
                                <td class="border-collapse border border-black">@{{item.tinh_trang_hv}}</td>
                                <td class="border-collapse border border-black  w-16"><img class="p-1 w-full"
                                        :src='item.fileuploads' alt=""></td>
                                <td class="border-collapse border border-black">@{{item.vitrihienvat}}</td>
                                <td class="border-collapse border border-black">@{{item.ghinho}}</td>

                            </tr>

                        </table>

                    </div>
                    <div class="col-span-12  flex justify-around mt-5 text-base">
                        <h1 class="text-center font-bold">Người lập <br>
                            <em class="font-light">(Ký tên)</em>
                        </h1>
                        <h1 class="text-center">Lâm Đồng, ngày &nbsp; tháng&nbsp; năm <br>
                            <span class="font-bold">Người kiểm tra <br>
                                <em class="font-light">
                                    (Ký, họ tên)
                                </em>
                            </span>

                        </h1>
                    </div>
                </div>
            </div>


            <!--footer-->
            <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                <button
                    class="items-center px-4 py-2 border border-green-700   text-sm font-medium rounded-md shadow-sm text-green-700 bg-white hover:text-white hover:bg-green-700"
                    @click="exportword(danhsachhienvat)">Xuất word</button>
                <button
                    class="items-center px-4 py-2 border border-blue-700   text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:text-white hover:bg-blue-700"
                    @click="print">In phiếu</button>
                <button @click="closemodal_2()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Thoát</button>
            </div>

        </div>


    </div>
    <!-- ---------------------------------------------------------- -->
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900">Báo cáo thống kê</h1>
    </div>
    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">
            <div class=" rounded-lg border-4 border-dashed border-gray-200 bg-white" style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-2">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row">
                                <div class="py-4">

                                    <div class="grid grid-cols-12">
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="hinhthucsuutam"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select">
                                                <option value="">-- Hình thức sưu tầm --</option>
                                                <option v-for="i in danhsachhinhthucsuutam" :value="i.id">
                                                    @{{i.name}}</option>
                                            </select>

                                        </div>
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-6 sm:pr-4 mt-1">
                                            <select v-model="chatlieu"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                                                <option value="">-- Chất liệu --</option>
                                                <option v-for="i in danhsachchatlieu" :value="i.id"> @{{i.name}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="loaihienvat"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                                                <option value="">-- Loại hiện vật --</option>
                                                <option v-for="i in danhsachloaihienvat" :value="i.id"> @{{i.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <treeselect v-model="vitrihienvat" required
                                                value-consists-of="LEAF_PRIORITY" :multiple="false" :options="datakho"
                                                placeholder="Chọn kho" :normalizer="normalizer" />
                                        </div>
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <treeselect v-model="bosuutap" required value-consists-of="LEAF_PRIORITY"
                                                :multiple="false" :options="danhsachbosuutap" placeholder="Bộ sưu tập"
                                                :normalizer="normalizer" />
                                        </div>
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <input
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select"
                                                type="date" placeholder="Tìm kiếm" />
                                            <span class="focus-border">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="col-span-12 xl:col-span-3 sm:col-span-4 sm:pr-4 mt-1">
                                            <select v-model="datatb.length"
                                                class="rounded-md w-full border border-gray-400 p-2 form-control form-select ">
                                                <option value="0">-- Số hiện vật hiển thị --</option>
                                                <option value="100"> 100</option>
                                                <option value="500"> 500</option>
                                                <option value="1000"> 1000</option>
                                                <option value="2000"> 2000</option>
                                                <option value="5000"> 5000</option>
                                                <option value="100000000"> toàn bộ</option>

                                            </select>
                                        </div>
                                        <div class="col-span-12 sm:col-span-4 sm:pr-4 mt-1">

                                            <input class="effect-7" type="text" placeholder="Tìm kiếm"
                                                v-model="searchnow" />

                                        </div>
                                        <button @click="openmodal_2()" type="button"
                                            class="col-span-12 sm:col-span-3 xl:col-span-2 mt-1 inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Xuất
                                            dữ liệu</button>
                                    </div>




                                </div>
                                <!-- Using the VdtnetTable component -->
                                <datatable :datatb="datatb" namePaging="pagination" methodselect="changeselect"
                                    @changeselect="changeselect" @pagination="pagination">
                                    <template>
                                        <el-table-column type="selection" width="55">
                                        </el-table-column>
                                        <el-table-column label="STT" width="100" align="center">
                                            <template slot-scope="scope">
                                                <span style="margin-left: 10px">@{{ scope.$index + 1 }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="name" width="200" label="Tên Hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="ten_khac" width="200" label="Tên khác">
                                        </el-table-column>
                                        <el-table-column prop="chu_nhan" width="200" label="Chủ nhân hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="dia_diem_st" width="200" label="Địa điểm sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="hinhthucsuutam" width="200" label="Hình thức sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="thoi_gian_st" width="200" label="Thời gian sưu tầm">
                                        </el-table-column>
                                        <el-table-column prop="tinh_trang_hv" width="200"
                                            label="Tình trạng hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="tenloaihienvat" width="200" label="Loại hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="chatlieu" width="200" label="Chất liệu">
                                        </el-table-column>

                                        <el-table-column prop="dudoan_niendai" width="200" label="Dự đoán niên đại">
                                        </el-table-column>
                                        <el-table-column prop="baoquan_phucche" width="200"
                                            label="Bảo quản, phục chế">
                                        </el-table-column>
                                        <el-table-column prop="vitrihienvat" width="200" label="Vị trí hiện vật">
                                        </el-table-column>
                                        <el-table-column prop="tenbosuutap" width="200" label="Bộ sưu tập">
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
                'name',
                // 'chatlieu_id',
                // 'kho_id',
                // 'hinhthucst_id'
            ],
            // đường dẫn đến ajax
            url: '/ajax-bao-cao-thong-ke',
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

        isActivemodal: true,
        isActivemodal_2: true,
        tieude: '',
        danhsachchatlieu: [],
        danhsachloaihienvat: [],
        danhsachkho: [],
        danhsachvitrihienvat: [],
        danhsachhinhthucsuutam: [],
        danhsachbosuutap: [],
        timenow: '',
        hinhthucsuutam: '',
        chatlieu: '',
        loaihienvat: '',
        kho: '',
        bosuutap: null,
        vitrihienvat: null,
        searchnow: null,
        danhsachhienvat: [],
        datakho: [],
        // bosuutap
        normalizer(node) {
            return {
                id: node.id,
                label: node.name,
                children: node.children,
            }
        },
    },
    watch: {
        'datatb.length'() {
            this.loadData();
        },
        searchnow() {
            const self = this;
            this.loadData();
        },
        timenow(data) {
            let d = new Date(this.timenow);
            let month = (d.getMonth() + 1).toString().padStart(2, '0');
            let day = d.getDate().toString().padStart(2, '0');
            let year = d.getFullYear();
            this.timenow = [year, month, day].join('-');
            this.loadData();
        },
        vitrihienvat() {
            this.loadData()
        },

        hinhthucsuutam() {
            this.loadData()

        },
        chatlieu() {
            this.loadData()
        },
        kho() {
            this.loadData()

        },
        loaihienvat() {
            this.loadData()
        },
        bosuutap() {
            this.loadData()
        }
    },
    mounted: function() {
        // console.log(this.hinhthucsuutam)
        const self = this;
        axios.get("/danh-muc/chatlieus").then(function(response) {
            self.danhsachchatlieu = response.data;
        })
        axios.get("/danh-muc/loaihienvats").then(function(response) {
            self.danhsachloaihienvat = response.data;
        })
        axios.get("/data-kho").then(function(response) {
            self.datakho = response.data;
        })
        axios.get("/ajax-bo-suu-tap-1").then(function(response) {
            self.danhsachbosuutap = response.data;
        })

        axios.get("/danh-muc/hinhthucsuutams").then(function(response) {
            self.danhsachhinhthucsuutam = response.data;
        })
        this.loadData();

    },
    methods: {
        exportword(data) {
            const self = this;
           
            if (data.length >0) {
                const idhienvats = [];
                for (let index = 0; index < data.length; index++) {
                    idhienvats.push(data[index].id);
                    
                }
                
               window.open('/export-word?data=' + idhienvats + '&kieuxuat=danhsachhienvat', '_blank')
            } else {
                self.thongbaothatbai('bạn chưa chọn hiện vật');
            }
      
        },
        print() {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },
        openmodal() {
            this.isActivemodal = false;
        },
        changeselect(data) {
      
            this.danhsachhienvat = data;
            // return data
        },
        openmodal_2() {

            // console.log(this.chat)
            this.isActivemodal_2 = false;
        },
        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },

        closemodal_2() {
            this.isActivemodal_2 = true;
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
                axios.post("/save-bao-cao-thong-ke", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loadData();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-bao-cao-thong-ke", {
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
            // console.log(self)
            // console.log(this)
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

                        start: self.datatb.start,
                        searchcolum: self.datatb.searchcolum,
                        length: self.datatb.length,
                        searchnow: self.searchnow,
                        timenow: self.timenow,
                        hinhthucsuutam: self.hinhthucsuutam,
                        chatlieu: self.chatlieu,
                        loaihienvat: self.loaihienvat,
                        kho: self.kho,
                        vitrihienvat: self.vitrihienvat,
                        bosuutap: self.bosuutap,

                    },
                })
                .then(function(response) {
                    // console.log(this.hinhthucsuutam)
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
                axios.delete("/delete-bao-cao-thong-ke?id=" + data.id)
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