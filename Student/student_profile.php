<?php
include '../Misc/db.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}
$student_id = $_SESSION['student_id']; 

$sql = "SELECT s.username, s.full_name, s.email, s.program
        FROM students s
        WHERE student_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<h1>My Profile</h1>';