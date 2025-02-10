@extends('../layout/top-menu')

@section('subhead')
<title>Tổng Hợp</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


@endsection

@section('subcontent')
<style>
.loader {
    border-top-color: #3498db;
    -webkit-animation: spinner 1.5s linear infinite;
    animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>

<div id="xuatdulieu">
    <h2 class="intro-y text-lg font-medium mt-10 border-b">Xuất Dữ Liệu</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

            <!-- Nút chọn nhóm Đơn Vị  -->
            <div class=" text-right w-3/12 sm:mr-4 mt-2 xl:mt-0">
                <select class="form-control form-select px-3 w-full" v-model="nhomdonvi_id">
                    <option value="">-- Nhóm Đơn Vị --</option>
                    <option v-for="dtndv in dtnhomdonvi" :value="dtndv.id">
                        @{{ dtndv.name }}
                    </option>
                </select>
                <div v-if="valinhomdonvi" class="w-full text-left mt-2">
                    <span class="font-normal italic text-red-500 ">Bạn chưa chọn mục này!</span>
                </div>
            </div>

            <!-- Nút chọn đợt báo cáo  -->
            <div class=" text-right w-3/12 sm:mr-4 mt-2 xl:mt-0">
                <select class="form-control form-select px-3 w-full" v-model="dotbaocao_id">
                    <option value="">-- Đơt báo cáo --</option>
                    <option v-for="dtdbc in dtdotbaocao" :value="dtdbc.id">
                        @{{ dtdbc.name }}
                    </option>

                </select>
                <div v-if="validotbaocao" class="w-full text-left mt-2">
                    <span class="font-normal italic text-red-500 ">Bạn chưa chọn mục này!</span>
                </div>
            </div>

            <div class="w-3/12 ">
                <button v-on:click="tracuudulieu" class="btn btn-primary mr-1 mb-2"> Xem kết quả</button>
            </div>

            <div v-if="check">
                <div wire:loading class="
              fixed
              top-12
              left-0
              right-0
              bottom-0
              w-full
              h-36
              z-50
              overflow-hidden
              bg-gray-700
              opacity-75
              flex flex-col
              items-center
              justify-center
          
            ">
                    <div class="
                loader
                ease-linear
                rounded-full
                border-4 border-t-4 border-gray-200
                h-12
                w-12
                mb-4
              "></div>
                </div>
            </div>

        </div>




    </div>

    <!-- component -->

    <div v-if="hienthi" class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <div class="overflow-x-auto">
            <table class="table -mt-2">
                <thead>
                    <tr>
                        <th rowspan="2" class="w-1/12 text-center p-1">STT</th>

                        <th rowspan="2" class="text-center w-3/12">
                            <span class=" ">Tiêu chí</span>
                            <br>
                            <span class=" ">Đơn vị </span>

                        </th>

                        <th class=" text-center" colspan="3">
                            <span> Ready</span>

                        </th>
                        <th class=" text-center" colspan="4">
                            <span> Egovernment</span>

                        </th>
                        <th rowspan="2" class="text-center w-2/12">Tổng Kết</th>
                    </tr>

                    <tr>
                        <th v-for="ntc1 in nhomtieuchi[0]['ready']">
                            @{{ntc1.t}}
                        </th>


                        <th v-for="ntc1 in nhomtieuchi[0]['egovernment']">
                            @{{ntc1.t}}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x " v-for="(dtxdl,index) in dataxuatdulieu">
                        <td class="w-1/12 p-1">

                            <div class="text-gray-600 text-sm whitespace-n  owrap mt-0.5 text-center">
                                @{{ index +1 }}
                            </div>
                        </td>
                        <td class="w-2/12">
                            <div class="text-indigo-700 text-sm whitespace-n  owrap mt-0.5 " style="min-width: 120px;">
                                @{{dtxdl.t}}
                            </div>
                        </td>


                        <td class="w-1/12" v-for=" ntc in dtxdl.ready">

                            <div class="w-full text-gray-600 text-sm whitespace-n  owrap mt-0.5">
                                <p class="text-center">
                                    @{{ntc.d}}
                                </p>
                                <p class="text-red-700 text-center" style="min-width: 70px;">
                                    ( @{{ntc.tl}} % )
                                </p>

                            </div>
                        </td>
                        <td class="w-1/12" v-for=" ntc in dtxdl.egovernment">

                            <div class="w-full text-gray-600 text-sm whitespace-n  owrap mt-0.5">

                                <p  class="text-center">
                                    @{{ntc.d}}
                                </p>
                                <p class="text-red-700 text-center" style="min-width: 70px;">
                                    ( @{{ntc.tl}} %)
                                </p>
                            </div>
                        </td>


                        <td class="w-7/12">

                            <div class="text-blue-900 text-sm whitespace-n  owrap mt-0.5 text-center">
                               <b> @{{dtxdl.tongdiem}}</b> 
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- v-if="hienthi" -->

</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
// Init plugin

var vm = new Vue({
    el: '#xuatdulieu',
    data: {
        dtnhomdonvi: [],
        dtdotbaocao: [],
        nhomdonvi_id: '',
        dotbaocao_id: '',
        valinhomdonvi: false,
        validotbaocao: false,
        dataxuatdulieu: [],
        hienthi: false,
        nhomtieuchi: [],
        check: false,

    },
    watch: {

    },


    mounted() {
        const self = this;
        axios.get("/xuat-du-lieu-data")

            .then(function(response) {
                self.dtnhomdonvi = response.data["dtnhomdonvi"];
                self.dtdotbaocao = response.data["dtdotbaocao"];

            });

    },
    methods: {
        tracuudulieu() {

            const self = this;
            self.check = true;
            if (self.nhomdonvi_id == '') {
                self.valinhomdonvi = true;
            }
            if (self.dotbaocao_id == '') {
                self.validotbaocao = true;
            } else {


                axios.get('/tra-cuu-du-lieu?nhomdonvi_id=' + self.nhomdonvi_id + "&dotbaocao_id=" + self
                        .dotbaocao_id)
                    .then(function(response) {
                        self.dataxuatdulieu = response.data;
                        self.nhomtieuchi = response.data;
                        self.check = false;
                        console.log(self.dataxuatdulieu[0]);
                        self.hienthi = true;
                    });
            }


        },

    }
})
</script>
@endsection