<template>
<div class="container py-2">
    <div class="large-12 medium-12 small-12 cell">

        <div class=" w-full ">
            <div class="col-span-4"></div>
            <svg v-if="files.length > 0" @click="isActivemodal = false" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto col-span-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <svg v-else @click="isActivemodal = false" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto col-span-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            <!-- <span v-if="files.length > 0"  class="col-span-3 mx-auto  px-2 py-1 text-xs font-bold leading-none text-red-100 
                                 bg-red-600 rounded-full"> ({{files.length}} )</span> -->
        </div>

    </div>

    <div v-cloak v-if="isActivemodal == false" style="z-index: 200" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
        <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div style="height:80vh" class="w-6/12   relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-y-auto h-screen ">
            <!--content-->
            <div class=" grid grid-cols-12 pt-2">
                <button class="text-4xl ml-2 col-span-1" @click="closemodal()">x </button>
                <div class=" text-center text-4xl text-red-500 col-span-11 text-center">
                    ĐÍNH KÈM
                </div>
            </div>

            <!--body-->
            <div class="p-2 mt-2">
                <div class="mt-1  border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center pt-4">
                        <svg style="cursor: pointer;" @click="clickupload()" class="my-4 mx-auto h-16 w-16 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <input class="hide" type="file" id="files" ref="files" multiple v-on:change="handleFilesUpload()" />
                            </label>
                        </div>
                        <div class=" grid grid-cols-12 ">
                            <table class="col-span-12 border-collapse border border-black mx-2">
                                <tr v-for="(file, key) in files" class="grid grid-cols-12 divide-x divide-black border-b border-black">
                                    <td class="col-span-1  p-4 whitespace-nowrap text-sm text-gray-500">
                                        {{key +1}}
                                    </td>
                                    <td class="col-span-4  p-4 whitespace-nowrap text-sm text-gray-500">
                                      <img v-if="file.duoifile == 'img' || file.duoifile == 'jpg' || file.duoifile == 'JPG' ||file.duoifile == 'PNG'" class="w-4/5" :src="file.linkbackground" alt="">
                                      <img v-if="file.duoifile == 'zip' || file.duoifile == 'rar'" src="/images/Winrar.png" alt="">
                                      </td>
                                    <td class="col-span-4  p-4 whitespace-nowrap text-sm text-gray-500">
                                        <!-- <div class="mb-2"> <a data-fancybox data-type="iframe" :href="file.linkview" data-small-btn="true"
                          data-iframe='{"preload":false}'>
                                {{ file.tenfile }}
                        </a></div> -->
                                        <input @blur="Savenote($event,file,'ten')" v-model="file.ten" name="ten" type="text" placeholder="Nhập tên" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm mb-2">
                                        <textarea @blur="Savenote($event,file,'ghichu')" id="w3review" v-model="file.ghichu" placeholder="ghi chú" class=" placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" name="w3review" rows="5" cols="200">
                                        </textarea>
                                    </td>
                                    <td class="col-span-3  p-4 whitespace-nowrap text-sm text-gray-500 grid grid-cols-12 items-center">
                                        <button v-on:click="removeFile(key, file)" class="h-12 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center col-span-12">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            <span>Xóa</span>
                                        </button>
                                        <a :href="file.linkbackground" download="" class="h-12 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center col-span-12">
                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" /></svg>
                                            <span>Download</span>
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!--footer-->
</div>
</div>
</div>
</template>

<script>
export default {
    name: "uploadfile",
    props: {
        tenbang: {
            type: String,
            default: "None",
        },
        id: {
            type: Number,
        },
        truong_id: {
            type: String,
        },
        row: {
            type: Number,
        },
    },
    data() {
        return {
            files: [],
            configfile: [],
            view: false,
            isActivemodal: true,
        };
    },
    watch: {
        id() {
            this.loadfile();
        },
    },
    mounted() {
        const self = this;
        // Lấy dữ liệu từ file config
        axios.get("/config").then(function (response) {
            self.configfile = response.data;
        });
        self.loadfile();
    },
    /*
        Defines the method used by the component
      */

    methods: {
        clickupload() {
            this.$refs.files.click();
        },
        closemodal() {
            this.isActivemodal = true;
        },

        loadfile() {
            const self = this;
            // Lấy dữ liệu
            axios
                .get(
                    "/load-file?uuid=" +
                    self.truong_id +
                    "&tenbang=" +
                    self.tenbang +
                    "&id=" +
                    this.id +
                    "&row=" +
                    this.row
                )
                .then(function (response) {
                    self.files = response.data;
                });
        },
        openModal() {
            this.view = true;
        },
        submitFiles() {
            const self = this;
            /*
                Initialize the form data
              */
            let formData = new FormData();

            /*
                Iteate over any file sent over appending the files
                to the form data.
              */
            //  Lấy dữ liệu file
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];

                formData.append("files[" + i + "]", file);
            }
            // Dữ liệu đính kèm
            formData.append("tenbang", this.tenbang);
            formData.append("row", this.row);
            if (this.id) {
                formData.append("truong_id", this.id);
            } else {
                formData.append("truong_id", this.truong_id);
            }
            /*
                Make the request to the POST /select-files URL
              */
            axios
                .post("/uploads", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(function (response) {
                    self.loadfile();
                    self.$notify({
                        title: "Success",
                        message: text,
                        type: "Tải file thành công",
                    });
                    // self.$toasted.success("Tải file thành công");
                })
                .catch(function () {
                    self.$notify.error({
                        title: "Tải file thất bại",
                        message: text,
                    });
                });
        },
        Savenote(event, file, tentruong) {
            const self = this;
            axios
                .post("/save-ghi-chu", {
                    id: file.id,
                    noidung: event.target.value,
                    tentruong: tentruong
                })
                .then(function (response) {
                    self.thongbaothanhcong("Lưu ghi chú thành công");
                    self.loadfile();
                })
                .catch((error) => {
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
        /*
            Handles the uploading of files
          */
        //  Sau khi thêm file thì chạy
        handleFilesUpload() {
            const self = this;
            let uploadedFiles = this.$refs.files.files;
            /*
                Adds the uploaded file to the files array
              */
            var check = 0;
            for (var i = 0; i < uploadedFiles.length; i++) {
                // Lấy tên fiel và đuôi file
                // Lấy vị trí dấu chấm
                var fileupload = uploadedFiles[i].name.lastIndexOf(".");
                //Lấy tên file
                var tenfile = uploadedFiles[i].name.slice(0, fileupload);
                // Lấy đuôi file
                var duoi = uploadedFiles[i].name.slice(fileupload + 1);
                // Kiểm tra đuôi file có nằm trong tập tin cofig ko(nằm trong là cho phép pull)
                //
                if (self.configfile.includes(duoi)) {
                    self.files.push(uploadedFiles[i]);
                    // Thêm dữ liệu vào biến files và gọi đến submit
                } else {
                    check = 1;
                }
            }
            if (check == 0) {
                self.submitFiles();
            } else {
                self.$notify.error({
                    title: "Error",
                    message: "File không hợp lệ",
                });
                // self.$toasted.error("File không hợp lệ");
            }
        },

        /*
            Removes a select file the user has uploaded
          */
        //  xóa file
        removeFile(key, file) {
            const self = this;
            axios
                .get("/xoa-file?name=" + file.tenfile + "&uuid=" + self.id)
                .then(function (response) {
                    self.$notify({
                        title: "Success",
                        message: text,
                        type: "Xóa thành công",
                    });
                    self.loadfile();
                })
                .catch(function () {
                    // self.$notify.error({
                    //   title: 'Error',
                    //   message: "Xóa thất bại!!"
                    // });
                    self.loadfile();
                });
        },
    },
};
</script>

<style>
.flex.text-sm.text-gray-600 {
    display: none;
}

div.file-listing {
    width: 200px;
}

span.remove-file {
    color: red;
    cursor: pointer;
    float: right;
}
</style>
