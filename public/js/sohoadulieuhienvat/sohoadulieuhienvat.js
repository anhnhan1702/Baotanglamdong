import {
    v4 as uuidv4
} from 'https://jspm.dev/uuid';
var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name'
            ],
            // đường dẫn đến ajax
            url: '/ajax-du-lieu-so-hoa-hien-vat',
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
            name: '',
            uuid: '',
        })
            .rules({
                name: 'required',
            })
            .messages({
                'name.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalnhomquyen: true,
        tieude: '',
        nhomquyen: [],
        datanhomquyens: [],
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
       

    },
    methods: {
        openmodal() {
            this.isActivemodal = false;
        },
        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },
        openmodalnhomquyen(data) {
            this.isActivemodalnhomquyen = false;
            this.dataForm.data.name = data.name;
            this.rowId = data.id;
            console.log(data);
        },
        closemodalnhomquyen() {
            this.isActivemodalnhomquyen = true;

        },
 
        // end hiện vật 
        saveform() {
            this.tieude = 'Thêm mới hiện vật số hóa'
            this.dataForm.data.name = '';
            this.dataForm.data.uuid = uuidv4();
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
                axios.post("/save-du-lieu-so-hoa-hien-vat", this.dataForm.data
                ).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loadData();
                   
                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                console.log();
                axios.post("/update-du-lieu-so-hoa-hien-vat", {
                    id: self.rowId,
                    data: this.dataForm.data
                }
                ).then(function (response) {
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
            this.tieude = 'Sửa số hóa dữ liệu hiện vật'
            this.dataForm.data.name = data.name;
            this.dataForm.data.uuid = data.id;
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
                axios.delete("/delete-du-lieu-so-hoa-hien-vat?id=" + data.id)
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
       
    }
})

