<?php
session_start();    // Start session management //
if (!isset($_SESSION['admin_id']))
{   // If admin is not logged in, redirect to login page //
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Menu</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- links the CSS file for styling -->
</head>
<body>
        <div class="menu-container">    <!-- CSS class for menu container-->
        <h2>Welcome, Administrator</h2>
        <!-- Navigation buttons with a class to stle the buttons-->
        <a href="admin_add_course.php" class="menu-button"style="background-color: #cc17dcff;">Add Courses</a>
        <a href="admin_approve_registration.php" class="menu-button"style="background-color: #545fc6ff;">Approve Registration</a>
        <a href="admin_view_registrations.php" class="menu-button"style="background-color: #4fd971ff;">Admin View Registration</a>
        <a href="admin_student_view.php" class="menu-button"style="background-color: #f4b942ff;">View Students</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: #d9534f;">Logout</a>
    </div>
</body>
</html>