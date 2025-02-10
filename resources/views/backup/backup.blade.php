@extends('../layout/layout')
@section('subhead')
<title>Backup</title>
@endsection
@section('subcontent')
<div id="demo" class="py-6  h-full ">
    <div class="mx-auto max-w-8xl  flex">
        <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Backup </h1>
    </div>
    <div class="mx-auto max-w-8xl  ">
        <!-- Replace with your content -->
        <div class="py-4 datatable">
            <div class=" rounded-lg border-4  border-gray-200 bg-white" style="min-height:80vh ;">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 mt-6">
                    <template>
                        <div id="app" class="col-12">
                            <div class="row ">
                                <div class="py-4">
                                    <div class="sm:flex sm:items-center">
                                        <div class="sm:flex-auto">
                                            <button @click="backupData()" type="button"
                                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                            Backup
                                            </button>

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
                                        <el-table-column prop="name" label="Tên">
                                        </el-table-column>
                                        <el-table-column align="center" label="Tên">
                                            <template slot-scope="scope">
                                                @{{ formatSize(scope.row.size, 5) }}
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Thời gian">
                                            <template slot-scope="scope">
                                                @{{ formattedDateTime(scope.row.timebackup) }}
                                            </template>
                                        </el-table-column>

                                        <el-table-column align="center" width="270">
                                            <template slot="header" slot-scope="scope">
                                                Chức năng
                                            </template>
                                            <template slot-scope="scope">
                                                <el-tooltip class="item" effect="dark" content="Khôi phục dữ liệu"
                                                    placement="top-start">
                                                    <el-button size="mini" @click="handleRestoreData(scope.row.id)">
                                                        <i class="el-icon-refresh-right text-lg"></i>
                                                    </el-button>
                                                </el-tooltip>
                                                <el-tooltip  class="item" effect="dark" content="Xóa"
                                                        placement="top-start">
                                                        <el-button size="mini" @click="handleRemove(scope.row.id)">
                                                            <i class="el-icon-delete text-lg"></i>
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
<script type="module" src="./js/backup/backup.js"></script>
@endsection