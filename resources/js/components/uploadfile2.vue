
<template>
  <div class="container mt-4">
    <div class="large-12 medium-12 small-12 cell">
      <div class="-my-2  sm:-mx-6 lg:-mx-8 col-span-12 mb-4">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow  border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <tr v-for="(file, key) in files">
                <td class="whitespace-nowrap  px-6 py-4 font-medium text-gray-900 ">
                  
                  <a  v-if="file.duoifile == 'png' || file.duoifile == 'PNG' || file.duoifile == 'jpg'|| file.duoifile == 'JPG'" class="hidden md:block mt-1"  :href="file.link"
                    data-small-btn="true" data-iframe='{"preload":false}' download>
                    <div class="items-center flex overflow-hidden">
                      <span class=" w-max px-2 py-1 rounded-lg  transition duration-300 ease-in-out">
                         {{ file.tenfile }}
                      </span>
                    </div>

                  </a>
                  <a v-else class="hidden md:block mt-1" data-fancybox data-type="iframe" :href="file.linkview"
                    data-small-btn="true" data-iframe='{"preload":false}' target="_blank">
                    <div class="items-center flex overflow-hidden">
                      <img v-if="file.duoifile == 'PDF' || file.duoifile == 'pdf'" class="w-6 h-8 mr-2"
                        src="/images/pdf.png" alt="">
                      <img v-if="file.duoifile == 'doc' || file.duoifile == 'docm' || file.duoifile == 'docx'"
                        class="w-6 h-8 mr-2" src="/images/doc.png" alt="">
                      <img v-if="file.duoifile == 'xlsm' || file.duoifile == 'xls' || file.duoifile == 'xlsx'"
                        class="w-6 h-8 mr-2" src="/images/xls.png" alt="">

                      <span class=" w-max px-2 py-1 rounded-lg  transition duration-300 ease-in-out">
                        
                         {{ file.tenfile }}
                      </span>
                    </div>

                  </a>

                  <a class=" md:hidden mt-1" :href="file.linkview" target="_blank">
                    <div class="items-center flex overflow-hidden">
                      <img v-if="file.duoifile == 'PDF' || file.duoifile == 'pdf'" class="w-6 h-8 mr-2"
                        src="/images/pdf.png" alt="">
                      <img v-if="file.duoifile == 'doc' || file.duoifile == 'docm' || file.duoifile == 'docx'"
                        class="w-6 h-8 mr-2" src="/images/doc.png" alt="">
                      <img v-if="file.duoifile == 'xlsm' || file.duoifile == 'xls' || file.duoifile == 'xlsx'"
                        class="w-6 h-8 mr-2" src="/images/xls.png" alt="">
                      
                      <span class=" w-max px-2 py-1 rounded-lg  transition duration-300 ease-in-out">{{ file.tenfile }}
                      </span>
                    </div>
                  </a>
                </td>
                <td class="  px-6 py-4 font-medium text-gray-900 text-center">
                  <span class="ml-4" v-on:click="removeFile(key, file)">Xóa </span>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="large-12 medium-12 small-12 cell">
      <label>
        <input type="file" id="files" ref="files" multiple v-on:change="handleFilesUpload()" />
      </label>
    </div>

    <!-- overlay -->
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
      // type: Number,
    },
    truong_id: {
      // type: String,
    },
  
    donvi_ma: {
      type: String,
    },
    check: {
      type: String,
    },
  },
  data() {
    return {
      files: [],
      configfile: [],
      view: false,
    };
  },
  watch: {
    id() {
      this.loadfile();

    }
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
    closeModal() {
      this.view = false;
    },
    loadfile() {
      const self = this;
      // Lấy dữ liệu
      axios
        .get("/load-file?uuid=" + self.truong_id + "&tenbang=" + self.tenbang + "&id=" + this.id + "&donvi_ma=" + this.donvi_ma + "&check=" + this.check)
        .then(function (response) {
          self.files = response.data;
          self.$emit('loadfile', self.files.length);

        });
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
      if (this.id) {
        formData.append("truong_id", this.id);
      }
      else {
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
            title: 'Success',
            message: "Tải file thành công",
            type: 'success'
          });
        })
        .catch(function () {
          self.$notify.error({
            title: 'Error',
            message: "Tải file thất bại",
          });

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
        }
        else {
          check = 1;
        }
      }
      console.log(check)
      if (check == 0) {
        self.submitFiles();
      }
      else {
        self.$notify.error({
            title: 'Error',
            message: "File không hợp lệ",
          });

        
      }

    },

    /*
        Removes a select file the user has uploaded
      */
    //  xóa file
    removeFile(key, file) {
      const self = this;
      console.log(1123);
      axios
        .get("/xoa-file?name=" + file.tenfile + "&uuid=" + self.id)
        .then(function (response) {
          self.$notify({
            title: 'Success',
            message: "Xóa thành công",
            type: 'success'
          });
          self.loadfile();
        })
        .catch(function () {
          self.$notify.error({
            title: 'Error',
            message: "Xóa thất bại!!",
          });
        });
    },
  },
};
</script>

<style>
div.file-listing {
  width: 200px;
}

span.remove-file {
  color: red;
  cursor: pointer;
  float: right;
}
</style>