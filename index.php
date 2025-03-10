<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dorkari Home</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
        <div class="logo">DORKARI</div>
        <nav>
            <ul class="nav-links">
                <li><a href="" class="active">Home</a></li>
                <li><a href="">Specials</a></li>
                <li><a href="">Menu</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO CAROUSEL -->
    <section class="hero">
        <div class="slider">
            <div class="slides">
                <img src="images/slide1.webp" class="slide active" alt="Delicious Food">
                <img src="images/slide2.webp" class="slide" alt="Tasty Meal">
                <img src="images/slide3.webp" class="slide" alt="Gourmet Dish">
            </div>
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>
        <div class="dots">
            <span class="dot active" onclick="goToSlide(0)"></span>
            <span class="dot" onclick="goToSlide(1)"></span>
            <span class="dot" onclick="goToSlide(2)"></span>
        </div>
    </section>

    <main class="main-container">
        <!-- Categories Sidebar -->
        <aside class="categories">
            <h3>Categories</h3>
            <ul>
                <li><a href="#">Meat</a></li>
                <li><a href="#">Seafood</a></li>
                <li><a href="#">Pizza & Pasta</a></li>
                <li><a href="#">Snacks</a></li>
                <li><a href="#">Ice Cream</a></li>
                <li><a href="#">Drinks</a></li>
                <li><a href="#">Desserts</a></li>
            </ul>
        </aside>

        <!-- Popular Products Section -->
        <section class="popular-products">
            <h2>Popular Products</h2>
            <div class="product-grid">
                <div class="product">
                    <img src="images/burger.jpg" alt="Cheese Burger">
                    <h3>Cheese Burger</h3>
                    <p>Juicy beef patty with melted cheese and fresh toppings.</p>
                    <p class="price">250 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/pizza.jpg" alt="Pepperoni Pizza">
                    <h3>Pepperoni Pizza</h3>
                    <p>Delicious cheesy pizza loaded with pepperoni.</p>
                    <p class="price">500 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/pasta.jpg" alt="Creamy Pasta">
                    <h3>Creamy Alfredo Pasta</h3>
                    <p>Rich and creamy pasta served with garlic bread.</p>
                    <p class="price">400 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/shrimp.jpg" alt="Grilled Shrimp">
                    <h3>Grilled Shrimp</h3>
                    <p>Fresh seafood grilled to perfection.</p>
                    <p class="price">600 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/fries.jpg" alt="French Fries">
                    <h3>French Fries</h3>
                    <p>Golden crispy fries served with dipping sauces.</p>
                    <p class="price">150 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/milkshake.jpg" alt="Strawberry Milkshake">
                    <h3>Strawberry Milkshake</h3>
                    <p>Refreshing strawberry shake with whipped cream.</p>
                    <p class="price">200 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/icecream.jpg" alt="Chocolate Ice Cream">
                    <h3>Chocolate Ice Cream</h3>
                    <p>Rich and creamy chocolate ice cream.</p>
                    <p class="price">250 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>

                <div class="product">
                    <img src="images/cake.jpg" alt="Chocolate Cake">
                    <h3>Chocolate Cake</h3>
                    <p>Moist and delicious chocolate cake slice.</p>
                    <p class="price">350 TK</p>
                    <button class="order-btn">Order Now</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dorkari. All rights reserved.</p>
    </footer>

    <!-- SCRIPT -->
    <script src="scripts/script.js"></script>
</body>

</html>