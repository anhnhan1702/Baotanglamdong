@extends('../layout/layout')


@section('subhead')
    <title>Quản lý module</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('subcontent')
    <div id="demo" class="py-6  h-full ">

    
        <div class="mx-auto max-w-8xl  flex">
            <h1 class="text-base sm:text-2xl font-semibold text-gray-900 dark:text-light">Quản lý module </h1>
        </div>
        <div class="mx-auto max-w-8xl ">
            <!-- Replace with your content -->
            <div class="py-4 datatable">
                <div class=" rounded-lg border-4  border-gray-200 bg-white" style="min-height:80vh ;">
                    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
                        <template>
                            <div id="app" class="grid xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10 mt-8">
                                <div v-for="item in modules" class="flex items-center gap-6 p-4 rounded-lg border-2 border-gray-500 ">
                                    <i :class="'text-5xl bi bi-'+item.icon"></i>

                                    <div>
                                        <p class="font-medium text-xl">@{{item.title}}</p>
                                        <button @click="handleStatus(item.id)" v-if="item.is_active" class="bg-red-500 px-2 py-1 text-xs text-white cursor-pointer rounded-lg mt-2">Huỷ cài đặt</button>
                                        <button @click="handleStatus(item.id)" v-if="!item.is_active" class="bg-blue-500 px-2 py-1 text-xs text-white cursor-pointer rounded-lg mt-2">Cài đặt</button>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </div>

    <script type="module" src="./js/danhmuc/module.js"></script>
@endsection
