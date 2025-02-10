var vm = new Vue({
    el: '#demo',
    data: {
        
        rowId: '',
        statusForm: '',
        isActivemodal: true,
        isActivemodalmodules: true,
        tieude: '',
        modules: [],
        datamodules: [],
        searchnow: '',
        selectedFile: null,
        namefile: ''
    },
   
    mounted: function () {
        this.loadData();
    },

    methods: {
        loadData() {
            const self = this;

            axios.get("/danh-muc/modules").then(function (response) {
                self.modules = response.data;
            })        
        },

        handleStatus(id) {


            const self = this;
                axios.get("/change-status-module/"+ id).then(function (response) {
                    self.thongbaothanhcong('Lưu thành công')
                    self.loadData();
                }).catch(error => {
                    self.thongbaothatbai(error);
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

