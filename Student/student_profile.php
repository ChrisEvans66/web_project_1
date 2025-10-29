<?php
session_start();
include '../Misc/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $program = $_POST['program'];

    $update_stmt = $con->prepare("UPDATE students SET username = ?, full_name = ?, email = ?, program = ? WHERE student_id = ?");
    $update_stmt->bind_param("ssssi", $username, $full_name, $email, $program, $student_id);

    if ($update_stmt->execute()) {
        $message = " Profile updated successfully.";
    } else {
        $message = " Error updating profile: " . $update_stmt->error;
    }

    $update_stmt->close();
}

// Fetch updated profile
$stmt = $con->prepare("SELECT username, full_name, email, program FROM students WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    
</head>
<body>
    <div class="menu-button">
        <h2>My Profile</h2>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
        <form method="post" action="">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required> <br>
    
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>

            <label>Program:</label>
            <input type="text" name="program" value="<?php echo htmlspecialchars($row['program']); ?>" required><br>

            <input type="submit" value="Update Profile">
        </form>
        <br>
        <a href="student_menu.php" class="menu-button" style="background-color: green;">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body>
</html>
