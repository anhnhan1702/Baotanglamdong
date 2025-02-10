@extends('../layout/top-menu')

@section('subhead')
<title>Biểu báo cáo</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('subcontent')
<style>
    .tooltip {
        display: block !important;
        z-index: 10000;
    }

    .tooltip .tooltip-inner {
        background: black;
        color: white;
        border-radius: 16px;
        padding: 5px 10px 4px;
    }

    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
        border-color: black;
    }

    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }

    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }

    .tooltip[x-placement^="bottom"] .tooltip-arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent !important;
        border-right-color: transparent !important;
        border-top-color: transparent !important;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="right"] {
        margin-left: 5px;
    }

    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent !important;
        border-top-color: transparent !important;
        border-bottom-color: transparent !important;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }

    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent !important;
        border-right-color: transparent !important;
        border-bottom-color: transparent !important;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .tooltip[aria-hidden='true'] {
        visibility: hidden;
        opacity: 0;
        transition: opacity .15s, visibility .15s;
    }

    .tooltip[aria-hidden='false'] {
        visibility: visible;
        opacity: 1;
        transition: opacity .15s;
    }
</style>
<div id="search123">
    <h2 class="intro-y text-lg font-medium mt-10 border-b">Biểu báo cáo</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <!-- BEGIN: Modal Toggle -->
            
            <div class=" w-full">
                <button v-on:click="openmodal()" class="btn btn-primary mr-1 mb-2"> Thêm mới</button>
            </div>

            <!-- Nút tìm kiếm -->
            <div class=" text-right w-full sm:mr-4 mt-2 xl:mt-0">
                <label class=" flex-none xl:w-auto xl:flex-initial mr-2">Tìm kiếm</label>
                <input id="tabulator-html-filter-value" v-on:keyup="search(event)" type="text" class="  form-control sm:w-40 xxl:w-full mt-2 sm:mt-0" placeholder="Tìm kiếm...">
            </div>
            
            <div id="superlarge-modal-size-preview" class="modal " tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="width: 50%;">
                    <div class="modal-content grid grid-cols-12">
                        <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                            <div class="preview col-span-12 grid grid-cols-12">
                                <div class=" col-span-12 grid grid-cols-12">
                                    <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                                    <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                        Thêm mới</label>

                                    
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Tên biểu cáo cáo</label>
                                        <input v-model="name" type="text" placeholder="Tên biểu báo cáo" class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="mt-3 px-8 py-6 col-span-12">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                     

                                        <textarea id="w3review" v-model="mota" placeholder="Nhập mô tả" class="border border-gray-400 w-full text-gray-600 px-2 py-2" name="w3review" rows="4" cols="50">
                                        </textarea>
                                        <!-- <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả </label>
                                        <div class="mt-2">
                                            <div data-simple-toolbar="true" v-model="mota" class="editor">
                                            </div>
                                        </div> -->


                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2 leading-tight"> Sử dụng: </label>
                                        <input v-model="checksudung" type="checkbox">
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
        </div>
        <!-- form hiển thị -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center text-base w-1/12 ">STT</th>
                        <!-- <th class="w-4/12 text-center ">Đơn vị</th> -->
                        <th class="text-justify text-base w-7/12  ">Tên đợt báo cáo</th>
                        <th class="text-center text-base w-2/12">Trạng thái</th>
                        <th class="text-center text-base w-2/12">Chức năng</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="intro-x" v-for="(dbc, index) in thongtinhd">
                        <td class="">
                            <a class="font-medium whitespace-nowrap">
                            <div class="text-gray-600 text-sm whitespace-n text-base text-center owrap mt-0.5"> @{{index + 1}} </div> </a>
                        </td>
                        <td class="w-40">
                            <a v-bind:href="'/bao-cao/'+ dbc.id" class="font-medium whitespace-nowrap">
                            <div class="text-gray-600 text-sm whitespace-n text-base owrap mt-0.5"> @{{dbc.name}} </div> </a>
                        </td>
                        
                        
                        <td class="w-40 ">
                            <div class="flex items-center justify-center text-base" v-bind:style="{ color: dbc.check,}">
                                <i data-feather="check-square" class="w-4 h-4 mr-2 "    ></i>
                                @{{dbc.trangthai}}
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">

                                <a v-tooltip="{ content: 'Chọn nhóm trường' }" v-on:click="chonnhomtruong(dbc.id)" class="mr-10 z-50 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>

                                </a>
                                <a class="mr-10" v-on:click="suadot(dbc.id) " href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview">
                                    <svg v-tooltip="{ content: 'Sửa biểu' }" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit block mx-auto">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <a class="flex items-center text-theme-6" v-on:click="hienxoa()" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" >
                                    <svg v-tooltip="{ content: 'Xóa biểu' }" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 block mx-auto">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </a>
                                <div id="hienxoa" class="modal " tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" style="width: 30%;">
                                        <div class="modal-content grid grid-cols-12">
                                            <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                                                <div class="preview col-span-12 grid grid-cols-12">
                                                    <div class=" col-span-12 grid grid-cols-12">
                                                        
                                                        <div class="  col-span-12 text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-theme-6"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                        </div>
                                                        <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                                            Bạn có chắc chắn muốn xóa?</label>

                                                        <div class="col-span-12 flex text-center">
                                                            <div class="pl-14 pb-8 text-center "> <button v-on:click="xoa(dbc.id)" data-dismiss="modal"  class="button w-24 bg-theme-6 py-2 rounded font-bold text-white text-base">Xóa</button> </div>
                                                            <div class="pl-14 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 py-2 rounded font-bold mr-1 text-base">Hủy</button> </div>
                                                        </div>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="chonnhomtruong" class="modal " tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" style="width: 75%;">
                                        <div class="modal-content grid grid-cols-12">
                                            <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                                                <div class="preview col-span-12 grid grid-cols-12">
                                                    <div class=" col-span-12 grid grid-cols-12">
                                                        <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                                                        <label for="" class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                                            Chọn nhóm trường báo cáo</label>
                                                            <div class="px-8  w-full col-span-12 mb-1 text-base ">

                                                            <div class=" col-span-12 grid grid-cols-12">
                                                                <div class="col-span-7">
                                                                <label for="" class="inline-block text-lg mb-2 leading-tight text-left">Nhóm đơn vị: </label>
                                                                <select v-model="donvi" class="form-control form-select px-3 w-full border-gray-500 px-4 text-gray-800 hover:border-blue-600" style="width: 300px; height: 35px; ">
                                                                    <option value="0">-- Chọn nhóm --</option>
                                                                    <option  v-for="dv in nhomdv" :value="dv.id" > @{{dv.name}} </option>
                                                                </select>
                                                                </div>
                                                                <div class="text-right mb-2 relative col-span-5">
                                                                    <input type="text" class="border-gray-500 px-4 text-gray-500 hover:border-blue-600 border rounded-lg" style="width: 300px; height: 35px; " placeholder="Tìm kiếm...">                                        
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  style="right: 7px; top:5px; " width="24" height="24" viewBox="0 0 24 24" fill="none"  stroke="#006dff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search absolute"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                                </div>
                                                            </div>
                                                            <form>
                                                                <div v-for="tr in nhomtruong" class="text-justify"  >
                                                                <input type="checkbox" v-model="tr.trangthai">
                                                                <label > @{{tr.tentruong}}</label><br>
                                                                </div>
                                                                <hr class="border-t border-gray-400">
                                                                <div v-for="tt in nhomtruongtrong" class="text-justify mt-2 "  >
                                                                <input type="checkbox" v-model="tt.trangthai" v-on:click="themnhom(tt.id)">
                                                                <label  > @{{tt.name}}</label><br>
                                                                </div>
                                                                
                                                            </form>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>

               
            </table>
            
        </div>
    <!-- BEGIN: Pagination -->
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
</div>


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- tham khảo thông báo link https://github.com/shakee93/vue-toasted#usage -->
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/popper.js"></script>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/v-tooltip@2.0.2"></script>
<script>
    Vue.use(Toasted)
    var vm = new Vue({
        el: '#search123',
        data: {
            id: '',
            thongtinhd: [],
            searchText: "",
            thongbao: "",    
            checkluusua: '',
            // Đơn vị 
            value: [],  
            xoabieu: "",
            phantrang:{
                tranghientai : 1,
                trangtieptheo :'',
                trangtruoc : '',
                trangcuoi: '',
                tongtrang:'',
            },
            name:'',
            checksudung: 0,
            mota:'',
            name:'',
            nhomtruong:[],
            nhomtruongtrong:[],
            bieu_id: '',
            donvi:'',
            nhomdv:[],
        },
        watch: {
           
        },
        mounted: function() {
            
            const self = this;
            self.hamphantrang(this.phantrang.tranghientai),
            
            // NHóm đơn vị
            axios.get("/ajax-nhom-dv?name=nhomdonvis").then(function(response) {
            self.nhomdv = response.data;
      });

          
            
        },
        methods: {
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
                if (!search) {
                axios.get("/ajax-thongtin-bieubaocao?tranghientai=" + tranghientai + '&table=bieubaocaos' )
                    .then(function(response) {
                        self.thongtinhd = response.data.dbc;
                        self.phantrang.tranghientai = tranghientai;
                        self.phantrang.tongtrang =  parseInt(response.data.sotrang);
                        if(self.phantrang.tranghientai <  self.phantrang.tongtrang)
                        {
                            self.phantrang.trangtieptheo =   self.phantrang.tranghientai + 1
                        }
                        else{
                            self.phantrang.trangtieptheo = null;
                        }
                        if(self.phantrang.tranghientai > 1)
                        {
                            self.phantrang.trangtruoc =   self.phantrang.tranghientai - 1
                        }
                        else{
                            self.phantrang.trangtruoc = null;
                        }
                    });
                }
                else {
                    axios.get("/ajax-thongtin-hopdong?tranghientai=" + tranghientai + '&table=bieubaocaos' + '&search=' + search)
                        .then(function(response) {
                            console.log(search)
                            // Bắt dữ liệu trả về
                            self.thongtinhd = response.data.dbc;
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
            thongbaothanhcong() {
                this.$toasted.show("Cập nhật thành công !!", {
                    type: 'success',
                    duration: 3000,
                    theme: 'toasted-primary'
                })
            },
            thongbaothatbai(test) {
                this.$toasted.show(test, {
                    type: 'error',
                    duration: 3000,
                    theme: 'toasted-primary'
                })
            },
            xoathanhcong() {
                this.$toasted.show("Xóa văn bản thành công !!", {
                    type: 'success',
                    duration: 3000,
                    theme: 'toasted-primary'
                })
            },
            openmodal() {
                const self = this;
                self.id = '';
                self.name = '';
                self.dotbaocao = '';
                self.mota = '';
                self.checksudung = 1;
                    
                self.checkluusua = 1;
                cash('#superlarge-modal-size-preview').modal('show');

            },

            hienxoa(id){
                const self = this;
                cash('#hienxoa').modal('show');
            },
            xoa(id) {
                
                const self = this;
               
                axios.get("/xoabbc?xoaid=" + id)
                    .then(function(response) {
                        self.xoathanhcong();
                        self.hamphantrang();
                        // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                        //     cash('#superlarge-modal-size-preview').modal('hide');
                });
                console.log(id)
            },
            

            ////////////////// Sửa văn bản
            suadot(id) {
                const self = this;
                axios.get("/hienthisuabbc/" + id)
                    .then(function(response) {
                        self.id = response.data['id'];
                        self.name = response.data['name'];
                        self.mota = response.data['mota'];
                        self.checksudung = response.data['sudung'];
                        
                        self.checkluusua = 0;
                       
                    });
            },

            themnhom(id){
                const self = this;
                axios.get("/ajax-them-nhomtruong-baocao?id=" + id + "&bieu_id=" +  self.bieu_id)
                .then(function (response) {
                  //console.log( self.nhomtruong_id);
                    self.data = response.data;
                    self.$toasted.success(response.data.message);
                    self.$forceUpdate();
                });
            },

            chonnhomtruong(id) {
                console.log(id);
                const self = this;
                axios.get("/danh-sach-bbc/" + id).then(function(response) {
                    self.bieu_id = id;
                    console.log(self.bieu_id);
                    self.nhomtruong = response.data['nhomtruong'];
                    self.nhomtruongtrong = response.data['nhomtruongtrong'];
                });
                cash('#chonnhomtruong').modal('show');

            },
            /////////////////////Sửa lưu văn bản
            ////////////////// Lưu văn bản
            luudot() {
                const self = this;
                // hàm thêm 
                if (self.checkluusua == 1) {
                    axios.get("/tao-bieu-bao-cao?name=" + self.name +
                            "&mota=" + self.mota + "&sudung=" + self.checksudung 
                        ).then(function(response) {
                            // handle success
                            self.id = '';
                            self.name = '';
                            self.mota = '';
                            self.checksudung = 0;
                         
                            self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            cash('#superlarge-modal-size-preview').modal('hide');
                            self.thongbaothanhcong()

                        })
                        .catch(function(error) {
                            self.thongbaothatbai(error)
                        })
                } 
                // hàm sửa
                else {
                    axios.get("/sua-bieu-bao-cao?name=" + self.name +  "&id=" + self.id + "&mota=" + self.mota + "&sudung=" + self.checksudung 
                   
                        ).then(function(response) {
                            // handle success
                            self.id = '';
                            self.name = '';
                            self.mota = '';
                            self.checksudung = 0;
                            self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            cash('#superlarge-modal-size-preview').modal('hide');
                            self.thongbaothanhcong()
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