<?php

require_once('../Global/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
    <link rel="stylesheet" href="../css/users.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js" integrity="sha512-4HqFZB8NdzL9PeOK11eDhu/ntLUkmrcQ2xJrNY9qX1iA2xNLj8O4hAf11/bF1sNEyRpMA1UmytPG3biLPHkF+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Create Account</h1>
                <span>or use your email for registeration</span>
                <input type="text" placeholder="Name" id="name">
                <input type="email" placeholder="Email" id="username">
                <input type="password" placeholder="Password" id="password">
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Sign In</h1>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
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
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js">

        $(document).ready(function() {

            $('#loginForm').on('submit', function(event) {

                event.preventDefault();

                var user_name = $('#username').val();
                var name = $('#name').val();
                var password = $('password').val();

                $.ajax({
                    url: '../controller/login.php',
                    method: 'POST',
                    data: {
                        
                        name: name,
                        user_name: user_name,
                        password:password
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '../account/home.php';
                        } else {
                            alert('Invalid username or password.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }


                });




            }

        }


    </script>
</body>

</html>




