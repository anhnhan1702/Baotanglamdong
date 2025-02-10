Vue.component('treeselect', VueTreeselect.Treeselect)
var vm = new Vue({
    el: '#demo',
    data: {
        options: {
            ajax: {
                url: '/ajax-giao-viec',
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
            congviec: {
                label: 'Công việc',
                name: 'congviec',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            },
            sotien: {
                label: 'Số tiền',
                name: 'sotien',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            },
            diadiem: {
                label: 'Địa điểm',
                name: 'diaban1',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
            },
            donvi_ma: {
                label: 'Đơn vị',
                name: 'donvi',
                sortable: false,
                searchable: true,
                className: 'text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
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
        diadiem: null,
        quickSearch: '',
        inputTongso: '',
        isActivemodal: true,
        dataForm: form({
                congviec: '',
                sotien: '',
                diadiem: null,
                donvi_ma: '',
            })
            .rules({
                congviec: 'required',
                sotien: 'required',
                diadiem: 'required',
                donvi_ma: 'required',
            })
            .messages({
                'congviec.required': 'Công việc bắt buộc nhập',
                'sotien.required': 'Số tiền bắt buộc nhập',
                'diadiem.required': 'Địa điểm bắt buộc nhập',
                'donvi_ma.required': 'Đơn vị bắt buộc nhập',


            }),
        statusForm: '',
        rowId: '',
        listdonvi: [],
        listdiaban: []

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
        diadiem() {
            this.dataForm.data.diadiem = this.diadiem;
        }

    },
    mounted: function() {
        //Load bảng khi load trang
        this.loaddatatable();
        const self = this;
        axios.get("/dl-diaban-ngayht")
            .then(function(response) {
                // handle success
                self.listdiaban = response.data["diaban"];
                // self.diaban_id = 1;

            });
        // danh mục đơn vị
        axios.get("/danh-muc/donvis")
            .then(function(response) {
                self.listdonvi = response.data;
            })
            .catch(function(error) {
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

            // Gán giá trị cho form
            this.dataForm.data.congviec = data.congviec;
            this.dataForm.data.sotien = data.sotien;
            this.dataForm.data.diadiem = data.diadiem;
            this.dataForm.data.donvi_ma = data.donvi_ma;
            console.log(data)
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
                    axios.delete("/delete-giao-viec?id=" + data.id)
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
            this.dataForm.data.congviec = '';
            this.dataForm.data.sotien = '';
            this.dataForm.data.diadiem = '';
            this.dataForm.data.donvi_ma = '';
            this.openmodal();
        },
        submitform() {
            if (this.dataForm.validate().errors().any()) {
                return;
            }
            const self = this;
            this.closemodal()
            if (this.statusForm == "insert") {
                axios.post("/save-giao-viec", self.dataForm.data).then(function(response) {
                        self.thongbaothanhcong('Lưu thành công')
                        self.loaddatatable();
                    })
                    .catch(error => {
                        thongbaothatbai(error);
                    });
            } else {
                axios.post("/update-giao-viec", {
                        id: self.rowId,
                        data: self.dataForm.data
                    }).then(function(response) {
                        self.thongbaothanhcong('Sửa thành công')
                        self.loaddatatable();
                    })
                    .catch(error => {
                        thongbaothatbai(error);
                    });
            }

        }
    }
})