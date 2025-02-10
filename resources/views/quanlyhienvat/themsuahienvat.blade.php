@extends('../layout/layout')


@section('subhead')
<script src="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@riophae/vue-treeselect@^0.4.0/dist/vue-treeselect.min.css">
<title>{{$tieude}}</title>
@endsection
@section('subcontent')
<div id="demo" class="bg-white min-h-screen">
    <div class="col-span-12  md:block flex p-2 justify-center">
        <button @click="Back()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="h-8 w-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            <span>Quản lý hiện vật</span>
        </button>

    </div>
    <template>
        <el-tabs type="card" @tab-click="handleClick">
            <el-tab-pane label="Thông tin chung">
                <div class="mt-5 md:col-span-3 md:mt-0">
                    <div class=" grid grid-cols-12 ">
                        <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Tên</label>
                            <input v-model="dataForm.name" name="name" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                                @{{ dataForm.errors().get('name') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Tên khác</label>
                            <input v-model="dataForm.ten_khac" name="ten_khac" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('ten_khac')">
                                @{{ dataForm.errors().get('ten_khac') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Số ký hiệu</label>
                            <input @blur="Checksokyhieu($event)" v-model="dataForm.so_ky_hieu" name="so_ky_hieu" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('so_ky_hieu')">
                                @{{ dataForm.errors().get('so_ky_hieu') }}
                            </span>
                        </div>
                        <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Số lượng</label>
                            <input v-model="dataForm.soluong" name="soluong" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('soluong')">
                                @{{ dataForm.errors().get('soluong') }}
                            </span>
                        </div>

                        <div class="col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Số thành phần hợp
                                thành:</label>
                            <input v-model="dataForm.sothanhphan" name=" sothanhphan" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('sothanhphan')">
                                @{{ dataForm.errors().get('sothanhphan') }}
                            </span>
                        </div>

                        <!-- <div class="col-span-12  bg-white px-4 py-5 sm:p-4">
                            <label class="block text-sm font-medium text-gray-700">Mô tả:</label>
                            <textarea rows="10" v-model="dataForm.mota" name="mota" type="text" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"> </textarea>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('mota')">
                                @{{ dataForm.errors().get('mota') }}
                            </span>
                        </div> -->

                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Thông tin sưu tầm">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:col-span-3 md:mt-0">
                        <div class=" grid grid-cols-12 ">
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Địa điểm sưu
                                    tầm:</label>
                                <input v-model="dataForm.dia_diem_st" name="dia_diem_st" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('dia_diem_st')">
                                    @{{ dataForm.errors().get('dia_diem_st') }}
                                </span>
                            </div>

                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">

                                <label class="block text-sm font-medium text-gray-700">Hình thức sưu
                                    tầm:</label>
                                <select v-model="dataForm.hinhthucst_id" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                                    <option value="">-- Hình thức sưu tầm: --</option>
                                    <option v-for="i in danhsachhinhthucsuutam" :value="i.id">
                                        @{{i.name}}
                                    </option>
                                </select>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('hinhthucst_id')">
                                    @{{ dataForm.errors().get('hinhthucst_id') }}
                                </span>

                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Thời gian sưu
                                    tầm:</label>
                                <input v-model="dataForm.thoi_gian_st" name="thoi_gian_st" type="date" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('thoi_gian_st')">
                                    @{{ dataForm.errors().get('thoi_gian_st') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Chủ nhân hiện
                                    vật:</label>
                                <input v-model="dataForm.chu_nhan" name=" chu_nhan" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('chu_nhan')">
                                    @{{ dataForm.errors().get('chu_nhan') }}
                                </span>
                            </div>
                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Thời gian nhập
                                    kho:</label>
                                <input v-model="dataForm.tg_nhap_kho" name=" tg_nhap_kho" type="date" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('tg_nhap_kho')">
                                    @{{ dataForm.errors().get('tg_nhap_kho') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Đặc điểm hiện vật">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:col-span-3 md:mt-0">
                        <div class=" grid grid-cols-12 ">


                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">

                                <label class="block text-sm font-medium text-gray-700">Chất
                                    liệu:</label>
                                <select v-model="dataForm.chatlieu_id" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                                    <option value="">-- Chất liệu: --</option>
                                    <option v-for="i in danhsachchatlieu" :value="i.id">
                                        @{{i.name}}
                                    </option>
                                </select>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('chatlieu_id')">
                                    @{{ dataForm.errors().get('chatlieu_id') }}
                                </span>

                            </div>

                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Màu
                                    sắc:</label>
                                <input v-model="dataForm.mau_sac" name="mau_sac" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('mau_sac')">
                                    @{{ dataForm.errors().get('mau_sac') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Kích
                                    thước:</label>
                                <input v-model="dataForm.kich_thuoc" name="kich_thuoc" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('kich_thuoc')">
                                    @{{ dataForm.errors().get('kich_thuoc') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Trọng
                                    lượng</label>
                                <input v-model="dataForm.trong_luong" name="trong_luong" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('trong_luong')">
                                    @{{ dataForm.errors().get('trong_luong') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Kỹ thuật chế
                                    tác:</label>
                                <input v-model="dataForm.ky_thuat_ct" name=" ky_thuat_ct" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('ky_thuat_ct')">
                                    @{{ dataForm.errors().get('ky_thuat_ct') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Tình trạng
                                    hiện
                                    vật:</label>
                                <input v-model="dataForm.tinh_trang_hv" name=" tinh_trang_hv" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('tinh_trang_hv')">
                                    @{{ dataForm.errors().get('tinh_trang_hv') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Hình
                                    dạng:</label>
                                <input v-model="dataForm.hinh_dang" name=" hinh_dang" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('hinh_dang')">
                                    @{{ dataForm.errors().get('hinh_dang') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">

                                <label class="block text-sm font-medium text-gray-700">Loại hiện
                                    vật:</label>
                                <select v-model="dataForm.loaihienvat_id" class="rounded-md border-2 p-2 form-control form-select px-5 w-full">
                                    <option value="">-- Loại hiện vật: --</option>
                                    <option v-for="i in danhsachloaihienvat" :value="i.id">
                                        @{{i.name}}
                                    </option>
                                </select>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('loaihienvat_id')">
                                    @{{ dataForm.errors().get('loaihienvat_id') }}
                                </span>

                            </div>


                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4">

                                <label class="block text-sm font-medium text-gray-700">Niên đại:</label>
                                <input v-model="dataForm.dudoan_niendai" name=" dudoan_niendai" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('dudoan_niendai')">
                                    @{{ dataForm.errors().get('dudoan_niendai') }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Phân loại sưu tập">
                <div class="md:grid md:grid-cols-3 md:gap-6 min-h-screen">
                    <div class="mt-5 md:col-span-3 md:mt-0">
                        <div class=" grid grid-cols-12 ">
                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4   ">

                                <label class="block mb-2 text-sm font-medium text-gray-700">Bộ sưu
                                    tập:</label>
                                <div>
                                    <treeselect v-model="dataForm.bosuutap_id" required :disable-branch-nodes="true" :multiple="false" :options="danhsachbosuutap" placeholder="Chọn bộ sưu tập" :normalizer="normalizer" />
                                </div>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('bosuutap_id')">
                                    @{{ dataForm.errors().get('bosuutap_id') }}
                                </span>
                            </div>
                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4   ">

                                <label class="block mb-2 text-sm font-medium text-gray-700">Vị trí hiện vật:</label>
                                <div>
                                    <treeselect v-model="dataForm.vitrihv_id" required value-consists-of="LEAF_PRIORITY" :multiple="false" :options="datakho" placeholder="Chọn kho" :normalizer="normalizer" />

                                </div>

                            </div>
                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4   ">

                                <label class="block mb-2 text-sm font-medium text-gray-700">Trưng bày:</label>
                                <div>
                                    <treeselect v-model="dataForm.trungbay_id" required :disable-branch-nodes="true" :multiple="false" :options="danhsachtrungbay" placeholder="Chọn Trưng bày" :normalizer="normalizer" />
                                </div>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('trungbay_id')">
                                    @{{ dataForm.errors().get('trungbay_id') }}
                                </span>
                            </div>
                            <div class="col-span-12  bg-white px-4 py-5 sm:p-4   ">

                                <label class="block mb-2 text-sm font-medium text-gray-700">Link file 3d:</label>
                                <div>
                                    <input v-model="dataForm.linkfile3d" name="linkfile3d" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Nội dung hiện vật">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:col-span-3 md:mt-0">
                        <div class=" grid grid-cols-12 ">
                            <div class="sm:col-span-12 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Nội dung hiện vật:</label>
                                <ckeditor v-model="dataForm.nguon_goc"></ckeditor>
                                <!-- <textarea rows="10" name="nguon_goc" type="text" required
                                    class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"> </textarea>
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('nguon_goc')">
                                    @{{ dataForm.errors().get('nguon_goc') }}
                                </span> -->
                            </div>

                        </div>
                    </div>
                </div>
            </el-tab-pane>
            <el-tab-pane label="Hình ảnh Hiện vật">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:col-span-3 md:mt-0">
                        <div class=" grid grid-cols-12 ">

                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Bảo quản, phục
                                    chế:</label>
                                <input v-model="dataForm.baoquan_phucche" name=" baoquan_phucche" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('baoquan_phucche')">
                                    @{{ dataForm.errors().get('baoquan_phucche') }}
                                </span>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Ghi chú:</label>
                                <input v-model="dataForm.ghinho" name=" ghinho" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('ghinho')">
                                    @{{ dataForm.errors().get('ghinho') }}
                                </span>
                            </div>

                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Upload ảnh:</label>
                                <uploadfile2 class="" tenbang="anhhienvat" :id="dataForm.uuid">
                                </uploadfile2>
                            </div>
                            <div class="sm:col-span-6 col-span-12  bg-white px-4 py-5 sm:p-4">
                                <label class="block text-sm font-medium text-gray-700">Upload tài liệu:</label>
                                <uploadfile2 tenbang="tailieuhienvat" :id="dataForm.uuid1">
                                </uploadfile2>
                            </div>



                        </div>
                    </div>
                </div>


            </el-tab-pane>

        </el-tabs>
        <div class="col-span-12 text-center  md:block flex p-2 justify-center">
            <button @click="submitform()" class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Lưu hiện vật
            </button>

        </div>
    </template>

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
                    'name'
                ],
                // đường dẫn đến ajax
                url: '/ajax-quan-ly-hien-vat',
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

                activeName: 'first'
            },
            rowId: '',
            statusForm: '',
            dataForm: form({
                    id: '',
                    uuid: '',
                    uuid1: '',
                    name: '',
                    ten_khac: '',
                    so_ky_hieu: '',
                    soluong: '',
                    sothanhphan: '',
                    dia_diem_st: '',
                    hinhthucst_id: '',
                    thoi_gian_st: '',
                    chatlieu_id: '',
                    mau_sac: '',
                    kich_thuoc: '',
                    trong_luong: '',
                    hinh_dang: '',
                    ky_thuat_ct: '',
                    tinh_trang_hv: '',
                    tg_nhap_kho: '',
                    loaihienvat_id: '',
                    nguon_goc: '',
                    mota: '',
                    dudoan_niendai: '',
                    baoquan_phucche: '',
                    vitrihv_id: null,
                    bosuutap_id: null,
                    trungbay_id: null,
                    ghinho: '',
                    linkfile3d:'',
                })
                .rules({
                    name: 'required',
                    bosuutap_id: 'required',
                    loaihienvat_id: 'required',
                    so_ky_hieu: 'required',
                })
                .messages({
                    'name.required': 'Trường bắt buộc nhập',
                    'bosuutap_id.required': 'Trường bắt buộc nhập',
                    'loaihienvat_id.required': 'Trường bắt buộc nhập',
                    'so_ky_hieu.required': 'Trường bắt buộc nhập',
                }),


            // danhmuc
            danhsachchatlieu: [],
            danhsachhinhthucsuutam: [],
            danhsachloaihienvat: [],
            // kho
            danhsachvitrihienvat: [],
            danhsachbosuutap: null,
            danhsachhienvat: [],
            datakho: [],
            tieude: '',
            tableDataView: {},
            lichsu: [],
            infohienvat: [],
            checkview: '',
            normalizer(node) {
                return {
                    // id: node.id,
                    label: node.name,
                    children: node.children,
                }
            },
        },
        watch: {},
        mounted: function() {
            let uri = window.location.search.substring(1);
            let params = new URLSearchParams(uri);
            this.id = params.get("id");
            this.checkview = params.get("check");

            if (this.id == null) {

                this.saveform();
            } else {

                this.doAlertEdit();
            }
            this.loadData();
            const self = this;
            axios.get("/danh-muc/chatlieus").then(function(response) {
                self.danhsachchatlieu = response.data;
            })
            axios.get("/danh-muc/quanlytrungbays").then(function(response) {
                self.danhsachtrungbay = response.data;
            })
            axios.get("/danh-muc/hinhthucsuutams").then(function(response) {
                self.danhsachhinhthucsuutam = response.data;
            })
            axios.get("/danh-muc/loaihienvats").then(function(response) {
                self.danhsachloaihienvat = response.data;
            })
            axios.get("/danh-muc/vitrihienvats").then(function(response) {
                self.danhsachvitrihienvat = response.data;
            })
            axios.get("/ajax-bo-suu-tap-1").then(function(response) {
                self.danhsachbosuutap = response.data;
            })
            axios.get("/data-kho").then(function(response) {
                self.datakho = response.data;
            })
        },
        methods: {

            handleClick(tab, event) {
                // console.log(event);
            },
            Checksokyhieu(event) {
                const self = this;
                axios
                    .post("/check-so-ky-hieu", {
                        sokyhieu: event.target.value,
                    })
                    .then(function(response) {
                        if (response.data == 1) {
                            self.thongbaothatbai('Số ký hiệu không được trùng');
                            self.dataForm.data.so_ky_hieu = '';
                        }

                    })

            },
            Back() {
                if (this.checkview == 1) {
                    window.location.href = "/duyet-nhieu-hien-vat";

                } else {
                    window.location.href = "/quan-ly-hien-vat";
                }
            },
            saveform() {
                const self = this

                this.dataForm.data.uuid = uuidv4();
                this.dataForm.data.uuid1 = uuidv4();
                this.tieude = 'Thêm mới thông tin hiện vật',
                    this.dataForm.data.name = '';
                this.dataForm.data.ten_khac = '';
                this.dataForm.data.soluong = '';
                this.dataForm.data.sothanhphan = '';
                this.dataForm.data.chu_nhan = '';
                this.dataForm.data.dia_diem_st = '';
                this.dataForm.data.hinhthucst_id = '';
                this.dataForm.data.thoi_gian_st = '';
                this.dataForm.data.chatlieu_id = '';
                this.dataForm.data.mau_sac = '';
                this.dataForm.data.kich_thuoc = '';
                this.dataForm.data.trong_luong = '';
                this.dataForm.data.hinh_dang = '';
                this.dataForm.data.ky_thuat_ct = '';
                this.dataForm.data.tinh_trang_hv = '';
                this.dataForm.data.tg_nhap_kho = '';
                this.dataForm.data.loaihienvat_id = '';
                this.dataForm.data.nguon_goc = '';
                this.dataForm.data.mota = '';
                this.dataForm.data.dudoan_niendai = '';
                this.dataForm.data.baoquan_phucche = '';
                this.dataForm.data.vitrihv_id = null;
                this.dataForm.data.bosuutap_id = null;
                this.dataForm.data.trungbay_id = null;
                this.dataForm.data.ghinho = '';
                this.dataForm.data.linkfile3d = '';

                
                this.dataForm.data.so_ky_hieu = 'BTLĐ.';
                // this.dataForm.data.uuid = uuidv4();
                this.statusForm = "insert";
            },
            submitform() {
                if (this.dataForm.validate().errors().any()) {
                    return;
                }
                const self = this;
     
                if(self.dataForm.trungbay_id == undefined){
                    self.dataForm.trungbay_id = null;
                }
                if (this.statusForm == "insert") {
                    axios.post("/save-quan-ly-hien-vat", self.dataForm.data).then(function(response) {
                            self.thongbaothanhcong('Lưu thành công');
                            self.saveform();
                        })
                        .catch(error => {
                            self.thongbaothatbai(error);
                        });
                } else {
                    console.log(self.dataForm.data);
                    axios.post("/update-quan-ly-hien-vat", {
                            id: self.rowId,
                            data: self.dataForm.data
                        }).then(function(response) {
                            self.thongbaothanhcong('Sửa thành công')
                            self.dataForm.data.bosuutap_idbefore = self.dataForm.data.bosuutap_id;

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

                        params: {
                            // Giá trị mặc định phải có
                            // start:index bản ghi bắt đầu
                            // length:số lượng bản ghi trên 1 trang
                            // searchcolum:Các cột được phép tìm kiếm
                            // searchnow: Giá trị tìm kiêm hiện tại

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
            doAlertEdit() {

                const self = this;
                self.infohienvat = <?php echo json_encode($infohienvat, JSON_HEX_TAG); ?>;

                // Gán giá trị cho form
                this.tieude = 'Sửa thông tin hiện vật';
                this.dataForm.data.uuid1 = self.infohienvat.id;
                this.dataForm.data.name = self.infohienvat.name;
                this.dataForm.data.ten_khac = self.infohienvat.ten_khac;
                this.dataForm.data.so_ky_hieu = self.infohienvat.so_ky_hieu;
                this.dataForm.data.soluong = self.infohienvat.soluong;
                this.dataForm.data.sothanhphan = self.infohienvat.sothanhphan;
                this.dataForm.data.chu_nhan = self.infohienvat.chu_nhan;
                this.dataForm.data.dia_diem_st = self.infohienvat.dia_diem_st;
                this.dataForm.data.hinhthucst_id = self.infohienvat.hinhthucst_id;
                this.dataForm.data.thoi_gian_st = self.infohienvat.thoi_gian_st;
                this.dataForm.data.chatlieu_id = self.infohienvat.chatlieu_id;
                this.dataForm.data.mau_sac = self.infohienvat.mau_sac;
                this.dataForm.data.kich_thuoc = self.infohienvat.kich_thuoc;
                this.dataForm.data.trong_luong = self.infohienvat.trong_luong;
                this.dataForm.data.hinh_dang = self.infohienvat.hinh_dang;
                this.dataForm.data.ky_thuat_ct = self.infohienvat.ky_thuat_ct;
                this.dataForm.data.tinh_trang_hv = self.infohienvat.tinh_trang_hv;
                this.dataForm.data.tg_nhap_kho = self.infohienvat.tg_nhap_kho;
                this.dataForm.data.loaihienvat_id = self.infohienvat.loaihienvat_id;
                this.dataForm.data.nguon_goc = self.infohienvat.nguon_goc;
                this.dataForm.data.mota = self.infohienvat.mota;
                this.dataForm.data.dudoan_niendai = self.infohienvat.dudoan_niendai;
                this.dataForm.data.baoquan_phucche = self.infohienvat.baoquan_phucche;
                this.dataForm.data.vitrihv_id = self.infohienvat.vitrihv_id;
                this.dataForm.data.bosuutap_id = self.infohienvat.bosuutap_id;
                this.dataForm.data.trungbay_id = self.infohienvat.trungbay_id;
                this.dataForm.data.bosuutap_idbefore = self.infohienvat.bosuutap_id;
                this.dataForm.data.vitrihv_idbefore = self.infohienvat.vitrihv_id;
                this.dataForm.data.ghinho = self.infohienvat.ghinho;
                this.dataForm.data.linkfile3d = self.infohienvat.linkfile3d;

                
                this.dataForm.data.uuid = self.infohienvat.id;
                // Sửa tình trạng form
                this.statusForm = "update";
                this.rowId = self.infohienvat.id;
            },

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
        }
    })
</script>
@endsection