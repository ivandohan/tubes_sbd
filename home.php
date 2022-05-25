<?php

include 'db_connect/config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
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
    <title>Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="src/css/style.css">

</head>

<body>

    <?php include 'globalUHeader.php'; ?>

    <section class="home">

        <div class="content">
            <h3>Work Hard, Stow Harder.</h3>
            <p>Enjoy Shopping</p>
            <a href="pages/user/about.php" class="white-btn">Discover More</a>
        </div>

    </section>

    <section class="products">

        <h1 class="title">latest products</h1>

        <div class="box-container">

            <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img class="image" src="uploaded_img/<?=$fetch_products['productImage']; ?>" alt="" width="250">
                <div class="name"><?=$fetch_products['productName']; ?></div>
                <div class="price">Rp<?=$fetch_products['productPrice']; ?></div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_id" value="<?=$fetch_products['productId']; ?>">
                <input type="submit" onclick="return confirm('Add <?= $fetch_products['productName']; ?> to cart?')"
                    value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
                }
            }else{
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="pages/user/shop.php" class="option-btn">Load more</a>
        </div>

    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="src/images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>about us</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
                    corporis ratione saepe sed adipisci?</p>
                <a href="pages/user/about.php" class="btn">read more</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet
                ullam voluptatibus?</p>
            <a href="pages/user/contact.php" class="white-btn">contact us</a>
        </div>

    </section>





    <?php include 'globalUFooter.php'; ?>

    <!-- custom js file link  -->
    <script src="src/js/script.js"></script>

</body>

</html>