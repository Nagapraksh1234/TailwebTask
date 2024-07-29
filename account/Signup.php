<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once('../Global/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/users.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="SignUpForm" method="post">
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="email" placeholder="Email" id="signup_email">
                <input type="password" placeholder="Password" id="signup_password">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="loginForm" method="post">
                <h1>Sign In</h1>
                <input type="text" placeholder="Name" id="signin_name">
                <input type="email" placeholder="Email" id="signin_email">
                <input type="password" placeholder="Password" id="signin_password">
                <a href="#">Forgot Your Password?</a>
                <button type="submit" onclick="authenticate(event)">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div id="lottie"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var animation = lottie.loadAnimation({
                container: document.getElementById('lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '../assets/school.json'
            });
        });

        function authenticate(event) {
    event.preventDefault();

    var user_name = document.getElementById('signin_email').value;
    var name = document.getElementById('signin_name').value;
    var password = document.getElementById('signin_password').value;
    var url = '../controller/userAthenticationController.php';


    console.log('Username: ' + user_name);
    console.log('Name: ' + name);
    console.log('Password: ' + password);
    console.log('Password: ' + url);


    $.ajax({
    url: '../controller/userAthenticationController.php',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
        username: user_name,
        name: name,
        password: password,
        mode: 'INSERT'
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

    </script>
</body>
</html>
