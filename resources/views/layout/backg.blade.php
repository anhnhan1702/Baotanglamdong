@extends('../layout/stylebackg')

@section('content')
    @include('../layout/components/mobile-menu')
    <!-- BEGIN: Top Bar -->
    <div class="border-b border-theme-29 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
        <div class="top-bar-boxed flex items-center">
            <!-- BEGIN: Logo -->
            <a href="" class="-intro-x hidden md:flex">
                <!-- <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}"> -->
                <span class="text-white text-lg ml-3">
                    TRANG <span class="font-medium">CHỦ</span>
                </span>
            </a>
            <!-- END: Logo -->
            <!-- END: Account Menu -->
        </div>
    </div>
    <!-- BEGIN: Content -->
    <div class="content relative">
        @yield('subcontent')
    </div>
    <!-- END: Content -->
@endsection