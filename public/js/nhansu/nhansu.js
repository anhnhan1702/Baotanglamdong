window.classcolum = 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider';
var vm = new Vue({
    el: '#demo',
    data: {
        options: {
            ajax: {
                url: '/ajax-nhan-su',
                type: 'GET',
                dataSrc: (json) => {
                    return json.data
                },
                // data: function ( d ) {
                //     d.tongso = window.tongso;
                // }
            },
            // buttons: ['copy', 'csv', 'print'],
            /*eslint-disable */
            dom: "Btr<'grid grid-cols-12 vdtnet-footer '<'col-span-4'i><'col-span-8 col-span-8 mx-auto'pl>>",
            /*eslint-enable */
            responsive: true,
            processing: true,
            searching: true,
            searchDelay: 1500,
            destroy: true,
            ordering: true,
            lengthChange: true,
            serverSide: true,
            fixedHeader: true,
            stateSave: true,
            scrollX: 600
        },
        fields: {
            id: {
                label: 'ID',
                sortable: true,
                className: window.classcolum
            },
            username: {
                label: 'Họ và tên',
                name: 'name',
                sortable: false,
                searchable: true,
                className: window.classcolum
            },
            ngaysinh1: {
                label: 'Ngày sinh',
                name: 'ngaysinh1',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            namcongtac1: {
                label: 'Năm công tác',
                name: 'namcongtac1',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            vaocongty1: {
                label: 'Vào công ty',
                name: 'vaocongty1',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            donvi1: {
                label: 'Đơn vị',
                name: 'donvi1',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            hesoluong: {
                label: 'Hệ số lương',
                name: 'hesoluong',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            thamnienvuotkhung: {
                label: 'Thâm niên vượt khung',
                name: 'thamnienvuotkhung',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            phucapthamnien: {
                label: 'Phụ cấp thâm niên',
                name: 'phucapthamnien',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            phucapchucvu: {
                label: 'Phụ cấp chức vụ',
                name: 'phucapchucvu',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            thulao: {
                label: 'Thù lao',
                name: 'thulao',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            quyluong: {
                label: 'Quỹ lương',
                name: 'quyluong',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            phucap5: {
                label: 'Phụ cấp 5%',
                name: 'phucap5',
                sortable: false,
                searchable: false,
                className: window.classcolum
            },
            // tongluong: {
            //     label: 'Tổng lương',
            //     name: 'tongluong',
            //     sortable: false,
            //     searchable: false,
            //     className: window.classcolum
            // },
            sosobaohiem: {
                label: 'Số sổ bảo hiểm',
                name: 'sosobaohiem',
                sortable: false,
                searchable: true,
                className: window.classcolum
            },
            actions: {
                isLocal: true,
                label: 'Actions',
                className: 'w-36',
                template: '<a href="javascript:void(0);" data-action="edit" class="btn btn-primary btn-sm mr-2"><i class="mdi mdi-square-edit-outline"></i> Edit</a>' +
                    '<span data-action="delete" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i> Delete</span>'
            },
        },
        quickSearch: '',
        details: {
            // index: 'a 123number (start at 1) representing the column position',
            // template: 'Thích viết j thì viết',
            // render: 'provide a custom render function as alternative to template'
        },
        inputTongso: '',
        isActivemodal: true,
        dataForm: form({
            hesoluong: '',
            thamnienvuotkhung: '',
            phucapthamnien: '',
            phucapchucvu: '',
            name: '',
            ngaysinh: '',
            namcongtac: '',
            vaocongty: '',
            thulao: '',
            quyluong: '',
            phucap5: '',
            sosobaohiem: '',
            donvi: '',
        })
            .rules({
                name: 'required',
                // ngaysinh: 'required',
                // namcongtac: 'required',
                // vaocongty: 'required',
                hesoluong: 'required',
                sosobaohiem: 'required',
                donvi:'required',
            })
            .messages({
                'name.required': 'Họ và tên bắt buộc nhập',
                // 'ngaysinh.required': 'Ngày sinh  bắt buộc nhập',
                // 'namcongtac.required': 'Năm công tác bắt buộc nhập',
                // 'vaocongty.required': 'Vào công ty bắt buộc nhập',
                'hesoluong.required': 'Hệ số lương bắt buộc nhập',
                'sosobaohiem.required': 'Số sổ bảo hiêm bắt buộc nhập',
                'donvi.required': 'Đơn vị bắt buộc nhập',

            }),
        statusForm: '',
        rowId: '',
        listhesoluong: [],
        listhamnienvuotkhung: [],
        lisphucapthamnien: [],
        lisphucapchucvu: [],
        listquyluong: [],
        listdonvi:[],



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
        ['form.data']: {
            deep: true,
            immediate: false,
            handler: (now, old) => { this.form.validate(); },
        }


    },
    mounted: function () {
        //Load bảng khi load trang
        this.loaddatatable();
        const self = this;
        // danh mục hệ số lương
        axios.get("/danh-muc/hesoluongs")
            .then(function (response) {
                self.listhesoluong = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
        // danh mục hệ số lương
        axios.get("/danh-muc/quyluongs")
            .then(function (response) {
                self.listquyluong = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
        axios.get("/danh-muc/donvis")
            .then(function (response) {
                self.listdonvi = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
        // danh mục thâm niên vượt khung
        axios.get("/danh-muc/thamnienvuotkhungs")
            .then(function (response) {
                self.listhamnienvuotkhung = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
        // danh mục hệ số lương
        axios.get("/danh-muc/phucapthamniens")
            .then(function (response) {
                self.lisphucapthamnien = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
        // danh mục hệ số lương
        axios.get("/danh-muc/phucapchucvus")
            .then(function (response) {
                self.lisphucapchucvu = response.data;
            })
            .catch(function (error) {
                // Thông báo xóa thất bại
            });
    },
    methods: {
        loaddatatable() {
            this.quickSearch = '';
            this.$refs.table.search(this.quickSearch)
        },
        //data table
        doAlertEdit(data) {
            const self = this;
            axios.get("/view-edit?id=" + data.id)
                .then(function (response) {
                    self.dataForm.data.name = response.data.name;
                    self.dataForm.data.ngaysinh = response.data.ngaysinh1;
                    self.dataForm.data.namcongtac = response.data.namcongtac1;
                    self.dataForm.data.vaocongty = response.data.vaocongty1;
                    self.dataForm.data.hesoluong = response.data.hesoluong_id;
                    self.dataForm.data.thamnienvuotkhung = response.data.thamnienvuotkhung_id;
                    self.dataForm.data.phucapthamnien = response.data.phucapthamnien_id;
                    self.dataForm.data.phucapchucvu = response.data.phucapchucvu_id;
                    self.dataForm.data.thulao = response.data.thulao;
                    self.dataForm.data.quyluong = response.data.quyluong;
                    self.dataForm.data.phucap5 = response.data.phucap5;
                    self.dataForm.data.sosobaohiem = response.data.sosobaohiem;
                    self.dataForm.data.donvi = response.data.donvi_ma;

                    // Sửa tình trạng form
                    self.statusForm = "update";
                    self.rowId = data.id;
                    self.openmodal('sua');
                })
                .catch(function (error) {
                    // Thông báo xóa thất bại
                });
            // Gán giá trị cho form

        },
        doAlertDelete(data, row, tr, target) {
            const self = this;
            swalWithBootstrapButtons.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const self = this;
                    axios.delete("/delete-nhan-su?id=" + data.id)
                        .then(function (response) {
                            self.loaddatatable();
                        })
                        .catch(function (error) {
                            // Thông báo xóa thất bại
                            self.thongbaothatbai(error)
                        });
                    swalWithBootstrapButtons.fire(
                        'Xóa thành công!!!',
                        '',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đã hủy xóa',
                    )
                }
            })
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
        //    End
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
            this.dataForm.data.ngaysinh = '';
            this.dataForm.data.namcongtac = '';
            this.dataForm.data.vaocongty = '';
            this.dataForm.data.hesoluong = '';
            this.dataForm.data.thamnienvuotkhung = '';
            this.dataForm.data.phucapthamnien = '';
            this.dataForm.data.phucapchucvu = '';
            this.dataForm.data.thulao = '';
            this.dataForm.data.quyluong = '';
            this.dataForm.data.phucap5 = '';
            this.dataForm.data.sosobaohiem = '';
            this.dataForm.data.donvi = '';

            this.openmodal();
        },
        submitform() {
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            if (this.statusForm == "insert") {
                axios.post("/save-nhan-su", self.dataForm.data).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loaddatatable();
                })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-nhan-su", {
                    id: self.rowId,
                    data: self.dataForm.data
                }).then(function (response) {
                    self.thongbaothanhcong('Sửa thành công')
                    self.loaddatatable();
                })
                    .catch(error => {
                        self.thongbaothatbai('123' + error);
                    });
            }

        }
    }
})