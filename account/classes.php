<?php
require_once('../Global/config.php');
include '../initilizers/init_classes.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>classes</title>
    <link rel="stylesheet" href="../css/classes.css">

</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="logo.png" alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <a href="../account/classes.php">Classes</a>
            <a href="#logout">Logout</a>
            <span class="username">Username</span>
        </div>
    </nav>
  <br>

  <div class="card-container">
        <?php if (isset($get_classes) && is_array($get_classes)): ?>
            <?php foreach ($get_classes as $class): ?>
                <a href="students.php?section=<?php echo base64_encode($class['section']); ?>&class_name=<?php echo base64_encode($class['class_name']); ?>" class="card">
                    <h2><?php echo htmlspecialchars($class['class_name']); ?></h2>
                    <p>Section: <?php echo htmlspecialchars($class['section']); ?></p>
                    <p>Instructor: <?php echo htmlspecialchars($class['instructor']); ?></p>
                    <p>Time: <?php echo htmlspecialchars($class['time']); ?></p>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No classes available.</p>
        <?php endif; ?>
    </div>


</body>
</html>
