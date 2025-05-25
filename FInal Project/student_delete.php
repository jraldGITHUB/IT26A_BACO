<?php
include("db.php");
$id = $_GET['id'];

$query = "DELETE FROM tbl_student WHERE student_id=$id";
if (mysqli_query($con, $query)) {
    header("Location: students.php");
} else {
    echo "Error deleting: " . mysqli_error($con);
}
