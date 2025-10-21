<?php 
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
    <link rel = "stylesheet" href="styles.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    echo '<h1>Hello from PHP</h1>';
  ?>
  <h2>Are you a student or an administrator?</h2>
  <a href="student_login.php"><button>Student Login</button></a>
  <a href="admin_login.php"><button>Administrator Login</button></a>
</body>
</html>
