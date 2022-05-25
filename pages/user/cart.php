<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$user_id = $_SESSION['user_id'];

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


if(!isset($user_id)){
    header('Location: ../../login.php');
}

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    $queryUpdateCart = <<< heredoc
        UPDATE cart SET quantity = $cart_quantity WHERE cartId = $cart_id
    heredoc;

    mysqli_query($conn, $queryUpdateCart) or die('query failed');
    $message[] = 'Cart quantity updated!';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    $queryDeleteCart = <<< heredoc
        DELETE FROM cart WHERE cartId = $delete_id
    heredoc;

    mysqli_query($conn, $queryDeleteCart) or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    $queryDeleteAllCart = <<< heredoc
        DELETE FROM cart WHERE customerId = $user_id
    heredoc;

    mysqli_query($conn, $queryDeleteAllCart) or die('query failed');
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Shopping Cart</h3>
        <p> <a href="../../home.php">Home</a> / Cart </p>
    </div>

    <section class="shopping-cart">

        <h1 class="title">Products Added</h1>

        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, $querySelectCart) or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
                <a href="cart.php?delete=<?=  $fetch_cart['id']; ?>" class="fas fa-times"
                    onclick="return confirm('delete this from cart?');"></a>
                <img src="../../uploaded_img/<?=  $fetch_cart['image']; ?>" alt="" width="250">
                <div class="name"><?=  $fetch_cart['name']; ?></div>
                <div class="price">Rp<?=  $fetch_cart['price']; ?>/-</div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?=  $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?=  $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_cart" value="update" class="option-btn">
                    <a href="checkout.php?productid=<?= $fetch_cart['productId'] ?>&cart=<?= $fetch_cart['id'] ?>"
                        class="option-btn">Checkout</a>
                </form>
                <div class="sub-total"> Sub total :
                    <span>Rp<?=  $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span>
                </div>
            </div>
            <?php
                $grand_total += $sub_total;
                    }
                }else{
                    echo '<p class="empty">Your cart is empty</p>';
                }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn <?=  ($grand_total > 1)?'':'disabled'; ?>"
                onclick="return confirm('delete all from cart?');">Delete all</a>
        </div>

        <div class="cart-total">
            <p>Grand total : <span>Rp<?=  $grand_total; ?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue shopping</a>
            </div>
        </div>

    </section>








    <?php include 'footer.php'; ?>
    <!-- custom js file link  
    -->
    <script src="../../src/js/script.js"></script>

</body>

</html>