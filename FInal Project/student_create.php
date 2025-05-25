<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);

    $insert = "INSERT INTO tbl_student (student_first_name, student_last_name, student_email, student_DOB)
               VALUES ('$fname', '$lname', '$email', '$dob')";

    if (mysqli_query($con, $insert)) {
        header("Location: students.php");
        exit;
    } else {
        echo "Insert failed: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Student</title></head>
 <link rel="stylesheet" href="student.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<body>
<h2>Add New Student</h2>
<form method="post">
    First Name: <input type="text" name="first_name" required><br>
    Last Name: <input type="text" name="last_name" required><br>
    Email: <input type="email" name="email" required><br>
    Date of Birth: <input type="date" name="dob" required><br><br>
    <button type="submit">Add Student</button>
    <a href="students.php">Cancel</a>
</form>
</body>
</html>
