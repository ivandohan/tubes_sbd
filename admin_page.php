<?php

include 'db_connect/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="src/css/admin_style.css">

</head>

<body>

    <?php include 'globalAHeader.php'; ?>

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">Dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $select_pending_price = mysqli_query($conn, "SELECT SUM(price) AS price FROM orderDetails WHERE statusOrder = 'pending'") or die('Query Failed');
                $fetch_pendings = mysqli_fetch_assoc($select_pending_price);
                ?>
                <h3>Rp<?= $fetch_pendings['price'] ?? " null"; ?></h3>
                <p>Total pendings</p>
            </div>

            <div class="box">
                <?php
                $select_completed_price = mysqli_query($conn, "SELECT SUM(price) AS price FROM orderDetails WHERE statusOrder = 'completed'") or die('Query Failed');
                $fetch_completed = mysqli_fetch_assoc($select_completed_price);
                ?>
                <h3>Rp<?= $fetch_completed['price'] ?? " null"; ?></h3>
                <p>Completed Payments</p>
            </div>

            <div class="box">
                <?php 
                $select_orders = mysqli_query($conn, "SELECT COUNT(orderId) AS totalOrder FROM orders") or die('query failed');
                $number_of_orders = mysqli_fetch_assoc($select_orders);
                ?>
                <h3><?= $number_of_orders['totalOrder']; ?></h3>
                <p>Order Placed</p>
            </div>

            <div class="box">
                <?php 
                $select_products = mysqli_query($conn, "SELECT COUNT(productId) AS totalOrder FROM `products`") or die('query failed');
                $number_of_products = mysqli_fetch_assoc($select_products);
                ?>
                <h3><?= $number_of_products['totalOrder'] ?></h3>
                <p>Products Added</p>
            </div>

            <div class="box">
                <?php 
                $select_users = mysqli_query($conn, "SELECT COUNT(id) AS totalUser FROM users WHERE userLevel = 'user'") or die('query failed');
                $number_of_users = mysqli_fetch_assoc($select_users);
                ?>
                <h3><?= $number_of_users['totalUser'] ?></h3>
                <p>Customers</p>
            </div>

            <div class="box">
                <?php 
                $select_admins = mysqli_query($conn, "SELECT COUNT(id) AS totalAdmin FROM users WHERE userLevel = 'admin'") or die('query failed');
                $number_of_admins = mysqli_fetch_assoc($select_admins);
                ?>
                <h3><?= $number_of_admins['totalAdmin'] ?></h3>
                <p>Admin Users</p>
            </div>

            <div class="box">
                <?php 
                $select_account = mysqli_query($conn, "SELECT COUNT(id) AS totalAcc FROM users") or die('query failed');
                $number_of_account = mysqli_fetch_assoc($select_account);
                ?>
                <h3><?= $number_of_account['totalAcc'] ?></h3>
                <p>Total Accounts</p>
            </div>

            <div class="box">
                <?php 
                $select_messages = mysqli_query($conn, "SELECT COUNT(messageId) AS totalMessage FROM messages") or die('query failed');
                $number_of_messages = mysqli_fetch_assoc($select_messages);
                ?>
                <h3><?= $number_of_messages['totalMessage'] ?></h3>
                <p>New Messages</p>
            </div>

        </div>

    </section>

    <!-- admin dashboard section ends -->









    <!-- custom admin js file link  -->
    <script src="src/js/admin_script.js"></script>

</body>

</html>