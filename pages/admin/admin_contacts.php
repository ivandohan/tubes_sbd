<?php

include __DIR__ . '/../../db_connect/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

$querySelectMessage = <<< heredoc
    SELECT ci.customerName AS name,
        m.customerId AS id,
        m.messageContent AS content,
        m.messageEmail AS email,
        m.messagePhone AS phone,
        m.rate AS rate
    FROM messages AS m
    INNER JOIN customerInfo ci on (m.customerId = ci.customerId)
heredoc;

if(!isset($admin_id)){
   header('location:../../login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `messages` WHERE customerId = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="../../src/css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="messages">

        <h1 class="title"> Messages </h1>

        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn,$querySelectMessage) or die('query failed');
            if(mysqli_num_rows($select_message) > 0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
            <div class="box">
                <p> User id : <span><?php echo $fetch_message['id']; ?></span> </p>
                <p> Name : <span><?php echo $fetch_message['name']; ?></span> </p>
                <p> Number : <span><?php echo $fetch_message['phone']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
                <p> Message : <span><?php echo $fetch_message['content']; ?></span> </p>
                <p> Rating : <span><?= $fetch_message['rate'] ?>/5</span> </p>
                <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>"
                    onclick="return confirm('delete this message?');" class="delete-btn">Delete Message</a>
            </div>
            <?php
      };
   }else{
      echo '<p class="empty">You ave no messages!</p>';
   }
   ?>
        </div>

    </section>









    <!-- custom admin js file link  -->
    <script src="../../src/js/admin_script.js"></script>

</body>

</html>