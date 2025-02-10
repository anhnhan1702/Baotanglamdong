@extends('../layout/top-menu')

@section('subhead')
    <title>Inbox - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div id="search122" class="grid grid-cols-12 gap-6 mt-8">
        <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
            <button type="button" v-on:click="openmodal()" class="btn text-white hover dark:text-gray-300 mt-2 w-full  bg-theme-1 mt-1">
                <i class="w-4 h-4 mr-2" data-feather="edit-3"></i> Thêm nhóm
            </button>
            <div id="superlarge-modal-size-preview" class="modal " tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="width: 50%;">
                    <div class="modal-content grid grid-cols-12">
                        <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                            <div class="preview col-span-12 grid grid-cols-12">
                                <div class=" col-span-12 grid grid-cols-12">
                                    <a data-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                                    
                                        <div class="px-8 py-6 w-full col-span-12  ">
                                        <div class="tab overflow-hidden border border-red-600 " style=" background-color: #f1f1f1;">
                                            <button class="tablinks bg-red-700 font-bold text-white" style="  float: left; border: none;  outline: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; font-size: 17px;" onclick="openCity(event, 'London')" id="defaultOpen">Thêm mới</button>
                                            
                                            <button  class="tablinks bg-red-700 font-bold text-white" style="  float: left; border: none;  outline: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; font-size: 17px;" onclick="openCity(event, 'Paris')">Sửa đổi</button>
                                            
                                            <button  class="tablinks bg-red-700 font-bold text-white" style="  float: left; border: none;  outline: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; font-size: 17px;" onclick="openCity(event, 'Tokyo')">Xóa</button>
                                        </div>
                                    <div id="London" class="tabcontent border border-red-600 " style="display: none; padding: 6px 12px;  border-top: none;">
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Tên nhóm </label>
                                                <input v-model="name" type="text" placeholder="Tên nhóm" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Mã</label>
                                                <input v-model="ma" type="text" placeholder="Mã" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                            
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm đơn vị</label>
                                                <select v-model="donvi" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm --</option>
                                                    <option  v-for="qd in quyetdinhgd" :value="qd.id" > @{{qd.name}} </option>
                                                </select>
                                            </div>
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm trường báo cáo</label>
                                                <select v-model="truongbc" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm --</option>
                                                    <option  v-for="bc in nhomtruongbc" :value="bc.id"> @{{bc.name}}</option>
                                                </select>
                                            </div>
                                            
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                                <input v-model="mota" type="text" placeholder="Mô tả" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Sử dụng</label>
                                                <input v-model="sudung" type="text" placeholder="1" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                    
                                            <div class="col-span-12 flex ">
                                                <div class="px-5 pb-8 text-center mr-4"> <button v-on:click="luunhom" class="btn btn-primary w-24 ">Lưu</button> </div>
                                                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-primary w-24">Hủy</button> </div>
                                            </div>
                                    
                                        </div>
                                    <div id="Paris" class="tabcontent border border-red-600" style="display: none; padding: 6px 12px;  border-top: none;">
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm trường báo cáo</label>
                                                <select @change="suanhomtruong()" v-model="nhomtruong_id" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm muốn sửa--</option>
                                                    <option  v-for="bc in nhomtruongbc" :value="bc.id"> @{{bc.name}}</option>
                                                </select>
                                            </div> 
                                    
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Mã</label>
                                                <input v-model="ma1" type="text" placeholder="Mã" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                            
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm đơn vị</label>
                                                <select v-model="donvi1" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm --</option>
                                                    <option  v-for="qd in quyetdinhgd" :value="qd.id" > @{{qd.name}} </option>
                                                </select>
                                            </div>
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm trường báo cáo</label>
                                                <select v-model="truongbc1" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm --</option>
                                                    <option  v-for="bc in nhomtruongbc" :value="bc.id"> @{{bc.name}}</option>
                                                </select>
                                            </div>
                                            
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Mô tả</label>
                                                <input v-model="mota1" type="text" placeholder="Mô tả" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                            <div class="px-8 py-6 w-full col-span-12  ">
                                                <label for="" class="inline-block text-lg mb-2 leading-tight"> Sử dụng</label>
                                                <input v-model="sudung1" type="text" placeholder="1" class="w-full form-control px-3 form-input form-input-bordered">
                                            </div>
                                    
                                            <div class="col-span-12 flex ">
                                                <div class="px-5 pb-8 text-center mr-4"> <button v-on:click="luusua()"  class="btn btn-primary w-24 ">Lưu</button> </div>
                                                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-primary w-24">Hủy</button> </div>
                                            </div>
                                    </div>
                                    <div id="Tokyo" class="tabcontent border border-red-600" style="display: none; padding: 6px 12px;  border-top: none;">
                                            <div class="w-full px-8 py-6 col-span-12">
                                                <label for="" class="inline-block text-lg mb-2leading-tight">Nhóm trường báo cáo</label>
                                                <select @change="xoanhomtruong()" v-model="nhomtruong1_id" class="form-control form-select px-3 w-full">
                                                    <option value="0">-- Chọn nhóm muốn xóa--</option>
                                                    <option  v-for="bc in nhomtruongbc" :value="bc.id"> @{{bc.name}}</option>
                                                </select>
                                            </div> 
                                            <div class="col-span-12 flex ">
                                                <div class="px-5 pb-8 text-center mr-4"> <button v-on:click="xoanhom()" class="btn btn-primary w-24 ">Xóa</button> </div>
                                                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-primary w-24">Hủy</button> </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <nhomtruong></nhomtruong> -->
            <!-- BEGIN: Inbox Menu -->
            <div class="intro-y box  p-5 mt-6">
                
                <div class="border-b border-theme-3 dark:border-dark-5 text-gray-700">
                   <!-- <div v-for="tk in thongkenhom">
                    <a href=""   class="flex items-center px-3 py-2 mt-2 rounded-md truncate"> -->
                        <!-- <div class="w-2 h-2 bg-theme-9 rounded-full mr-3">@{{ tk.name }}</div>  -->
                     
                        <nhomtruong></nhomtruong>
                    <!-- </a>
                    </div> -->
                
                </div>
                <button type="button" class="btn text-white hover dark:text-gray-300 mt-2 w-full  bg-theme-1 mt-1">
                    <i class="w-4 h-4 mr-2" data-feather="activity"></i> Chọn nhóm
                </button>
                
            </div>

            <!-- END: Inbox Menu -->
        </div>
        <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
            <!-- BEGIN: Inbox Filter -->
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300" data-feather="search"></i>
                    <input type="text" class="form-control w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13" placeholder="Search mail">
                    <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center" data-placement="bottom-start">
                        <i class="dropdown-toggle w-4 h-4 cursor-pointer text-gray-700 dark:text-gray-300" role="button" aria-expanded="false" data-feather="chevron-down"></i>
                        <div class="inbox-filter__dropdown-menu dropdown-menu pt-2">
                            <div class="dropdown-menu__content box p-5">
                                <div class="grid grid-cols-12 gap-4 gap-y-3">
                                    <div class="col-span-6">
                                        <label for="input-filter-1" class="form-label text-xs">From</label>
                                        <input id="input-filter-1" type="text" class="form-control flex-1" placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-2" class="form-label text-xs">To</label>
                                        <input id="input-filter-2" type="text" class="form-control flex-1" placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-3" class="form-label text-xs">Subject</label>
                                        <input id="input-filter-3" type="text" class="form-control flex-1" placeholder="Important Meeting">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-4" class="form-label text-xs">Has the Words</label>
                                        <input id="input-filter-4" type="text" class="form-control flex-1" placeholder="Job, Work, Documentation">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-5" class="form-label text-xs">Doesn't Have</label>
                                        <input id="input-filter-5" type="text" class="form-control flex-1" placeholder="Job, Work, Documentation">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-6" class="form-label text-xs">Size</label>
                                        <select id="input-filter-6" class="form-select flex-1">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>35</option>
                                            <option>50</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 flex items-center mt-3">
                                        <button class="btn btn-secondary w-32 ml-auto">Create Filter</button>
                                        <button class="btn btn-primary w-32 ml-2">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-auto flex">
                    <button class="btn btn-primary shadow-md mr-2">Start a Video Call</button>
                    <div class="dropdown">
                        <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                            <span class="w-5 h-5 flex items-center justify-center">
                                <i class="w-4 h-4" data-feather="plus"></i>
                            </span>
                        </button>
                        <div class="dropdown-menu w-40">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i data-feather="user" class="w-4 h-4 mr-2"></i> Contacts
                                </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                    <i data-feather="settings" class="w-4 h-4 mr-2"></i> Settings
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Inbox Filter -->
            <!-- BEGIN: Inbox Content -->
            <div class="intro-y inbox box mt-5">
                <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
                    <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                        <input class="form-check-input" type="checkbox">
                        <div class="dropdown ml-1" data-placement="bottom-start">
                            <a class="dropdown-toggle w-5 h-5 block dark:text-gray-300" href="javascript:;" aria-expanded="false">
                                <i data-feather="chevron-down" class="w-5 h-5"></i>
                            </a>
                            <div class="dropdown-menu w-32">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">All</a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">None</a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Read</a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Unread</a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Starred</a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Unstarred</a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300">
                            <i class="w-4 h-4" data-feather="refresh-cw"></i>
                        </a>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300">
                            <i class="w-4 h-4" data-feather="more-horizontal"></i>
                        </a>
                    </div>
                    <div class="flex items-center sm:ml-auto">
                        <div class="dark:text-gray-300">1 - 50 of 5,238</div>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300">
                            <i class="w-4 h-4" data-feather="chevron-left"></i>
                        </a>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300">
                            <i class="w-4 h-4" data-feather="chevron-right"></i>
                        </a>
                        <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center dark:text-gray-300">
                            <i class="w-4 h-4" data-feather="settings"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto sm:overflow-x-visible">
                    @foreach ($fakers as $faker)
                        <div class="intro-y">
                            <div class="inbox__item{{ $faker['true_false'][0] ? ' inbox__item--active' : '' }} inline-block sm:block text-gray-700 dark:text-gray-500 bg-gray-100 dark:bg-dark-1 border-b border-gray-200 dark:border-dark-1">
                                <div class="flex px-5 py-3">
                                    <div class="w-72 flex-none flex items-center mr-5">
                                        <input class="form-check-input flex-none" type="checkbox" {{ !$faker['true_false'][0] ? 'checked' : '' }}>
                                        <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-gray-500">
                                            <i class="w-4 h-4" data-feather="star"></i>
                                        </a>
                                        <a href="javascript:;" class="w-5 h-5 flex-none ml-2 flex items-center justify-center text-gray-500">
                                            <i class="w-4 h-4" data-feather="bookmark"></i>
                                        </a>
                                        <div class="w-6 h-6 flex-none image-fit relative ml-5">
                                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
                                        </div>
                                        <div class="inbox__item--sender truncate ml-3">{{ $faker['users'][0]['name'] }}</div>
                                    </div>
                                    <div class="w-64 sm:w-auto truncate">
                                        <span class="inbox__item--highlight">{{ $faker['news'][0]['super_short_content'] }}</span> {{ $faker['news'][0]['short_content'] }}
                                    </div>
                                    <div class="inbox__item--time whitespace-nowrap ml-auto pl-10">{{ $faker['times'][0] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
                    <div class="dark:text-gray-300">4.41 GB (25%) of 17 GB used Manage</div>
                    <div class="sm:ml-auto mt-2 sm:mt-0 dark:text-gray-300">Last account activity: 36 minutes ago</div>
                </div>
            </div>
            <!-- END: Inbox Content -->
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- tham khảo thông báo link https://github.com/shakee93/vue-toasted#usage -->
<script src="https://unpkg.com/vue-toasted"></script>
<script src="./js/data-nhomtruong.js"></script>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
      
</script>
<script>
    Vue.use(Toasted)
    var vm = new Vue({
        el: '#search122',
        data: {
            name: "",
            ma: "",
            donvi: "0",
            truongbc: "0",
            mota: "",
            sudung: "",
            nhomtruongbc:[],
            suatruongbc: "0",
            name1: "",
            ma1: "",
            donvi1: "0",
            truongbc1: "0",
            mota1: "",
            sudung1: "",
            nhomtruong_id: "",
            id: '',
            nhomtruong1_id: "",
            bieuBaoCao_id: "",
            thongkenhom: [],
            bieubc_id: "",  

            
            thongtinhd: [],
            searchText: "",
            thongbao: "",
            id: '',     
            checkluusua: '',
            // Đơn vị 
            value: [],  
            phantrang:{
                tranghientai : 1,
                trangtieptheo :'',
                trangtruoc : '',
                trangcuoi: '',
                tongtrang:'',
            },
            quyetdinhgd: [],
            thuadatchothue:[],
            thoihanthue:[],
            mucdichthue:[],
            quyetdinh: '0',
            thuadat: '0',
            thoihan: '0',
            mucdich: '0',
            name:'',
            giadat:'',
            ngayapdung:'',
            sudung: 1,
            mota:'',
            name:'',
           
        },
        watch: {
           
        },
        mounted: function() {
            let uri = window.location.search.substring(1);
            let params = new URLSearchParams(uri);
            this.bieubc_id = params.get("bieubc");

            const self = this;
            // self.hamphantrang(this.phantrang.tranghientai),

            axios.get("/nhomdonvitbc?name=nhomdonvis").then(function(response) {
                // handle success
                self.quyetdinhgd = response.data;
            });
            axios.get("/nhomtruongbctbc?name=nhomtruongbaocaos").then(function(response) {
                // handle success
                self.nhomtruongbc = response.data;
            });
            axios.get("/nhom-truong-bao-cao?bieubc_id=" + self.bieubc_id)
                    .then(function(response) {
                        self.thongkenhom = response.data;
                        console.log( response.data);
                        // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            // cash('#superlarge-modal-size-preview').modal('hide');
            });

            axios.get("/thongkenhomtruongbc?bieuBaoCao_id=" + self.bieuBaoCao_id +  '&table=bieubaocao_nhomtruongbaocao')
                .then(function(response) {
                    self.thongkenhom = response.data;
                    console.log( response.data);
                    // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                        // cash('#superlarge-modal-size-preview').modal('hide');
            });
            
        },
        methods: {
            search: function(event) {
                // Lấy giá trị value ô tìm kiếm
                this.searchText = event.currentTarget.value
                // Gọi đến hàm phân trang
                // this.hamphantrang(this.phantrang.tranghientai, event.currentTarget.value)
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
                
                self.checkluusua = 1;
                cash('#superlarge-modal-size-preview').modal('show');

            },
           
            reload() {
                const self = this;
                axios.get("/nhomtruongbctbc?name=nhomtruongbaocaos").then(function(response) {
                // handle success
                self.nhomtruongbc = response.data;
            
                });
            },

            xoanhom() {
                const self = this;
                axios.get("/xoanhomtruongbc?nhomtruong1_id=" + self.nhomtruong1_id)
                    .then(function(response) {
                        self.xoathanhcong();
                        self.reload();
                        // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            // cash('#superlarge-modal-size-preview').modal('hide');
                });
            },
            

            ////////////////// Sửa văn bản
            suadot(id) {
                const self = this;
                axios.get("/hienthisuabbc/" + id)
                    .then(function(response) {
                        self.id = response.data['id'];
                        self.name = response.data['name'];
                        self.mota = response.data['mota'];
                        self.sudung = response.data['sudung'];
                        
                        self.checkluusua = 0;
                       
                    });
            },
            /////////////////////Sửa lưu văn bản
            ////////////////// Lưu văn bản
            luunhom() {
                const self = this;
                    axios.get("/tao-nhomtruong-baocao?name=" + self.name +"&ma=" + self.ma + "&donvi=" + self.donvi +"&truongbc=" + self.truongbc +
                            "&mota=" + self.mota + "&sudung=" + self.sudung 
                        ).then(function(response) {
                            // handle success
                            self.id = '';
                            self.name = '';
                            self.ma = '';
                            self.donvi = '';
                            self.truongbc = '';
                            self.mota = '';
                            self.sudung = '';
                         
                            // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            // cash('#superlarge-modal-size-preview').modal('hide');
                            self.thongbaothanhcong()
                            self.reload();
                        })
                        .catch(function(error) {
                            self.thongbaothatbai(error)
                        })
            }, 

            luusua() {
                const self = this;
                    axios.get("/luu-sua-nhom-truong?nhomtruong_id=" + self.nhomtruong_id +"&id=" + self.id  +"&name=" + self.name1+ "&ma=" + self.ma1 + "&donvi=" + self.donvi1 +"&truongbc=" + self.truongbc1 +
                            "&mota=" + self.mota1 + "&sudung=" + self.sudung1
                        ).then(function(response) {
                            // handle success
                            self.id = '';
                            self.name1 = '';
                            self.ma1 = '';
                            self.donvi1 = '';
                            self.truongbc1 = '';
                            self.mota1 = '';
                            self.sudung1 = '';
                         
                            // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
                            // cash('#superlarge-modal-size-preview').modal('hide');
                            self.thongbaothanhcong()

                        })
                        .catch(function(error) {
                            self.thongbaothatbai(error)
                        })
                        self.reload();
            }, 
            suanhomtruong() {
                const self = this;
                axios.get("/ajax-suanhomtruong?nhomtruong_id=" + self.nhomtruong_id  )
                    .then(function (response) {
                        
                        self.id = response.data['id'];
                        self.name1 = response.data['name'];
                        self.ma1 = response.data['ma'];
                        self.donvi1 = response.data['nhomdonvi_id'];
                        self.truongbc1 = response.data['nhomtruongbaocao_id'];
                        self.mota1 = response.data['mota'];
                        self.sudung1 = response.data['sudung'];
                    });

            },
            xoanhomtruong() {
                const self = this;
                axios.get("/ajax-suanhomtruong?nhomtruong1_id=" + self.nhomtruong1_id  )
                    .then(function (response) {
                        
                        self.id = response.data['id'];
                        self.name1 = response.data['name'];
                        self.ma1 = response.data['ma'];
                        self.donvi1 = response.data['nhomdonvi_id'];
                        self.truongbc1 = response.data['nhomtruongbaocao_id'];
                        self.mota1 = response.data['mota'];
                        self.sudung1 = response.data['sudung'];
                    });

            },
            
            // nhomtruong() {
            //     const self = this;
            //     axios.get("/thongkenhomtruongbc?bieuBaoCao_id=8" +  '&table=bieubaocao_nhomtruongbaocao')
            //         .then(function(response) {
            //             self.thongkenhom = response.data;
            //             console.log( response.data);
            //             // self.hamphantrang(self.phantrang.tranghientai, self.searchText),
            //                 // cash('#superlarge-modal-size-preview').modal('hide');
            //     });
            // },
        }
    })
</script>
<style>
        .tab button:hover {
    background-color: #05c1b9;
    }

    /* Create an active/current tablink class */
    .tab button.active {
    background-color: #05c1b9;
    }
</style>
@endsection