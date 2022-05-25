<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location: ../../login.php');
}

$queryShowOrder = <<< heredoc
    SELECT o.orderDate AS orderDate,
        o.orderId AS orderIdS,
        u.id AS userId,
        ci.customerName AS name,
        od.shippedTo AS address,
        od.emailOrder AS email,
        od.paymentMethod AS method,
        od.quantity AS quantity,
        od.price AS price,
        od.statusOrder AS status,
        od.phoneNumber AS number
    FROM orderDetails AS od
    INNER JOIN orders AS o ON (od.orderId = o.orderId)
    INNER JOIN users AS u ON (o.customerId = u.id)
    INNER JOIN customerInfo AS ci ON (o.customerId = ci.customerId)
    INNER JOIN products AS p ON (od.productId = p.productId);
heredoc;

if(isset($_POST['update_order'])){
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $update_supplier = $_POST['update_supplier'];

    mysqli_query($conn, "UPDATE orderDetails SET statusOrder = '$update_payment' WHERE orderId = '$order_update_id'") or die('query failed');
    mysqli_query($conn, "UPDATE orders SET shippedBy = '$update_supplier' WHERE orderId = '$order_update_id'") or die('query failed');
    $message[] = 'Payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM orderDetails WHERE orderId = '$delete_id'") or die('query failed');
   header('location: admin_orders.php');
}

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

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="../../src/css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="orders">

        <h1 class="title">Placed Orders</h1>

        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, $queryShowOrder) or die('query failed');
            $select_supplier = mysqli_query($conn, "SELECT * FROM suppliers") or die('query failed');
            $data = $select_supplier->fetch_all(MYSQLI_ASSOC);
            if(mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="box">
                <p> User id : <span><?= $fetch_orders['userId']; ?></span> </p>
                <p> Placed on : <span><?= $fetch_orders['orderDate']; ?></span> </p>
                <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
                <p> Number : <span><?= $fetch_orders['number']; ?></span> </p>
                <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
                <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
                <p> Total products : <span><?= $fetch_orders['quantity']; ?></span> </p>
                <p> Total price : <span>Rp<?= $fetch_orders['price']; ?>/-</span> </p>
                <p> Payment method : <span><?= $fetch_orders['method']; ?></span> </p>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['orderIdS']; ?>">
                    <input type="hidden" name="user_id" value="<?= $fetch_orders['userId']; ?>">
                    <select name="update_payment">
                        <option value="" selected disabled><?= $fetch_orders['status']; ?></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select name="update_supplier">
                        <?php
                        foreach($data as $row){
                        ?>
                        <option value="<?= $row['supplierId'] ?>"><?= $row['supplierName'] ?>
                        </option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="update" name="update_order" class="option-btn">
                    <a href="admin_orders.php?delete=<?= $fetch_orders['orderIdS']?>"
                        onclick="return confirm('delete this order?');" class="delete-btn">Delete</a>
                </form>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">no orders placed yet!</p>';
            }
            ?>
        </div>

    </section>










    <!-- custom admin js file link  -->
    <script src="../../src/js/admin_script.js"></script>

</body>

</html>