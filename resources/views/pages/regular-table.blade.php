@extends('../layout/top-menu')

@section('subhead')
    <title>Regular Table - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Regular Table </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Table Head Options -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Nhóm trường báo cáo...</h2>
                </div>
                <div class="p-5" id="head-options-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                        @foreach($truongbc as $tbc)
                                        <th class="whitespace-nowrap">{{ $tbc->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b dark:border-dark-5">1</td>
                                        <td class="border-b dark:border-dark-5">Angelina</td>
                                        <td class="border-b dark:border-dark-5">Jolie</td>
                                        <td class="border-b dark:border-dark-5">@angelinajolie</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b dark:border-dark-5">2</td>
                                        <td class="border-b dark:border-dark-5">Brad</td>
                                        <td class="border-b dark:border-dark-5">Pitt</td>
                                        <td class="border-b dark:border-dark-5">@bradpitt</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b dark:border-dark-5">3</td>
                                        <td class="border-b dark:border-dark-5">Charlie</td>
                                        <td class="border-b dark:border-dark-5">Hunnam</td>
                                        <td class="border-b dark:border-dark-5">@charliehunnam</td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                    
                </div>
            </div>
           
        </div>
    </div>
@endsection