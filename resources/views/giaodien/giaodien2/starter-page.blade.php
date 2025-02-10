<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="giaodien2/assets/img/favicon.png" rel="icon">
    <link href="giaodien2/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="giaodien2/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="giaodien2/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="giaodien2/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="giaodien2/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="giaodien2/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="giaodien2/assets/css/main.css" rel="stylesheet">


</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="/trang-tin" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="giaodien2/assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Bảo Tàng Lâm Đồng </h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/trang-tin" class="active">Trang chủ<br></a></li>
                    <li><a href="/danh-muc-trang-tin">Tin Tức</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="/">Đăng Nhập</a>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <h1>Tin Tức</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/trang-tin">Trang chủ</a></li>
                        <li class="current">Tin Tức</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <!-- Chefs Section -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Posts Section -->
                    <section id="blog-posts" class="blog-posts section">

                        <div class="container">

                            <div class="row gy-4">
                                @foreach ($listPosts as $post)
                                    <div class="col-12">
                                        <article
                                            style="
                                                background-color: var(--surface-color);
                                                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                                                padding: 30px;
                                                height: 100%;">
                                            <div class="post-img">
                                                <img src="{{ $post->thumbnail }}"
                                                    onerror="this.src='/images/images.png';" alt=""
                                                    class="img-fluid">
                                            </div>

                                            <h2 class="title">
                                                <a
                                                    href="/chi-tiet-trang-tin?slug={{ $post->slug }}">{{ $post->title }}</a>
                                            </h2>

                                            <div class="meta-top">
                                                <ul>
                                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                                        <a href="/chi-tiet-trang-tin?slug={{ $post->slug }}">Admin</a>
                                                    </li>
                                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                            href="/chi-tiet-trang-tin?slug={{ $post->slug }}"><time
                                                                datetime="2022-01-01">{{ $post->created_at }}</time></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="content">
                                                <p>
                                                    {{ $post->desc }}
                                                </p>

                                                <div class="read-more">
                                                    <a href="/chi-tiet-trang-tin?slug={{ $post->slug }}">Xem Bài
                                                        Viết</a>
                                                </div>
                                            </div>

                                        </article>
                                    </div><!-- End post list item -->
                                @endforeach



                            </div><!-- End blog posts list -->

                        </div>

                    </section><!-- /Blog Posts Section -->

                    <!-- Blog Pagination Section -->
                    <section id="blog-pagination" class="blog-pagination section">

                        <div class="container">
                            <div class="d-flex justify-content-center">
                                {{ $listPosts->links() }}
                            </div>
                        </div>

                    </section><!-- /Blog Pagination Section -->

                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Search Widget -->
                        <div class="search-widget widget-item">

                            <h3 class="widget-title">Tìm Kiếm Bài Viết</h3>
                            <form action="">
                                <input type="text">
                                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                            </form>

                        </div><!--/Search Widget -->



                        <!-- Recent Posts Widget -->
                        <div class="recent-posts-widget widget-item">

                            <h3 class="widget-title">Một số bài viết cũ</h3>
                            @foreach ($listPostsOr as $PostsOr)
                                <div class="post-item">
                                    <img src="{{ $PostsOr->thumbnail }}" onerror="this.src='/images/images.png';"
                                        alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a
                                                href="/chi-tiet-trang-tin?slug={{ $PostsOr->slug }}">{{ $PostsOr->title }}</a>
                                        </h4>
                                        <time datetime="2020-01-01">{{ $PostsOr->created_at }}</time>
                                    </div>
                                </div><!-- End recent post item-->
                            @endforeach



                        </div><!--/Recent Posts Widget -->



                    </div>

                </div>

            </div>
        </div>



    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Địa chỉ</h4>
                        <p>4 Đ. Hùng Vương,Phường 10, Đà Lạt, Lâm Đồng</p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Liên Hệ</h4>
                        <p>
                            <strong>Phone:</strong> <span>0263 3812624</span><br>
                            <strong>Email:</strong> <span>tbtt.baotanglamdong@gmail.com</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Giờ Mở Cửa</h4>
                        <p>
                            <strong>Thứ Hai - Chủ Nhật</strong> <br>
                            <span>Sáng: 7h30 - 11h30 - Chiều: 13h30 - 17h00</span><br>

                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Bảo Tàng Lâm Đồng</strong>
            </p>
            <div class="credits">
                Designed by Công ty cổ phần đầu tư PITC
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="giaodien2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="giaodien2/assets/vendor/php-email-form/validate.js"></script>
    <script src="giaodien2/assets/vendor/aos/aos.js"></script>
    <script src="giaodien2/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="giaodien2/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="giaodien2/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="giaodien2/assets/js/main.js"></script>

</body>

</html>
