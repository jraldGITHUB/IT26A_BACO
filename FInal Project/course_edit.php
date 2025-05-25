<?php
include("db.php");

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($course_id <= 0) {
    echo "Invalid course ID.";
    exit;
}

// Fetch course
$result = mysqli_query($con, "SELECT * FROM tbl_course WHERE course_id = $course_id");
if (!$result || mysqli_num_rows($result) != 1) {
    echo "Course not found.";
    exit;
}
$course = mysqli_fetch_assoc($result);

// Fetch departments
$departments = mysqli_query($con, "SELECT * FROM tbl_department");

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['course_name']);
    $credits = intval($_POST['credits']);
    $description = mysqli_real_escape_string($con, $_POST['course_description']);
    $department_id = intval($_POST['department_id']);

    $update = "UPDATE tbl_course SET 
                course_name = '$name',
                credits = $credits,
                course_description = '$description',
                department_id = $department_id
               WHERE course_id = $course_id";

    if (mysqli_query($con, $update)) {
        header("Location: course.php");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link rel="stylesheet" href="course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Edit Course</h2>
    <form method="post">
        <label>Course Name:</label>
        <input type="text" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>

        <label>Credits:</label>
        <input type="number" name="credits" value="<?php echo $course['credits']; ?>" min="1" required>

        <label>Description:</label>
        <textarea name="course_description"><?php echo htmlspecialchars($course['course_description']); ?></textarea>

        <label>Department:</label>
        <select name="department_id" required>
            <option value="">-- Select Department --</option>
            <?php while ($dept = mysqli_fetch_assoc($departments)) : ?>
                <option value="<?php echo $dept['department_id']; ?>"
                    <?php echo $dept['department_id'] == $course['department_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($dept['department_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Update</button>
        <a href="course.php">Cancel</a>
    </form>
</div>

</body>
</html>
