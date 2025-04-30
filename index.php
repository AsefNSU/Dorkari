<?php

session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Burgerii </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
    crossorigin="anonymous" />
  <!--slider-->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/51eab89142.js" crossorigin="anonymous"></script>


  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              Burgerii
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="book.php">Book Table</a>
              </li>
              <li class="nav-item d-flex align-items-center gap-2">
                <?php if (isset($_SESSION["first_name"])): ?>
                  <a href="dashboard.php" class="header-btn">
                    <i class="uil uil-user-md"></i>
                  </a>
                  <span class="text-white"><?= htmlspecialchars($_SESSION["first_name"]) ?></span>
                  <a href="logout.php" class="btn btn-sm btn-danger ms-2">Logout</a>
                <?php else: ?>
                  <a class="nav-link" href="login.php">Login/Signup</a>
                <?php endif; ?>
              </li>

            </ul>
            <div class="user_option">
              <a href="" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false"
                  style="display: flex; flex-direction:row; gap:10px; align-items: center; align-content: center; padding: .20vw; border-radius: 10px ; "
                  id="cart">
                  <i class="fa-sharp-duotone fa-solid fa-cart-shopping"></i>
                  <p id="count" style=" font-size: large;">0 </p>
                </button>
                <ul class="dropdown-menu">
                  <div class="cartcontainer container">
                    <!-- d-none -->
                    <div class="root">

                    </div>
                    <div class="sidebar">
                      <div class="head">
                        <p>
                          My Cart
                        </p>
                      </div>
                      <div id="cartitem">

                      </div>
                      <div class="foot">
                        <h3>
                          Total
                        </h3>
                        <div style="display: flex;">
                          <h2>
                            ৳
                          </h2>
                          <h2 id="total">
                            0.00
                          </h2>
                        </div>

                      </div>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section">
      <div id="customCarousel1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-7 col-lg-6">
                  <div class="detail-box">
                    <h1>Welcome to Burgerii!</h1>
                    <p>Our burgers don’t just satisfy hunger—they spark cravings.</p>
                    <div class="btn-box">
                      <a href="menu.php" class="btn1">Order Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-7 col-lg-6">
                  <div class="detail-box">
                    <h1>Flavors You Can’t Forget</h1>
                    <p>From classic favorites to bold new twists, we serve burgers that leave a lasting impression.
                      Fresh, flavorful, and made with love.</p>
                    <div class="btn-box">
                      <a href="menu.php" class="btn1">Order Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-7 col-lg-6">
                  <div class="detail-box">
                    <h1>Where Every Bite Tells a Story</h1>
                    <p>More than just burgers — it's an experience. Taste the difference with every layer of premium
                      ingredients stacked to perfection.</p>
                    <div class="btn-box">
                      <a href="menu.php" class="btn1">Order Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#customCarousel1" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#customCarousel1" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-bs-target="#customCarousel1" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#customCarousel1" data-bs-slide-to="1"></li>
            <li data-bs-target="#customCarousel1" data-bs-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->


  </div>

  <!-- offer section -->

  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="images/burger.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Tasty Thursdays
                </h5>
                <h6>
                  <span>20%</span> Off
                </h6>
                <a href="">
                  Order Now
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
                <img src="images/wings.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Wings Days
                </h5>
                <h6>
                  <span>15%</span> Off
                </h6>
                <a href="">
                  Order Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end offer section -->

  <!-- food section -->

  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>



      <div class="filters-content">
        <div class="row grid">
          <div class="col-sm-6 col-lg-4 all burger">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/b1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Study Buddy
                  </h5>

                  <div class="options">
                    <h6>
                      69 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all burger">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/b2.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Chicky Chucky
                  </h5>
                  <div class="options">
                    <h6>
                      260 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all burger">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/b3.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Big Hunger Fix
                  </h5>

                  <div class="options">
                    <h6>
                      350 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all wings">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/w1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Naga Wings
                  </h5>

                  <div class="options">
                    <h6>
                      200 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all wings">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/w2.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Plain Wings
                  </h5>

                  <div class="options">
                    <h6>
                      100 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all wings">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/w3.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Crispy Wings
                  </h5>

                  <div class="options">
                    <h6>
                      150 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Meat">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/m1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Chicken Meat Box
                  </h5>

                  <div class="options">
                    <h6>
                      170 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Meat">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/m1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Grilled Meat Box
                  </h5>

                  <div class="options">
                    <h6>
                      230 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 all Meat">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="images/m1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Crust Meat Box
                  </h5>

                  <div class="options">
                    <h6>
                      200 BDT
                    </h6>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="btn-box">
        <a href="menu.html">
          View More
        </a>
      </div>
    </div>
  </section>

  <!-- end food section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Burger Bliss on a Budget
              </h2>
            </div>
            <p>
              At Burgerii, we believe great taste shouldn't break the bank. Our specialty? Serving mouthwatering, juicy
              burgers that satisfy your cravings and your wallet. Quality ingredients, bold flavors, and unbeatable
              prices — because everyone deserves a bite of happiness. 🍔
            </p>
            <a href="about.html">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!--team-->
  <section class="team-section">
    <h2>Meet Our Team</h2>
    <div class="team-container">
      <div class="team-card">
        <img src="images/profile1.jpg" alt="Team Member 1">
        <h3>KH Borhan Siyam</h3>
        <div class="social-icons">
          <a href="https://www.facebook.com" target="_blank">
            <img src="images/facebook.png" alt="Facebook" width="40" height="40">
          </a>
          <a href="https://www.instagram.com" target="_blank">
            <img src="images/instagram.png" alt="Instagram" width="40" height="40">
          </a>
          <a href="https://www.linkedin.com/" target="_blank">
            <img src="images/linkdin.png" alt="Linkedin" width="40" height="40">
          </a>
        </div>
      </div>

      <div class="team-card">
        <img src="images/profile2.jpg" alt="Team Member 2">
        <h3>Rafat Jahan</h3>
        <div class="social-icons">
          <a href="https://www.facebook.com" target="_blank">
            <img src="images/facebook.png" alt="Facebook" width="40" height="40">
          </a>
          <a href="https://www.instagram.com" target="_blank">
            <img src="images/instagram.png" alt="Instagram" width="40" height="40">
          </a>
          <a href="https://www.linkedin.com/" target="_blank">
            <img src="images/linkdin.png" alt="Linekdin" width="40" height="40">
          </a>
        </div>
      </div>

      <div class="team-card">
        <img src="images/profile3.jpg" alt="Team Member 3">
        <h3>Yeasin Khalili</h3>
        <div class="social-icons">
          <a href="https://www.facebook.com" target="_blank">
            <img src="images/facebook.png" alt="Facebook" width="40" height="40">
          </a>
          <a href="https://www.instagram.com" target="_blank">
            <img src="images/instagram.png" alt="Instagram" width="40" height="40">
          </a>
          <a href="https://www.linkedin.com/" target="_blank">
            <img src="images/linkdin.png" alt="Linkedin" width="40" height="40">
          </a>
        </div>
      </div>

      <div class="team-card">
        <img src="images/profile4 .jpg" alt="Team Member 4">
        <h3>Asef Khan</h3>
        <div class="social-icons">
          <a href="https://www.facebook.com" target="_blank">
            <img src="images/facebook.png" alt="Facebook" width="40" height="40">
          </a>
          <a href="https://www.instagram.com" target="_blank">
            <img src="images/instagram.png" alt="Instagram" width="40" height="40">
          </a>
          <a href="https://www.linkedin.com/" target="_blank">
            <img src="images/linkdin.png" alt="Linkedin" width="40" height="40">
          </a>
        </div>
      </div>
    </div>
  </section>
  <!--end team-->

  <!-- client section -->
  <section class="review-section">
    <h2 class="text-3xl font-extrabold text-center mb-8 text-gray-800">⭐ Customer Reviews</h2>
    <div class="grid gap-8 md:grid-cols-3">

      <!-- Customer 1 -->
      <div class="review-card">
        <div class="flex flex-col items-center">
          <img src="/images/client1.jpg" alt="Customer 1" class="profile-img">
          <h3 class="text-xl font-semibold text-gray-700">Sadia Khan Nova</h3>
          <p class="rating">★★★★★</p>
          <p class="review-text" style="font-size: larger; font-weight:bold;">"Absolutely loved the burgers! The perfect
            balance of flavor and affordability. Will definitely come back!"</p>
        </div>
      </div>

      <!-- Customer 2 -->
      <div class="review-card">
        <div class="flex flex-col items-center">
          <img src="/images/client2.jpg" alt="Customer 2" class="profile-img">
          <h3 class="text-xl font-semibold text-gray-700">Rafi Ahmed</h3>
          <p class="rating">★★★★☆</p>
          <p class="review-text" style="font-size: larger; font-weight:bold;">"Great burgers at an amazing price!
            Perfect spot for a quick, delicious meal."</p>
        </div>
      </div>

      <!-- Customer 3 -->
      <div class="review-card">
        <div class="flex flex-col items-center">
          <img src="/images/client3.jpg" alt="Customer 3" class="profile-img">
          <h3 class="text-xl font-semibold text-gray-700">Jarin tasin</h3>
          <p class="rating">★★★★★</p>
          <p class="review-text" style="font-size: larger; font-weight:bold;">"Amazing taste and super budget-friendly!
            Highly recommend Burgerii to all my friends."</p>
        </div>
      </div>

    </div>
  </section>




  <!-- end client section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Mirpur
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call 01759-842576
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  burgerii@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Burgerii
            </a>
            <p>
              More than just burgers — it's an experience. Taste the difference with every layer of premium ingredients
              stacked to perfection.


            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Opening Hours
          </h4>
          <p>
            Everyday
          </p>
          <p>
            10.00 Am -10.00 Pm
          </p>
        </div>
      </div>

  </footer>
  <!-- footer section -->


  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- js- files -->
  <script src="js/addtocart.js"></script>
  <script src="js/carticon.js"></script>


</body>

</html>