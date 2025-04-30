<div class="hero_area" style="background-color: rgb(39, 22, 22)">

    <!-- header section starts -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.html">
                    <span>
                        Burgerii
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  mx-auto ">
                        <!-- Home Link -->
                        <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php')
                            echo 'active'; ?>">
                            <a class="nav-link" href="index.php">Home </a>
                        </li>
                        <!-- Menu Link -->
                        <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'menu.php')
                            echo 'active'; ?>">
                            <a class="nav-link" href="menu.php">Menu </a>
                        </li>
                        <!-- About Link -->
                        <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php')
                            echo 'active'; ?>">
                            <a class="nav-link" href="about.php">About </a>
                        </li>
                        <!-- Book Table Link -->
                        <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'book.php')
                            echo 'active'; ?>">
                            <a class="nav-link" href="book.php">Book Table</a>
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
                        <form id="cartForm" action="order.php" method="post">
                            <input type="hidden" name="cart" id="cartInput">
                            <button type="submit" class="btn btn-danger">Order Online</button>
                        </form>


                        <script>
                            document.getElementById("orderForm").addEventListener("submit", function (e) {
                                const cart = JSON.parse(localStorage.getItem("cart") || "[]");
                                document.getElementById("cartDataInput").value = JSON.stringify(cart);
                            });
                        </script>

                    </div>
                </div>
            </nav>
        </div>
    </header>
    <script>
        document.getElementById("order-button").addEventListener("click", function (e) {
            e.preventDefault();
            const cart = localStorage.getItem("cart");
            if (!cart || JSON.parse(cart).length === 0) {
                alert("Your cart is empty!");
                return;
            }

            // Redirect to order.php with cart JSON in URL
            const encodedCart = encodeURIComponent(cart);
            window.location.href = "order.php?cart=" + encodedCart;
        });
    </script>
    <script>
        document.getElementById("cartForm").addEventListener("submit", function (e) {
            const cart = localStorage.getItem("cart");
            document.getElementById("cartInput").value = cart;
        });
    </script>


    <script src="js/cart.js"></script>

    <!-- end header section -->
</div>