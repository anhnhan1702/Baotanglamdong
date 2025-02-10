window.tongso = 100;
var vm = new Vue({
    el: '#demo',
    data: {
        options: {
            ajax: {
                url: '/ajax-luong-co-ban',
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
            responsive: false,
            processing: true,
            searching: true,
            searchDelay: 1500,
            destroy: true,
            ordering: true,
            lengthChange: true,
            serverSide: true,
            fixedHeader: true,
            stateSave: true,
        },
        fields: {
            id: {
                label: 'ID',
                sortable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',

            },
            username: {
                label: 'Lương cơ bản',
                name: 'name',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            },
            action: {
                label: 'Tình trạng',
                name: 'action',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500  tracking-wider',
            },
            // updated_at: {
            //     label: 'time',
            //     name: 'updated_at',
            //     sortable: false,
            //     searchable: true,
            //     className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            // },
            actions: {
                isLocal: true,
                label: 'Actions',
                defaultContent: '<a href="javascript:void(0);" data-action="edit" class="btn btn-primary btn-sm mr-2"><i class="mdi mdi-square-edit-outline"></i> Edit</a>' +
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
                name: '',
                action: ''
            })
            .rules({
                name: 'required',
            })
            .messages({
                'name.required': 'Hệ số lương bắt buộc nhập',
            }),
        statusForm: '',
        rowId: '',



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

    },
    mounted: function() {
        //Load bảng khi load trang
        this.loaddatatable();
    },
    methods: {
        loaddatatable() {
            this.quickSearch = '';
            this.$refs.table.search(this.quickSearch)
        },
        //data table
        doAlertEdit(data) {

            // Gán giá trị cho form
            this.dataForm.data.name = data.name;
            this.dataForm.data.action = data.action;

            // Sửa tình trạng form
            this.statusForm = "update";
            this.rowId = data.id;
            this.openmodal('sua');
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
                    axios.delete("/delete-luong-co-ban?id=" + data.id)
                        .then(function(response) {
                            self.loaddatatable();
                        })
                        .catch(function(error) {
                            // Thông báo xóa thất bại
                            self.thongbaothatbai(error)
                        });;
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
            this.openmodal();
        },
        submitform() {
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            if (this.statusForm == "insert") {
                axios.post("/save-luong-co-ban", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loaddatatable();
                    })
                    .catch(error => {
                        self.thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-luong-co-ban", {
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