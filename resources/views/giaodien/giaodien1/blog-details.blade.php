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

<body class="blog-details-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
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

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Tin Tức Mới Nhấ</h1>
                            <p class="mb-0">Luôn cập nhật những thông tin thời sự nóng hổi, sự kiện nổi bật trong và
                              ngoài nước. Cùng khám phá những câu chuyện thú vị, ý nghĩa và những xu hướng mới nhất
                              trong đời sống, kinh tế, công nghệ, và giải trí.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                      <li><a href="/trang-tin">Trang Chủ</a></li>
                      <li class="/danh-muc-trang-tin">Tin Tức</li>
                    </ol>
                </div>
            </nav>
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
