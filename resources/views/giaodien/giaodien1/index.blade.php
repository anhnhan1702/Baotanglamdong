<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="giaodien1/assets/img/favicon.png" rel="icon">
    <link href="giaodien1/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="giaodien1/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="giaodien1/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="giaodien1/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="giaodien1/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="giaodien1/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="giaodien1/assets/css/main.css" rel="stylesheet">


</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="/trang-tin" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="giaodien1/assets/img/logo.png" alt="">
                <h1 class="sitename">Bảo Tàng Lâm Đồng</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/trang-tin" class="active">Trang chủ<br></a></li>
                    <li><a href="/danh-muc-trang-tin">Tin Tức</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted flex-md-shrink-0" href="/">Đăng Nhập</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 data-aos="fade-up">Bảo Tàng Lâm Đồng </h2>
                        <p data-aos="fade-up" data-aos-delay="100">Bảo tàng Lâm Đồng là bảo tàng tổng hợp (khảo cứu địa
                            phương), hiện đang lưu giữ trên 15.000 hiện vật với nhiều sưu tập hiện vật độc đáo và quý
                            hiếm</p>

                    </div>
                    <div class="col-lg-8 order-1 order-lg-2 hero-img " data-aos="zoom-out">
                        <img src="giaodien1/assets/img/anhnen.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Thông tin Bảo Tàng</h3>
                            <h2>Lịch sử hình thành.</h2>
                            <p>
                                Ngay sau khi đất nước độc lập thống nhất, công tác bảo tồn, bảo tàng ở Lâm Đồng đã được
                                lãnh đạo tỉnh quan tâm. Tháng 8/1975, bộ phận Bảo tồn - Bảo tàng được thành lập, trực
                                thuộc Thành ủy Đà Lạt - với nhiệm vụ sưu tầm, gìn giữ và bảo quản những hiện vật, tư
                                liệu có giá trị lịch sử, văn hóa của tỉnh.
                            </p>
                            <div class="text-center text-lg-start">
                                <a href="#"
                                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Xem chi tiết</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="giaodien1/assets/img/about.png" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- /About Section -->

        <!-- Values Section -->
        <section id="values" class="values section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>
                    <a href="/danh-muc-trang-tin"></a>Tin Tức</a>
                </h2>
                <p>Một số tin nổi bật<br></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @foreach ($listPosts as $post)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="card">
                                <img src="{{ $post->thumbnail }}" onerror="this.src='/images/images.png';"
                                    class="img-fluid-custom" alt="">

                                <h3>
                                    <a href="/chi-tiet-trang-tin?slug={{ $post->slug }}">
                                        {{ $post->title }}

                                    </a>
                                </h3>

                                <p>{{ $post->desc }}</p>
                            </div>
                        </div><!-- End Card Item -->
                    @endforeach



                </div>

            </div>

        </section>
        <!-- /Values Section -->


        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Hình ảnh</h2>
                <p>Hình ảnh các khu vực bảo tàng</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-toancanh">Toàn cảnh</li>
                        <li data-filter=".filter-thacnuoc">Thác nước</li>
                        <li data-filter=".filter-cungnamphuonghoanghau">Cung Nam Phương Hoàng Hậu</li>
                        <li data-filter=".filter-khukhanhtiet">Khu Khánh Tiết</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-toancanh">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/toancanh1.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>App 1</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/toancanh1.png" title="App 1"
                                        data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-thacnuoc">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/thacnuoc1.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Product 1</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/thacnuoc1.png" title="Product 1"
                                        data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-cungnamphuonghoanghau">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/cungnamphuonghoanghau1.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Branding 1</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/cungnamphuonghoanghau1.png"
                                        title="Branding 1" data-gallery="portfolio-gallery-branding"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-khukhanhtiet">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/khukhanhtiet1.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Books 1</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/khukhanhtiet1.png" title="Branding 1"
                                        data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-toancanh">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/toancanh2.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>App 2</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/toancanh2.pn" title="App 2"
                                        data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-thacnuoc">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/thacnuoc2.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Product 2</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/thacnuoc2.png" title="Product 2"
                                        data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-cungnamphuonghoanghau">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/cungnamphuonghoanghau2.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Branding 2</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/cungnamphuonghoanghau2.png"
                                        title="Branding 2" data-gallery="portfolio-gallery-branding"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-khukhanhtiet">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/khukhanhtiet2.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Books 2</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/khukhanhtiet2.png" title="Branding 2"
                                        data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-toancanh">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/toancanh3.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>App 3</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/toancanh3.png" title="App 3"
                                        data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-thacnuoc">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/thacnuoc3.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Product 3</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/thacnuoc3.png" title="Product 3"
                                        data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-cungnamphuonghoanghau">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/cungnamphuonghoanghau3.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Branding 3</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/cungnamphuonghoanghau3.png"
                                        title="Branding 2" data-gallery="portfolio-gallery-branding"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-khukhanhtiet">
                            <div class="portfolio-content h-100">
                                <img src="giaodien1/assets/img/portfolio/khukhanhtiet3.png" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>Books 3</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                    <a href="giaodien1/assets/img/portfolio/khukhanhtiet3.png" title="Branding 3"
                                        data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->



        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Liên Hệ</h2>
                <p>Liên hệ Bảo Tàng</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Địa chỉ</h3>
                                    <p>4 Đ. Hùng Vương</p>
                                    <p>Phường 10, Đà Lạt, Lâm Đồng</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Liên Hệ</h3>
                                    <p>0263 3812624</p>
                                    <p>0263 3813325</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email</h3>
                                    <p>tbtt.baotanglamdong@gmail.com</p>
                                    <p>tbtt.baotanglamdong@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3>Giờ Mở Cửa</h3>
                                    <p>Thứ Hai - Chủ Nhật</p>
                                    <p>Sáng: 7h30 - 11h30 </p>
                                    <p>Chiều: 13h30 - 17h00</p>

                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Your Email" required="">
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Gửi Yêu Cầu</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Để Nhận Các Bài Báo Mới Nhất Của Bảo Tàng</h4>
                        <p>Đăng ký nhận bản tin của chúng tôi và nhận tin tức mới nhất về Bảo Tàng Lâm Đồng!</p>
                        <form action="/" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                    value="Gửi"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Bảo Tàng Lâm Đồng</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>4 Đ. Hùng Vương</p>
                        <p>Phường 10, Đà Lạt, Lâm Đồng</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>0263 3813325</span></p>
                        <p><strong>Email:</strong> <span>tbtt.baotanglamdong@gmail.com</span></p>
                    </div>
                </div>



                <div class="col-lg-4 col-md-12">
                    <h4>Theo Dõi Bảo Tàng</h4>
                    <p>Theo dõi Bảo Tàng Lâm Đồng trên:</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Bảo Tàng Lâm Đồng</strong></p>
            <div class="credits">
                Designed by Công ty cổ phần đầu tư PITC
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="giaodien1/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="giaodien1/assets/vendor/php-email-form/validate.js"></script>
    <script src="giaodien1/assets/vendor/aos/aos.js"></script>
    <script src="giaodien1/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="giaodien1/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="giaodien1/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="giaodien1/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="giaodien1/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="giaodien1/assets/js/main.js"></script>

</body>

</html>
