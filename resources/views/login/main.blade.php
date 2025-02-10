@extends('../layout/' . $layout)

@section('head')
<title>Nền tảng bảo tàng số</title>
@endsection

@section('content')
<style>
.background-login {
    background-image: url("/images/bg-login.jpg");
    background-size: cover;
    background-repeat: round;
}
</style>
<!-- <style>
    .large-header {
        position: relative;
        width: 100%;
        background: #111;
        overflow: hidden;
        background-size: cover;
        background-position: center center;
        z-index: 1;
    }

    .demo .large-header {
        background-image: url("https://images.wallpaperscraft.com/image/starry_sky_stars_space_night_119881_1366x768.jpg");
    }

    .main-title {
        position: absolute;
        margin: 0;
        padding: 0;
        color: #f9f1e9;
        text-align: center;
        top: 50%;
        left: 50%;
        -webkit-transform: translate3d(-50%, -50%, 0);
        transform: translate3d(-50%, -50%, 0);
    }

    .demo .main-title {
        text-transform: uppercase;
        font-size: 4.2em;
        letter-spacing: 0.1em;
    }

    .main-title .thin {
        font-weight: 200;
    }

    .bg3D {
        width: 400px;
        height: 325px;
        padding: 19px;
    }

    @media only screen and (max-width: 768px) {
        .demo .main-title {
            font-size: 3em;
        }

        .bg3D {
            width: 94%;
            height: 368px;
            margin: auto;
            margin-top: 36px;
        }
    }
</style> -->


<div class="min-h-screen  flex justify-center items-center background-login">

    <div class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20">
        <div>
            <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">NỀN TẢNG BẢO TÀNG SỐ</h1>

        </div>
        <div class="space-y-4">
            <form id="login-form">
                <input id="name" type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                    placeholder="Tên đăng nhập">
                <div id="error-name" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                <input id="password" type="password"
                    class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                    placeholder="Mật khẩu">
                <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
            </form>
        </div>
        <div class="text-center mt-6">
            <button id="btn-login" class="py-3 w-64 text-xl text-white bg-purple-400 rounded-2xl">ĐĂNG NHẬP</button>

        </div>
    </div>

</div>

<!--
        <script src="./stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js.download"></script>-->

<script src="./js/TweenLite.min.js.download"></script>
<script src="./js/EasePack.min.js.download"></script>
<script src="./js/demo.js.download"></script>
<script id="rendered-js"></script>




@endsection

@section('script')
<script>
cash(function() {
    async function login() {
        // Reset state
        cash('#login-form').find('.login__input').removeClass('border-theme-6')
        cash('#login-form').find('.login__input-error').html('')

        // Post form
        let name = cash('#name').val()
        let password = cash('#password').val()
        let rememberMe = cash('#remember-me').val()

        // Loading state
        cash('#btn-login').html(
            '<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)

        axios.post(`login`, {
            name: name,
            password: password,
            remember_me: rememberMe
        }).then(res => {
            location.href = '/'
        }).catch(err => {
            cash('#btn-login').html('Login')
            if (err.response.data.message != 'Tên đăng nhập hoặc mật khẩu sai') {
                for (const [key, val] of Object.entries(err.response.data.errors)) {
                    cash(`#${key}`).addClass('border-theme-6')
                    cash(`#error-${key}`).html(val)
                }
            } else {
                cash(`#password`).addClass('border-theme-6')
                cash(`#error-password`).html(err.response.data.message)
            }
        })
    }

    // axios.post(`get-nguoi-dang-nhap`, {
    //         name: name,
    //         password: password,
    //         remember_me: rememberMe
    //     }).then(res=>{
    //         console.log()
    //     })

    cash('#login-form').on('keyup', function(e) {
        if (e.keyCode === 13) {
            login()
        }
    })

    cash('#btn-login').on('click', function() {
        login()
    })
})
</script>
@endsection