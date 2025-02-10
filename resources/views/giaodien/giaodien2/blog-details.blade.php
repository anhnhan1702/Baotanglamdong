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
                        <li class="current">Chi tiết tin tức</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Blog Details Section -->
                    <section id="blog-details" class="blog-details section">
                        <div class="container">

                            <article class="article">

                                <div class="post-img">
                                    <img src="{{ $indexPost->thumbnail }}"
                                    onerror="this.src='/images/images.png';" class="img-fluid">
                                </div>

                                <h2 class="title">{{$indexPost->title}}</h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="blog-details.html">Admin</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="blog-details.html"><time datetime="2020-01-01">{{$indexPost->created_at}}</time></a></li>
                                     
                                    </ul>
                                </div><!-- End meta top -->

                                <div class="content">
                               {!! $indexPost->content!!}

                                </div><!-- End post content -->

                               

                            </article>

                        </div>
                    </section><!-- /Blog Details Section -->

            

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
                          @foreach ($listPosts as $PostsOr)
                              <div class="post-item">
                                  <img src="{{ $PostsOr->thumbnail }}"
                                  onerror="this.src='/images/images.png';" alt=""
                                      class="flex-shrink-0">
                                  <div>
                                      <h4><a href="/chi-tiet-trang-tin?slug={{ $PostsOr->slug }}">{{$PostsOr->title }}</a></h4>
                                      <time datetime="2020-01-01">{{$PostsOr->created_at }}</time>
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
