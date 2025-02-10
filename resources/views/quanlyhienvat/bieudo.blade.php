@extends('../layout/layout')
@section('subhead')

@if($quanlybosuutap)
@if($qlnoitrungbay)
@if($qlntbAo)
<title>Bảo tàng số 4.0</title>
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet"
    href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
text.highcharts-credits {
    display: none;
}

#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 90vw;
    margin: 1em auto;
}


#container5 .highcharts-data-table table {
    min-width: 310px;
    margin: 2px;
}

#container6 .highcharts-data-table table {
    min-width: 310px;
    margin: 2px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

[v-cloak] {
    display: none;
}
</style>
@endsection

@section('subcontent')
<div class="py-6  h-full ">

    <div id="bieudo" class="px-4 sm:px-6 md:px-8 grid grid-cols-12">
        @if(auth()->user()->chucvu_id == 1 || auth()->user()->chucvu_id == 2 || auth()->user()->chucvu_id == 3)
        <div class="relative col-span-12 md:col-span-4 xl:col-span-6 2xl:col-span-8 ">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" v-model="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nhập hiện vật, số ký hiệu" required>

        </div>
        <button type="submit" @click="searchinfohienvat"
            class=" col-span-12  md:col-span-4 xl:col-span-3 2xl:col-span-2  inline-flex items-center py-2.5 px-3 mt-4 md:ml-2 md:mt-0 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>TÌM KIẾM
        </button>

        <button type="submit" @click="creatHienvat"
            class="col-span-12  md:col-span-4 xl:col-span-3 2xl:col-span-2   inline-flex items-center py-2.5 px-3 mt-4 md:ml-2 md:mt-0 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-codesandbox">
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                </path>
                <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            Thêm hiện vật

        </button>
        @else
        <div class="relative col-span-12 md:col-span-10 xl:col-span-10 2xl:col-span-10 ">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" v-model="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nhập hiện vật, số ký hiệu" required>

        </div>
        <button type="submit" @click="searchinfohienvat"
            class=" col-span-12  md:col-span-2 xl:col-span-2 2xl:col-span-2  inline-flex items-center py-2.5 px-3 mt-4 md:ml-2 md:mt-0 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>TÌM KIẾM
        </button>

        @endif
    </div>
    <div class="flex flex-wrap  ">
        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5 mb-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-3 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <a href="/quan-ly-hien-vat">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs"> Hiện vật</h5>
                                <span class="font-semibold text-xl text-blueGray-700">{{$demhienvat}}</span>
                            </a>

                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-red-500">
                                <a href="/quan-ly-hien-vat">
                                    <i class="fas fa-chart-bar "></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class=" mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-4 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <a href="/bo-suu-tap">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">Bộ sưu tập</h5>
                                <span class="font-semibold text-xl text-blueGray-700">{{$dembosuutap}}</span>
                            </a>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-pink-500">
                                <a href="bo-suu-tap">
                                    <i class="fas fa-chart-pie"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <a href="quan-ly-trung-bay">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">Nơi Trưng bày </h5>
                                <span class="font-semibold text-xl text-blueGray-700">{{$demnoitrungbay}}</span>
                            </a>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-lightBlue-500">
                                <a href="quan-ly-trung-bay">
                                    <i class="fas fa-users"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-4 w-full lg:w-6/12 xl:w-3/12 px-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <a href="trung-bay-ao">
                                <h5 class="text-blueGray-400 uppercase font-bold text-xs">Nơi Trưng bày ảo</h5>
                                <span class="font-semibold text-xl text-blueGray-700">{{$demntbAo}}</span>
                            </a>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-emerald-500">
                                <a href="trung-bay-ao">
                                    <i class="fas fa-percent"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- statistical -->
    <!--  -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8 ">
        <div id="demo " class="grid grid-cols-12 sm:overflow-hidden overflow-x-auto">
            <!-- biểu 1 -->
            <!-- bieu 5 -->
            <div class="col-span-12 md:col-span-6 p-2">
                <figure class="highcharts-figure">
                    <div id="container5"></div>
                </figure>
            </div>

            <!-- bieu 2 -->
            <div class="col-span-12 md:col-span-6 p-2">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>

            <!-- bieu 3 -->

            <div class="col-span-12 md:col-span-6 p-2">
                <figure class="highcharts-figure">
                    <div id="container3"></div>
                </figure>
            </div>
            <!-- bieu 4 -->

            <div class="col-span-12 md:col-span-6 p-2">
                <figure class="highcharts-figure">
                    <div id="container4"></div>
                </figure>
            </div>




            <!-- bieu 6 -->

            <!-- <div class="col-span-12 p-2">
                <figure class="highcharts-figure  ">
                    <div id="container6"></div>
                </figure>
            </div> -->

        </div>

    </div>
</div>

<script>
var vm = new Vue({
    el: '#bieudo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name'
            ],
            // đường dẫn đến ajax
            url: '',
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
        },
        rowId: '',
        statusForm: '',
        dataForm: form({

            })
            .rules({

            })
            .messages({

            }),
        search: '',
    },
    watch: {

    },
    mounted: function() {

    },
    methods: {
        searchinfohienvat() {
            const self = this;
            window.location.href = "/tim-kiem-hien-vat?search=" + self.search;
        },
        creatHienvat() {
            const self = this;
            window.location.href = "/view-them-sua-hien-vat";
        },
    }
})
window.width = screen.width;

// bieu 2
// Data retrieved from https://netmarketshare.com
var datass = <?php echo json_encode($data, JSON_HEX_TAG); ?>;

Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Thống kê hiện vật theo hình thức sưu tầm'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{

        name: 'Tỷ lệ',

        data: datass,


        colorByPoint: true,
    }]
});
// bieu 3
var lhv = <?php echo json_encode($dataloaihienvat, JSON_HEX_TAG); ?>;
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Thống kê loại hiện vật',
        align: 'center',
        verticalAlign: '',
        y: 60
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%'],
            size: '110%'
        }
    },
    series: [{
        type: 'pie',
        name: 'Tỷ lệ',
        innerSize: '50%',
        data: lhv,
    }]
});
// bieu 4
var vthv = <?php echo json_encode($datavthv, JSON_HEX_TAG); ?>;
Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Thống kê theo Vị trí hiện vật'
    },
    subtitle: {
        align: 'left',
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: ''
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Tài liệu kiểm chứng<br/>'
    },

    series: [{
        name: "",
        colorByPoint: true,
        data: vthv,
    }],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'center'
            }
        },
        series: [{
                name: "Chrome",
                id: "Chrome",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                    [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Firefox",
                id: "Firefox",
                data: [
                    [
                        "v58.0",
                        1.02
                    ],
                    [
                        "v57.0",
                        7.36
                    ],
                    [
                        "v56.0",
                        0.35
                    ],
                    [
                        "v55.0",
                        0.11
                    ],
                    [
                        "v54.0",
                        0.1
                    ],
                    [
                        "v52.0",
                        0.95
                    ],
                    [
                        "v51.0",
                        0.15
                    ],
                    [
                        "v50.0",
                        0.1
                    ],
                    [
                        "v48.0",
                        0.31
                    ],
                    [
                        "v47.0",
                        0.12
                    ]
                ]
            },
            {
                name: "Internet Explorer",
                id: "Internet Explorer",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Safari",
                id: "Safari",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            {
                name: "Edge",
                id: "Edge",
                data: [
                    [
                        "v16",
                        2.6
                    ],
                    [
                        "v15",
                        0.92
                    ],
                    [
                        "v14",
                        0.4
                    ],
                    [
                        "v13",
                        0.1
                    ]
                ]
            },
            {
                name: "Opera",
                id: "Opera",
                data: [
                    [
                        "v50.0",
                        0.96
                    ],
                    [
                        "v49.0",
                        0.82
                    ],
                    [
                        "v12.1",
                        0.14
                    ]
                ]
            }
        ]
    }
});
// bieu 5
var datachatlieu = <?php echo json_encode($datachatlieu, JSON_HEX_TAG); ?>;
Highcharts.chart('container5', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Thống kê hiện vật theo chất liệu'
    },

    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Times New Roman", Times, serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Đơn vị đo số lượng'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Số lượng hiện vật theo chất liệu'
    },
    series: [{
        name: 'số lượng',
        data: datachatlieu,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            //   format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Times New Roman", Times, serif'
            }
        }
    }]
});
var chart2 = Highcharts.chart('container6', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Tổng điểm các đơn vị cấp huyện năm ' + new Date().getFullYear()
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Tổng điểm năm 2022: <b>{point.y:.1f} điểm</b>'
    },
    series: [{
        name: 'Population',
        // data: bieu6,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
// chart.setSize(screen.width - 400);
// chart2.setSize(screen.width - 400);
</script>


@endif
@endif
@endif
@endsection