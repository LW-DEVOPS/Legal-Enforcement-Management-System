<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cases</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">cases</h1>

        <div class="box-container">

            <?php
            $cases_query = mysqli_query($conn, "SELECT * FROM `cases`") or die('query failed');
            if (mysqli_num_rows($cases_query) > 0) {
                while ($fetch_cases = mysqli_fetch_assoc($cases_query)) {
            ?>

                    <div class="box">
                        <p> Filed on : <span><?php echo $fetch_cases['date']; ?></span> </p>
                        <p> Case title : <span><?php echo $fetch_cases['title']; ?></span> </p>
                        <p> Case statement : <span><?php echo $fetch_cases['statement']; ?></span> </p>
                        <p> OB number : <span><?php echo $fetch_cases['obnumber']; ?></span> </p>
                        <p> Case status : <span><?php echo $fetch_cases['status']; ?></span> </p>


                        <!-- show the assign button only if the case is not assigned, check the case_assignments table to see if the case with the same id is already assigned -->
                        <?php
                        $case_id = $fetch_cases['id'];
                        $case_assignments_query = mysqli_query($conn, "SELECT * FROM `case_assignments` WHERE `caseid` = '$case_id'") or die('query failed');
                        if (mysqli_num_rows($case_assignments_query) == 0) {
                        ?>
                            <a href="admin_assigncase.php?case_id=<?php echo $fetch_cases['id']; ?>" class="option-btn" onclick="return confirm('assign this case?')">Assign case</a>
                        <?php
                        }
                        ?>


                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no orders placed yet!</p>';
            }
            ?>
        </div>

    </section>



    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>