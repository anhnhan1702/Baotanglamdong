
var vm = new Vue({
    el: '#demo',
    data: {
        
        datatb: {
            // Tên các cột có thẻ search
            searchcolum: [
                'title'
            ],
            // đường dẫn đến ajax
            url: '/ajax-hethong',
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
        })
            .rules({
                title: 'required',
            })
            .messages({
                'title.required': 'Trường bắt buộc nhập',
            }),

        isActivemodal: true,
        isActivemodalhethong: true,
        tieude: '',
        hethong: [],
        datahethongs: [],
        searchnow: '',
        selectedFile: null,
        namefile: '',
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


        axios.get("/danh-muc/systems").then(function (response) {
            self.hethong = response.data;
        })
        this.getdatahethongs();

    },
    methods: {

        exportToExcel() {
            
            const filteredData = this.datatb.tableData.map(item => ({
                'STT': item.stt,
                'Người truy cập': item.title,
                'Hành động': item.action,
                'Nội dung': item.content,
                'Thời gian': item.time,
            }));
            // Chuyển dữ liệu thành worksheet
            const worksheet = XLSX.utils.json_to_sheet(filteredData);
      
            // Tạo workbook
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");
      
            // Xuất file
            XLSX.writeFile(workbook, "Nhật ký hệ thống.xlsx");
          },

        getdatahethongs() {
            const self = this;
            axios.get("/danh-muc/systems").then(function (response) {
                self.datahethongs = response.data;
            })

        },
        filterMethod(query, item) {

            return item.title.toLowerCase().indexOf(query.toLowerCase()) > -1;
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
      
    }
})

