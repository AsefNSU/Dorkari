<?php
require("sql/functions.php");
?>
<?php
$message = loginCheck();
if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/51eab89142.js" crossorigin="anonymous"></script>


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
        .hidden {
            display: none;
        }

        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>

<body class="sub_page">
    <?php
    include('header.php');
    ?>

    <section class="book_section layout_padding">
        <div class="container">

            <main class="login-page">
                <div class="container">
                    <div class="heading_container">

                        <h1>Login</h1>
                    </div>
                    <form method="POST" class="login-form">
                        <!-- Email Field -->
                        <div class="form-group" id="email-section">
                            <label for="email">Phone Number</label>
                            <input type="text" style="width: 25vw;" id="email" name="email" class="form-control"
                                placeholder="Enter your Phone Number" required>
                            <button type="button" class="btn btn-primary mt-3"
                                onclick="showPasswordField()">Next</button>
                        </div>

                        <!-- Password Field (Initially Hidden) -->
                        <div class="form-group hidden" id="password-section">
                            <label for="password">Password</label>
                            <input type="password" style="width: 25vw;" id="password" name="password"
                                class="form-control" placeholder="Enter your password" required>
                        </div>

                        <div class="form-group hidden" id="submit-section">
                            <button type="button" class="btn btn-secondary mt-3" onclick="goBackToEmail()">Back</button>
                            <button type="submit" class="btn btn-primary mt-3">Login</button>
                        </div>
                    </form>
                    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
                </div>
            </main>

            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script>
                // Function to show the password field after entering the email
                function showPasswordField() {
                    const emailSection = document.getElementById('email-section');
                    const passwordSection = document.getElementById('password-section');
                    const submitSection = document.getElementById('submit-section');

                    /* Validate the email before proceeding
                    const email = document.getElementById('email').value;
                    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                    if (!email || !emailRegex.test(email)) {
                        alert('Please enter a valid email address');
                        return;
                    }*/

                    // Hide the email section and show password and submit sections
                    emailSection.classList.add('hidden');
                    passwordSection.classList.remove('hidden');
                    submitSection.classList.remove('hidden');
                }

                // Function to go back to the email input section
                function goBackToEmail() {
                    const emailSection = document.getElementById('email-section');
                    const passwordSection = document.getElementById('password-section');
                    const submitSection = document.getElementById('submit-section');

                    // Show the email section and hide the password and submit sections
                    emailSection.classList.remove('hidden');
                    passwordSection.classList.add('hidden');
                    submitSection.classList.add('hidden');
                }
            </script>
</body>

</html>