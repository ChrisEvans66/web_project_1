<?php
include '../Misc/db.php';   // connect to the database//
session_start();    // start the session//
    // Handles the login form submission//
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Prepare and execute the SQL statement//
    $stmt = $con->prepare("SELECT student_id, password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) 
    {   // User is found//
        $stmt->bind_result($student_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) 
        {// Password is correct//
            $_SESSION['student_id'] = $student_id;
            header("Location: student_menu.php");
            exit();
        } else 
        {   // Password is incorrect//
            echo "Invalid password.";
        }
    } else 
    {   // User is not found//
        echo "User not found.";
    }
    $stmt->close();
}
?>
<hmtl>
    <head>
    <title>Student Login</title>
   <link rel="stylesheet" href="../Misc/style.css?v=1.0">   <!-- Links to CSS file -->
    </head>
<body>
<div class ="menu-button">  <!-- Container for the login form -->
<h2>Student Login</h2>
<form method="post" action="">  <!-- Login form -->
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
        <!-- Link to registration page -->
    <p>New Student? <a href="student_register.php">Register here</a></p>     
</form>
</div>
</body>
</html>