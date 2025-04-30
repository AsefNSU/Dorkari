<?php
include 'config.php';
include 'header.php';

$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Burgerii</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
  <script src="https://kit.fontawesome.com/51eab89142.js" crossorigin="anonymous"></script>
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Our Menu</h2>
      </div>

      <div class="filters-content">
        <div class="row grid">
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)):
              if ($count >= 9)
                break;
              $count++;
              ?>
              <div class="col-sm-6 col-lg-4 all burger">
                <div class="box">
                  <div>
                    <div class="img-box">
                      <img src="images/<?php echo htmlspecialchars($row['image']); ?>"
                        alt="<?php echo htmlspecialchars($row['food_name']); ?>">
                    </div>
                    <div class="detail-box">
                      <h5 class="item-name">
                        <?php echo htmlspecialchars($row['food_name']); ?>
                      </h5>
                      <div class="options">
                        <div style="display: flex;">
                          <h6 class="item-price">
                            <?php echo number_format($row['price'], 2); ?>
                          </h6>
                          <h6>- BDT</h6>
                        </div>
                        <button class="add-to-cart btn btn-warning"
                          data-name="<?php echo htmlspecialchars($row['food_name']); ?>"
                          data-price="<?php echo number_format($row['price'], 2, '.', ''); ?>"
                          data-image="<?php echo htmlspecialchars($row['image']); ?>">
                          <i class="fa fa-cart-plus"></i> Add
                        </button>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>No menu items found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>Contact Us</h4>
            <div class="contact_link_box">
              <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i><span>Mirpur</span></a>
              <a href=""><i class="fa fa-phone" aria-hidden="true"></i><span>Call 01759-842576</span></a>
              <a href=""><i class="fa fa-envelope" aria-hidden="true"></i><span>burgerii@gmail.com</span></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">Burgerii</a>
            <p>More than just burgers — it's an experience.</p>
            <div class="footer_social">
              <a href=""><i class="fa fa-facebook"></i></a>
              <a href=""><i class="fa fa-twitter"></i></a>
              <a href=""><i class="fa fa-linkedin"></i></a>
              <a href=""><i class="fa fa-instagram"></i></a>
              <a href=""><i class="fa fa-pinterest"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>Opening Hours</h4>
          <p>Everyday</p>
          <p>10.00 Am - 10.00 Pm</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

  <!-- Cart Logic -->
  <script>
    // Load cart from localStorage
    function updateCartCount() {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      let count = cart.reduce((total, item) => total + item.qty, 0);
      $('#count').text(count);
    }

    function saveCart(cart) {
      localStorage.setItem('cart', JSON.stringify(cart));
    }

    $(document).ready(function () {
      updateCartCount();

      $('.add-to-cart').click(function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = parseFloat($(this).data('price'));
        let image = $(this).data('image');

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let existing = cart.find(item => item.id == id);

        if (existing) {
          existing.qty += 1;
        } else {
          cart.push({ id, name, price, image, qty: 1 });
        }

        saveCart(cart);
        updateCartCount();
      });

      // When "Order Online" is clicked
      $('.order_online').click(function (e) {
        e.preventDefault();
        let cart = localStorage.getItem('cart');
        if (!cart || JSON.parse(cart).length === 0) {
          alert('Your cart is empty!');
          return;
        }
        // Store cart in session via AJAX
        $.post('save_cart.php', { cart: cart }, function () {
          window.location.href = 'order.php';
        });
      });
    });
  </script>
  <script src="js/addtocart.js"></script>

</body>

</html>