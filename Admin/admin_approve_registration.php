<?php //start of PHP//
include '../Misc/db.php';     //includes connection to database//
if ($_SERVER["REQUEST_METHOD"] == "POST") // check if the form has been submitted //
{
    $registration_id = $_POST['registration_id'];   // retrieves registration ID from form //
    if (isset($_POST['approve']))   // checks if approving registration //
    {   //  prepares and executes update query //
      $stmt = $con->prepare("UPDATE registration SET status = ? WHERE registration_id = ?");
       $status = 'Accepted'; 
        $stmt->bind_param("si", $status, $registration_id);
        $stmt->execute();
        $stmt->close();
        echo "Registration approved.";
    } elseif (isset($_POST['remove'])) 
    {   // checks if removing registration //
        $stmt = $con->prepare("DELETE FROM registration WHERE registration_id = ?");
        $stmt->bind_param("i", $registration_id);
        $stmt->execute();
        $stmt->close();
        echo "Registration removed.";
    }
}
?>  <!-- End of PHP-->
<html>
<head>
    <title>Approve Registrations</title>    <!-- Title of the page -->
    <link rel="stylesheet" href="../Misc/style.css?v=1.0"> <!-- links the CSS file for styling -->
</head>
<body>
    <div class="menu-container">    
            <h1>Approve Registrations</h1>
    <h2>Pending Registrations</h2>
    </div>
    <?php   //  Start of PHP code //
    // Retrieves pending registrations from database //
    $result = $con->query("SELECT r.registration_id, s.student_id, c.course_id
                           FROM registration r
                           JOIN students s ON r.student_id = s.student_id
                           JOIN courses c ON r.course_id = c.course_id
                           WHERE r.status = 'Pending'");
    if ($result->num_rows > 0)
    {   // Displays each pending registration with approve and remove buttons //
        while ($row = $result->fetch_assoc()) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='registration_id' value='" . $row['registration_id'] . "'>
                    Student: " . $row['student_id'] . " | Course: " . $row['course_id'] . "
                    <input type='submit' name='approve' value='Approve' >
                    <input type='submit' name='remove' value='Remove' >
                  </form><br>";
        }
    } else 
    {   // If no pending registrations //
        echo "No pending registrations.";
    }
    ?>  
    <div class="menu-button">       <!-- Navigation buttons with a class to stle the buttons-->     
        <a href="admin_menu.php" class="menu-button" style="background-color: green; ">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>

</body>
</html>
