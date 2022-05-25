<?php

include 'db_connect/config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   
   $querySelectAcc = <<< heredoc
      SELECT * FROM users WHERE email = '$email' AND password = '$pass'
   heredoc;

   $select_users = mysqli_query($conn, $querySelectAcc) or die('query failed');
   $rowAcc = mysqli_fetch_assoc($select_users);

   $idAcc = $rowAcc['id'];

   echo $idAcc;

   $querySelectInfoAcc = <<< heredoc
      SELECT customerName AS name FROM customerInfo AS ci
      INNER JOIN users AS c ON (ci.customerId = $idAcc)
   heredoc;
   $select_usersInfo = mysqli_query($conn, $querySelectInfoAcc);
   $rowAccInfo = mysqli_fetch_assoc($select_usersInfo);


   if(mysqli_num_rows($select_users) > 0){
      if($rowAcc['userLevel'] == 'admin'){
         $_SESSION['admin_name'] = $rowAccInfo['name'];
         $_SESSION['admin_email'] = $rowAcc['email'];
         $_SESSION['admin_id'] = $rowAcc['id'];
         header('location:admin_page.php');

      }elseif($rowAcc['userLevel'] == 'user'){
         $_SESSION['user_name'] = $rowAccInfo['name'];
         $_SESSION['user_email'] = $rowAcc['email'];
         $_SESSION['user_id'] = $rowAcc['id'];
         header('location:home.php');
      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            <h3>Login Now</h3>
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>

    </div>

</body>

</html>