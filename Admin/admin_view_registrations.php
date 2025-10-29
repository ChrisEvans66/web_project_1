<?php
session_start();    // Start session management //
include '../Misc/db.php';   // includes connection to database //

// If admin is not logged in, redirect to login page //
if (!isset($_SESSION['admin_id'])) 
{
    header("Location: admin_login.php");
    exit();
}

// retrieves all registration details from the database //
$sql = "SELECT r.registration_id, s.full_name, c.course_code, c.course_name, r.status FROM registration r JOIN students s ON r.student_id = s.student_id JOIN courses c ON r.course_id = c.course_id";
$result = $con->query($sql);
if (!$result) 
{
    die("Query failed: " . $con->error);
}

?>
<!DOCTYPE html>
<html>
    <head>
    <title>View Registration</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">  <!-- links the CSS file for styling -->

</head>
<body>
<h1>Admin View Registrations</h1>
<table class = "table">     <!-- Table to display registration records -->
    <tr><th>Student</th><th>Course Code</th><th>Course Name</th><th>Status</th><th>Action</th></tr>
    <?php while ($row = $result->fetch_assoc()) 
{ ?>
        <tr>    <!-- Displays each registration record -->
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['course_code']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php if ($row['status'] == 'Pending')
            { ?>   <!-- Form to approve or remove pending registration -->
                    <form method="post" action="admin_approve_registration.php" style="display:inline;">
                        <input type="hidden" name="registration_id" value="<?php echo $row['registration_id']; ?>">
                        <input type="submit" name="approve" value="Approve">
                        <input type="submit" name="remove" value="Remove">
                    </form>   
                <?php 
            } elseif ($row['status'] == 'Approved') 
            { ?>    <!-- Form to remove approved registration -->
                    <form method="post" action="admin_approve_registration.php" style="display:inline;">
                        <input type="hidden" name="registration_id" value="<?php echo $row['registration_id']; ?>">
                        <input type="submit" name="remove" value="Remove">
                    </form>
                <?php  
            } ?>
            </td>
        </tr>
    <?php   // End of while loop //
} ?>

</table>


<div class="menu-button">       <!-- Navigation buttons with a class to stle the buttons-->    
        <a href="admin_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
         <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>


</body>     
</html>
