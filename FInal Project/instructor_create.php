<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($con, $_POST['instructor_fullname']);
    $email = mysqli_real_escape_string($con, $_POST['instructor_email']);
    $dob = $_POST['instructor_DOB'];

    $query = "INSERT INTO tbl_instructor (instructor_fullname, instructor_email, instructor_DOB) 
              VALUES ('$fullname', '$email', '$dob')";
    mysqli_query($con, $query);

    header("Location: instructor.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Instructor</title>
    <link rel="stylesheet" href="student.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
<h2>Add Instructor</h2>
<form method="post">
    Full Name: <input type="text" name="instructor_fullname" required><br>
    Email: <input type="email" name="instructor_email" required><br>
    Date of Birth: <input type="date" name="instructor_DOB" required><br><br>
    <button type="submit">Add</button>
    <a href="instructor.php">Cancel</a>
</form>
</body>
</html>
