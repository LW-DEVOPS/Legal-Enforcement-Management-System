<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cases</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'public_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">My cases</h1>

        <div class="box-container">

            <?php
            $cases_query = mysqli_query($conn, "SELECT * FROM `cases` WHERE userid = '$user_id'") or die('query failed');
            if (mysqli_num_rows($cases_query) > 0) {
                while ($fetch_cases = mysqli_fetch_assoc($cases_query)) {
            ?>

                    <div class="box">
                        <p> Filed on : <span><?php echo $fetch_cases['date']; ?></span> </p>
                        <p> Case title : <span><?php echo $fetch_cases['title']; ?></span> </p>
                        <p> Case statement : <span><?php echo $fetch_cases['statement']; ?></span> </p>
                        <p> OB number : <span><?php echo $fetch_cases['obnumber']; ?></span> </p>
                        <p> Case status : <span><?php echo $fetch_cases['status']; ?></span> </p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no cases filed yet!</p>';
            }
            ?>
        </div>

    </section>



    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>