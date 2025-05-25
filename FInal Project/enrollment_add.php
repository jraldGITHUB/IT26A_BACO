<?php
include("db.php");

$selected_course_id = '';
$entered_grade = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = intval($_POST['student_id']);
    $selected_course_id = intval($_POST['course_id']);
    $entered_grade = mysqli_real_escape_string($con, $_POST['grade']);

    $check = mysqli_query($con, "SELECT * FROM tbl_enrollment WHERE student_id = $student_id");
    if (mysqli_num_rows($check) > 0) {
        $error = "This student is already enrolled in a course.";
    } else {
        $query = "INSERT INTO tbl_enrollment (student_id, course_id, grade) 
                  VALUES ($student_id, $selected_course_id, '$entered_grade')";
        if (mysqli_query($con, $query)) {
            header("Location: enrollment.php");
            exit;
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}

// Fetch students not already enrolled
$students = mysqli_query($con, "
    SELECT * FROM tbl_student 
    WHERE student_id NOT IN (SELECT student_id FROM tbl_enrollment)
");

$courses = mysqli_query($con, "SELECT * FROM tbl_course");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enroll Student</title>
  <link rel="stylesheet" href="enrollment.css" />
</head>
<body>
<div class="container">
  <h2>Enroll Student in a Course</h2>

  <?php if (!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="post">
    Student:
    <select name="student_id" required <?php if (mysqli_num_rows($students) == 0) echo 'disabled'; ?>>
      <?php if (mysqli_num_rows($students) > 0): ?>
        <?php while($student = mysqli_fetch_assoc($students)): ?>
          <option value="<?php echo $student['student_id']; ?>">
            <?php echo $student['student_first_name'] . ' ' . $student['student_last_name']; ?>
          </option>
        <?php endwhile; ?>
      <?php else: ?>
        <option disabled selected>No students available</option>
      <?php endif; ?>
    </select><br>

    Course:
    <select name="course_id" required>
      <?php while($course = mysqli_fetch_assoc($courses)): ?>
        <option value="<?php echo $course['course_id']; ?>"
          <?php if ($course['course_id'] == $selected_course_id) echo 'selected'; ?>>
          <?php echo $course['course_name']; ?>
        </option>
      <?php endwhile; ?>
    </select><br>

    Grade: 
    <input type="text" name="grade" maxlength="2" required 
           value="<?php echo htmlspecialchars($entered_grade); ?>"><br><br>

    <button type="submit" <?php if (mysqli_num_rows($students) == 0) echo 'disabled'; ?>>Enroll</button>
    <a href="enrollment.php">Cancel</a>
  </form>
</div>
</body>
</html>
