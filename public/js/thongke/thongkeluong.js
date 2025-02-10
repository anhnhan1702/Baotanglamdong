window.loainhanvien = '';
var vm = new Vue({
    el: '#demo',
    data: {
        rowId: '',
        loainhanvien: '',
        listnhanvien: [],



    },

    watch: {
        // inputTongso(data){
        //     window.tongso  =data;
        //     this.$refs.table.search(this.quickSearch)
        // },
        // tìm kiếm
        quickSearch() {
            this.$refs.table.search(this.quickSearch);
            // this.$refs.table.search(this.quickSearch);
        },
        loainhanvien() {
            const self = this;
            axios.get("/ajax-thong-ke-luong?loainhanvien=" +
                    self.loainhanvien).then(function(response) {
                    self.listnhanvien = response.data;
                })
                .catch(error => {});

        }

    },
    mounted: function() {


    },
    methods: {
        openmodal() {
            this.isActivemodal = false;
        },
        closemodal() {
            this.isActivemodal = true;
            this.dataForm.errors().messages = {};
        },
        thongbaothanhcong(text) {
            this.$toasted.show(text, {
                type: 'success',
                duration: 3000,
                theme: 'toasted-primary'
            })
        },
        thongbaothatbai(text) {
            this.$toasted.show(text, {
                type: 'error',
                duration: 3000,
                theme: 'toasted-primary'
            })
        },
        saveform() {
            // Sửa tình trạng form
            this.statusForm = "insert";
            this.dataForm.data.name = '';
            this.openmodal();
        },
        tinhluong() {
            const self = this;
            axios.get("/tinh-luong").then(function(response) {
                    self.thongbaothanhcong('Tính toán thành công');
                    // self.loaddatatable();

                })
                .catch(error => {
                    self.thongbaothatbai(error);
                });
        },
        submitform() {
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            if (this.statusForm == "insert") {
                axios.post("/save-thong-ke-luong", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loaddatatable();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-thong-ke-luong", {
                        id: self.rowId,
                        data: self.dataForm.data
                    }).then(function(response) {
                        self.thongbaothanhcong('Sửa thành công')
                        self.loaddatatable();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            }

        }
    }
})