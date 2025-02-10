@extends('../layout/layout')


@section('subhead')
    <title>Nhật ký hệ thống</title>
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

       
        <div class="mx-auto max-w-8xl  flex">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Nhật ký hệ thống </h1>
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
                                           
                                            <div class="col-3 col-span-4">
                                                <input class="effect-7" type="text" placeholder="Tìm kiếm"
                                                    v-model="searchnow" />

                                            </div>
                                            <button class="ml-auto bg-green-700 text-white px-4 py-2 rounded font-bold" @click="exportToExcel">Xuất Excel</button>

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
                                            <el-table-column prop="title" label="Người truy cập">
                                            </el-table-column>
                                            <el-table-column prop="action" label="Hành động">
                                            </el-table-column>
                                            <el-table-column prop="content" label="Nội dung">
                                            </el-table-column>
                                            <el-table-column prop="time" label="Thời gian">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script type="module" src="./js/hethong/hethong.js"></script>

@endsection
