<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $credits = intval($_POST['credits']);
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $dept = intval($_POST['department_id']);

    $query = "INSERT INTO tbl_course (course_name, credits, course_description, department_id) 
              VALUES ('$name', $credits, '$desc', $dept)";
    if (mysqli_query($con, $query)) {
        header("Location: course.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch departments
$departments = mysqli_query($con, "SELECT * FROM tbl_department");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Course</title>
  <link rel="stylesheet" href="course.css" />
</head>
<body>
<div class="container">
  <h2>Add New Course</h2>
  <form method="post">
    Course Name: <input type="text" name="name" required><br>
    Credits: <input type="number" name="credits" required><br>
    Description: <textarea name="description"></textarea><br>
    Department:
    <select name="department_id" required>
      <?php while($dept = mysqli_fetch_assoc($departments)): ?>
        <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['department_name']; ?></option>
      <?php endwhile; ?>
    </select><br><br>
    <button type="submit">Add Course</button>
    <a href="course.php">Cancel</a>
  </form>
</div>
</body>
</html>
