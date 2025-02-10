var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-post',
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
            slug:'',
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
   
        searchnow: '',
        selectedFile: null,
        namefile: '',
        imagePreview:null,
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
      
     

    },
    methods: {
        deleteFile(){
            this.selectedFile = null;
            this.imagePreview = null;
            this.namefile = null;
        },
        generateSlug() {
            this.dataForm.slug = this.slugify(this.dataForm.title);
        },
        slugify(text) {
            return text
            .toString() // Chuyển thành chuỗi
            .toLowerCase() // Chuyển thành chữ thường
            .normalize('NFD') // Chuẩn hóa các ký tự đặc biệt
            .replace(/[\u0300-\u036f]/g, '') // Xóa các dấu nhưng giữ lại ký tự như 'đ', 'Đ'
            .replace(/[^a-z0-9àáạảãâầấẩẫăằắẳẵêềếểễiíìỉĩịóòọỏõôồốổỗơờớởỡúùụủũưừứửữýỳỵỷỹđĐ\s-]/g, '') // Giữ lại các ký tự đặc biệt tiếng Việt
            .trim() // Xóa khoảng trắng thừa
            .replace(/\s+/g, '-') // Thay dấu cách bằng dấu gạch ngang
            .replace(/-+/g, '-'); // Thay nhiều dấu gạch ngang bằng một
        },
        handleFileChange(event) {

            
            this.selectedFile = event.target.files[0];
            console.log('namefile', event.target.files[0]);
            this.namefile = this.selectedFile.name;
            if (this.selectedFile) {
                const reader = new FileReader(); // Tạo FileReader
                reader.onload = (e) => {
                    this.imagePreview = e.target.result; // Gán URL vào biến để hiển thị
                };
                reader.readAsDataURL(this.selectedFile); // Đọc file dưới dạng Data URL
            }
            console.log(this.selectedFile);
            
        },

        getdataposts() {
            const self = this;
            axios.get("/danh-muc/posts").then(function (response) {
                self.dataposts = response.data;

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
        
       
        
        // end hiện vật 
        saveform() {
            this.tieude = 'Thêm mới tin bài'
            this.dataForm.data.title = '';
            this.dataForm.data.desc = '';
            this.dataForm.data.content = '';
            this.dataForm.data.thumbnail = '';
            this.namefile = '';
            this.dataForm.slug = '';
            this.deleteFile();
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
            formData.append('slug', this.dataForm.data.slug);
            formData.append('content', this.dataForm.data.content);
          

            if (this.statusForm == "insert") {
                axios.post("/save-post", formData, {
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
         
                axios.post("/update-post", {
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
            this.dataForm.data.desc = data.desc;
            this.dataForm.data.slug = data.slug;
            this.dataForm.data.content = data.content;
            this.dataForm.data.thumbnail = data.thumbnail;
            this.imagePreview = data.thumbnail;
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
                axios.delete("/delete-post?id=" + data.id)
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
            axios.post("/update-post", {
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

