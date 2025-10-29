<?php
include '../Misc/db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT student_id, password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($student_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['student_id'] = $student_id;
            header("Location: student_menu.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();
}
?>
<hmtl>
    <head>
    <title>Student Login</title>
   <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    </head>
<body>
<div class ="menu-button">
<h2>Student Login</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
    <p>New Student? <a href="student_register.php">Register here</a></p>     
</form>
</div>
</body>
</html>