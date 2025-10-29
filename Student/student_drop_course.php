<?php
session_start();
include '../Misc/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Handle course drop
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registration_id'])) {
    $registration_id = $_POST['registration_id'];
    $stmt = $con->prepare("UPDATE registration SET status = 'Dropped' WHERE registration_id = ? AND student_id = ?");
    $stmt->bind_param("ii", $registration_id, $student_id);
    if ($stmt->execute()) {
        $message = " Course dropped successfully.";
    } else {
        $message = " Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch approved courses
$sql = "SELECT r.registration_id, c.course_code, c.course_name
        FROM registration r
        JOIN courses c ON r.course_id = c.course_id
        WHERE r.student_id = ? AND r.status = 'Accepted'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Drop a Course</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    
</head>
<body>
    <div class="table">
        <h2>Drop a Course</h2>
        <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>
        <?php if ($result->num_rows > 0): ?>
            <form method="post" action="">
                <table>
                    <tr><th>Course Code</th><th>Course Name</th><th>Action</th></tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                            <td>
                                <button type="submit" name="registration_id" value="<?php echo $row['registration_id']; ?>">Drop</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </form>
        <?php else: ?>
            <p>No approved courses to drop.</p>
        <?php endif; ?>
        <?php $stmt->close(); ?>
    </div>

    <div class="menu-button">
        <a href="student_menu.php" class="menu-button" style="background-color: green;">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body>
</html>


