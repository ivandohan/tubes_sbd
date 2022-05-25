<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$user_id = $_SESSION['user_id'];
$product_id = $_GET['productid'];
$cart_id = $_GET['cart'];

if(!isset($user_id)){
    header('Location: ../../login.php');
}

$querySelectAddress = <<< heredoc
    SELECT * FROM address WHERE customerId = $user_id
heredoc;

$querySelectCart = <<< heredoc
    SELECT c.cartId as id,
        c.productId as productId,
        c.quantity as quantity,
        p.productName AS name,
        p.productImage AS image,
        p.productPrice AS price
    FROM cart AS c
    INNER JOIN products AS p ON (c.productId = p.productId)
    WHERE customerId = $user_id;
heredoc;



$querySelectOrder = <<< heredoc
    SELECT * FROM orderDetails AS od
    INNER JOIN orders AS o ON (od.orderId = o.orderId)
    INNER JOIN products AS p ON (od.productId = $product_id);
heredoc;

if(isset($_POST['order_btn'])){
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['province'].', '. $_POST['city'].', Details : '. $_POST['street'].', '. $_POST['postal_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, $querySelectCart) or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $total_products = $cart_item['quantity'];
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $order_query = mysqli_query($conn, $querySelectOrder) or die('query failed');

    if($cart_total == 0){
        $message[] = 'Your cart is empty';
    }else{
        if(mysqli_num_rows($order_query) > 0){
            $message[] = 'Order already placed!'; 
        }else{
            mysqli_query($conn, "INSERT INTO orders (customerId) VALUES ($user_id)") or die('Query Failed Insert');
    
            $selectAgain = mysqli_query($conn, "SELECT * FROM orders WHERE orderId IN (SELECT MAX(orderId) FROM orders)");
            if(mysqli_num_rows($selectAgain) > 0){
                $row = mysqli_fetch_assoc($selectAgain);
                $id = $row['orderId'];
                $queryInsertDetailOrder = <<< heredoc
                    INSERT INTO orderDetails (orderId, productId, price, quantity, shippedTo, paymentMethod, phoneNumber, emailOrder)
                    VALUES ($id, $product_id, $cart_total, $total_products, '$address', '$method', '$number', '$email');
                heredoc;
                mysqli_query($conn, $queryInsertDetailOrder) or die('Query failed');
            }else {
                mysqli_query($conn, "ROLLBACK");
            }

            $message[] = 'Order placed successfully!';
            mysqli_query($conn, "DELETE FROM cart WHERE customerId = '$user_id' AND cartId = '$cart_id'") or die('Query Failed');
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
    <title>Checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Checkout</h3>
        <p> <a href="../../home.php">Home</a> / Checkout </p>
    </div>

    <section class="display-order">

        <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, $querySelectCart) or die('query failed10');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
        <p> <?php echo $fetch_cart['name']; ?>
            <span>(<?php echo 'Rp'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span>
        </p>
        <?php
      }
   }else{
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
        <div class="grand-total"> Grand total : <span>Rp.<?php echo $grand_total; ?>/-</span> </div>

    </section>

    <section class="checkout">
        <?php 
        $showAddress = mysqli_query($conn, $querySelectAddress) or die('Query Failed');
        $row = mysqli_fetch_assoc($showAddress);
        ?>
        <form action="" method="post">
            <h3>Place your order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Your phone number :</span>
                    <input type="text" name="number" required placeholder="Enter your number">
                </div>
                <div class="inputBox">
                    <span>Your email :</span>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="inputBox">
                    <span>Payment method :</span>
                    <select name="method">
                        <option value="cash on delivery">Cash on delivery</option>
                        <!-- <option value="credit card">Credit card</option>
                        <option value="paypal">Paypal</option>
                        <option value="paytm">Paytm</option> -->
                    </select>
                </div>
                <div class="inputBox">
                    <span>Province :</span>
                    <input type="text" name="province" required placeholder="e.g. Sumatera Utara"
                        value="<?= $row['province'] ?>">
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" name="city" required placeholder="e.g. Medan Selayang"
                        value="<?= $row['city'] ?>">
                </div>

                <div class="inputBox">
                    <span>Postal code :</span>
                    <input type="number" min="0" name="postal_code" required placeholder="e.g. 123456">
                </div>
                <div class="inputBox">
                    <span>Address Details :</span>
                    <input type="text" name="street" required placeholder="e.g. street name"
                        value="<?= $row['details'] ?>">
                </div>
            </div>
            <input type="submit" onclick="return confirm('Are you sure?')" value="order now" class="btn"
                name="order_btn">
        </form>

    </section>









    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src=" ../../src/js/script.js"></script>

</body>

</html>