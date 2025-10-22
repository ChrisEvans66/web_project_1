<?php 
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
    <link rel = "stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    echo '<h1>Welcome to the main menu</h1>';
  ?>
  <h2>Are you a student or an administrator?</h2>
  <a href="student_login.php" class="button">Student Login</a>
  <a href="admin_login.php" class="button">Administrator Login</a>
</body>
</html>
