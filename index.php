<?php 
include 'Misc/db.php';  // Connection To Database//
session_start();  // Start The Session //
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>  <!-- Title Of The Page -->
   <link rel="stylesheet" href="../Misc/style.css?v=1.0"> <!-- Links To the CSS File -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
   <div class ="menu-button"> <!-- Main Menu Buttons -->
   <h1>Welcome to the main menu</h1>
  <h2>Are you a student or an administrator?</h2>
  <!-- Buttons to redirect to student or admin login pages -->
  <a href="Student/student_login.php" class="menu-button" style=" background: green">Student Login</a>
  <a href="Admin/admin_login.php" class="menu-button"  style=" background: red">Administrator Login</a>
  </div>
</body>
</html>
