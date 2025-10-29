<?php
include '../Misc/db.php';     // connects to the database//
session_start();    // Start the session//

    // Checks if the student is logged in//
if (!isset($_SESSION['student_id']))
{
    header("Location: student_login.php");
    exit();
}   // Gets the student ID from session//
$student_id = $_SESSION['student_id'];
$sql = "SELECT s.full_name, c.course_code, c.course_name, r.status, r.registration_id
        FROM registration r
        JOIN courses c ON r.course_id = c.course_id
        JOIN students s ON r.student_id = s.student_id
        WHERE r.student_id = ?";
$stmt = $con->prepare($sql);
if ($stmt) // Check if the statement was prepared successfully//
{
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else 
{   // Statement preparation failed//
    echo "SQL error: " . $con->error;
    exit;
}
$stmt->close();
?>
<!DOCTYPE html>
<html>      
<head>
    <title>My Courses</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- Links to CSS file -->
</head>
<body> 
 <div class="menu-container">
    <h1>My Registered Courses</h1>
    </div>    
<table border="1">  <!-- Table to display registered courses -->
    <tr><th>Student</th><th>Course Code</th><th>Course Name</th><th>Status</th></tr>
    <?php 
    while ($row = $result->fetch_assoc()) 
{ ?>     <!-- Loops through each registered course-->
        <tr>
            <td><?php echo $row['full_name']; ?></td>   <!-- Displays student full name-->
            <td><?php echo $row['course_code']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['status']; ?></td>          
        </tr>
    <?php 
} ?>
</table>

      <div class="menu-button"> <!-- Navigation buttons to menu page and logout with a CSS class-->
        <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>  
</body>
</html>