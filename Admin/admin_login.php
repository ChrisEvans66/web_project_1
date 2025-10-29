<?php // Start of PHP //
include '../Misc/db.php';   // Include connection to database//   
session_start();    // Start session management //
if ($_SERVER["REQUEST_METHOD"] == "POST") // Check if the form has been submitted //
{ 
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Prepare and execute query to retrieve admin user //
    $stmt = $con->prepare("SELECT admin_id, password FROM administrators WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) 
    {   // If admin user found, password is verified //
        $stmt->bind_result($admin_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) 
        {   // if
            $_SESSION['admin_id'] = $admin_id;
            header("Location: admin_menu.php");
            exit();
        } else 
        {   // If password is incorrect //
            echo "Invalid password.";
        }
    } else 
    {   // If admin user not found //
        echo "Admin user not found.";
    }
    $stmt->close();    
}
?>  <!-- End of PHP-->
<hmtl>  
    <head>  
    <title>Admin Login</title>
    <div class ="menu-button">
    <h1>Admin Login</h1>    
        <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- links the CSS file for styling -->
    </head> 
<body>
<form method="post" action="">  <!-- Form for admin login -->
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
              <input type="submit" value="Login"> 
</form>
</div>
</body>
</html>