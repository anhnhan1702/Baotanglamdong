@extends('../layout/base')

@section('body')
    <body class="login" style="padding: 0px;">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="./dist/js/app.js"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection
