var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name'
            ],
            // đường dẫn đến ajax
            url: '/ajax-gallery-hien-vat',
            // Số bản ghi trên 1 trang
            length: 200,

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


        tieude: '',
        isActivemodal_1: true,
        isActivemodal_2: true,
        isActivemodal_3: true,
        search: '',
        table: '',
        databosuutaps: [],
        tableDataView: {},
        danhsachchatlieu: [],
        danhsachhinhthucsuutam: [],
        danhsachloaihienvat: [],
        datakho: [],
        danhsachbosuutap: [],
        // kho
        hinhthucsuutam: '',
        chatlieu: '',
        loaihienvat: '',
        vitrihienvat: null,
        bosuutap: null,
        anhhienvat: [],
        tailieuhienvat: [],
        hienvat_id: '',
        normalizer(node) {
            return {
                id: node.id,
                label: node.name,
                children: node.children,
            }
        },
        danhsachhienvat: [],
    },
    watch: {
        searchnow() {
            const self = this;
            this.loadData();
        },
        vitrihienvat() {
            this.loadData()
        },

        hinhthucsuutam() {
            this.loadData()

        },
        chatlieu() {
            this.loadData()
        },

        loaihienvat() {
            this.loadData()
        },
        bosuutap() {
            this.loadData()
        }
    },
    mounted: function () {
        let uri = window.location.search.substring(1);
        let params = new URLSearchParams(uri);
        this.id = params.get("id");
        this.table = params.get("table");
        this.loadData();
        const self = this;

        axios.get("/danh-muc/chatlieus").then(function (response) {
            self.danhsachchatlieu = response.data;
        })
        axios.get("/danh-muc/hinhthucsuutams").then(function (response) {
            self.danhsachhinhthucsuutam = response.data;
        })
        axios.get("/danh-muc/loaihienvats").then(function (response) {
            self.danhsachloaihienvat = response.data; //ok
        })
        axios.get("/data-kho").then(function (response) {
            self.datakho = response.data;
        })
        axios.get("/ajax-bo-suu-tap-1").then(function (response) {
            self.danhsachbosuutap = response.data;
        })

    },
    methods: {
        exportworddanhsachhienvat(data) {
            const self = this;

            if (data.length > 0) {
                const idhienvats = [];
                for (let index = 0; index < data.length; index++) {
                    idhienvats.push(data[index].id);

                }

                window.open('/export-word?data=' + idhienvats + '&kieuxuat=danhsachhienvat', '_blank')
            } else {
                self.thongbaothatbai('bạn chưa chọn hiện vật');
            }

        },
        exportword(data) {
            const self = this;
            window.open('/export-word?data=' + self.hienvat_id + '&kieuxuat=phieuhienvat', '_blank')
        },
        decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        pagination(data) {
            // Gán lại giá trị paginatenow
            this.datatb.paginatenow = data;
            // Load lại bảng
            this.loadData();
        },
        // load lại dữ liệu
        loadData() {
            const self = this;
            // Lấy index bản ghi bắt đầu
            var start = this.datatb.length * (this.datatb.paginatenow - 1);
            self.datatb.start = start;
            // Ajax dữ liệu
            axios
                .get(self.datatb.url, {
                    // Đẩy dữ liệu lên controller
                    params: {
                        // Giá trị mặc định phải có
                        // start:index bản ghi bắt đầu
                        // length:số lượng bản ghi trên 1 trang
                        // searchcolum:Các cột được phép tìm kiếm
                        // searchnow: Giá trị tìm kiêm hiện tại
                        id: this.id,
                        table: this.table,
                        start: this.datatb.start,
                        searchcolum: this.datatb.searchcolum,
                        length: this.datatb.length,
                        searchnow: this.searchnow,
                        hinhthucsuutam: self.hinhthucsuutam,
                        chatlieu: self.chatlieu,
                        loaihienvat: self.loaihienvat,
                        vitrihienvat: self.vitrihienvat,
                        bosuutap: self.bosuutap,
                    },
                })
                .then(function (response) {
                    // Tổng số trang hiện có
                    self.datatb.total = Math.ceil(
                        response.data.recordsTotal / self.datatb.length
                    );
                    // Dữ liệu bảng
                    self.datatb.tableData = response.data.data;
                    self.danhsachhienvat = response.data.data;

                });
        },
        searchinfohienvat() {
            const self = this;
            this.loadData();
        },

        openmodalView(data) {
            this.hienvat_id = data.id;
            this.isActivemodal_1 = false;
            const self = this;
            if (data.bosuutap_id == null) {
                self.infomodalView(data, null);
            } else {
                axios.get("/info-bo-suu-tap?bosuutap_id=" + data.bosuutap_id).then(function (response) {
                    self.namebosuutap = response.data;

                    self.infomodalView(data, self.namebosuutap);
                })

            }


        },
        openmodalXemfile(data) {
            this.isActivemodal_2 = false;
            const self = this;
            axios.get("/info-file-hien-vat?hienvat_id=" + data.id).then(function (response) {
                self.anhhienvat = response.data.anh;
                self.tailieuhienvat = response.data.tailieuhienvat;
            })
        },
        infomodalView(data, namebosuutap) {
            var namehinhthucsuutam = '';
            for (let i = 0; i < this.danhsachhinhthucsuutam.length; i++) {

                if (this.danhsachhinhthucsuutam[i]['id'] == data.hinhthucst_id) {
                    namehinhthucsuutam = this.danhsachhinhthucsuutam[i]['name'];
                }


            }
            var namechatlieu = '';
            for (let i = 0; i < this.danhsachchatlieu.length; i++) {

                if (this.danhsachchatlieu[i]['id'] == data.chatlieu_id) {
                    namechatlieu = this.danhsachchatlieu[i]['name'];
                }


            }
            var nameloaihienvat = '';
            for (let i = 0; i < this.danhsachloaihienvat.length; i++) {
                if (this.danhsachloaihienvat[i]['id'] == data.loaihienvat_id) {
                    nameloaihienvat = this.danhsachloaihienvat[i]['name'];
                }
            }
            var anh1 = null;
            var anh2 = null;
            var namevitrihienvat = '';
            for (let i = 0; i < this.datakho.length; i++) {
                if (this.datakho[i]['id'] == data.vitrihv_id) {
                    namevitrihienvat = this.datakho[i]['name'];
                }
            }
            if (data.fileuploads.length >= 2) {
                anh1 = data.fileuploads[0]['link'];
                anh2 = data.fileuploads[0]['link'];
            } else if (data.fileuploads.length > 0) {
                anh1 = data.fileuploads[0]['link'];
            }
            this.tableDataView = {
                name: data.name,
                ten_khac: data.ten_khac,
                so_ky_hieu: data.so_ky_hieu,
                soluong: data.soluong,
                sothanhphan: data.sothanhphan,
                chu_nhan: data.chu_nhan,
                dia_diem_st: data.dia_diem_st,
                hinhthucst_id: namehinhthucsuutam,
                thoi_gian_st: data.thoi_gian_st,
                chatlieu_id: namechatlieu,
                mau_sac: data.mau_sac,
                kich_thuoc: data.kich_thuoc,
                trong_luong: data.trong_luong,
                hinh_dang: data.hinh_dang,
                ky_thuat_ct: data.ky_thuat_ct,
                tinh_trang_hv: data.tinh_trang_hv,
                tg_nhap_kho: data.tg_nhap_kho,
                loaihienvat_id: nameloaihienvat,
                nguon_goc: this.decodeHtml(data.nguon_goc),
                dudoan_niendai: data.dudoan_niendai,
                baoquan_phucche: data.baoquan_phucche,
                vitrihv_id: data.vitrihv_id,
                vitrihienvat: namevitrihienvat,
                bosuutap_id: namebosuutap,
                anh1: anh1,
                anh2: anh2,
                ghinho: data.ghinho,
            }

        },
        closemodal_1() {
            this.isActivemodal_1 = true;


        },
        closemodal_2() {
            this.isActivemodal_2 = true;


        },
        openmodalDshienvat() {
            const self = this
            for (let index = 0; index < self.danhsachhienvat.length; index++) {
               
                if (self.danhsachhienvat[index].fileuploads.length > 0) {
                    self.danhsachhienvat[index].anh = self.danhsachhienvat[index].fileuploads[0]['link'];
                }

            }
         
            this.isActivemodal_3 = false;
        },
        closemodal_3() {
            this.isActivemodal_3 = true;


        },

        print() {
            // Pass the element id here
            this.$htmlToPaper('printMe');
        },
        print2() {
            // Pass the element id here
            this.$htmlToPaper('printMe2');
        },
        thongbaothanhcong(text) {
            this.$notify({
                title: 'Success',
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

    }
})

