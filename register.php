<?php
require("sql/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/signup.css">
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
            $message = signupCheck();
            ?>
            <?php if ($message): ?>
                <p class="msg"><?php echo $message; ?></p>
            <?php endif; ?>
            <h2>Sign Up</h2>

            <form method="POST">
                <div class="input-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="input-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required>
                </div>
                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" required>
                </div>
                <div class="input-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-btn">Sign Up</button>
                <p class="register-link">Have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </section>
</body>

</html>