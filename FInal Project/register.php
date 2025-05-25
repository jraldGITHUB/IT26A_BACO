<?php
include("connection.php");

$msg='';
if(isset($_POST['submit'])){
    $name =$_POST['name'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $cpassword =$_POST['cpassword'];

    $select1= "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    
    $select_user = mysqli_query($conn,$select1);
    if(mysqli_num_rows($select_user)>0){

        $msg="user already exit!";

    }
    else{
        $insert1="INSERT INTO `users`(`name`,`email`,`password`) VALUES('$name','$email','$password')";
        mysqli_query($conn,$insert1);
        header('location:login.php');

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
        <form action=""method="post">
            <h2>Registration</h2>
            <p class="msg"><?=$msg?> </p>
            <div class="form-group" >
                <input type="text" name="name" placeholder="Enter your name" class="form-control" required>
             </div>
             <div class="form-group" >
                <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
             </div>
           
                
                <div class="form-group" >
                <input type="password" name="password" placeholder="Enter your password" class="form-control" required>
             </div>
               <div class="form-group" >
                <input type="password" name="cpassword" placeholder="Confirm your password" class="form-control" required>
             </div>
             <button class= "btn font-weight-bold" name="submit">Register Now</button>
             <p>Already have an Account? <a href="login.php">Login Now</a></p>





        </form>
</body>
</html>