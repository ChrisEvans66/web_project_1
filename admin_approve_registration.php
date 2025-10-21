<hmtl>
    <head>
    <title>Approve Registration</title>
    <link rel = "stylesheet" href="style.css">
    </head>
<body>
<?php
include 'db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration_id = $_POST['registration_id'];
    if (isset($_POST['approve'])) {
        $stmt = $con->prepare("UPDATE registrations SET status = 'Approved' WHERE registration_id = ?");
        $stmt->bind_param("i", $registration_id);
        $stmt->execute();
        $stmt->close();
        echo "Registration approved.";
    } elseif (isset($_POST['remove'])) {
        $stmt = $con->prepare("DELETE FROM registrations WHERE registration_id = ?");
        $stmt->bind_param("i", $registration_id);
        $stmt->execute();
        $stmt->close();
        echo "Registration removed.";
    }
}
?>
</body>
</html>
