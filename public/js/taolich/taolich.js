// Vue.component('tuyen-duong', {
//     data: function() {
//         return {
//             tuyenduong: "",
//             danhsachcon: [],
//         }
//     },
//     props: {
//         data: {
//             type: Array,
//         }
//     },
//     methods: {
//         chontuyenduong() {
//             for (var i = 0; i < this.data.length; i++) {
//                 if (this.data[i]['id'] == this.tuyenduong) {
//                     // this.datadachon = this.data[i];
//                     this.danhsachcon = this.data[i].con;
//                     console.log(this.tuyenduong)
//                     this.$emit('clicked-something', this.tuyenduong)
//                 }
//             }
//         },
//         handleClickInParent(tuyenduong) {
//             this.$emit('clicked-something', tuyenduong)
//         }
//     },

//     template: ` <div>
//                     <div class=" flex justify-start items-center mx-2">
//                         <select v-on:change="chontuyenduong()" v-model="tuyenduong"
//                          class="mb-2 form-control form-select mx-1 w-full">
//                             <option     value="">-- Tuyến đường--</option>
//                             <option v-for="dt in data" :value="dt.id">
//                                 {{dt.name}}
//                             </option>
//                         </select>
//                     </div>
//                     <div v-if="danhsachcon">
//                         <tuyen-duong v-on:clicked-something="handleClickInParent" v-if="danhsachcon.length" :data="danhsachcon"></tuyen-duong>
//                     </div>
//                 </div>`
// })
Vue.component('treeselect', VueTreeselect.Treeselect)
Vue.use(Toasted)
var vm = new Vue({
    el: '#dangkylichlam1',
    data: {
        ngayht: '',
        dsthanhvien: [],
        dadiemdanh: false,
        diaban: [],
        test: 0,
        diaban_id: '',
        hienthi: true,
        dslich: [],
        congviec_id: '',
        tuyenduong: null,
        diabandachon: {},
        search: ''

    },
    // chạy ngay khi web load
    mounted: function() {
        const self = this;
        // self.dangkylichlam();

        axios.get("/dl-diaban-ngayht")
            .then(function(response) {
                // handle success
                self.ngayht = response.data["ngayht"];
                self.diabandachon = response.data["diaban"];
                // self.diaban_id = 1;

            });
        axios.get("/lich-lam-theo-to")
            .then(function(response) {
                // handle success
                self.dslich = response.data;
            });


    },
    watch: {
        tuyenduong() {
            if (this.congviec_id) {
                this.dangkylichlam();
            }
        },
        search() {
            this.dangkylichlam();
        }
    },
    // chạy khi thực hiện event
    methods: {
        // handleClickInParent(tuyenduong) {
        //     this.tuyenduong = tuyenduong;
        //     // console.log(this.tuyenduong)
        //     this.dangkylichlam();
        // },
        thaydoingay(e) {
            const self = this;
            self.ngayht = e.target.value;
            self.dangkylichlam();
        },
        thaydoicongviec(e) {
            const self = this;
            axios.get("/show-tuyen-duong?congviec=" + e.target.value)
                .then(function(response) {
                    self.tuyenduong = response.data;
                });
            // self.diaban_id = e.target.value;
            if (self.diaban_id) {
                self.dangkylichlam();
            }
        },
        // thaydoidiadiem(e) {
        //     const self = this;
        //     // self.diaban_id = e.target.value;

        //     for (var i = 0; i < self.diaban.length; i++) {
        //         if (self.diaban[i]['id'] == self.diaban_id) {
        //             self.diabandachon = self.diaban[i];
        //             console.log(self.diabandachon)
        //         }
        //     }
        //     if (self.congviec_id) {
        //         self.dangkylichlam();
        //     }
        // },
        dangkylichlam() {
            const self = this;
            axios.get("/thongtindangkylichlam?ngayht=" + self.ngayht + '&diaban_id=' +
                    self.diaban_id + '&congviec_id=' + self.congviec_id + '&tuyenduong=' +
                    self.tuyenduong + '&search=' + self.search)
                .then(function(response) {
                    // handle success
                    self.dsthanhvien = response.data["dsthanhvien"];
                });
        },

        thongbaothanhcong() {
            this.$toasted.show("Cập nhật thành công !!", {
                type: 'success',
                duration: 3000,
                theme: 'toasted-primary'
            })
        },
        thongbaothatbai(test) {
            this.$toasted.show(test, {
                type: 'error',
                duration: 3000,
                theme: 'toasted-primary'
            })
        },

        Dangkyll(id) {
            const self = this;
            axios.get("/dang-ky-ll?id=" + id + '&diaban_id=' + self.diaban_id +
                    '&ngay=' + self.ngayht + '&congviec_id=' + self.congviec_id + '&tuyenduong=' + self.tuyenduong)
                .then(function(response) {
                    // handle success
                    self.thongbaothanhcong();
                    self.dangkylichlam();
                })
                .catch(function(error) {
                    self.thongbaothatbai(error)
                });
        },
    }
})