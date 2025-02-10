@extends('../layout/layout')


@section('subhead')
<title>Quản lý trưng bày ảo</title>
@endsection
<style>
.transfer-footer {
    margin-left: 20px !important ;
    padding: 6px 5px  !important;
}

.el-transfer-panel {
    width: 40% !important;
    margin: auto  !important;
}

.el-transfer-panel__item.el-checkbox .el-checkbox__label {
    overflow: auto  !important;
    white-space: break-spaces  !important;
    text-overflow: break-word  !important;


}

.el-transfer-panel__item {
    height: max-content;
}
</style>
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="sm:w-6/12 w-10/12   p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white">
            <div class="w-full  overflow-auto ">
                <div class=" flex justify-between items-center  rounded-t border-b mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                        @{{tieude}}
                    </h3>
                    <button type="button" @click="closemodal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="grid grid-cols-12 ">
                    <div class="col-span-12 sm:col-span-6 px-4 py-5 sm:p-4">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                        <input v-model="dataForm.name" type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nhập tên" required="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('name')">
                            @{{ dataForm.errors().get('name') }}
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6 px-4 py-5 sm:p-4">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tóm tắt:</label>
                        <input v-model="dataForm.description" type="text" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Tóm tắt" required="">
                        <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('description')">
                            @{{ dataForm.errors().get('description') }}
                        </span>
                    </div>

                </div>
            </div>

            <!--footer-->
            <div class="col-span-12 text-center  md:block flex pt-4 justify-center">
                <button @click="submitform()"
                    class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    @{{tieude}}
                </button>
                <button @click="closemodal()"
                    class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
            </div>

        </div>

    </div>
    <div v-cloak v-bind:class="{ hidden: isActivemodalhienvat }" style="z-index: 100"
        class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodalhienvat()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="w-10/12 relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
            <div class="px-8 py-4 w-full grid grid-cols-12 " style="min-width: 600px;">
                <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                    Thêm hiện vật vào trưng bày ảo
                </div>


                <el-transfer filterable :filter-method="filterMethod" filter-placeholder="State Abbreviations"
                    class="col-span-12 flex justify-center items-center  py-2"
                    :props="{key:'id',label:'tentrungbayao',initial:'tentrungbayao'}" v-model="dataForm.hienvat_id" :data="hienvat">

                </el-transfer>

                <!--footer-->
                <div class="col-span-12 text-center  md:block flex p-2 justify-center">
                    <button @click="submitformHienvat()"
                        class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Lưu hiện vật
                    </button>
                    <button @click="closemodalhienvat()"
                        class=" items-center px-4 py-2 border border-red-700   text-sm font-medium rounded-md shadow-sm text-red-700 bg-white hover:text-white hover:bg-red-700 ">Hủy</button>
                </div>

            </div>
        </div>

    </div>
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý trưng bày ảo </h1>
    </div>
    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">
            <div class=" rounded-lg border-4  border-gray-200 bg-white     " style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row ">
                                <div class="py-4">
                                    <div class="sm:flex sm:items-center">
                                        <div class="sm:flex-auto">
                                            <button @click="saveform()" type="button"
                                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Thêm
                                                mới</button>

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
                                        <el-table-column prop="name" label="Tên">
                                        </el-table-column>
                                        <el-table-column prop="description" label="Mô tả">
                                        </el-table-column>
                                        <el-table-column align="center" width="270">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
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
                                                <el-tooltip class="item" effect="dark" content="thêm hiện vật"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="openmodalhienvat(scope.row)">
                                                        <i class="  el-icon-star-off text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>

                                                <el-tooltip class="item" effect="dark" content="xem hiện vật"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="galleryhienvat(scope.row)">
                                                        <i class="  el-icon-view text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>

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

<script type="module" src="./js/trungbayao/trungbayao.js"></script>
@endsection