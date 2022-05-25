<?php

// include 'config.php';
include __DIR__ . '/../../db_connect/config.php';


session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('Location: ../../login.php');
}

if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $querySelectCart = <<< heredoc
            SELECT * FROM cart WHERE productId = $product_id AND customerId = $user_id
    heredoc;

    $queryInsertCart = <<< heredoc
            INSERT INTO cart (customerId, productId, quantity) VALUES ($user_id, $product_id, $product_quantity)
    heredoc;

    $check_cart_numbers = mysqli_query($conn, $querySelectCart) or die('Query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'Already added to cart!';
    }else{
            mysqli_query($conn, $queryInsertCart) or die('query failed');
            $message[] = 'Product added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Our Shop</h3>
        <p> <a href="../../home.php">Home</a> / Shop </p>
        <p> Pria | Wanita | Bayi | Anak </p>
    </div>

    <section class="products">

        <h1 class="title">Latest Products</h1>

        <div class="box-container">

            <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img class="image" src="../../uploaded_img/<?php echo $fetch_products['productImage']; ?>" alt=""
                    width="250">
                <div class="name"><?php echo $fetch_products['productName']; ?></div>
                <div class="price">Rp<?php echo $fetch_products['productPrice']; ?>/-</div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['productName']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['productId']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['productPrice']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['productImage']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
                }
            }else{
                echo '<p class="empty">No products added yet!</p>';
            }
            ?>
        </div>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>
    <script src="../../src/js/script.js"></script>

</body>

</html>