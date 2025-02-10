@extends('../layout/top-menu')

@section('subhead')
<title>CRUD Data List - Rubick - Tailwind HTML Admin Template</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('subcontent')
<div id="search">
    <h2 class="intro-y text-lg font-medium mt-10">Đợt báo cáo</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <!-- BEGIN: Modal Toggle -->
            <div class="text-center">
                <button v-on:click="openmodal()" class="btn btn-primary mr-1 mb-2"> Thêm đợt báo cáo</button>

            </div>
            <div id="superlarge-modal-size-preview" class="modal " tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="    width: 50%;">
                    <div class="modal-content grid grid-cols-12">
                        <div class="p-5 col-span-12 grid grid-cols-12" id="basic-datepicker ">
                            <div class="preview col-span-12 grid grid-cols-12">
                                <div class="validate-form col-span-12 grid grid-cols-12">
                                    <a data-dismiss="modal" href="javascript:;"> <i data-feather="x"
                                            class="w-8 h-8 text-gray-500"></i> </a>
                                    <label for=""
                                        class=" col-span-12 inline-block mb-4 mt-4 text-2xl text-center text-red-500 leading-tight">
                                        ĐỢT
                                        BÁO
                                        CÁO</label>

                                    <div class="w-full px-8 py-6 col-span-12 select-form">

                                        <select id="validation-form-1" v-model="bieubaocao"
                                            class="form-control form-select px-3 w-full">
                                            <option value="0">-- Chọn biểu báo cáo --</option>
                                            <option v-for="bbc in bieubc" :value="bbc.id"> @{{ bbc.name}}</option>
                                        </select>
                                    </div>
                                    <div class="w-full px-8 py-6 col-span-12">

                                        <select v-model="dotbaocao" class="form-control form-select px-3 w-full">
                                            <option value="0">-- Chọn đợt báo cáo --</option>
                                            <option v-for="dbc in dotbc" :value="dbc.id"> @{{ dbc.name}}</option>

                                        </select>
                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12  ">
                                        <label for="" class="inline-block text-lg mb-2leading-tight"> Tên đợt</label>
                                        <input id="validation-form-2" v-model="tendot" type="text" placeholder="Tên đợt"
                                            required class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>

                                    <div class="w-full col-span-12 px-8 py-6 ">
                                        <div class="w-full  mb-4  grid grid-cols-3 ">
                                            <button type="button" class="p-4 bg-red-500 rounded-lg mr-8"
                                                v-on:click="alltinh()">
                                                Chọn cấp tỉnh
                                            </button>
                                            <button type="button" class="p-4 bg-green-500 rounded-lg mr-8"
                                                v-on:click="allhuyen()">
                                                Chọn cấp huyện
                                            </button>
                                            <button type="button" class="p-4 bg-yellow-500 rounded-lg mr-8"
                                                v-on:click="allxa()">
                                                Chọn cấp xã
                                            </button>
                                        </div>
                                        <div class="w-full   grid grid-cols-3 px-8 py-6">
                                            <div class="" style="height: 200px; overflow: scroll">
                                                <div class="block">
                                                    <span class="text-gray-700">Cấp tỉnh</span>
                                                    <div class="mt-2">
                                                        <div v-for="(t, index) in captinh">
                                                            <label class="inline-flex items-center">
                                                                <input v-if="dataform.includes(t.id)" type="checkbox"
                                                                    class="form-checkbox" :value="t.macode"
                                                                    v-bind:checked=" true"
                                                                    @change="gettinh(t.id, index)" />
                                                                <input v-else type="checkbox" class="form-checkbox"
                                                                    :value="t.macode" v-bind:checked="chonalltinh"
                                                                    @change="gettinh(t.id, index)" />
                                                                <span class="ml-2">@{{ t.name }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="height: 200px; overflow: scroll">
                                                <div class="block">
                                                    <span class="text-gray-700">Cấp huyện</span>
                                                    <div class="mt-2">
                                                        <div v-for="(t, index) in caphuyen">
                                                            <label class="inline-flex items-center">
                                                                <input v-if="dataform.includes(t.id)" type="checkbox"
                                                                    class="form-checkbox" :value="t.macode"
                                                                    v-bind:checked=" true"
                                                                    @change="gethuyen(t.id, index)" />
                                                                <input v-else type="checkbox" class="form-checkbox"
                                                                    :value="t.macode" v-bind:checked="chonallhuyen"
                                                                    @change="gethuyen(t.id, index)" />
                                                                <span class="ml-2">@{{ t.name }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="height: 200px; overflow: scroll">
                                                <div class="block">
                                                    <span class="text-gray-700">Cấp xã</span>
                                                    <div class="mt-2">
                                                        <div v-for="(t, index) in capxa">
                                                            <label class="inline-flex items-center">
                                                                <input v-if="dataform.includes(t.id)" type="checkbox"
                                                                    class="form-checkbox" :value="t.macode"
                                                                    v-bind:checked=" true"
                                                                    @change="gettinh(t.id, index)" />
                                                                <input v-else type="checkbox" class="form-checkbox"
                                                                    :value="t.macode" v-bind:checked="chonallxa"
                                                                    @change="gettinh(t.id, index)" />
                                                                <span class="ml-2">@{{ t.name }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full px-8 py-6 col-span-12">
                                        <label for="" class="inline-block text-lg mb-2leading-tight">Kỳ dữ liệu</label>
                                        <select v-model="kydulieu" class="form-control form-select px-3 w-full">
                                            <option value="0">-- Kỳ dữ liệu --</option>
                                            <option v-for="kdl in kydl" :value="kdl.id"> @{{ kdl.name}}</option>
                                        </select>
                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12">
                                        <label for="" class="inline-block text-lg mb-2leading-tight"> Năm số
                                            liệu</label>
                                        <input v-model="namsl" type="number" placeholder="Năm số liệu"
                                            class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="mt-3 px-8 py-6 col-span-12">
                                        <label for="" class="inline-block text-lg mb-2leading-tight"> Mô tả đợt</label>
                                        <div class="mt-2">
                                            <div data-simple-toolbar="true" v-model="motadot" class="editor">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="px-8 py-6 w-full col-span-12">
                                        <input type="text" v-model="trangthai" placeholder="Trạng thái"
                                            class="w-full form-control px-3 form-input form-input-bordered">
                                    </div>
                                    <div class="col-span-12 flex ">

                                        <div class="px-5 pb-8 text-center mr-4"> <button
                                                class="btn btn-primary w-24 ">Lưu</button> </div>
                                        <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                                                class="btn btn-primary w-24">Hủy</button> </div>
                                    </div>

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
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Tên đợt báo cáo</th>
                    <th class="whitespace-nowrap">Đơn vị</th>
                    <th class="text-center whitespace-nowrap">Năm số liệu</th>
                    <th class="text-center whitespace-nowrap">Trạng thái</th>
                    <th class="text-center whitespace-nowrap">Điều chỉnh</th>
                </tr>
            </thead>
            <tbody>

                <tr class="intro-x" v-for="dbc in thongtindbc">
                    <td class="w-40">
                        <a href="" class="font-medium whitespace-nowrap"> </a>
                        <div class="text-gray-600 text-sm whitespace-n  owrap mt-0.5"> @{{dbc.name}} </div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-nowrap"> </a>
                        <div class="text-gray-600 text-sm whitespace-nowrap mt-0.5" v-for="db in dbc.namdv"
                            v-if="db != null">
                            @{{db.name}} </div>
                    </td>
                    <td class="text-center"> @{{dbc.namsolieu}} </td>
                    <td class="w-40">
                        <div class="flex items-center justify-center  @{{dbc.check}}" style="color: @{{dbc.check}}">
                            <i data-feather="check-square" class="w-4 h-4 mr-2" style="color: @{{dbc.check}}"></i>
                            @{{dbc.trangthai1}}
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="mr-10" v-on:click="suadot(dbc.id) " href="javascript:;" data-toggle="modal"
                                data-target="#superlarge-modal-size-preview">
                                Sửa
                            </a>
                            <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                                data-target="#delete-confirmation-modal" v-on:click="xoa(dbc.id)">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa
                            </a>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <ul class="pagination">
            <li>
                <a class="pagination__link" href="">
                    <i class="w-4 h-4" data-feather="chevrons-left"></i>
                </a>
            </li>
            <li>
                <a class="pagination__link" href="">
                    <i class="w-4 h-4" data-feather="chevron-left"></i>
                </a>
            </li>
            <li>
                <a class="pagination__link" href="">...</a>
            </li>
            <li>
                <a class="pagination__link" href="">1</a>
            </li>
            <li>
                <a class="pagination__link pagination__link--active" href="">2</a>
            </li>
            <li>
                <a class="pagination__link" href="">3</a>
            </li>
            <li>
                <a class="pagination__link" href="">...</a>
            </li>
            <li>
                <a class="pagination__link" href="">
                    <i class="w-4 h-4" data-feather="chevron-right"></i>
                </a>
            </li>
            <li>
                <a class="pagination__link" href="">
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
    <!-- BEGIN: Success Notification -->
    <!-- BEGIN: Notification Content -->
    <div id="success-notification-content" class="toastify-content hidden flex">
        <CheckCircleIcon class="text-theme-9" />
        <div class="ml-4 mr-4">
            <div class="font-medium">Message Saved!</div>
            <div class="text-gray-600 mt-1">
                The message will be sent in 5 minutes.
            </div>
        </div>
    </div>
    <!-- END: Notification Content -->
    <!-- BEGIN: Notification Toggle -->
    <button id="success-notification-toggle" class="btn btn-primary" @click="successNotificationToggle">
        Show Notification
    </button>
    <!-- END: Notification Toggle -->
</div>
<!-- END: Success Notification -->
</div>


@endsection
@section('script')

<script>
var vm = new Vue({
    el: '#search',
    data: {
        thongtindbc: [],
        searchText: "",
        thongbao: "",
        donvi: [],
        dotbaocao: "0",
        dotbc: [],
        bieubaocao: "0",
        bieubc: [],
        tendot: '',
        kydl: [],
        id: '',
        kydulieu: '0',
        namsl: '',
        motadot: '',
        trangthai: '',
        checkluusua: '',
        // Đơn vị
        checkalltinh: 1,
        chonalltinh: false,

        checkallhuyen: 1,
        chonallhuyen: false,

        checkallxa: 1,
        chonallxa: false,

        value: [],
        dataform: [],
        checktinh: [],
        checkhuyen: [],
        checkxa: [],
        captinh: [],
        caphuyen: [],
        capxa: [],
    },
    watch: {
        bieubaocao: function(newId) {
            const self = this;
            axios.get("/dot-bao-cao/" + newId).then(function(response) {
                // handle success
                self.dotbc = response.data;
            });

        },
    },
 
  
})
</script>
@endsection