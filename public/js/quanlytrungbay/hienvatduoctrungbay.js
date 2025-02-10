var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-quan-ly-hien-vat-trung-bay',
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
            id: '',
            title: '',
            mota: '',
        })
            .rules({
                title: 'required',
            })
            .messages({
                'title.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalhienvat: true,
        tieude: '',
        hienvat: [],
        hienvatdatrungbay: [],
        searchnow: '',
        selectedFile: null,
        namefile: ''
    },
    watch: {
        searchnow() {
            const self = this;
            this.loadData();
        },
    },
    mounted: function () {
        this.loadData();
        const self = this;

        // axios.get("/danh-muc/hienvats").then(function(response) {
        //     self.hienvat = response.data;

        // })
        axios.get("/danh-muc/quanlytrungbays").then(function (response) {
            self.hienvatdatrungbay = response.data;

        })

    },
    methods: {
 
      

        filterMethod(query, item) {
            return item.title.toLowerCase().indexOf(query.toLowerCase()) > -1;
        },
        openmodal() {
            this.isActivemodal = false;
        },
        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },
  
        saveform() {
            this.tieude = 'Thêm mới hiện vật'
            this.dataForm.data.title = '';
            this.dataForm.data.mota = '';
            this.dataForm.data.file = '';
            this.namefile = '';

            this.statusForm = "insert";
            this.openmodal();
        },
        submitform() {

            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;

            this.closemodal()

            if (this.statusForm == "insert") {
                const formData = new FormData();
                formData.append('file', this.selectedFile);
                formData.append('title', this.dataForm.data.title);
                formData.append('mota', this.dataForm.data.mota);

                axios.post("/save-quan-ly-hien-vat-trung-bay", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loadData();

                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {

                axios.post("/update-quan-ly-hien-vat-trung-bay", {
                    id: self.rowId,
                    data: self.dataForm.data
                }).then(function (response) {
                    self.thongbaothanhcong('Sửa thành công')
                    self.loadData();
                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            }

        },
        pagination(data) {
            // Gán lại giá trị paginatenow
            this.datatb.paginatenow = data;
            // Load lại bảng
            this.loadData();
        },

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
            console.log('namefile', event.target.files[0]);
            this.namefile = this.selectedFile.name;
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

                        start: this.datatb.start,
                        searchcolum: this.datatb.searchcolum,
                        length: this.datatb.length,
                        searchnow: this.searchnow,
                    },
                })
                .then(function (response) {
                    // Tổng số trang hiện có
                    self.datatb.total = Math.ceil(
                        response.data.recordsTotal / self.datatb.length
                    );
                    // Dữ liệu bảng
                    self.datatb.tableData = response.data.data;
                });
        },
        //data table
        doAlertEdit(data) {
            const self = this;
            // Gán giá trị cho form
            this.tieude = 'Sửa hiện vật'
            this.dataForm.data.title = data.title;
            this.dataForm.data.mota = data.mota;
            this.namefile = data.file;

            // Sửa tình trạng form
            this.statusForm = "update";
            this.rowId = data.id;
            this.openmodal('sua');
        },
        doAlertDelete(data, row, tr, target) {
            const self = this;
            this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                type: 'warning',
                center: true
            }).then(() => {
                axios.delete("/delete-quan-ly-hien-vat-trung-bay?id=" + data.id)
                    .then(function (response) {
                        self.loadData();
                    })
                    .catch(function (error) {
                        // Thông báo xóa thất bại
                        self.thongbaothatbai(error)
                    });
                this.$message({
                    type: 'success',
                    message: 'Xóa thành công'
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy xóa'
                });
            });


        },

        doAfterReload(data, table) {
            window.alert('data reloaded')
        },
        doCreating(comp, el) {
            console.log('creating')
        },
        doCreated(comp) {
            console.log('created')
        },
        doExport(type) {
            const parms = this.$refs.table.getServerParams()
            parms.export = type
            window.alert('GET /api/v1/export?' + jQuery.param(parms))
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
      
        // trưng bày hiện vật
        galleryhienvat(data) {
            const self = this;
            window.location.href = "/gallery-hien-vat?id=" + data.id +"&table=quanlytrungbays";
        },
    }
})

