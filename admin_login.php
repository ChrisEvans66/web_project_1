<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT admin_id, password FROM administrators WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin_id'] = $admin_id;
            header("Location: admin_menu.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Admin user not found.";
    }
    $stmt->close();
}
?>
<hmtl>
    <head>
    <title>Admin Login</title>
    <link rel = "stylesheet" href="style.css">
    </head>
<body>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
</body>
</html>