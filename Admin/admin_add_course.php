<hmtl>
    <head>
    <title>Add Course Menu</title>
    <link rel = "stylesheet" href="../Misc/style.css">
    </head>
<body>
<?php
include '../Misc/db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $credits = $_POST['credits'];
    $lecturer = $_POST['lecturer'];

    $stmt = $con->prepare("INSERT INTO courses (course_code, course_name, description, credits, lecturer) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $course_code, $course_name, $description, $credits, $lecturer);
    if ($stmt->execute()) {
        echo "Course added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<form method="post" action="">
    Course Code: <input type="text" name="course_code" required><br>
    Course Name: <input type="text" name="course_name" required><br>
    Description: <textarea name="description" required></textarea><br>
    Credits: <input type="number" name="credits" step="0.5" required><br>
    Lecturer: <input type="text" name="lecturer" required><br>
    <input type="submit" value="Add Course">
</form>
</body>
</html>