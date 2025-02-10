var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-category',
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

            title: '',
            desc: '',
            content: '',
            display: false,
        })
            .rules({
                title: 'required',
            })
            .messages({
                'title.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalpost: true,
        tieude: '',
        post: [],
        datadanhmucs: [],
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
        axios.get("/danh-muc/danhmucs").then(function (response) {
            self.post = response.data;
        })
        this.getdatadanhmucs();

    },
    methods: {

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
            console.log('namefile', event.target.files[0]);
            this.namefile = this.selectedFile.name;
        },

        getdatadanhmucs() {
            const self = this;
            axios.get("/danh-muc/danhmucs").then(function (response) {
                self.datadanhmucs = response.data;

            })

        },
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
        openmodalpost(data) {
            this.isActivemodalpost = false;
            this.dataForm.data.title = data.title;
            this.dataForm.data.desc = data.desc;
            this.dataForm.data.content = data.content;
            this.rowId = data.id;
            console.log(data);
        },
        closemodalpost() {
            this.isActivemodalpost = true;

        },
        // view hiện vật
        gallerypost(data) {
            const self = this;
            window.location.href = "/gallery-hien-vat?id=" + data.id +"&table=danhmucs";
        }, 
       
        
        // end hiện vật 
        saveform() {
            this.tieude = 'Thêm mới danh mục'
            this.dataForm.data.title = '';
            this.dataForm.data.order = '';
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
                axios.post("/save-category", this.dataForm.data).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loadData();
                    self.getdatadanhmucs();
                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                console.log();
                axios.post("/update-category", {
                    id: self.rowId,
                    data: this.dataForm.data
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
        // load lại dữ liệu
        loadData() {
            const self = this;
            // Lấy index bản ghi bắt đầu
            var start = this.datatb.length * (this.datatb.paginatenow - 1);
            self.datatb.start = start;
            // Ajax dữ liệu
            axios.get(self.datatb.url, {
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
                    console.log('response', response);
                    
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
            this.tieude = 'Sửa tin bài'
            this.dataForm.data.title = data.title;
            this.dataForm.data.order = data.order;
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
                axios.delete("/delete-category?id=" + data.id)
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
        submitformpost() {

            this.closemodalpost();
            const self = this;
            axios.post("/update-category", {
                id: self.rowId,
                data: self.dataForm.data
            }).then(function (response) {
                self.thongbaothanhcong('Sửa thành công')
                self.loadData();

            })
                .catch(error => {
                    self.thongbaothatbai(error);
                });


        },
    }
})

