var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-pagenew',
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
            keyword: ''
        })
            .rules({
                title: 'required',
            })
            .messages({
                'title.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalpagenew: true,
        tieude: '',
        pagenew: [],
        datapagenew: [],
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
        axios.get("/danh-muc/pagenews").then(function (response) {
            self.pagenew = response.data;
        })
        this.getdatapagenew();

    },
    methods: {

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
            console.log('namefile', event.target.files[0]);
            this.namefile = this.selectedFile.name;
        },

        getdatapagenew() {
            const self = this;
            axios.get("/danh-muc/pagenews").then(function (response) {
                self.datapagenew = response.data;

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
        openmodalpagenew(data) {
            this.isActivemodalpagenew = false;
            this.dataForm.data.title = data.title;
            this.dataForm.data.desc = data.desc;
            this.dataForm.data.content = data.content;
            this.dataForm.data.keyword = data.keyword;
            
            this.rowId = data.id;
            console.log(data);
        },
        closemodalpagenew() {
            this.isActivemodalpagenew = true;

        },
        // view hiện vật
        gallerypagenew(data) {
            const self = this;
            window.location.href = "/gallery-hien-vat?id=" + data.id +"&table=pagenew";
        }, 
       
        
        // end hiện vật 
        saveform() {
            this.tieude = 'Thêm mới trang con'
            this.dataForm.data.title = '';
            this.dataForm.data.desc = '';
            this.dataForm.data.content = '';
            this.dataForm.data.thumbnail = '';
            this.dataForm.data.keyword = '';
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
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            formData.append('title', this.dataForm.data.title);
            formData.append('desc', this.dataForm.data.desc);
            formData.append('content', this.dataForm.data.content);
            formData.append('keyword', this.dataForm.data.keyword);
            
            if (this.statusForm == "insert") {
                axios.post("/save-pagenew", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loadData();
                    self.getdatapagenew();
                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                console.log();
                axios.post("/update-pagenew", {
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
            this.tieude = 'Sửa trang con'
            this.dataForm.data.title = data.title;
            this.dataForm.data.desc = data.desc;
            this.dataForm.data.content = data.content;
            this.dataForm.data.thumbnail = data.thumbnail;
            this.dataForm.data.keyword = data.keyword;
            
            this.namefile = data.thumbnail;

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
                axios.delete("/delete-pagenew?id=" + data.id)
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
        submitformpagenew() {

            this.closemodalpagenew();
            const self = this;
            axios.post("/update-keyword", {
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

