<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};
//get the case id from the url
$case_id = $_GET['case_id'];

//if the assign button is clicked
if (isset($_POST['assign_btn'])) {
    //get the police officer id from the form
    $cases_id = $_POST['case_id'];
    $police_officer_id = $_POST['police_officer_id'];
    //update the case status to assigned
    $update_case_status = mysqli_query($conn, "UPDATE `cases` SET `status` = 'opened' WHERE `id` = '$cases_id'") or die('query failed');
    //insert the case id and police officer id into the case_assignments table
    $date = date('Y-m-d');
    $status = "active";
    $insert_case_assignment = mysqli_query($conn, "INSERT INTO `case_assignments` (`caseid`, `policeid`, `date`, `status`) VALUES ('$cases_id', '$police_officer_id', '$date', '$status')") or die('query failed');
    //redirect to the admin_dashboard.php
    header('location:admin_cases.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assign case</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">assignments</h1>

        <div class="box-container">

            <?php
            $cases_query = mysqli_query($conn, "SELECT * FROM `cases` where id='$case_id'") or die('query failed');
            if (mysqli_num_rows($cases_query) > 0) {
                while ($fetch_cases = mysqli_fetch_assoc($cases_query)) {
            ?>

                    <div class="box">
                        <input type="hidden" name="case_id" value="<?php echo $fetch_cases['id']; ?>">
                        <input type="hidden" name="obnumbers" value="<?php echo $fetch_cases['obnumber']; ?>">
                        <p> Filed on : <span><?php echo $fetch_cases['date']; ?></span> </p>
                        <p> Case title : <span><?php echo $fetch_cases['title']; ?></span> </p>
                        <p> Case statement : <span><?php echo $fetch_cases['statement']; ?></span> </p>
                        <p> OB number : <span><?php echo $fetch_cases['obnumber']; ?></span> </p>
                        <p> Case status : <span><?php echo $fetch_cases['status']; ?></span> </p>
                        <!-- display a dropdown menu to select a police officer -->
                        <form action="admin_assigncase.php" method="post">
                            <span>Police officers :</span>
                            <select name="police_officer_id">
                                <?php
                                $police_officers_query = mysqli_query($conn, "SELECT * FROM `police`") or die('query failed');
                                if (mysqli_num_rows($police_officers_query) > 0) {
                                    while ($fetch_police_officers = mysqli_fetch_assoc($police_officers_query)) {
                                ?>
                                        <option value="<?php echo $fetch_police_officers['id']; ?>"><?php echo $fetch_police_officers['fullname']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">

                    </div>
                    <input type="submit" value="Assign now" class="btn" name="assign_btn">
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