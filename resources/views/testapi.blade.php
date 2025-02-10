<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <div class="p-5 text-center bg-blue-500 text-white text-2xl">
        PHÒNG GIÁO DỤC VÀ ĐÀO TẠO HUYỆN HÓC MÔN
    </div>
    <div id="demo" class="p-20">

        <button @click="daylen"
            class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Đẩy
            dữ liệu lên</button>
        <button @click="layve"
            class=" mr-2 items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Lấy dữ liệu về</button>


        <table id="customers" class="mt-4">
            <tr>
                <th class="w-32">Tên</th>
                <th>Mã số giao dịch</th>
                <th>Mã phòng gd</th>
                <th>Mã năm học</th>
                <th>Danh sách trường</th>

            </tr>
            <tr v-for="(i,index) in array">
                <td>Lần thứ @{{  index }}</td>
                <td>@{{ i.name.ma_so_gd }}</td>
                <td>@{{ i.name.ma_phong_gd }}</td>
                <td>@{{ i.name.ma_nam_hoc }}</td>
                <td>@{{ i.name.danh_sach_truong }}</td>

            </tr>

        </table>
    </div>
    <script>
        var vm = new Vue({
            el: '#demo',
            data: {
                dataTest: {
                    "ma_so_gd": "79",
                    "ma_phong_gd": "790001",
                    "ma_nam_hoc": 2022,
                    "danh_sach_truong": [{
                        "ma_cap_hoc": "01",
                        "ma_truong": "0111111",
                        "chi_tieu_lop": 10,
                        "chi_tieu_hoc_sinh": 400,
                        "dia_chi": "quận 1",
                        "gioi_thieu_truong": "giới thiệu trường",
                        "hoc_sinh_dieu_tra": 420,
                        "huong_dan_tuyen_sinh": "hướng dẫn tuyển sinh",
                        "dieu_kien_tuyen_sinh": "điều kiện tuyển sinh",
                        "tuyen_tuyen_sinh": "tuyến tuyển sinh",
                        "huong_dan_sau_htdk": "hướng dẫn sau hoàn thành đăng ký"
                    }, ]
                },
                array: [],
            },
            watch: {

            },
            mounted: function() {},
            methods: {
                thongbaothanhcong(text) {
                    this.$notify({
                        // title: 'Success',
                        message: text,
                        type: 'success'
                    });
                },
                thongbaothatbai(text) {
                    this.$notify.error({
                        title: 'Error',
                        message: text
                    });

                },
                layve() {
                    const self = this;
                    axios.get('/api-lay')
                        .then((response) => {
                            self.thongbaothanhcong(
                                'Dữ liệu đã được tải')
                            this.array = response.data;
                            // console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        })

                },
                daylen() {
                    const self = this;
                    axios.post('/api-luu', self.dataTest, {
                            headers: {
                                'Content-Type': 'application/json',
                                'AuthToken': 'd32ed548-e44c-350c-b047-c10f829064fb'
                            }

                        })
                        .then((response) => {
                            self.thongbaothanhcong(
                                'Dữ liệu đã được đẩy lên SỞ GIÁO DỤC VÀ ĐÀO TẠO THÀNH PHỐ HCM')
                            console.log(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        })

                }
            }
        })
    </script>
</body>

</html>
