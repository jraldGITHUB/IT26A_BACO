<?php
include("db.php");
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM tbl_enrollment WHERE enrollment_id = $id");
header("Location: enrollment.php");
exit;
