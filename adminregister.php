<?php

include 'db_connect/config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = "admin";

   $queryInsert = <<< heredoc
      INSERT INTO users (email, password, userLevel)
      VALUES ('$email', '$cpass', '$user_type')
   heredoc;

   $querySelect = <<< heredoc
      SELECT * FROM users WHERE email = '$email' AND password = '$pass'
   heredoc;

   $queryInsertId = <<< heredoc
      SELECT id FROM users WHERE email = '$email' AND password = '$pass'
   heredoc;

   $select_users = mysqli_query($conn, $querySelect) or die('query failed');



   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         mysqli_query($conn, $queryInsert) or die('query failed');
         $message[] = 'Registered successfully!';
         $insertRelationId = mysqli_query($conn, $queryInsertId) or die ('Query Failed');
         $row = mysqli_fetch_assoc($insertRelationId);
         $id = $row['id'];
         mysqli_query($conn, "INSERT INTO customerInfo (customerId, customerName) VALUES ('$id','$name')") or die ('Query Failed');
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="src/css/style.css">

</head>

<body>



    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

    <div class="form-container">

        <form action="" method="post">
            <h3>Register Now</h3>
            <input type="text" name="name" placeholder="enter your name" required class="box">
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
            <select name="user_type" class="box">
                <!-- <option value="user">User</option> -->
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="btn">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>

    </div>

</body>

</html>