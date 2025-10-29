<?php
include '../Misc/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $program = $_POST['program'];

    $stmt = $con->prepare("INSERT INTO students (username, password, full_name, email, program) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $full_name, $email, $program);
    if ($stmt->execute()) {
        echo "Registration successful. <a href='student_login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<hmtl>
    <head>
    <title>Student Regitration</title>
   <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    </head>
<body>
    <h1>Student Registration</h1>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Full Name: <input type="text" name="full_name" required><br>
    Email: <input type="email" name="email" required><br>
    Program: <input type="text" name="program" required><br>
    <input type="submit" value="Register">
</form>
        <div class="menu-container">    
        <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>  
</body>
</html>