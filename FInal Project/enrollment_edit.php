<?php
include("db.php");

if (!isset($_GET['id'])) {
    die("No enrollment ID provided.");
}

$enrollment_id = intval($_GET['id']);

// Fetch existing enrollment
$enrollment_result = mysqli_query($con, "
    SELECT e.*, s.student_first_name, s.student_last_name 
    FROM tbl_enrollment e
    JOIN tbl_student s ON e.student_id = s.student_id
    WHERE e.enrollment_id = $enrollment_id
");

if (mysqli_num_rows($enrollment_result) == 0) {
    die("Enrollment not found.");
}

$enrollment = mysqli_fetch_assoc($enrollment_result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = intval($_POST['course_id']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);

    $update = "UPDATE tbl_enrollment 
               SET course_id = $course_id, grade = '$grade' 
               WHERE enrollment_id = $enrollment_id";

    if (mysqli_query($con, $update)) {
        header("Location: enrollment.php");
        exit;
    } else {
        $error = "Update failed: " . mysqli_error($con);
    }
}

// Get all courses
$courses = mysqli_query($con, "SELECT * FROM tbl_course");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Enrollment</title>
  <link rel="stylesheet" href="enrollment.css" />
</head>
<body>
<div class="container">
  <h2>Edit Enrollment</h2>

  <?php if (!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="post">
    Student:
    <input type="text" value="<?php echo $enrollment['student_first_name'] . ' ' . $enrollment['student_last_name']; ?>" disabled><br>

    Course:
    <select name="course_id" required>
      <?php while ($course = mysqli_fetch_assoc($courses)): ?>
        <option value="<?php echo $course['course_id']; ?>"
          <?php if ($course['course_id'] == $enrollment['course_id']) echo 'selected'; ?>>
          <?php echo $course['course_name']; ?>
        </option>
      <?php endwhile; ?>
    </select><br>

    Grade:
    <input type="text" name="grade" maxlength="2" required value="<?php echo htmlspecialchars($enrollment['grade']); ?>"><br><br>

    <button type="submit">Update Enrollment</button>
    <a href="enrollment.php">Cancel</a>
  </form>
</div>
</body>
</html>
