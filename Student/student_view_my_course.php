<?php
session_start();
include '../Misc/db.php'; // the DB connection file

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    echo "Please log in to view your courses.";
    exit;
}

$student_id = $_SESSION['student_id'];

// Fetch courses for the logged-in student
$sql = "SELECT c.course_name, c.course_code 
        FROM registration r
        JOIN courses c ON r.course_id = c.course_id
        WHERE r.student_id = ? AND r.status = 'Accepted'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>My Registered Courses</h2>";
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>{$row['course_name']}</strong> ({$row['course_code']}) </li>";
    }
    echo "</ul>";
} else {
    echo "You are not registered for any courses.";
}

$stmt->close();
$con->close();
?>
