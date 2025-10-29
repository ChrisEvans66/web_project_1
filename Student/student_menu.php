<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Menu</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
</head>
<body>
    <h1>Welcome, Student</h1>
    <div class="menu-container">       
        <a href="student_register_course.php" class="menu-button"style="background-color: #cc17dcff;">Register for Courses</a>
        <a href="student_view_my_course.php" class="menu-button"style="background-color: #545fc6ff;">View My Courses</a>
        <a href="student_drop_course.php" class="menu-button"style="background-color: #dcdc17ff;">Drop a Course</a>
        <a href="student_profile.php" class="menu-button"style="background-color: #4fd971ff;">Edit Profile</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: #d9534f;">Logout</a>
    </div>
</body>
</html>
