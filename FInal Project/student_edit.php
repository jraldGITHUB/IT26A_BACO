<?php
include("db.php");

$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($student_id <= 0) {
    echo "Invalid student ID.";
    exit;
}

// Fetch student
$result = mysqli_query($con, "SELECT * FROM tbl_student WHERE student_id = $student_id");
if (!$result || mysqli_num_rows($result) != 1) {
    echo "Student not found.";
    exit;
}
$student = mysqli_fetch_assoc($result);

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    $update = "UPDATE tbl_student SET 
                student_first_name = '$fname', 
                student_last_name = '$lname', 
                student_email = '$email', 
                student_DOB = '$dob' 
               WHERE student_id = $student_id";

    if (mysqli_query($con, $update)) {
        header("Location: students.php");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
 <link rel="stylesheet" href="student.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<body>
<h2>Edit Student</h2>
<form method="post">
    First Name: <input type="text" name="first_name" value="<?php echo $student['student_first_name']; ?>" required><br>
    Last Name: <input type="text" name="last_name" value="<?php echo $student['student_last_name']; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $student['student_email']; ?>" required><br>
    Date of Birth: <input type="date" name="dob" value="<?php echo $student['student_DOB']; ?>" required><br><br>
    <button type="submit">Update</button>
    <a href="students.php">Cancel</a>
</form>
</body>
</html>
