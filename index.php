<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - MOMO</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  

  <!-- Additional Styling for Beauty -->
  <style>
    body {
      font-family: 'Inconsolata', monospace;
      background: linear-gradient(135deg, #ffcc99, #ff99cc);
      color: #333;
      line-height: 1.6;
    }

    .header {
      background-color: #111;
      padding: 20px 0;
    }

    .header .logo h1 {
      color: #fff;
      font-size: 36px;
      font-weight: 700;
      letter-spacing: 2px;
    }

    #navmenu ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    #navmenu ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    #navmenu ul li a:hover {
      color: #ff99cc;
    }

    .portfolio-item .portfolio-content {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .portfolio-item .portfolio-content:hover {
      transform: translateY(-10px);
    }

    .portfolio-info h5 {
      font-size: 18px;
      font-weight: 600;
      color: #111;
      margin-top: 15px;
    }

    .portfolio-info p {
      color: #555;
      font-size: 16px;
      margin-bottom: 15px;
    }

    .portfolio-item img {
      width: 100%;
      height: auto;
      transition: all 0.3s ease;
    }

    .portfolio-item img:hover {
      transform: scale(1.05);
    }

    .scroll-top {
      background-color: #ff99cc;
      border-radius: 50%;
      padding: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      bottom: 20px;
      right: 20px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .scroll-top:hover {
      background-color: #ff80b3;
    }
  </style>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <h1 class="sitename">MOMO Shop</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="login.php" class="active">Log out</a></li>
          <li><a href="signup.php" class="active">Signup</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-7 portfolio-info">
            <h3>CRYBABY</h3>
            <p>CRYBABY เป็นตัวแทนของคนที่ "ไม่กล้าร้องไห้หรือไม่กล้าแสดงความอ่อนแอให้คนอื่นเห็น" 
              เพราะต้องติดอยู่ในกรอบสังคมที่พยายามบอกให้คนเราเข้มแข็ง ทำให้ต้องแสดงออกว่าโอเคและรับมือได้</p>
          </div>
        </div>

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/app-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY x Powerpuff Girls</h5>
                <p>🧺฿380.00</p>
                <div>
                  <img src="assets/img/1.jpg" width="250px">
                  <a href="assets/img/1.jpg" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/product-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY Sad Club Series Fidget Spiner</h5>
                <p>🧺฿380.00</p>
                <div>
                  <img src="assets/img/2.jpg" width="300px">
                  <a href="assets/img/2.jpg" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/branding-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY Sad Club Series Scene Sets</h5>
                <p>🧺฿380.00</p>
                <div>
                  <img src="assets/img/3.jpg" width="300px">
                  <a href="assets/img/3.jpg" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/books-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY Crying Again Series Figures</h5>
                <p>🧺฿380.00</p>
                <div>
                  <img src="assets/img/4.png" width="300px">
                  <a href="assets/img/4.png" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/app-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY Crying Again Series-Vinyl Face Plush Blind</h5>
                <p>🧺฿690.00</p>
                <div>
                  <img src="assets/img/5.png" width="260px">
                  <a href="assets/img/5.png" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
            <div class="portfolio-content h-100">
              <img src="assets/img/portfolio/product-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5>CRYBABY Crying Parade Series</h5>
                <p>🧺฿380.00</p>
                <div>
                  <img src="assets/img/6.png" width="300px">
                  <a href="assets/img/6.png" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Portfolio Item -->
        </div><!-- End Portfolio Container -->
      </div><!-- End Container -->
    </section><!-- End Portfolio Section -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  </main><!-- End Main -->

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

