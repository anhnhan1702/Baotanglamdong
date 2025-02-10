@extends('../layout/layout')


@section('subhead')
    <title>Quản lý tin bài</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

        <div v-cloak v-bind:class="{ hidden: isActivemodal }" style="z-index: 100"
            class="min-w-screen h-screen animated fadeIn faster 
         fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
            <div class="w-6/12  h-4/5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-auto ">
                <div class="px-8 py-4 w-full grid grid-cols-12 " style="min-width: 600px;">
                    <div class="col-span-12  text-center sm:text-3xl text-base py-2  font-medium">
                        @{{ tieude }}
                    </div>

                    <div class="col-span-12 grid grid-cols-12 py-2">

                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                            <div class="grid grid-cols-12">


                                <div class="col-span-2">
                                    <img v-if="imagePreview != null" :src="imagePreview"
                                        class="h-40 w-40 object-contain rounded-full" data-dz-thumbnail="">

                                    <div class="flex items-center">
                                        <div v-if="imagePreview == null" class="group" data-hs-file-upload-previews=""
                                            data-hs-file-upload-pseudo-trigger="">
                                            <span
                                                class="group-has-[div]:hidden flex shrink-0 justify-center items-center size-20 border-2 border-dotted border-gray-300 text-gray-400 cursor-pointer rounded-full hover:bg-gray-50 dark:border-neutral-700 dark:text-neutral-600 dark:hover:bg-neutral-700/50">
                                                <svg class="shrink-0 size-7" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-span-10 px-2 flex flex-wrap items-center gap-3 sm:gap-5">

                                    <div class="grow">
                                        <div class="flex items-center gap-x-2">

                                            <button @click="fileInput.click()"
                                                class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="17 8 12 3 7 8"></polyline>
                                                    <line x1="12" x2="12" y1="3" y2="15">
                                                    </line>
                                                </svg>
                                                Upload photo
                                            </button>

                                            <!-- Ẩn input file -->
                                            <input ref="fileInput" @change="handleFileChange" type="file" id="fileInput"
                                                class="hidden">
                                            <button type="button" @click="deleteFile"
                                                class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-semibold rounded-lg border border-gray-200 bg-white text-gray-500 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                data-hs-file-upload-clear="">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                            <input v-model="dataForm.title"  @input="generateSlug" name="title" type="text" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('title')">
                                @{{ dataForm.errors().get('title') }}
                            </span>
                        </div>
                        <div class="col-span-12 bg-white py-4">
                            <label class="block text-sm font-medium text-gray-700">Slug</label>
                            <input v-model="dataForm.slug" name="slug" type="text" readonly
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Giới thiệu</label>
                            <textarea v-model="dataForm.desc" name="desc" type="text" required rows="4"
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </textarea>
                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('desc')">
                                @{{ dataForm.errors().get('desc') }}
                            </span>
                        </div>

                        <div class=" col-span-12  bg-white py-4 ">
                            <label class="block text-sm font-medium text-gray-700">Nội dung</label>
                            <ckeditor v-model="dataForm.content"></ckeditor>

                            <span class="mt-4 mb-2 text-red-500" v-if="dataForm.errors().has('content')">
                                @{{ dataForm.errors().get('content') }}
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
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý tin bài </h1>
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
                                            <el-table-column prop="title" label="Tiêu đề">
                                            </el-table-column>
                                            <!-- <el-table-column prop="nameparent" label="Thuộc tin bài">
                                                                        </el-table-column> -->
                                            <el-table-column prop="desc" label="Nội dung ngắn">
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

    <script type="module" src="./js/post/post.js"></script>
@endsection
