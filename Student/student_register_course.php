<?php
include '../Misc/db.php';     // connects to the database//
session_start();    // Start the session//

    // Checks if the student is logged in//
if (!isset($_SESSION['student_id'])) 
{
    header("Location: student_login.php");
    exit();
}   
    // Gets the student ID from session//
$student_id = $_SESSION['student_id'];

// Fetches the list of available courses//
$courses = $con->query("SELECT * FROM courses");
// Handles the course registration form submission//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $stmt = $con->prepare("INSERT INTO registration (student_id, course_id, status, date_registered) VALUES (?, ?, 'Pending', NOW())");
    $stmt->bind_param("ii", $student_id, $course_id);
    if ($stmt->execute()) 
    {   //
        echo "Course registration submitted and pending approval.";
    } else 
    {   // Registration failed//
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>          
<head>
    <title>Register for Courses</title>
<link rel="stylesheet" href="../Misc/style.css?v=1.0">      <!-- Links to CSS file -->
</head>
<body>
    <div class ="menu-button">   
<h2>Register for a Course</h2>
<form method="post" action="">  <!-- Course registration form -->
    <label for="course_id">Select Course:</label>
    <select name="course_id" id="course_id" required>
        <?php   // Populates the dropdown menu with available courses//
        while ($course = $courses->fetch_assoc()) 
        {   // Loops through each course//
            echo '<option value="' . $course['course_id'] . '">' . htmlspecialchars($course['course_code'] . ' - ' . $course['course_name']) . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Register" style="background-color: green; " >   <!-- Submit button -->     
</form> 
        <!--    Navigation buttons to menu page and logout -->
        <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body> 
</html>
