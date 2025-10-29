<?php   // Start of PHP //
include '../Misc/db.php';   // includes connection to database //
session_start();    // Start session management //
if (!isset($_SESSION['admin_id'])) // If admin is not logged in, redirect to login page //
{
    header("Location: admin_login.php");
    exit();
}
// retrieves all students from the database //
$sql = "SELECT student_id, username, full_name, email, program FROM students ORDER BY student_id";
$result = $con->query($sql);
if ($result === false)
{
    die("Database error: " . $con->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Students</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- links the CSS file for styling -->
    <style>              /* Additional inline styles for table */
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
<?php if ($result->num_rows > 0): ?>    <!-- Check if there are any students -->
        <table class="table">   <!-- Table to display student records -->
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
                <?php while ($row = $result->fetch_assoc()): ?> <!-- Loop through each student record -->
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['program']); ?></td>
                    </tr>
                <?php endwhile; ?>  <!-- End of loop -->
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-records">No students found.</p>
    <?php endif; ?>
    <div class="menu-button">    <!-- Navigation buttons with a class to stle the buttons-->
            <a href="admin_menu.php" class="menu-button" style="background-color: #0c7624ff;">Back to Menu</a>
            <a href="../Misc/logout.php" class="menu-button" style="background-color: #d9534f;">Logout</a>
    </div>
<?php
$result->free();        // Free result set //
$con->close();  // Close the database connection //
?>
</body>
</html>
