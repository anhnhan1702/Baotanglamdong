@extends('../layout/layout')


@section('subhead')
    <title>Quản lý nhóm quyền</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

        <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
            class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-6/12   relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
                <div class="px-8 py-4 w-full grid grid-cols-12 " style="min-width: 600px;">
                    <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                        @{{ tieude }}
                    </div>

                    <div class="col-span-12 grid grid-cols-12 py-2">
                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Tên quyền</label>
                            <input v-model="dataForm.name" name="name" type="text" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                                @{{ dataForm.errors().get('name') }}
                            </span>
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
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý nhóm quyền </h1>
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
                                                <button @click="saveform()" type="button"
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
                                            <el-table-column prop="name" label="Tên quyền">
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
                                                        <el-tooltip class="item" effect="dark" content="Xóa"
                                                            placement="top-start">
                                                            <el-button size="mini" @click="doAlertDelete(scope.row)">
                                                                <i class="  el-icon-delete text-lg"></i>
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

    <script type="module" src="./js/nhomquyen/nhomquyen.js"></script>
@endsection
