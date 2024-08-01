<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar</title>

    <style>
        .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 10px 20px;
    color: #512da8;
    height: 50px;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(81, 45, 168, 0.5);
}

.navbar-left .logo {
    height: 40px;
}

.navbar-right a, .navbar-right .username {
    color: #512da8;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
}

.navbar-right a:hover, .navbar-right .username:hover {
    text-decoration: underline;
}

    </style>
</head>
    <nav class="navbar">
        <div class="navbar-left">
            <img  alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <a href="../account/classes.php">Classes</a>
            <a  onclick="confirmLogout(event)">Logout</a>
            <span class="username">Username</span>
        </div>
    </nav>




    
    
</body>

</html>
