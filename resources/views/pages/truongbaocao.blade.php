@extends('../layout/top-menu')

@section('subhead')
<title>Đợt báo cáo</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('subcontent')
<script src="https://cdn.jsdelivr.net/npm/color-js@1.0.3"></script>

<div id="search">
    <h2 class="intro-y text-lg font-medium mt-10">Trường báo cáo</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12  sm:flex-nowrap items-center mt-2 sm:flex sm:justify-between">
            <!-- BEGIN: Nút tạo đợt -->
            <div class="text-center ">
                <button v-on:click="openmodal()" class="btn btn-primary mr-1 mb-2"> Thêm trường</button>

            </div>
            <!-- Nút tìm kiếm -->
            <div class="items-center sm:mr-4 mt-2 xl:mt-0">
                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Tên đợt</label>
                <input id="tabulator-html-filter-value" v-on:keyup="search(event)" type="text" class="  form-control sm:w-40 xxl:w-full mt-2 sm:mt-0" placeholder="Tìm kiếm...">
            </div>
            <div id="superlarge-modal-size-preview" class="modal " tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="    width: 50%;">
                    <div class="modal-content grid grid-cols-12">
                        <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                            <div class="preview col-span-12 grid grid-cols-12">
                                <div class=" col-span-12 grid grid-cols-12">
                                    <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                                    <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                        Trường báo cáo</label>

                                    <div class="w-full px-8 py-6 col-span-12 select-form">

                                        <select v-model="truongbaocao" class="form-control form-select px-3 w-full">
                                            <option value="0">-- Chọn trường báo cáo --</option>
                                            <option v-for="ds in dstbc" :value="ds.id">  @{{ds.name}}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Tên trường</label>
                                        <input v-model="tentruong" type="text" placeholder="Tên trường" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Mã</label>
                                        <input v-model="ma" type="text" placeholder="Mã" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div> 
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Loại dữ liệu</label>
                                        <input v-model="loaidulieu" type="text" placeholder="Loại dữ liệu" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="mt-3 px-8 py-6 col-span-12">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                        <div class="mt-2">
                                            <div data-simple-toolbar="true" v-model="mota" class="editor">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Kiểm chứng</label>
                                        <input v-model="kiemchung" type="text" placeholder="0" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Sử dụng</label>
                                        <input v-model="sudung" type="text" placeholder="1" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Link api</label>
                                        <input v-model="link" type="text" placeholder="Loại dữ liệu" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="col-span-12 flex ">

                                        <div class="px-5 pb-8 text-center mr-4"> <button v-on:click="luudot" class="btn btn-primary w-24 ">Lưu</button> </div>
                                        <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-primary w-24">Hủy</button> </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hết thêm đợt báo cáo -->
            <!-- END: Modal Toggle -->
            <!-- BEGIN: Modal Content -->

        </div>
        <!-- BEGIN: Dữ liẹu đổ ra bảng -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap text-center ">Tên trường báo cáo</th>
                        <th class="whitespace-nowrap text-center ">Mã</th>
                        <th class="text-center whitespace-nowrap">Trạng thái</th>
                        <th class="text-center w-3/12">Điều chỉnh</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="intro-x" v-for="dbc in thongtindbc">
                        <td class="w-40">
                            <a href="" class="font-medium whitespace-nowrap"> </a>
                            <div class="text-gray-600 text-sm whitespace-n  owrap mt-0.5">@{{dbc.name}} </div>
                        </td>
                      
                        <td class="text-center">  @{{dbc.ma}} </td>
                        <td class="w-40" >
                            <div class="flex items-center justify-center "  style="color: @{{dbc.check}};">
                                <i data-feather="check-square" class="w-4 h-4 mr-2" ></i>@{{dbc.trangthai1}}
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center"  v-model="baocao_id">
                                
                                <a class="mr-10" v-on:click="suadot(dbc.id) " href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview">
                                    Sửa
                                </a>
                                <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" v-on:click="xoa(dbc.id)">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Phân trang -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <ul class="pagination">
                <li v-if="phantrang.trangtruoc > 1">
                    <a class="pagination__link" href="javascript:;" v-on:click="hamphantrang(1, searchText)">
                        <i class="w-4 h-4" data-feather="chevrons-left"></i>
                    </a>
                </li>
                <li v-if="phantrang.tranghientai > 1">
                    <a class="pagination__link" href="javascript:;" v-on:click="hamphantrang(phantrang.trangtruoc,searchText)">
                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                    </a>
                </li>
                <li v-if="phantrang.trangtruoc > 1">
                    <a class="pagination__link" href="javascript:;">...</a>
                </li>
                <li v-if="phantrang.tranghientai != 1" v-on:click="hamphantrang(phantrang.trangtruoc,searchText)">
                    <a class="pagination__link" href="javascript:;">@{{phantrang.trangtruoc}}</a>
                </li>
                <li>
                    <a class="pagination__link pagination__link--active" href="">@{{phantrang.tranghientai}}</a>
                </li>
                <li>
                    <a class="pagination__link" href="javascript:;" v-on:click="hamphantrang(phantrang.trangtieptheo,searchText)">@{{phantrang.trangtieptheo}}</a>
                </li>
                <li v-if="phantrang.tranghientai < phantrang.tongtrang && phantrang.tongtrang>0">
                    <a class="pagination__link" href="javascript:;">...</a>
                </li>
                <li v-if="phantrang.tranghientai < phantrang.tongtrang && phantrang.tongtrang>0">
                    <a class="pagination__link" href="javascript:;" v-on:click="hamphantrang(phantrang.trangtieptheo,searchText)">
                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                    </a>
                </li>
                <li v-if="phantrang.tranghientai < phantrang.tongtrang && phantrang.tongtrang>0">
                    <a class="pagination__link" href="javascript:;" v-on:click="hamphantrang(phantrang.tongtrang,searchText)">
                        <i class="w-4 h-4" data-feather="chevrons-right"></i>
                    </a>
                </li>
            </ul>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
    </div>


    @endsection
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- tham khảo thông báo link https://github.com/shakee93/vue-toasted#usage -->
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        Vue.use(Toasted)
        var vm = new Vue({
            el: '#search',
            data: {

                truongbaocao: "0",
                tentruong: "",
                ma: "",
                loaidulieu: "",
                mota: "",
                kiemchung: "",
                sudung: "",
                link: "",
                dstbc: [],
                baocao_id: "",
                // Dữ liệu bảng
                thongtindbc: [],
                // Ô search
                searchText: "",
                // Dữ liệu trong form
                thongbao: "",
                id: '',       
                // Kiểm tra mở modal để sửa hay tạo mới
                checkluusua: '',
            
                value: [],
                // chức năng phân trang
                phantrang: {
                    tranghientai: 1,
                    trangtieptheo: '',
                    trangtruoc: '',
                    trangcuoi: '',
                    tongtrang: '',
                },
            },
            watch: {
               
            },
            mounted: function() {
                const self = this;
                self.hamphantrang(this.phantrang.tranghientai),           
                axios.get("/danhsachtbc?name=truongbaocaos" ).then(function(response) {
                    // handle success
                    self.dstbc = response.data;
                    console.log(self.baocao_id);
                });              
            },
            methods: {
                // hiends() {
                //     const self = this;
                //     axios .get("/hiendstbc?name=truongbaocaos" + "&baocao_id=" + self.baocao_id)
                //     .then(function (response) {            
                //         self.dstbc = response.data;
                //         console.log(self.baocao_id);
                //     });
                // },
                
                search: function(event) {
                    // Lấy giá trị value ô tìm kiếm
                    this.searchText = event.currentTarget.value
                    // Gọi đến hàm phân trang
                    this.hamphantrang(this.phantrang.tranghientai, event.currentTarget.value)
                },

                hamphantrang(tranghientai, search) {
                    const self = this;

                    if (!tranghientai) {
                        tranghientai = 1;
                    }
                    // Nếu không tìm kiếm thì gửi dữ liệu lên
                    if (!search) {
                        axios.get("/ajax-thongtin-truongbaocao?tranghientai=" + tranghientai + '&table=truongbaocaos')
                            .then(function(response) {
                                // Bắt dữ liệu trả về
                                self.thongtindbc = response.data.dbc;
                                self.phantrang.tongtrang = parseInt(response.data.sotrang);

                                // Từ trang hiện tại tính trang tiếp theo,trang trươc ...
                                self.phantrang.tranghientai = tranghientai;
                                if (self.phantrang.tranghientai < self.phantrang.tongtrang) {
                                    self.phantrang.trangtieptheo = self.phantrang.tranghientai + 1
                                } else {
                                    self.phantrang.trangtieptheo = null;
                                }
                                if (self.phantrang.tranghientai > 1) {
                                    self.phantrang.trangtruoc = self.phantrang.tranghientai - 1
                                } else {
                                    self.phantrang.trangtruoc = null;
                                }

                            });

                    }
                    // Có tìm kiếm gửi thêm search lên
                    else {
                        axios.get("/ajax-thongtin-truongbaocao?tranghientai=" + tranghientai + '&table=truongbaocaos' + '&search=' + search)
                            .then(function(response) {
                                console.log(search)
                                // Bắt dữ liệu trả về
                                self.thongtindbc = response.data.dbc;
                                self.phantrang.tongtrang = parseInt(response.data.sotrang);
                                // Từ trang hiện tại tính trang tiếp theo,trang trươc ...
                                self.phantrang.tranghientai = tranghientai;
                                if (self.phantrang.tranghientai < self.phantrang.tongtrang) {
                                    self.phantrang.trangtieptheo = self.phantrang.tranghientai + 1
                                } else {
                                    self.phantrang.trangtieptheo = null;
                                }
                                if (self.phantrang.tranghientai > 1) {
                                    self.phantrang.trangtruoc = self.phantrang.tranghientai - 1
                                } else {
                                    self.phantrang.trangtruoc = null;
                                }

                            });

                    }
                },
                // Hàm gọi thông báo thành công
                thongbaothanhcong(test) {
                    this.$toasted.show(test, {
                        type: 'success',
                        duration: 3000,
                        theme: 'toasted-primary'
                    })
                },
                // Hàm gọi thông báo thất bại
                thongbaothatbai(test) {
                    this.$toasted.show(test, {
                        type: 'error',
                        duration: 3000,
                        theme: 'toasted-primary'
                    })
                },
                // Hàm mở modal
                openmodal() {
                    const self = this;
                   // Khi mở(thêm mới) trả các giá trị về rỗng
                    self.id = '';
                    self.truongbaocao = '';
                    self.tentruong = '';
                    self.ma = '';
                    self.loaidulieu = '';
                    self.mota = '';
                    self.kiemchung = '';
                    self.sudung = '';
                    self.link = '';
                    self.checkluusua = 1;
                    cash('#superlarge-modal-size-preview').modal('show');

                },
                xoa(id) {
                    const self = this;
                    axios.get("/xoa-truong-bao-cao/" + id)
                        .then(function(response) {
                            // Gọi lại để load trang
                            self.hamphantrang(self.phantrang.tranghientai, self.searchText);
                            // Thông báo xóa thành công
                            self.thongbaothanhcong("Xóa thành công !!");
                        })
                        .catch(function(error) {
                            // Thông báo xóa thất bại
                            self.thongbaothatbai(error)
                        });
                },
                ////////////////// Sửa đợt báo cáo
                suadot(id) {
                    const self = this;
                    axios.get("/suatruongbaocao/" + id)
                        .then(function(response) {
                            // Đổ dữ liệu đã có vào fỏm
                            self.id = response.data['id'];
                            self.truongbaocao = response.data['truongbaocao_id'];
                            self.tentruong = response.data['name'];
                            self.ma = response.data['ma'];
                            self.loaidulieu = response.data['loaidulieu'];
                            self.mota = response.data['mota'];
                            self.kiemchung = response.data['kiemchung'];
                            self.sudung = response.data['sudung'];
                            self.link = response.data['linkapi'];

                            // gán biến check = 0 (mở để sửa)
                            self.checkluusua = 0;                     
                        });
                },
                /////////////////////Sửa lưu đơn
                ////////////////// Lưu đợt báo cáo
                luudot() {
                    const self = this;
                    // hàm thêm 
                    if (self.checkluusua == 1) {
                        axios.get("/tao-truong-bao-cao?truongbaocao=" + self.truongbaocao +
                                "&tentruong=" + self.tentruong + "&ma=" + self.ma +
                                "&loaidulieu=" + self.loaidulieu + "&mota=" + self.mota +
                                "&kiemchung=" + self.kiemchung + "&sudung=" + self.sudung + "&link=" + self.link
                            ).then(function(response) {
                                // Khi lưu xong trả về giá trị rỗng cho form
                                self.id = '';
                                self.truongbaocao = '';
                                self.tentruong = '';
                                self.ma = '';
                                self.loaidulieu = '';
                                self.mota = '';
                                self.kiemchung = '';
                                self.sudung = '';
                                self.link = '';
                                self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                                    cash('#superlarge-modal-size-preview').modal('hide');
                                self.thongbaothanhcong("Cập nhật thành công !!")

                            })
                            .catch(function(error) {
                                self.thongbaothatbai(error)
                            })
                    }
                    // hàm sửa
                    else {
                        axios.get("/sua-truong-bao-cao?truongbaocao=" + self.truongbaocao + "&id=" + self.id +
                        "&tentruong=" + self.tentruong + "&ma=" + self.ma +
                                "&loaidulieu=" + self.loaidulieu + "&mota=" + self.mota +
                                "&kiemchung=" + self.kiemchung + "&sudung=" + self.sudung + "&link=" + self.link
                            ).then(function(response) {
                                // Khi lưu xong trả về giá trị rỗng cho form
                                self.id = '';
                                self.truongbaocao = '';
                                self.tentruong = '';
                                self.ma = '';
                                self.loaidulieu = '';
                                self.mota = '';
                                self.kiemchung = '';
                                self.sudung = '';
                                self.link = '';
                                self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                                    cash('#superlarge-modal-size-preview').modal('hide');
                                self.thongbaothanhcong("Cập nhật thành công !!")
                            })
                            .catch(function(error) {
                                self.thongbaothatbai(error)
                            });
                    }

                },
            }
        })
    </script>
    @endsection