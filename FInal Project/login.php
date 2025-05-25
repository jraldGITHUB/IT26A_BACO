<?php
include("connection.php");
$msg='';

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_time = date('Y-m-d H:i:s');  // current datetime

    $select1 = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $select_user = mysqli_query($conn, $select1);

    if(mysqli_num_rows($select_user) > 0){
        // Update logs for successful login
        $update_log = "UPDATE users SET logs = '$date_time' WHERE email = '$email'";
        mysqli_query($conn, $update_log);

        header('location:dad.php');
        exit();
    } else {
        // Update logs even on failed attempt (if user exists)
        $check_user = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_user);
        if(mysqli_num_rows($result) > 0){
            $update_log = "UPDATE users SET logs = '$date_time' WHERE email = '$email'";
            mysqli_query($conn, $update_log);
        }

        $msg = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="form">
        <form action="" method="post">
            <h2>Log In</h2>
            <p class="msg"><?php echo $msg; ?></p>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
            </div>
             
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter your password" class="form-control" required>
            </div>
               
            <button class="btn font-weight-bold" name="submit">Login Now</button>
            <p>Don't have an Account? <a href="register.php">Register Now</a></p>
        </form>
    </div>
</body>
</html>
