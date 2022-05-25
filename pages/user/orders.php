<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('Location: ../../login.php');
}

$queryShowOrder = <<< heredoc
    SELECT o.orderDate AS orderDate,
        ci.customerName AS name,
        s.supplierName as supplierName,
        s.detailAddress AS fromAddress,
        od.shippedTo AS address,
        od.emailOrder AS email,
        od.paymentMethod AS method,
        od.price AS price,
        od.statusOrder AS status,
        od.phoneNumber AS number
    FROM orderDetails AS od
    INNER JOIN orders AS o ON (od.orderId = o.orderId)
    INNER JOIN customerInfo AS ci ON (o.customerId = $user_id)
    INNER JOIN suppliers AS s ON (o.shippedBy = s.supplierId)
    WHERE ci.customerId = $user_id;
heredoc;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Your orders</h3>
        <p> <a href="../../home.php">Home</a> / Orders </p>
    </div>

    <section class="placed-orders">

        <h1 class="title">Placed orders</h1>

        <div class="box-container">

            <?php
            $order_query = mysqli_query($conn, $queryShowOrder) or die('query failed');
            if(mysqli_num_rows($order_query) > 0){
                while($fetch_orders = mysqli_fetch_assoc($order_query)){
            ?>
            <div class="box">
                <p> placed on : <span><?php echo $fetch_orders['orderDate']; ?></span> </p>
                <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                <p> total price : <span>Rp<?php echo $fetch_orders['price']; ?>/-</span> </p>
                <p> checkout status : <span
                        style="color:<?php if($fetch_orders['status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?= $fetch_orders['status']; ?></span>
                </p>
                <?php if(!is_null($fetch_orders['supplierName']) && $fetch_orders['status'] == 'completed'){ ?>
                <p> shipped by : <span><?= $fetch_orders['supplierName'] ?></span> </p>
                <p> from : <span><?= $fetch_orders['fromAddress'] ?></span> </p>
                <?php } ?>
            </div>
            <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
        </div>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="../../src/js/script.js"></script>

</body>

</html>