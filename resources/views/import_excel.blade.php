@extends('./layout/top-menu')

@section('subhead')
<title>Import Dữ Liệu</title>
@endsection

<!--  -->

@section('subcontent')
<div class="w-full mx-auto pt-4" id="importDulieu">
    <div class="title-header">
        <h1 class="font-medium text-2xl text-center">KHỞI TẠO DỮ LIỆU</h1>
    </div>
    <div class="w-full justify-center mt-4 flex items-center">
        <div class="">
            <div class="w-full">
                <div class="w-full flex justify-center mb-10 pt-10">
                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                </div>
            </div>
            <div class="w-full justify-center mt-4 flex items-center">
                <button class="btn btn-default btn-primary inline-flex items-center mr-3" v-on:click="submitFilediaban()">
                    Khởi tạo dữ liệu Địa bàn
                </button>
            </div>
            <div v-if="check == true">
                <div wire:loading class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
                    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
                </div>
            </div>
        </div>
        <a href="/import_excel/importNhomtbc" class="btn btn-default btn-primary inline-flex items-center mr-3">Khởi tạo Nhóm trường báo cáo</a>
        <a href="/import_excel/importTruongbc" class="btn btn-default btn-primary inline-flex items-center mr-3">Khởi tạo
            Trường báo cáo</a>
    </div>
    <!-- @if(session('message'))
    <div id="alertSuc" class="absolute alert flex flex-row items-center bg-green-200 px-5 py-2 rounded-full"
        style="width: max-content; top: 20px; right: 20px; z-index:999; background-color:#56fc5f; ">
        <div
            class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
            <span class="">
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        <div class="alert-content ml-4">
            <div class="alert-title font-semibold text-sm ">
                Thành công
            </div>
            <div class="alert-description text-sm ">
                {{ session('message') }}
            </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div id="alertSuc"
        class="absolute alert alert-danger flex flex-row items-center bg-green-200 px-5 py-2 rounded-full"
        style="width: max-content; top: 20px; right: 20px; z-index:999; ">
        <div
            class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
            <span class="">
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        <div class="alert-content ml-4">
            <div class="alert-title font-semibold text-sm ">
                Lỗi !
            </div>
            <div class="alert-description text-sm ">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif
    <div class="w-full mt-4 justify-center">
        @if(session('diaban'))
        <div class="overflow-x-auto">
            <div class="w-full bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-400 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="border-2 py-3 px-6 text-center">STT</th>
                                    <th class="border-2 py-3 px-6 text-center">Mã phường xã</th>
                                    <th class="border-2 py-3 px-6 text-center">Tên địa bàn</th>
                                    <th class="border-2 py-3 px-6 text-center">Thuộc địa bàn</th>
                                    <th class="border-2 py-3 px-6 text-center">Loại địa bàn</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach (session('diaban') as $db)
                                <tr class="border-b border-gray-200 hover:bg-gray-200">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center text-left">
                                            {{$db->id}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->mapx}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->name}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->ten}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->tenldb}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(session('donvi'))
        <div class="overflow-x-auto">
            <div class="w-full bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-400 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="border-2 py-3 px-6 text-left" align="left">STT</th>
                                    <th class="border-2 py-3 px-6 text-left" align="left">Mã phường xã</th>
                                    <th class="border-2 py-3 px-6 text-center">Tên đơn vị</th>
                                    <th class="border-2 py-3 px-6 text-center">Cấp đơn vị</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach (session('donvi') as $db)
                                <tr class="border-b border-gray-200 hover:bg-gray-200">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex justify-start text-left">
                                            {{$db->id}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-start items-center">
                                            {{$db->macode}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-start items-center">
                                            {{$db->name}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->tencdv}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(session('nguoidung'))
        <div class="overflow-x-auto">
            <div class="w-full bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-400 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="border-2 py-3 px-6 text-left" align="left">STT</th>
                                    <th class="border-2 py-3 px-6 text-left" align="left">Tên Đơn vị</th>
                                    <th class="border-2 py-3 px-6 text-center">Tên tài khoản</th>
                                    <th class="border-2 py-3 px-6 text-center">Password</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach (session('nguoidung') as $db)
                                <tr class="border-b border-gray-200 hover:bg-gray-200">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex justify-start text-left">
                                            {{$db->id-1}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-start items-center">
                                            {{$db->name}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-start items-center">
                                            {{$db->email}}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex justify-center items-center">
                                            {{$db->password}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(session('ntbc'))
        <div class="overflow-x-auto">
            <div class="w-full bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-400 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="border-2 py-3 px-6" align="left">STT</th>
                                    <th class="border-2 py-3 px-6" align="center">Nhóm trường báo cáo</th>
                                     style="width:max-content;white-space: nowrap;" 
    <th class="border-2 py-3 px-6 text-center">Biểu báo cáo cấp</th>
    <th class="border-2 py-3 px-6 text-center" style="width:max-content;white-space: nowrap;">Trạng thái</th>
    </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
        @foreach (session('ntbc') as $db)
        <tr class="border-b border-gray-200 hover:bg-gray-200">
            <td class="py-3 px-6 text-left whitespace-nowrap">
                <div class="flex justify-start text-left">
                    {{$db->id}}
                </div>
            </td>
            <td class="py-3 px-6 text-center">
                <div class="flex justify-center items-center" style="width:max-content">
                    {{$db->name}}
                </div>
            </td>
            <td class="py-3 px-6 text-left">
                <div class="flex justify-start items-center">
                    {{$db->tenndv}}
                </div>
            </td>
            <td class="py-3 px-6 text-center">
                <div class="flex justify-center items-center">
                    {{$db->trangthai}}
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>
</div>
@endif
@if(session('tbc'))
<div class="overflow-x-auto">
    <div class="w-full bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">
            <div class="bg-white shadow-md rounded">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-400 text-gray-700 uppercase text-sm leading-normal">
                            <th class="border-2 py-3 px-6" align="left">STT</th>
                            <th class="border-2 py-3 px-6 text-center" style="width: max-content;white-space: nowrap; ">Nhóm trường báo cáo</th>
                            <th class="border-2 py-3 px-6" align="center">Tên biểu báo cáo</th>
                            style="width:max-content;white-space: nowrap;" 
                            <th class="border-2 py-3 px-6 text-center" style="width: max-content;white-space: nowrap; ">Biểu báo cáo cấp</th>
                            <th class="border-2 py-3 px-6 text-center" style="width:max-content;white-space: nowrap;">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach (session('tbc') as $db)
                        <tr class="border-b border-gray-200 hover:bg-gray-200">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex justify-start text-left">
                                    {{$db->id}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex justify-start items-center">
                                    {{$db->ntbc}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex justify-start items-center" align="left">
                                    {{$db->name}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex justify-start items-center">
                                    {{$db->capbbc}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center items-center">
                                    {{$db->trangthai}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
</div> -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    var app = new Vue({
        el: '#importDulieu',
        data: {
            check: false,
            file: "",
        },
        submitFilediaban() {
            const self = this;
            this.check = true;
            if (this.file == "") {
                self.$toasted.error("Chưa nhập file!!");
                self.check = false;
            } else {
                let formData = new FormData();
                formData.append("file", this.file);
                axios
                    .post("/import_excel/importDiaban", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(function() {
                        self.check = false;
                        self.$toasted.success("Tạo địa bàn thành công!!");
                        axios.get("/import_excel/import_user").then(function(response) {
                            self.dsdotchitra = response.data;
                        });
                    })
                    .catch(function() {
                        self.check = false;
                        self.$toasted.error("Tạo địa bàn thất bại!!");
                    });
            }
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
    })
</script>
@endsection