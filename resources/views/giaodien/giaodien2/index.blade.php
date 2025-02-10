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

    <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

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

        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">

            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-4 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">Bảo Tàng Lâm Đồng</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Bảo tàng Lâm Đồng là bảo tàng tổng hợp (khảo cứu địa
                            phương), hiện đang lưu giữ trên 15.000 hiện vật với nhiều sưu tập hiện vật độc đáo và quý
                            hiếm</p>

                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="giaodien1/assets/img/anhnen.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Thông tin Bảo Tàng<br></h2>
                <p><span>Lịch sử </span> <span class="description-title">hình thành.</span></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                        <img src="giaodien2/assets/img/gioithieu.png" class="img-fluid mb-4" alt="">

                    </div>
                    <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">

                            <p>
                                Ngay sau khi đất nước độc lập thống nhất, công tác bảo tồn, bảo tàng ở Lâm Đồng đã được
                                lãnh đạo tỉnh quan tâm. Tháng 8/1975, bộ phận Bảo tồn - Bảo tàng được thành lập, trực
                                thuộc Thành ủy Đà Lạt - với nhiệm vụ sưu tầm, gìn giữ và bảo quản những hiện vật, tư
                                liệu có giá trị lịch sử, văn hóa của tỉnh.
                            </p>

                            <div class="position-relative mt-4">
                                <img src="giaodien1/assets/img/about.png" class="img-fluid" alt="">
                                <a href="https://www.youtube.com/watch?v=oLlEH1NkunU"
                                    class="glightbox pulsating-play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->





        <!-- Chefs Section -->
        <section id="chefs" class="chefs section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2><a href="/danh-muc-trang-tin"></a>Tin Tức</a></h2>
                <p><span>Một số </span> <span class="description-title">tin nổi bật<br></span></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @foreach ($listPosts as $post)
                        <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ $post->thumbnail }}" onerror="this.src='/images/images.png';"
                                        class="img-fluid-custom" alt="">
                                    <div class="social">
                                        <a href=""><i class="bi bi-twitter-x"></i></a>
                                        <a href=""><i class="bi bi-facebook"></i></a>
                                        <a href=""><i class="bi bi-instagram"></i></a>
                                        <a href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4> <a href="/chi-tiet-trang-tin?slug={{ $post->slug }}">
                                            {{ $post->title }}

                                        </a></h4>

                                    <p>{{ $post->desc }}</p>
                                </div>
                            </div>
                        </div><!-- End Chef Team Member -->
                    @endforeach
                </div>

            </div>

        </section><!-- /Chefs Section -->



        <!-- Gallery Section -->
        <section id="gallery" class="gallery section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Album Ảnh</h2>
                <p><span>Hình ảnh</span> <span class="description-title">Bảo Tàng</span></p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/toancanh1.png"><img
                                    src="giaodien1/assets/img/portfolio/toancanh1.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/thacnuoc1.png"><img
                                    src="giaodien1/assets/img/portfolio/thacnuoc1.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/cungnamphuonghoanghau1.png"><img
                                    src="giaodien1/assets/img/portfolio/cungnamphuonghoanghau1.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/khukhanhtiet1.png"><img
                                    src="giaodien1/assets/img/portfolio/khukhanhtiet1.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/toancanh2.png"><img
                                    src="giaodien1/assets/img/portfolio/toancanh2.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/cungnamphuonghoanghau2.png"><img
                                    src="giaodien1/assets/img/portfolio/cungnamphuonghoanghau2.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/khukhanhtiet2.png"><img
                                    src="giaodien1/assets/img/portfolio/khukhanhtiet2.png" class="img-fluid"
                                    alt=""></a></div>
                        <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                href="giaodien1/assets/img/portfolio/thacnuoc2.png"><img
                                    src="giaodien1/assets/img/portfolio/thacnuoc2.png" class="img-fluid"
                                    alt=""></a></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Gallery Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Liên Hệ</h2>
                <p><span>Liên hệ</span> <span class="description-title">Bảo Tàng</span></p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="mb-5">
              
                    <iframe style="width: 100%; height: 400px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5189.406634154002!2d108.4573107116767!3d11.940470236594507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3171131b9795a10f%3A0x643ee750c5d0d6cd!2zQuG6o28gdMOgbmcgTMOibSDEkOG7k25n!5e1!3m2!1svi!2s!4v1736234361775!5m2!1svi!2s"
                        frameborder="0" allowfullscreen=""></iframe>
                </div><!-- End Google Maps -->

                <div class="row gy-4">

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                            <i class="icon bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Địa chỉ</h3>
                                <p>4 Đ. Hùng Vương,Phường 10, Đà Lạt, Lâm Đồng</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                            <i class="icon bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Liên Hệ</h3>
                                <p>0263 3812624</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
                            <i class="icon bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email</h3>
                                <p>tbtt.baotanglamdong@gmail.com</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
                            <i class="icon bi bi-clock flex-shrink-0"></i>
                            <div>
                                <h3>Giờ Mở Cửa<br></h3>
                                <p><strong>Thứ Hai - Chủ Nhật</strong> Sáng: 7h30 - 11h30 - Chiều: 13h30 - 17h00</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                    data-aos-delay="600">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                required="">
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Your Email"
                                required="">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                required="">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>

                            <button type="submit">Gửi Yêu Cầu</button>
                        </div>

                    </div>
                </form><!-- End Contact Form -->

            </div>

        </section><!-- /Contact Section -->

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
