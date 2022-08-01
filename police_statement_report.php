<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];
$police_workid = $_SESSION['workid'];

if (!isset($user_id)) {
    header('location:police_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement Report</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <Script>
        function printpage() {
            window.print()
        }
    </Script>

</head>

<body>

    <?php include 'police_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">Statements report</h1>

        <div class="box-container">

            <?php
            $order_query = mysqli_query($conn, "SELECT * FROM `public_view_statement` WHERE workid = '$police_workid'") or die('query failed');
            if (mysqli_num_rows($order_query) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
            ?>

                    <div class="box">

                        <p> Id-number : <span><?php echo $fetch_orders['idnumber']; ?></span> </p>
                        <p> Fullname : <span><?php echo $fetch_orders['firstname'] . ' ' . $fetch_orders['lastname']; ?></span> </p>
                        <p> Case Obnumber : <span><?php echo $fetch_orders['obnumber']; ?></span> </p>
                        <p> Title : <span><?php echo $fetch_orders['title']; ?></span> </p>
                        <p> Statement : <span><?php echo $fetch_orders['statement']; ?></span> </p>
                        <p> Filed on : <span><?php echo $fetch_orders['date']; ?></span> </p>
                        <p> police workid : <span><?php echo $fetch_orders['workid']; ?></span> </p>
                        <p> police fullname : <span><?php echo $fetch_orders['fullname']; ?></span> </p>
                        <p> Investigation status : <span><?php echo $fetch_orders['status']; ?></span> </p>
                        <p> Investigation : <span><?php echo $fetch_orders['investigation']; ?></span> </p>
                        <input type="button" class="btn" value="Print" onclick="printpage()">
                    </div>

            <?php
                }
            } else {
                echo '<p class="empty">no cases investigated!</p>';
            }
            ?>
        </div>

    </section>



    <!-- custom js file link  -->
    <script src=" js/script.js"></script>

</body>

</html>