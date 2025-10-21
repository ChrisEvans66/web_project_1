<hmtl>
    <head>
    <title>Student Course Registration</title>
    <link rel = "stylesheet" href="styles.css">
    </head>
<body>
<?php
include 'db.php';
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch available courses
$courses = $con->query("SELECT * FROM courses");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $stmt = $con->prepare("INSERT INTO registrations (student_id, course_id, status, date_registered) VALUES (?, ?, 'Pending', NOW())");
    $stmt->bind_param("ii", $student_id, $course_id);
    if ($stmt->execute()) {
        echo "Course registration submitted and pending approval.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="post" action="">
    <label for="course_id">Select Course:</label>
    <select name="course_id" id="course_id" required>
        <?php while ($row = $courses->fetch_assoc()) { ?>
            <option value="<?php echo $row['course_id']; ?>"><?php echo $row['course_code'] . " - " . $row['course_name']; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Register">
</form>
</body>
</html>