<?php

include __DIR__ . '/../../db_connect/config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('Location: ../../login.php');
}

$querySelectMessages = <<< heredoc
    SELECT ci.customerName AS name,
        m.messageContent AS content,
        m.rate AS rate
    FROM messages AS m
    INNER JOIN customerinfo AS ci on (m.customerId = ci.customerId)
heredoc;

$querySelectAuthor = <<< heredoc
    SELECT * FROM author
heredoc;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>about us</h3>
        <p> <a href="../../home.php">Home</a> / About </p>
    </div>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="../../src/images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>why choose us?</h3>
                <p>TIM10 hadir dengan penawaran produk-produk menarik yang bikin kamu enjoy belanja.</p>
                <p>Kepuasan anda dalam berbelanja adalah kebahagiaan kami.</p>
                <a href="contact.php" class="btn">contact us</a>
            </div>
        </div>
    </section>

    <section class="reviews">

        <h1 class="title">client's reviews</h1>

        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, $querySelectMessages) or die('Query Failed');
            if(mysqli_num_rows($select_message) > 0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
            <div class="box">
                <img src="../../src/images/profilsementara.jfif" alt="">
                <p><?= $fetch_message['content'] ?></p>
                <div class="stars">
                    <?php
                    for($i = 0; $i < $fetch_message['rate']; $i++){
                    ?>
                    <i class="fas fa-star"></i>
                    <!-- <i class="fas fa-star-half-alt"></i> -->
                    <?php } ?>
                </div>
                <h3><?= $fetch_message['name'] ?></h3>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">No reviews added yet!</p>';
            }
            ?>

        </div>

    </section>

    <section class="authors">

        <h1 class="title">greate authors</h1>

        <div class="box-container">
            <?php
            $select_author = mysqli_query($conn, $querySelectAuthor) or die('Query Failed');
            if(mysqli_num_rows($select_author) > 0){
                while($fetch_author = mysqli_fetch_assoc($select_author)){
            ?>
            <div class="box">
                <img src="../../src/images/<?= $fetch_author['authorImage'] ?>" alt="">
                <div class="share">
                    <a href="<?php $fetch_author['fb'] ?? '#'; ?>" class="fab fa-facebook-f"></a>
                    <a href="<?php $fetch_author['twitter'] ?? '#'; ?>" class="fab fa-twitter"></a>
                    <a href="<?php $fetch_author['ig'] ?? '#'; ?>" class="fab fa-instagram"></a>
                    <a href="<?php $fetch_author['linkedIn'] ?? '#'; ?>" class="fab fa-linkedin"></a>
                </div>
                <h3><?= $fetch_author['authorName'] ?></h3>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">No reviews added yet!</p>';
            }
            ?>

        </div>

    </section>







    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="../../src/js/script.js"></script>

</body>

</html>