<?php

require_once('../Global/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/users.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="signInForm" method="post">
                <h1>Sign In</h1>
                <input type="email" placeholder="Email" id="signin_email">
                <input type="password" placeholder="Password" id="signin_password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" onclick="authenticate()">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register" onclick="signup()">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function authenticate() {
            var email = document.getElementById('signin_email').value;
            var password = document.getElementById('signin_password').value;

            console.log('Email: ' + email);
            console.log('Password: ' + password);

            $.ajax({
                url: '../controller/userAthenticationController.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    username: email,
                    password: password,
                    mode: 'SIGN_IN'
                }),
                success: function(response) {
        console.log('Response: ', response);
        if (response.result) {
            window.location.href = '../account/home.php';
        } else {
            alert('Invalid username or password.');
        }
    },
                error: function(xhr, status, error) {
                    console.error('Error: ', error);
                    alert('An error occurred. Please try again.');
                }
            });
        }

        function signup() {
            var url = '../account/Signup.php';
            window.location.href = url;
        }
    </script>
</body>

</html>
