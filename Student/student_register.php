<?php
include '../Misc/db.php';   // connects to the database//  
    // Handles the registration form submission//
if ($_SERVER["REQUEST_METHOD"] == "POST")
{   // Retrieves fron the form data//
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    // Prepare and execute the insert statement//
    $stmt = $con->prepare("INSERT INTO students (username, password, full_name, email, program) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $full_name, $email, $program);
    if ($stmt->execute()) 
    {   // Registration successful//
        echo "Registration successful. <a href='student_login.php'>Login here</a>";
    } else 
    {   // Registration failed//
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<hmtl>
    <head>
    <title>Student Regitration</title>
   <link rel="stylesheet" href="../Misc/style.css?v=1.0">   <!-- Links to CSS file -->
    </head>
<body>
    <h1>Student Registration</h1>
<form method="post" action="">  <!-- Registration form -->
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Full Name: <input type="text" name="full_name" required><br>
    Email: <input type="email" name="email" required><br>
    Program: <input type="text" name="program" required><br>
    <input type="submit" value="Register">
</form>
        <div class="menu-container">     <!-- Navigation button to menu page with a CSS class-->
        <a href="student_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>   
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>  
</body>
</html>