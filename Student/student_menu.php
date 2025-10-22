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
    <link rel = "stylesheet" href="../Misc/style.css">
</head>
<body>
    <div class="menu-container">
        <h2>Welcome, Student</h2>
        <a href="student_register_course.php" class="menu-button">Register for Courses</a>
        <a href="view_registrations.php" class="menu-button">View My Courses</a>
        <a href="drop_course.php" class="menu-button">Drop a Course</a>
        <a href="edit_profile.php" class="menu-button">Edit Profile</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: #d9534f;">Logout</a>
    </div>
</body>
</html>
