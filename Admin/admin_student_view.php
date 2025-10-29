<?php
include '../Misc/db.php';
session_start();

// Optional: require admin login (adjust session key as used in your project)
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all students
$sql = "SELECT student_id, username, full_name, email, program FROM students ORDER BY student_id";
$result = $con->query($sql);
if ($result === false) {
    die("Database error: " . $con->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Students</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    <style>
        /* small table tweaks */
        .student-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .student-table th, .student-table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .student-table th { background: #2e7d32; color: #fff; }
        .no-records { margin-top: 20px; color: #b71c1c; }
    </style>
</head>
<body>
    <div class="menu-container">
            <h1>Students</h1>
    </div>
<?php if ($result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Program</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['program']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-records">No students found.</p>
    <?php endif; ?>

    <div class="menu-button">
            <a href="admin_menu.php" class="menu-button" style="background-color: #0c7624ff;">Back to Menu</a>
            <a href="../Misc/logout.php" class="menu-button" style="background-color: #d9534f;">Logout</a>
    </div>
</body>
</html>
<?php
$result->free();
$con->close();
?>