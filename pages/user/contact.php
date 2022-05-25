<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('Location: ../../login.php');
}

if(isset($_POST['send'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $rate = $_POST['rate'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $querySelectMessage = <<< heredoc
        SELECT * FROM `messages` WHERE messageEmail = '$email' 
        AND messagePhone = '$number' AND messageContent = '$msg'
    heredoc;

    $select_message = mysqli_query($conn, $querySelectMessage) or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'Message sent already!';
    }else{
        $queryInsertMessage = <<< heredoc
            INSERT INTO messages (customerId, messageEmail, messagePhone, messageContent, rate) 
            VALUES($user_id, '$email', '$number', '$msg', $rate)
        heredoc;

        mysqli_query($conn, $queryInsertMessage) or die('query failed');
        $message[] = 'Message sent successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Rate Us</h3>
        <p> <a href="../../home.php">Home</a> / Rating </p>
    </div>

    <section class="contact">

        <form action="" method="post">
            <h3>Say Something!</h3>
            <input type="email" name="email" required placeholder="Enter your email" class="box">
            <input type="text" name="number" required placeholder="Enter your number" class="box">
            <input type="number" name="rate" min="1" max="5" required placeholder="Rate us [1-5]" class="box">
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="../../src/js/script.js"></script>

</body>

</html>