import {
    v4 as uuidv4
} from 'https://jspm.dev/uuid';
var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-portal',
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
            file: '',
            content: '',
            type:'',
            uuid1: '',
        })
            .rules({
                title: 'required',
            })
            .messages({
                'title.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalportal: true,
        tieude: '',
        portal: [],
        searchnow: '',
        selectedFile: null,
        namefile: '',
        decodedContent: "",
        typeModal: '',
        arrImportGiaoDien:[],
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
        decodeHtml(html) {
            const textArea = document.createElement("textarea");
            textArea.innerHTML = html;
            return textArea.value;
          },

        handleFileChange(event) {
            this.selectedFile = event.target.files[0];
            console.log('namefile', event.target.files[0]);
            this.namefile = this.selectedFile.name;
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
            this.tieude = 'Thêm portal'
            this.dataForm.data.title = '';
            this.dataForm.data.uuid1 = uuidv4();
            this.dataForm.data.file = '';
            this.dataForm.data.content = '';
            this.namefile = '';
            this.dataForm.data.type = '';
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
            formData.append('content', this.dataForm.data.content);
            formData.append('type', this.dataForm.data.type);
            formData.append('uuid1', this.dataForm.data.uuid1);
            if (this.statusForm == "insert") {
                axios.post("/save-portal", formData, {
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
                console.log('this.dataForm', this.dataForm.data);
                
                axios.post("/update-portal", {
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
                // Tổng số trang hiện có
                self.datatb.total = Math.ceil(
                    response.data.recordsTotal / self.datatb.length
                );
                // Dữ liệu bảng
                self.datatb.tableData = response.data.data;
                self.arrImportGiaoDien = response.data.data[0]['arrgiaodienimport'];
            });
        },
        //data table
        doAlertEdit(data, typeModal) {
            this.typeModal = typeModal;
            const self = this;

            // Gán giá trị cho form
            this.tieude = 'Lưu'
            this.dataForm.data.title = data.title;
            this.dataForm.data.file = data.file;
            this.dataForm.data.uuid1 = data.id;
            this.dataForm.data.content = this.decodeHtml(data.content);
            this.namefile = data.file;
            this.dataForm.data.type = data.type;
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
                axios.delete("/delete-portal?id=" + data.id)
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
    }
})

