<?php
include '../Misc/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_course'])) {
        $course_id = $_POST['course_id'];
        $course_code = $_POST['course_code'];
        $course_name = $_POST['course_name'];
        $description = $_POST['description'];
        $credits = $_POST['credits'];
        $lecturer = $_POST['lecturer'];

        $stmt = $con->prepare("UPDATE courses SET course_code = ?, course_name = ?, description = ?, credits = ?, lecturer = ? WHERE course_id = ?");
        $stmt->bind_param("sssisi", $course_code, $course_name, $description, $credits, $lecturer, $course_id);
        $stmt->execute();
        $stmt->close();
        $message = "Course updated.";
    }

    if (isset($_POST['add_course'])) {
        $course_code = $_POST['course_code'];
        $course_name = $_POST['course_name'];
        $description = $_POST['description'];
        $credits = $_POST['credits'];
        $lecturer = $_POST['lecturer'];

        $stmt = $con->prepare("INSERT INTO courses (course_code, course_name, description, credits, lecturer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $course_code, $course_name, $description, $credits, $lecturer);
        $stmt->execute();
        $stmt->close();
        $message = "New course added.";
    }
}
?>
<!DOCTYPE html>
<hmtl>
<head>
    <title>Add Course Menu</title>
    <link rel="stylesheet" href="../Misc/style.css?v=1.0">
    </head>
<body>

<div class="form-box">
        <h2>Add New Course</h2>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
        <form method="post" action="">
            <input type="text" name="course_code" placeholder="Course Code" required>
            <input type="text" name="course_name" placeholder="Course Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="credits" placeholder="Credits" required>
            <input type="text" name="lecturer" placeholder="Lecturer" required>
            <input type="submit" name="add_course" value="Add Course">
        </form>
    </div>

    <h2 style="text-align:center;">Edit Existing Courses</h2>
    <table>
        <tr><th>Code</th><th>Name</th><th>Description</th><th>Credits</th><th>Lecturer</th><th>Action</th></tr>
        <?php
        $result = $con->query("SELECT * FROM courses");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <form method='post' action=''>
                    <td><input type='text' name='course_code' value='" . htmlspecialchars($row['course_code']) . "'></td>
                    <td><input type='text' name='course_name' value='" . htmlspecialchars($row['course_name']) . "'></td>
                    <td><textarea name='description'>" . htmlspecialchars($row['description']) . "</textarea></td>
                    <td><input type='number' name='credits' value='" . htmlspecialchars($row['credits']) . "'></td>
                    <td><input type='text' name='lecturer' value='" . htmlspecialchars($row['lecturer']) . "'></td>
                    <td>
                        <input type='hidden' name='course_id' value='" . $row['course_id'] . "'>
                        <input type='submit' name='update_course' value='Update'>
                    </td>
                </form>
            </tr>";
        }
        ?>
    </table>

    <div class="menu-container">
        <a href="admin_menu.php" class="menu-button" style="background-color: green;">Back to Menu</a>
        <a href="../Misc/logout.php" class="menu-button" style="background-color: red;">Logout</a>
    </div>
</body>
</html>