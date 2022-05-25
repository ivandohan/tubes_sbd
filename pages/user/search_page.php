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

if(isset($_POST['submit'])){
   $search_item = $_POST['search'];
   $querySearchProduct = <<< heredoc
      SELECT p.productName AS productName,
         p.productId as productId,
         p.productImage AS productImage,
         p.productPrice AS productPrice,
         c.categoryName AS categoryName,
         sC.subCategoryName AS subCategoryName
      FROM products AS p
      INNER JOIN category AS c ON (p.categoryId = c.categoryId)
      INNER JOIN subCategory sC on (p.subCategoryId = sC.subCategoryId)
      WHERE productName LIKE '%{$search_item}%'
      OR categoryName LIKE '%{$search_item}%'
      OR subCategoryName LIKE '%{$search_item}%';
   heredoc;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Our Shop</h3>
        <p> <a href="../../home.php">Home</a> / Search </p>
        <p> Pria | Wanita | Bayi | Anak </p>
        <p> Atasan | Bawahan | Luaran | Aksesoris </p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search products..." class="box">
            <input type="submit" name="submit" value="search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        <div class="box-container">
            <?php
            if(isset($_POST['submit'])){
               $select_products = mysqli_query($conn, $querySearchProduct) or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
                  while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img src="../../uploaded_img/<?php echo $fetch_product['productImage']; ?>" alt="" class="image"
                    width="250">
                <div class="name"><?php echo $fetch_product['productName']; ?></div>
                <div class="price">Rp<?php echo $fetch_product['productPrice']; ?>/-</div>
                <input type="number" class="qty" name="product_quantity" min="1" value="1">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['productName']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $fetch_product['productId']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['productPrice']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['productImage']; ?>">
                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            </form>
            <?php
               }
               }else{
                  echo '<p class="empty">No result found!</p>';
               }
            }else{
               echo '<p class="empty">Search something!</p>';
            }
            ?>
        </div>


    </section>









    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="../../src/js/script.js"></script>

</body>

</html>