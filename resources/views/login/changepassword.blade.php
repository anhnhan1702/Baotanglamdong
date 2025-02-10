@extends('../layout/layout')
@section('subhead')
<title>Đổi mật khẩu</title>
@endsection
@section('subcontent')
<section id="changPassword" class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
            <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Đổi mật khẩu
            </h2>
            <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="#">
                <div>
                    <label for="oldpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật
                        khẩu
                        cũ</label>
                    <input type="password" v-model="changeForm.oldpassword" name="oldpassword" id="oldpassword"
                        placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                    <span class="mt-4 mb-2 text-red-500" v-if="changeForm.errors().has('oldpassword')">
                        @{{ changeForm.errors().get('oldpassword') }}
                    </span>
                </div>
                <div>
                    <label for="newpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật
                        khẩu
                        mới</label>
                    <input v-model="changeForm.newpassword" type="password" name="newpassword" id="newpassword"
                        placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                    <span class="mt-4 mb-2 text-red-500" v-if="changeForm.errors().has('newpassword')">
                        @{{ changeForm.errors().get('newpassword') }}
                    </span>
                </div>
                <div>
                    <label for="newpassword2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nhập
                        lại mật khẩu</label>
                    <input type="password" v-model="changeForm.newpassword2" name="newpassword2" id="newpassword2"
                        placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                    <span class="mt-4 mb-2 text-red-500" v-if="changeForm.errors().has('newpassword2')">
                        @{{ changeForm.errors().get('newpassword2') }}
                    </span>
                </div>
                <button type="submit" @click="submit"
                    class="w-full sm:mr-4 sm:mb-0 mb-1  px-4 py-2 text-sm  text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đổi
                    mật khẩu</button>
            </form>
        </div>
    </div>
</section>
<script>
var vm = new Vue({
    el: '#changPassword',
    data: {

        changeForm: form({
                oldpassword: '',
                newpassword: '',
                newpassword2: '',
            })
            .rules({
                oldpassword: 'required',
                newpassword: 'required',
                newpassword2: 'required',
            })
            .messages({
                'oldpassword.required': ' Trường bắt buộc nhập',
                'newpassword.required': ' Trường bắt buộc nhập',
                'newpassword2.required': ' Trường bắt buộc nhập',

            }),
    },

    watch: {},
    mounted: function() {


    },
    methods: {
        reset() {
            this.changeForm.data.oldpassword = '';
            this.changeForm.data.newpassword = '';
            this.changeForm.data.newpassword2 = '';
        },
        submit() {
            if (this.changeForm.validate().errors().any()) {
                return;
            }
            const self = this;
            axios.post("/changepw", self.changeForm.data).then(function(response) {
                if (response.data == 1) {
                    self.thongbaothanhcong('Lưu thành công')
                } else {
                    self.thongbaothatbai('Thông tin không chính xác');

                }


            });
            this.reset();
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
</script>
@endsection