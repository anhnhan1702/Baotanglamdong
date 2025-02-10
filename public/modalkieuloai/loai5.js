Vue.component('modalloaitruong5', {
    data: function () {
        return {
            dataTuyentruyen: []
        }

    },
    props: {
        isActive2: {
            type: String,
        },

        dulieudot_id: {
            type: String,
        },
        check: {
            type: String,
        },
        trangthai: {
            type: String,
        },

    },
    watch: {
        isActive2: function (text) {
            this.tuyentruyen();
        },
        dulieudot_id: function (newId) {
            this.tuyentruyen()
        }
    },
    mounted: function () {
        this.tuyentruyen();
    },
    methods: {
        // Lưu tuyên truyền
        giatritruyentruyen(tuyentruyen) {
            var giatri = {};
            giatri['noidung'] = tuyentruyen.noidung;
            const self = this;
            axios.post("/luu-truyen-truyen", {
                giatri: giatri,
                id: tuyentruyen.id,
                check: self.check
            }).then(function (response) {
                self.$toasted.show('Lưu thành công', {
                    type: 'success',
                    duration: 3000,
                    theme: 'toasted-primary'
                })
                self.tuyentruyen();
            }).catch(function () {
                self.$toasted.show('Lưu thất bại', {
                    type: 'error',
                    duration: 3000,
                    theme: 'toasted-primary'
                })
            });;
        },
        // load lại
        tuyentruyen() {
            const self = this;
            axios
                .get(
                    "/tuyen-truyen?dulieudot_id=" + self.dulieudot_id
                )
                .then(function (response) {
                    self.dataTuyentruyen = response.data;
                    if (self.check != 1) {
                        for (var i = 0; i < 11; i++) {
                            if (self.dataTuyentruyen[i]) {
                                if (self.dataTuyentruyen[i].giatri != null) {
                                    self.dataTuyentruyen[i].noidung = self.dataTuyentruyen[i].giatri['noidung']

                                }
                            }
                        }
                    } else {
                        for (var i = 0; i < 11; i++) {
                            if (self.dataTuyentruyen[i]) {
                                if (self.dataTuyentruyen[i].giatriduyet != null) {
                                    self.dataTuyentruyen[i].noidung = self.dataTuyentruyen[i].giatriduyet['noidung']

                                }
                            }
                        }

                    }
                })



        },
        // tắt modal
        tatmodalloai() {
            this.isActive2 = true;
            this.$emit('tatmodalloai');
        },

        // xóa
        xoatuyentruyen(id) {
            const self = this;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: " Toàn bộ dữ liệu về nhóm trường sẽ biến mất",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không xóa!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const self = this;
                    axios
                        .get(
                            "/xoa-tuyen-truyen?id=" + id
                        )
                        .then(function (response) {
                            self.tuyentruyen();
                        })
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
                        '',
                        'error'
                    )
                }
            })



        },
    },

    // Khi dungf v-for trong template bắt buộc phải có thẻ mẫu gói toàn bộ thẻ 
    template: `
    <div  v-cloak v-bind:class="{ hidden: isActive2 }" style="z-index: 100" class="overflow-y-auto h-full w-full  animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div @click="tatmodalloai()"  class="absolute h-screen w-full bg-black opacity-80 inset-0 z-0"></div>
            <div style="z-index: 200 ; height:80%"  class=" w-full  sm:w-10/12 overflow-y-auto p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white  ">
                <!--content-->   

                <button @click="tatmodalloai()"><i data-feather="x" class="w-8 h-8 text-gray-500"></i> </button>
                <div class=" text-center text-2xl text-red-500">
                   Dữ liệu chi tiết
                </div>
                <!--body-->
                <!--sm:block hidden-->
                <table class="table table-report z-10 ">
                    <thead>
                        <tr class="">
                            <th class="text-center ">STT</th>
                            <th class="text-center ">Nội dung</th>
                            <th class="text-center sm:mb-0 mb-4  ">Kiểm chứng</th>
                            <th class="text-center ">Trạng thái</th>
                            <th class="text-center ">Chức năng</th>
                        </tr>
                           
                    </thead>
                    <tbody>
                        <tr class="intro-x testthu" v-for="(i,index) in dataTuyentruyen">
                            <td class=" repon_modal " data-lable="STT">
                                {{index+1}}
                            </td>
                            <td class=" repon_modal " data-lable="Nội dung">
                                <input   @change="giatritruyentruyen(i)" v-model="i.noidung" :disabled="(i.sudung == 1 ? true : false) || (trangthai == 2 ? true :false) " type="text" step="0.01" class="px-3 py-2 border-2 border-gray-300 rounded-lg" />
                                </td>
                            <td class=" repon_modal " data-lable="Kiểm chứng" v-if="i.giatri">
                                <uploadimage v-if="i.giatri.noidung != null" tenbang="tuyentruyens" :id="i.id"></uploadimage> 
                            </td>
                            <td data-lable="Trạng thái" class=" repon_modal ">
                                <div v-if="i.sudung == 1">
                                    Đã khóa
                                </div>
                                <div v-else>
                                    Đang sử dụng
                                </div>
                            </td>
                            <td class=" repon_modal mt-4 " data-lable="Chức năng">
                                <div class="">
                               
                                    <button @click="xoatuyentruyen(i.id)">
                                        <svg v-tooltip="{ content: 'Xóa ' }" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 feather feather-trash-2 block mx-auto">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </div>
                               
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!--footer-->
               
            </div>
        </div>
`

})