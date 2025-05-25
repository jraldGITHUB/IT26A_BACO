<?php
include("db.php");

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($instructor_id <= 0) {
    echo "Invalid instructor ID.";
    exit;
}

$result = mysqli_query($con, "SELECT * FROM tbl_instructor WHERE instructor_id = $instructor_id");
if (!$result || mysqli_num_rows($result) != 1) {
    echo "Instructor not found.";
    exit;
}
$instructor = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($con, $_POST['instructor_fullname']);
    $email = mysqli_real_escape_string($con, $_POST['instructor_email']);
    $dob = mysqli_real_escape_string($con, $_POST['instructor_DOB']);

    $update = "UPDATE tbl_instructor SET 
                instructor_fullname = '$fullname', 
                instructor_email = '$email', 
                instructor_DOB = '$dob' 
               WHERE instructor_id = $instructor_id";

    if (mysqli_query($con, $update)) {
        header("Location: instructor.php");
        exit;
    } else {
        echo "Update failed: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Instructor</title>
    <link rel="stylesheet" href="student.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
<h2>Edit Instructor</h2>
<form method="post">
    Full Name: <input type="text" name="instructor_fullname" value="<?php echo $instructor['instructor_fullname']; ?>" required><br>
    Email: <input type="email" name="instructor_email" value="<?php echo $instructor['instructor_email']; ?>" required><br>
    Date of Birth: <input type="date" name="instructor_DOB" value="<?php echo $instructor['instructor_DOB']; ?>" required><br><br>
    <button type="submit">Update</button>
    <a href="instructor.php">Cancel</a>
</form>
</body>
</html>
