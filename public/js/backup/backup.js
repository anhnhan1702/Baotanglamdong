var vm = new Vue({
    el: '#demo',
    data: {
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'name'
            ],
            // đường dẫn đến ajax
            url: '/ajax-backup',
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
        searchnow: '',
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
        formatSize(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        },
        formattedDateTime(timestamp){
            const date = new Date(timestamp * 1000); // Nhân với 1000 để chuyển sang milliseconds

            // Định dạng ngày giờ theo ý muốn
            const formattedDateTime = date.toLocaleString("vi-VN", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false, // Sử dụng định dạng 24 giờ
            });
            return formattedDateTime
        },
        handleRestoreData(id){
            const _this = this

            this.$confirm('Sau khi khôi phục dữ liệu. Dữ liệu hiện tại của bạn sẽ được thay thế bằng dữ liệu này!', 'Chú ý', {
                confirmButtonText: 'Vâng, khôi phục!',
                cancelButtonText: 'Hủy!',
                type: 'warning',
                center: true
            }).then(() => {
                const loading = _this.$loading({
                    lock: true,
                    text: 'Vui lòng chờ. Hành động này không thể hủy!',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                  });
                axios.post('/ajax/restore-data',{id})
                    .then((res)=>{
                        loading.close();
                        if(res.data.status == 1){
                            _this.thongbaothanhcong(res.data.message)
                            setTimeout(()=>{
                                window.location.href="/"
                            }, 500)
                        }else{
                            loading.close();
                        }
                    })
                    .catch((error)=>{
                        loading.close();
                        _this.thongbaothatbai('Thất bại')
                    })
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy khôi phục'
                });
            });
        },
        pagination(data) {
            // Gán lại giá trị paginatenow
            this.datatb.paginatenow = data;
            // Load lại bảng
            this.loadData();
        },
        backupData(){
            const _this = this
            const loading = _this.$loading({
                lock: true,
                text: 'Vui lòng chờ. Hành động này không thể hủy!',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
              });
            axios.post('/ajax/backup-data-now')
                .then((response)=>{
                    loading.close();
                    _this.thongbaothanhcong('Backup dữ liệu hệ thống thành công')
                    _this.loadData()
                })
                .catch((error)=>{
                    loading.close();
                    _this.thongbaothatbai('Thất bại')
                })
        },
        handleRemove(id){
            const _this = this

            this.$confirm('Thao tác này không thể quay lại, bạn chắc chắn tiếp tục?', 'Cảnh báo', {
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                type: 'warning',
                center: true
            }).then(() => {
                axios.delete('/backup-data/'+id)
                    .then((res)=>{
                        if(res.data.status == 1){
                            _this.thongbaothanhcong(res.data.message)
                            _this.loadData()
                        }else{
                            _this.thongbaothatbai(res.data.message)
                        }
                    })
                    .catch((error)=>{
                        _this.thongbaothatbai('Thất bại')
                    })
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Đã hủy xóa'
                });
            });
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

