<?php
include("db.php");
$id = $_GET['id'];

$query = "DELETE FROM tbl_course WHERE course_id=$id";
if (mysqli_query($con, $query)) {
    header("Location: course.php");
} else {
    echo "Error deleting: " . mysqli_error($con);
}