<?php

include 'config.php';

session_start();

$public_id = $_SESSION['id'];

if (!isset($public_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public User Panel</title>
    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'public_header.php'; ?>

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $select_cases = mysqli_query($conn, "SELECT * FROM `cases` WHERE `userid`='$public_id'") or die('query failed');
                $number_of_cases = mysqli_num_rows($select_cases);
                ?>
                <h3><?php echo $number_of_cases; ?></h3>
                <p>Cases</p>
            </div>

            <div class="box">
                <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `message` WHERE `user_id`='$public_id'") or die('query failed');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <h3><?php echo $number_of_messages; ?></h3>
                <p>Reviews</p>
            </div>

        </div>



    </section>

    <!-- admin dashboard section ends -->


    <!-- custom admin js file link  -->

    <script src="js/admin_script.js"></script>

</body>

</html>