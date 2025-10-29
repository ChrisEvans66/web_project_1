<?php
include '../Misc/db.php';
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch available courses
$courses = $con->query("SELECT * FROM courses");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $stmt = $con->prepare("INSERT INTO registration (student_id, course_id, status, date_registered) VALUES (?, ?, 'Pending', NOW())");
    $stmt->bind_param("ii", $student_id, $course_id);
    if ($stmt->execute()) {
        echo "Course registration submitted and pending approval.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>          
<head>
    <title>Register for Courses</title>
<link rel="stylesheet" href="../Misc/style.css?v=1.0">
</head>
<body>
    <div class ="menu-button">   
<h2>Register for a Course</h2>
<form method="post" action="">
    <label for="course_id">Select Course:</label>
    <select name="course_id" id="course_id" required>
        <?php
        while ($course = $courses->fetch_assoc()) {
            echo '<option value="' . $course['course_id'] . '">' . htmlspecialchars($course['course_code'] . ' - ' . $course['course_name']) . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Register" style="background-color: green; " >      
</form>
     <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
     <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body> 
</html>
