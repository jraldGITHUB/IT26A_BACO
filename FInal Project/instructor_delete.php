<?php
include("db.php");

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($instructor_id > 0) {
    $query = "DELETE FROM tbl_instructor WHERE instructor_id = $instructor_id";
    mysqli_query($con, $query);
}

header("Location: instructor.php");
exit;
