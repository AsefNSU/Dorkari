<?php
require("sql/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <header>
        <div class="logo">DORKARI</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="">Specials</a></li>
                <li><a href="">Menu</a></li>
                <li><a href="login.php" class="active">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="login-container">
        <div class="login-box">
            <?php
            $message = loginCheck();
            ?>
            <?php if ($message): ?>
                <p class="msg"><?php echo $message; ?></p>
            <?php endif; ?>
            <h2>Login</h2>
            <form>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p class="register-link">Don't have an account? <a href="register.php">Sign up</a></p>
            </form>
        </div>
    </section>
</body>

</html>