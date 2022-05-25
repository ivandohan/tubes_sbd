<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

$querySelectCustomers = <<< heredoc
    SELECT ci.customerName AS name,
        u.id AS id,
        u.email AS email,
        u.userLevel AS userLevel
    FROM customerInfo AS ci
    INNER JOIN users AS u ON (u.id = ci.customerId)
heredoc;

if(!isset($admin_id)){
    header('location: ../../login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $querySelectOrder = <<< heredoc
        SELECT orderId FROM orders WHERE customerId = '$delete_id'
    heredoc;
    $result = mysqli_query($conn, $querySelectOrder);
    $row = mysqli_fetch_assoc($result);

    if(!is_null($row['orderId'])){
        $orderId = $row['orderId'];
        mysqli_query($conn, "DELETE FROM orderDetails WHERE orderId = $orderId");
        myqli_query($conn, "DELETE FROM orders WHERE customerId = $delete_id");
        mysqli_query($conn, "DELETE FROM cart WHERE customerId = $delete_id");
    }

    mysqli_query($conn, "DELETE FROM customerInfo WHERE customerId = $delete_id") or die('query failed');
    mysqli_query($conn, "DELETE FROM messages WHERE customerId = $delete_id") or die('query failed');
    mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id") or die('query failed');
    $address = mysqli_query($conn, "SELECT * FROM address WHERE customerId = $delete_id");
    if(mysqli_num_rows($address) > 1){
        mysqli_query($conn, "DELETE FROM address WHERE customerId = $delete_id");
    }
    header('location: admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="../../src/css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="users">

        <h1 class="title"> user accounts </h1>

        <div class="box-container">
            <?php
            $select_customers = mysqli_query($conn, $querySelectCustomers) or die('query failed');
                while($fetch_customers = mysqli_fetch_assoc($select_customers)){
            ?>
            <div class="box">
                <p> User id : <span><?= $fetch_customers['id']; ?></span> </p>
                <p> Username : <span><?= $fetch_customers['name']; ?></span> </p>
                <p> Email : <span><?= $fetch_customers['email']; ?></span> </p>
                <p> User type : <span
                        style="color:<?php if($fetch_customers['userLevel'] == 'admin'){ echo 'var(--orange)'; } ?>"><?= $fetch_customers['userLevel']; ?></span>
                </p>
                <a href="admin_users.php?delete=<?= $fetch_customers['id']; ?>"
                    onclick="return confirm('delete this user?');" class="delete-btn">Delete user</a>
            </div>
            <?php
         };
      ?>
        </div>

    </section>









    <!-- custom admin js file link  -->
    <script src="../../src/js/admin_script.js"></script>

</body>

</html>