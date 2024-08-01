<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar</title>
    <link rel="stylesheet" href="../css/home.css">

    <style>
        .welcome-notes {
    text-align: center;
    margin: 20px;
    padding: 10px;
    color: blue;
    padding-top: 150px
   
}
.welcome-notes h1 {
    color: black;
    font-weight: #512da8;
}
.welcome-notes p {
    color: black;
    font-weight: bold;
}

    </style>
</head>
<body style=" background-size: cover; background-repeat: no-repeat; background-position: center; width: 100%; height: 100vh; margin: 0;">
    <nav class="navbar">
        <div class="navbar-left">
            <img src="logo.png" alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <a href="../account/Home.php">Home</a>
            <a href="../account/classes.php">Classes</a>
            <a id="logout-link">Logout</a>
            <span class="username">Username</span>
        </div>
    </nav>
    
    <div class="welcome-notes">
      
        <h1>Welcome to Our School Portal!</h1>
        <p>We are delighted to have you here. Explore our resources and have a great day!</p>
    </div>
</body>

<script>
  document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault(); 
    
    if (confirm('Are you sure you want to log out?')) {
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = '../account/Login.php'; 
      
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'logout';
      form.appendChild(input);
      
      document.body.appendChild(form);
      form.submit();
    }
  });
</script>


</html>
