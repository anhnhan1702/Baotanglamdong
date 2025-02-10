@extends('../layout/top-menu')

@section('subhead')
    <title>Tổng hợp</title>
@endsection

@section('subcontent')

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <div class="col-span-12 mt-8">

                <div class="grid grid-cols-12 gap-6 mt-6">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-users  report-box__icon text-theme-10">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>

                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer tooltipstered">
                                            33%
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-users mx-auto">
                                                <polyline points="18 15 12 9 6 15"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">1.510</div>
                                <div class="text-base text-gray-600 mt-1">Tổng số đại biểu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-monitor report-box__icon text-theme-12">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                        <line x1="12" y1="17" x2="12" y2="21"></line>
                                    </svg>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer tooltipstered">
                                            12%
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-chevron-up w-4 h-4">
                                                <polyline points="18 15 12 9 6 15"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">145</div>
                                <div class="text-base text-gray-600 mt-1">Kỳ họp đã diễn ra</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-9 mt-6">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">ĐỊA ĐIỂM TIẾP XÚC CỬ TRI</h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                                <i data-feather="map-pin" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                <input type="text" class="input w-full sm:w-40 box pl-10" placeholder="Nhập thành phố">
                            </div>
                        </div>
                        <div class="intro-y box p-5 mt-12 sm:mt-5">
                            <div class="card">
                                <div class="card-header">
                                    Bản đồ di tích
                                </div>

                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
                                      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
                                      crossorigin=""/>

                                <!-- Make sure you put this AFTER Leaflet's CSS -->
                                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                                        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                                        crossorigin=""></script>
                                <div id="mapid" style="height: 280px; text-aglign:center"></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y mt-6">
                        <div class="col-span-12 xl:col-span-4 ">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    PHIÊN HỌP SẮP DIỄN RA
                                </h2>
                            </div>
                            <div class="mt-5">
                                <div class="intro-y">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="/images/1.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">Phiên họp 01</div>
                                            <div class="text-gray-600 text-xs">Ngày 20/1/2021</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            137 Sales
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="/images/2.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">Phiên họp 02</div>
                                            <div class="text-gray-600 text-xs">Ngày 22/2/2021</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            137 Sales
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="/images/1.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">Phiên họp 03</div>
                                            <div class="text-gray-600 text-xs">Ngày 5/7/2021</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            137 Sales
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="/images/2.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">Phiên họp 04</div>
                                            <div class="text-gray-600 text-xs">Ngày 5/7/2021</div>
                                        </div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            137 Sales
                                        </div>
                                    </div>
                                </div>
                                <a href=""
                                   class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 text-theme-16">Xem
                                    thêm</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-span-12 sm:col-span-9 xl:col-span-9 intro-y mt-6">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                THỐNG KÊ SỐ LƯỢNG ĐƠN BÁO CÁO
                            </h2>

                        </div>
                        <div class="intro-y box p-5 mt-12 sm:mt-5">

                            <div class="report-chart">
                                <canvas id="report-line-chart" height="160" class="mt-6"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y mt-12">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                KẾ HOẠCH GIÁM SÁT
                            </h2>
                        </div>
                        <div class="mt-2">
                            <div class="intro-x box">
                                <div class="p-5">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="feather feather-chevron-left w-5 h-5 text-gray-600">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg>
                                        <div class="font-medium mx-auto">April</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="feather feather-chevron-right w-5 h-5 text-gray-600">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </div>
                                    <div class="grid grid-cols-7 gap-4 mt-5 text-center">
                                        <div class="font-medium">Su</div>
                                        <div class="font-medium">Mo</div>
                                        <div class="font-medium">Tu</div>
                                        <div class="font-medium">We</div>
                                        <div class="font-medium">Th</div>
                                        <div class="font-medium">Fr</div>
                                        <div class="font-medium">Sa</div>
                                        <div class="py-1 rounded relative text-gray-600">29</div>
                                        <div class="py-1 rounded relative text-gray-600">30</div>
                                        <div class="py-1 rounded relative text-gray-600">31</div>
                                        <div class="py-1 rounded relative">1</div>
                                        <div class="py-1 rounded relative">2</div>
                                        <div class="py-1 rounded relative">3</div>
                                        <div class="py-1 rounded relative">4</div>
                                        <div class="py-1 rounded relative">5</div>
                                        <div class="py-1 bg-theme-18 rounded relative">6</div>
                                        <div class="py-1 rounded relative">7</div>
                                        <div class="py-1 bg-theme-1 text-white rounded relative">8</div>
                                        <div class="py-1 rounded relative">9</div>
                                        <div class="py-1 rounded relative">10</div>
                                        <div class="py-1 rounded relative">11</div>
                                        <div class="py-1 rounded relative">12</div>
                                        <div class="py-1 rounded relative">13</div>
                                        <div class="py-1 rounded relative">14</div>
                                        <div class="py-1 rounded relative">15</div>
                                        <div class="py-1 rounded relative">16</div>
                                        <div class="py-1 rounded relative">17</div>
                                        <div class="py-1 rounded relative">18</div>
                                        <div class="py-1 rounded relative">19</div>
                                        <div class="py-1 rounded relative">20</div>
                                        <div class="py-1 rounded relative">21</div>
                                        <div class="py-1 rounded relative">22</div>
                                        <div class="py-1 bg-theme-17 rounded relative">23</div>
                                        <div class="py-1 rounded relative">24</div>
                                        <div class="py-1 rounded relative">25</div>
                                        <div class="py-1 rounded relative">26</div>
                                        <div class="py-1 bg-theme-14 rounded relative">27</div>
                                        <div class="py-1 rounded relative">28</div>
                                        <div class="py-1 rounded relative">29</div>
                                        <div class="py-1 rounded relative">30</div>
                                        <div class="py-1 rounded relative text-gray-600">1</div>
                                        <div class="py-1 rounded relative text-gray-600">2</div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        var myIcon = L.icon({
            iconUrl: 'https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-512.png',
            iconSize: [40, 45],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            <!--    shadowUrl: 'my-icon-shadow.png',-->
            <!--    shadowSize: [14, 55],-->
            <!--    shadowAnchor: [12, 64]-->
        });
        var myIcon1 = L.icon({
            iconUrl: 'https://icon-library.com/images/map-point-icon/map-point-icon-23.jpg',
            iconSize: [40, 45],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            <!--    shadowUrl: 'my-icon-shadow.png',-->
            <!--    shadowSize: [14, 55],-->
            <!--    shadowAnchor: [22, 64]-->
        });

        var map = L.map('mapid').setView([18.66823085738225, 105.66698819555278], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);




        <!--L.marker([ditich[i].kinhdo,ditich[i].vido],{icon: myIcon}).addTo(map).bindPopup(ditich[i].ten).openPopup();-->

        <!--L.marker([ditich[i].kinhdo,ditich[i].vido],{icon: myIcon1}).addTo(map).bindPopup(ditich[i].ten).openPopup();-->

        L.marker([18.60,105.66]).addTo(map).bindPopup('test').openPopup();



        var x = document.getElementById("kinhdo");
        var y = document.getElementById("vido");
        var z = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                z.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.value =  position.coords.latitude;
            y.value =  position.coords.longitude;

        }


    </script>
@endsection
