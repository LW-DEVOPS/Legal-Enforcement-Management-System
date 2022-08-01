<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">Dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $select_stations = mysqli_query($conn, "SELECT * FROM `police_station`") or die('query failed');
                $number_of_stations = mysqli_num_rows($select_stations);
                ?>
                <h3><?php echo $number_of_stations; ?></h3>
                <a href="stations.php"><p>Police Stations</p></a>
            </div>

            <div class="box">
                <?php
                $select_police = mysqli_query($conn, "SELECT * FROM `police`") or die('query failed');
                $number_of_police = mysqli_num_rows($select_police);
                ?>
                <h3><?php echo $number_of_police; ?></h3>
                <a href="police_officer.php"><p>Police Officers</p></a>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `public`") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?php echo $number_of_users; ?></h3>
                <a href="users.php"><p>Public Users</p></a>
            </div>

            <div class="box">
                <?php
                $select_stations = mysqli_query($conn, "SELECT * FROM `public_view_assigned`") or die('query failed');
                $number_of_stations = mysqli_num_rows($select_stations);
                ?>
                <h3><?php echo $number_of_stations; ?></h3>
                <a href="admin_assigned_cases.php"><p>Assigned Cases</p></a>
            </div>

            <div class="box">
                <?php
                $select_stations = mysqli_query($conn, "SELECT * FROM `public_view_unassigned`") or die('query failed');
                $number_of_stations = mysqli_num_rows($select_stations);
                ?>
                <h3><?php echo $number_of_stations; ?></h3>
                <a href="admin_unassigned_cases.php"><p>Unassigned Cases</p></a>
            </div>

            <div class="box">
                <?php
                $select_stations = mysqli_query($conn, "SELECT * FROM public_view_statement where status = 'Ongoing'") or die('query failed');
                $number_of_stations = mysqli_num_rows($select_stations);
                ?>
                <h3><?php echo $number_of_stations; ?></h3>
                <a href="admin_ongoing_cases.php"><p>Ongoing Cases</p></a>
            </div>

             <div class="box">
                <?php
                $select_stations = mysqli_query($conn, "SELECT * FROM public_view_statement where status = 'Completed'") or die('query failed');
                $number_of_stations = mysqli_num_rows($select_stations);
                ?>
                <h3><?php echo $number_of_stations; ?></h3>
                <a href="admin_completed_cases.php"><p>Completed Cases</p></a>
            </div>

            <div class="box">
                <?php
                $select_police = mysqli_query($conn, "SELECT * FROM `police`") or die('query failed');
                $number_of_police = mysqli_num_rows($select_police);
                $select_users = mysqli_query($conn, "SELECT * FROM `public`") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
                $total_users = $number_of_police + $number_of_users;
                ?>
                <h3><?php echo $total_users; ?></h3>
                <p>Total accounts</p>
            </div>

            <div class="box">
                <?php
                $select_cases = mysqli_query($conn, "SELECT * FROM `cases`") or die('query failed');
                $number_of_cases = mysqli_num_rows($select_cases);
                ?>
                <h3><?php echo $number_of_cases; ?></h3>
                <a href="admin_cases.php"><p>Cases</p></a>
            </div>

            <div class="box">
                <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                $number_of_message = mysqli_num_rows($select_message);
                ?>
                <h3><?php echo $number_of_message; ?></h3>
                <a href="admin_reviews.php"><p>Reviews</p></a>
            </div>


        </div>



    </section>

    <!-- admin dashboard section ends -->


    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>