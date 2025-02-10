@extends('../layout/layout')


@section('subhead')
    <title>Quản lý portal</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

        <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
            class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-6/12  h-4/5  relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
                <div class="px-8 py-4 w-full grid grid-cols-12 " style="min-width: 600px; ">
                    <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                        @{{ tieude }}
                    </div>

                    <div class="col-span-12 grid grid-cols-12 py-2">
                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                            <input v-model="dataForm.title" name="title" type="text" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('title')">
                                @{{ dataForm.errors().get('title') }}
                            </span>
                        </div>

                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Chọn giao diện hiện thị</label>
                            <div class="grid grid-cols-12 gap-4 ">
                                <div class="col-span-6 border border-gray-200 rounded dark:border-gray-700">

                                    <img class="rounded"
                                        src="/images/giaodien1.png"
                                        alt="image description">
                                    <div class="flex items-center p-2  rounded dark:border-gray-700">
                                        <input v-model="dataForm.type" id="bordered-radio-1" type="radio" value="1"
                                            name="bordered-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="bordered-radio-1"
                                            class="w-full p-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giao
                                            diện 1</label>
                                    </div>
                                </div>
                                <div class="col-span-6 border border-gray-200 rounded dark:border-gray-700">

                                    <img class="rounded"
                                        src="/images/giaodien2.png"
                                        alt="image description">
                                    <div class="flex items-center p-2  ">
                                        <input v-model="dataForm.type" checked id="bordered-radio-2" type="radio"
                                            value="2" name="bordered-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="bordered-radio-2"
                                            class="w-full p-2 text-sm font-medium text-gray-900 dark:text-gray-300">Giao
                                            diện 2</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Mô tả</label>
                            <textarea v-model="dataForm.content" name="content" type="text" required rows="10"
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </textarea>
                        </div>
                        <div v-if="arrImportGiaoDien.length > 0" class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Chọn giao diện import</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="dataForm.type">
                                <option value="">-- Chon Giao Diện --</option>
                                <option v-for="importGiaoDien in arrImportGiaoDien" :value="importGiaoDien.id">
                                    @{{ importGiaoDien.name }}
                                </option>
                            </select>
                        </div>
                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Import file</label>
                            <uploadfile2 tenbang="giaodien" :id="dataForm.uuid1">
                            </uploadfile2>

                        </div>
                    </div>
                    <!--footer-->
                    <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                        <button @click="submitform()"
                            class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Lưu thông tin
                        </button>
                        <button @click="closemodal()"
                            class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
                    </div>

                </div>
            </div>

        </div>

        <div class="mx-auto max-w-8xl  flex">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý portal </h1>
        </div>
        <div class="mx-auto max-w-8xl ">
            <!-- Replace with your content -->
            <div class="py-4 datatable">
                <div class=" rounded-lg border-4  border-gray-200 bg-white" style="min-height:80vh ;">
                    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
                        <template>
                            <div id="app" class="col-12">
                                <div class="row">
                                    <div class="py-4">
                                        <div class="sm:flex sm:items-center">
                                            <div class="sm:flex-auto">

                                                <button v-if="datatb.tableData.length == 0" @click="saveform()"
                                                    type="button"
                                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
                                                    mới</button>
                                            </div>

                                            <div class="col-3 col-span-4">
                                                <input class="effect-7" type="text" placeholder="Tìm kiếm"
                                                    v-model="searchnow" />

                                            </div>
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
                                            <el-table-column prop="title" label="Tiêu đề">
                                            </el-table-column>

                                            <el-table-column prop="content" label="Mô tả">
                                            </el-table-column>

                                            <el-table-column align="center" width="200">
                                                <template slot="header" slot-scope="scope">
                                                    Chức năng
                                                </template>
                                                <template slot-scope="scope">
                                                    @if (auth()->user()->chucvu_id != 3 && auth()->user()->chucvu_id != 6)
                                                        <el-tooltip class="item" effect="dark" content="Chỉnh sửa"
                                                            placement="top-start">
                                                            <el-button size="mini" @click="doAlertEdit(scope.row)">
                                                                <i class="el-icon-edit-outline text-lg"></i>
                                                            </el-button>
                                                        </el-tooltip>
                                                    @endif
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

    <script type="module" src="./js/post/portal.js"></script>
@endsection
