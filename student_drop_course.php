<?php
include 'db.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_id = $_POST['registration_id'];
    $stmt = $con->prepare("UPDATE registrations SET status = 'Dropped' WHERE registration_id = ? AND student_id = ?");
    $stmt->bind_param("ii", $registration_id, $_SESSION['student_id']);
    if ($stmt->execute()) {
        echo "Course dropped successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
