<hmtl>
    <head>
    <title>Student View Course</title>
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

$sql = "SELECT c.course_code, c.course_name, r.status, r.registration_id FROM registrations r JOIN courses c ON r.course_id = c.course_id WHERE r.student_id = ? AND r.status != 'Dropped'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>My Registered Courses</h2>
<table border="1">
    <tr><th>Course Code</th><th>Course Name</th><th>Status</th><th>Action</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['course_code']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php if ($row['status'] == 'Approved' || $row['status'] == 'Pending') { ?>
                    <form method="post" action="student_drop_course.php" style="display:inline;">
                        <input type="hidden" name="registration_id" value="<?php echo $row['registration_id']; ?>">
                        <input type="submit" value="Drop">
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>