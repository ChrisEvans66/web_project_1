<?php
session_start();    // Start the session//
include '../Misc/db.php';   // Database connection//
    // Checks if the student is logged in//
if (!isset($_SESSION['student_id'])) 
{
    header("Location: student_login.php");
    exit();
}
$student_id = $_SESSION['student_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") // Handles profile update//
{
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    // Prepare and execute the update statement//
    $update_stmt = $con->prepare("UPDATE students SET username = ?, full_name = ?, email = ?, program = ? WHERE student_id = ?");
    $update_stmt->bind_param("ssssi", $username, $full_name, $email, $program, $student_id);
    if ($update_stmt->execute()) 
    {   // Update successful//
        $message = " Profile updated successfully.";
    } else 
    {   // Update failed//
        $message = " Error updating profile: " . $update_stmt->error;
    }
    $update_stmt->close();
}
// Fetches the current profile data//
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
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- Links to CSS file -->
</head>
<body>
    <div class="menu-button">
        <h2>My Profile</h2>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>   <!-- Displays success or error message -->
        <form method="post" action="">
            <label>Username:</label>    <!-- Username field -->
            <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required> <br>
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
            <label>Program:</label>
            <input type="text" name="program" value="<?php echo htmlspecialchars($row['program']); ?>" required><br>
            <input type="submit" value="Update Profile">    <!-- Submit button -->
        </form>
        <br>    <!-- Links to menu page and logout -->
        <a href="student_menu.php" class="menu-button" style="background-color: green;">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body>
</html>
