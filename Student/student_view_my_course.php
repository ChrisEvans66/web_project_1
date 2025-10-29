<?php
include '../Misc/db.php';
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}   
$student_id = $_SESSION['student_id'];
$sql = "SELECT s.full_name, c.course_code, c.course_name, r.status, r.registration_id
        FROM registration r
        JOIN courses c ON r.course_id = c.course_id
        JOIN students s ON r.student_id = s.student_id
        WHERE r.student_id = ?";
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "SQL error: " . $con->error;
    exit;
}
$stmt->close();
?>
<!DOCTYPE html>
<html>      
<head>
    <title>My Courses</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
</head>
<body> 
 <div class="menu-container">
    <h1>My Registered Courses</h1>
    </div>    
<table border="1">
    <tr><th>Student</th><th>Course Code</th><th>Course Name</th><th>Status</th></tr>
    <?php 
    
    while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['course_code']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['status']; ?></td>          
        </tr>
    <?php } ?>
</table>

      <div class="menu-button">
        <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>  



</body>
</html>