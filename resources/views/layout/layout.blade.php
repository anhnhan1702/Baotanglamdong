<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src='https://unpkg.com/vuejs-form@latest/build/vuejs-form.min.js'></script>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css">
    @yield('subhead')
    <style>
    [v-cloak] {
        display: none;
    }
    </style>
    <style>
    /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
    /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
    :root {
        --light: #edf2f9;
        --dark: #152e4d;
        --darker: #12263f;
    }

    .dark .dark\:text-light {
        color: var(--light);
        /* background-color: var(--light); */
    }

    .dark .dark\:bg-dark {
        background-color: var(--dark);
    }

    .dark .dark\:bg-darker {
        background-color: var(--darker);
    }

    .dark .dark\:text-gray-300 {
        color: #d1d5db;
    }

    .dark .dark\:text-indigo-500 {
        color: #6366f1;
    }

    .dark .dark\:text-indigo-100 {
        color: #e0e7ff;
    }

    .dark .dark\:hover\:text-light:hover {
        color: var(--light);
    }

    .dark .dark\:border-indigo-800 {
        border-color: #3730a3;
    }

    .dark .dark\:border-indigo-700 {
        border-color: #4338ca;
    }

    .dark .dark\:bg-indigo-600 {
        background-color: #4f46e5;
    }

    .dark .dark\:hover\:bg-indigo-600:hover {
        background-color: #4f46e5;
    }

    .dark .dark\:border-indigo-500 {
        border-color: #6366f1;
    }

    .hover\:overflow-y-auto:hover {
        overflow-y: auto;
    }

    .layout.fixed-header.fixed-sidebar .header {
        background-color: white;
    }

    .layout {
        z-index: 10 !important;
    }
    </style>

</head>

<body>
    <div id="trangchu" class="layout has-sidebar fixed-sidebar fixed-header">
        <aside id="sidebar" class="sidebar break-point-lg has-bg-image">
            <div class="image-wrapper">
                <img src="https://user-images.githubusercontent.com/25878302/144499035-2911184c-76d3-4611-86e7-bc4e8ff84ff5.jpg"
                    alt="sidebar background" />
            </div>
            <div class="sidebar-layout">
                <div class="sidebar-header">
                    <span style="
                      text-transform: uppercase;
                      font-size: 15px;
                      letter-spacing: 3px;
                      font-weight: bold;
                    ">Bảo tàng Lâm Đồng</span>
                </div>
                <div class="sidebar-content">
                    <!-- tesst -->
                    <nav class="menu open-current-submenu">
                        <ul>
                            <li class="menu-item">
                                <a href="/">
                                    <span class="menu-icon">
                                        <i class="ri-home-line"></i>
                                    </span>
                                    <span class="menu-title"> Trang chủ</span>
                                </a>
                            </li>
                            @foreach (config('menu') as $menu)
                            @if (isset($menu['sub_menu']))
                            @foreach($menu['decentralization'] as $dec)
                            @if(auth()->user()->chucvu_id == $dec)
                            <li class="menu-item sub-menu">
                                <a>
                                    <span class="menu-icon">
                                        <i class="{{$menu['icon']}}"></i>
                                    </span>

                                    <span class="menu-title"> {{$menu['title']}} </span>

                                </a>

                                <div class="sub-menu-list">

                                    <ul>
                                        @foreach ($menu['sub_menu'] as $menuKey => $sub_menu)
                                        @if (isset($sub_menu['sub_menu']))
                                        <li class="menu-item sub-menu">
                                            <a href="">
                                                <span class="menu-title">Forms</span>
                                            </a>
                                            <div class="sub-menu-list">
                                                <ul>
                                                    <li class="menu-item">
                                                        <a href="#">
                                                            <span class="menu-title">Input</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="#">
                                                            <span class="menu-title">Select</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item sub-menu">
                                                        <a href="#">
                                                            <span class="menu-title">More</span>
                                                        </a>
                                                        <div class="sub-menu-list">
                                                            <ul>
                                                                <li class="menu-item">
                                                                    <a href="#">
                                                                        <span class="menu-title">CheckBox</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a href="#">
                                                                        <span class="menu-title">Radio</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item sub-menu">
                                                                    <a href="#">
                                                                        <span class="menu-title">Want more ?</span>
                                                                        <span class="menu-suffix">&#x1F914;</span>
                                                                    </a>
                                                                    <div class="sub-menu-list">
                                                                        <ul>
                                                                            <li class="menu-item">
                                                                                <a href="#">
                                                                                    <span
                                                                                        class="menu-prefix">&#127881;</span>
                                                                                    <span class="menu-title">You made it
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @else

                                        @if( $sub_menu['title'] == 'Nhập hiện vật' || $sub_menu['title'] == 'Xuất hiện
                                        vật' )
                                        @if(auth()->user()->chucvu_id == 6 || auth()->user()->chucvu_id == 1 )
                                        <li class="menu-item">
                                            <a href="{{$sub_menu['route_name']}}">

                                                <span class="menu-title"> {{$sub_menu['title']}}</span>

                                            </a>
                                        </li>
                                        @endif
                                        @else
                                        <li class="menu-item">

                                            <a href="{{$sub_menu['route_name']}}">

                                                <span class="menu-title"> {{$sub_menu['title']}} </span>

                                            </a>
                                           
                                        </li>
                                        @endif
                                        @endif
                                        @endforeach
                                    </ul>

                                </div>

                            </li>
                            @endif
                            @endforeach
                            @else
                            @foreach($menu['decentralization'] as $dec)
                            @if(auth()->user()->chucvu_id == $dec)
                            <li class="menu-item">
                                <a href="{{$menu['route_name']}}">
                                    <span class="menu-icon">
                                        <i class="{{$menu['icon']}}"></i>
                                    </span>
                                    <span class="menu-title"> {{$menu['title']}}</span>
                                </a>
                            </li>
                            @endif

                            @endforeach
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <!-- <div class="relative flex items-center justify-center flex-shrink-0">
                  

                </div>
                <div class="sidebar-footer"><span>Sidebar footer</span></div> -->
            </div>
        </aside>
        <div id="overlay" class="overlay"></div>
        <div class="layout">
            <header class="header">
                <a id="btn-collapse" class="cursor-pointer">
                    <i class="ri-menu-line ri-xl"></i>
                </a>
                <a id="btn-toggle" class="sidebar-toggler break-point-lg">
                    <i class="ri-menu-line ri-xl"></i>
                </a>
            </header>
            <main class="content flex bg-gray-100">

                @yield('subcontent')
            </main>
            <footer class="text-center text-white" style="background-color: #0a4275;">
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.2);">
                    ©
                    Nền tảng bảo tàng số 4.0. Phát triển bởi PITC Group |
                    <a class="text-white" target="_blank" href="http://pitcgroup.com.vn/"> www.pitcgroup.com.vn</a>
                </div>
            </footer>
        </div>

    </div>


    <style>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }
    </style>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script>
    const ANIMATION_DURATION = 300;

    const SIDEBAR_EL = document.getElementById("sidebar");

    const SUB_MENU_ELS = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu"
    );

    const FIRST_SUB_MENUS_BTN = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu > a"
    );

    const INNER_SUB_MENUS_BTN = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu .menu-item.sub-menu > a"
    );

    class PopperObject {
        instance = null;
        reference = null;
        popperTarget = null;

        constructor(reference, popperTarget) {
            this.init(reference, popperTarget);
        }

        init(reference, popperTarget) {
            this.reference = reference;
            this.popperTarget = popperTarget;
            this.instance = Popper.createPopper(this.reference, this.popperTarget, {
                placement: "right",
                strategy: "fixed",
                resize: true,
                modifiers: [{
                        name: "computeStyles",
                        options: {
                            adaptive: false
                        }
                    },
                    {
                        name: "flip",
                        options: {
                            fallbackPlacements: ["left", "right"]
                        }
                    }
                ]
            });

            document.addEventListener(
                "click",
                (e) => this.clicker(e, this.popperTarget, this.reference),
                false
            );

            const ro = new ResizeObserver(() => {
                this.instance.update();
            });

            ro.observe(this.popperTarget);
            ro.observe(this.reference);
        }

        clicker(event, popperTarget, reference) {
            if (
                SIDEBAR_EL.classList.contains("collapsed") &&
                !popperTarget.contains(event.target) &&
                !reference.contains(event.target)
            ) {
                this.hide();
            }
        }

        hide() {
            this.instance.state.elements.popper.style.visibility = "hidden";
        }
    }

    class Poppers {
        subMenuPoppers = [];

        constructor() {
            this.init();
        }

        init() {
            SUB_MENU_ELS.forEach((element) => {
                this.subMenuPoppers.push(
                    new PopperObject(element, element.lastElementChild)
                );
                this.closePoppers();
            });
        }

        togglePopper(target) {
            if (window.getComputedStyle(target).visibility === "hidden")
                target.style.visibility = "visible";
            else target.style.visibility = "hidden";
        }

        updatePoppers() {
            this.subMenuPoppers.forEach((element) => {
                element.instance.state.elements.popper.style.display = "none";
                element.instance.update();
            });
        }

        closePoppers() {
            this.subMenuPoppers.forEach((element) => {
                element.hide();
            });
        }
    }

    const slideUp = (target, duration = ANIMATION_DURATION) => {
        const {
            parentElement
        } = target;
        parentElement.classList.remove("open");
        target.style.transitionProperty = "height, margin, padding";
        target.style.transitionDuration = `${duration}ms`;
        target.style.boxSizing = "border-box";
        target.style.height = `${target.offsetHeight}px`;
        target.offsetHeight;
        target.style.overflow = "hidden";
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        window.setTimeout(() => {
            target.style.display = "none";
            target.style.removeProperty("height");
            target.style.removeProperty("padding-top");
            target.style.removeProperty("padding-bottom");
            target.style.removeProperty("margin-top");
            target.style.removeProperty("margin-bottom");
            target.style.removeProperty("overflow");
            target.style.removeProperty("transition-duration");
            target.style.removeProperty("transition-property");
        }, duration);
    };
    const slideDown = (target, duration = ANIMATION_DURATION) => {
        const {
            parentElement
        } = target;
        parentElement.classList.add("open");
        target.style.removeProperty("display");
        let {
            display
        } = window.getComputedStyle(target);
        if (display === "none") display = "block";
        target.style.display = display;
        const height = target.offsetHeight;
        target.style.overflow = "hidden";
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        target.offsetHeight;
        target.style.boxSizing = "border-box";
        target.style.transitionProperty = "height, margin, padding";
        target.style.transitionDuration = `${duration}ms`;
        target.style.height = `${height}px`;
        target.style.removeProperty("padding-top");
        target.style.removeProperty("padding-bottom");
        target.style.removeProperty("margin-top");
        target.style.removeProperty("margin-bottom");
        window.setTimeout(() => {
            target.style.removeProperty("height");
            target.style.removeProperty("overflow");
            target.style.removeProperty("transition-duration");
            target.style.removeProperty("transition-property");
        }, duration);
    };

    const slideToggle = (target, duration = ANIMATION_DURATION) => {
        if (window.getComputedStyle(target).display === "none")
            return slideDown(target, duration);
        return slideUp(target, duration);
    };

    const PoppersInstance = new Poppers();

    /**
     * wait for the current animation to finish and update poppers position
     */
    const updatePoppersTimeout = () => {
        setTimeout(() => {
            PoppersInstance.updatePoppers();
        }, ANIMATION_DURATION);
    };

    /**
     * sidebar collapse handler
     */
    document.getElementById("btn-collapse").addEventListener("click", () => {
        SIDEBAR_EL.classList.toggle("collapsed");
        PoppersInstance.closePoppers();
        if (SIDEBAR_EL.classList.contains("collapsed"))
            FIRST_SUB_MENUS_BTN.forEach((element) => {
                element.parentElement.classList.remove("open");
            });

        updatePoppersTimeout();
    });

    /**
     * sidebar toggle handler (on break point )
     */
    document.getElementById("btn-toggle").addEventListener("click", () => {
        SIDEBAR_EL.classList.toggle("toggled");

        updatePoppersTimeout();
    });

    /**
     * toggle sidebar on overlay click
     */
    document.getElementById("overlay").addEventListener("click", () => {
        SIDEBAR_EL.classList.toggle("toggled");
    });

    const defaultOpenMenus = document.querySelectorAll(".menu-item.sub-menu.open");

    defaultOpenMenus.forEach((element) => {
        element.lastElementChild.style.display = "block";
    });

    /**
     * handle top level submenu click
     */
    FIRST_SUB_MENUS_BTN.forEach((element) => {
        element.addEventListener("click", () => {
            if (SIDEBAR_EL.classList.contains("collapsed"))
                PoppersInstance.togglePopper(element.nextElementSibling);
            else {
                const parentMenu = element.closest(".menu.open-current-submenu");
                if (parentMenu)
                    parentMenu
                    .querySelectorAll(":scope > ul > .menu-item.sub-menu > a")
                    .forEach(
                        (el) =>
                        window.getComputedStyle(el.nextElementSibling).display !==
                        "none" && slideUp(el.nextElementSibling)
                    );
                slideToggle(element.nextElementSibling);
            }
        });
    });

    /**
     * handle inner submenu click
     */
    INNER_SUB_MENUS_BTN.forEach((element) => {
        element.addEventListener("click", () => {
            slideToggle(element.nextElementSibling);
        });
    });
    </script>


</body>

</html>