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

    <?php include 'police_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">My cases</h1>

        <div class="box-container">

            <?php
            $police_workid = $_SESSION['workid'];
            $cases_query = mysqli_query($conn, "SELECT * FROM `public_view` WHERE workid = '$police_workid'") or die('query failed');
            if (mysqli_num_rows($cases_query) > 0) {
                while ($fetch_cases = mysqli_fetch_assoc($cases_query)) {
            ?>

                    <div class="box">
                        <p> Filed on : <span><?php echo $fetch_cases['date']; ?></span> </p>
                        <p> Case title : <span><?php echo $fetch_cases['title']; ?></span> </p>
                        <p> OB number : <span><?php echo $fetch_cases['obnumber']; ?></span> </p>
                        <p> Case status : <span><?php echo $fetch_cases['status']; ?></span> </p>
                        <p> User id number : <span><?php echo $fetch_cases['idnumber']; ?></span> </p>
                        <p> User name : <span><?php echo $fetch_cases['firstname'] . ' ' . $fetch_cases['lastname']; ?></span> </p>
                        <a href="police_statement.php?case_id=<?php echo $fetch_cases['id']; ?>" class="option-btn" onclick="return confirm('view case statement this case?')">Statement Page</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no caces assigned yet!</p>';
            }
            ?>
        </div>

    </section>



    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>