<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:police_login.php');
}

//get the case id from the url
$case_id = $_GET['case_id'];

//when the user clicks the submit button
if (isset($_POST['save_statement_btn'])) {
    $case_id = $_POST['case_id'];
    $police_workid = $_SESSION['workid'];
    $obnumber = $_POST['obnumber'];
    $investigation = $_POST['statement'];
    $status = $_POST['status'];

    //check if the case is already in the database
    $query = "SELECT * FROM case_investigations WHERE caseid='$case_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        //update the case investigation
        $query = "UPDATE case_investigations SET policeworkid='$police_workid', obnumber='$obnumber', investigation='$investigation', status='$status' WHERE caseid='$case_id'";
        mysqli_query($conn, $query);
        //create a javascript alert to tell the user that the statement has been added
        echo "<script>alert('Statement updated successfully!')</script>";
    } else {
        //insert the case investigation
        $query = "INSERT INTO case_investigations (caseid, policeworkid, obnumber, investigation, status) VALUES ('$case_id', '$police_workid', '$obnumber', '$investigation', '$status')";
        mysqli_query($conn, $query);
        //create a javascript alert to tell the user that the statement has been added
        echo "<script>alert('Statement added successfully!')</script>";
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case statement</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <script>
        //function validate message
        function validateMessage() {
            var message = document.getElementById("message").value;
            var message_error = document.getElementById("message_error");
            if (message == "") {
                message_error.innerHTML = "Please enter your message";
                alert("Please enter your message");
                return false;
            } else {
                message_error.innerHTML = "";
                return true;
            }
        }
    </script>
</head>

<body>

    <?php include 'police_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">My cases</h1>

        <div class="box-container">

            <?php
            $police_workid = $_SESSION['workid'];
            $cases_query = mysqli_query($conn, "SELECT * FROM `public_view` WHERE id = '$case_id'") or die('query failed');
            if (mysqli_num_rows($cases_query) > 0) {
                while ($fetch_cases = mysqli_fetch_assoc($cases_query)) {
            ?>

                    <div class="box" id="print-content">
                        <p> Case title : <span><?php echo $fetch_cases['title']; ?></span> </p>
                        <p> Case statement : <span><?php echo $fetch_cases['statement']; ?></span> </p>
                        <p> OB number : <span><?php echo $fetch_cases['obnumber']; ?></span> </p>
                        <p> Case status : <span><?php echo $fetch_cases['status']; ?></span> </p>

                        <p>complainant name : <span><?php echo $fetch_cases['firstname'] . ' ' . $fetch_cases['lastname']; ?></span> </p>
                        <p> id-number : <span><?php echo $fetch_cases['idnumber']; ?></span> </p>

                        <p> DOB : <span><?php echo $fetch_cases['dob']; ?></span> </p>

                    </div>
                    <section class="checkout">

                        <form action="" method="post">
                            <h3>Add statement</h3>
                            <div class="flex">
                                <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">
                                <input type="hidden" name="obnumber" value="<?php echo $fetch_cases['obnumber']; ?>">
                                <div class="inputBox">
                                    <span>Select case status :</span>
                                    <select name="status" required>
                                        <option value="Ongoing">ongoing</option>
                                        <option value="Completed">Completed</option>

                                    </select>
                                </div>
                                <div class="inputBox">
                                    <span>Add statement :</span>
                                    </br>
                                    <textarea name="statement" class="box" placeholder="enter your message" id="message" cols="30" rows="10" onblur="validateMessage()"></textarea>
                                    <span id="message_error"></span>
                                </div>

                            </div>
                            <!-- create a submit button that will submit the form data if the validateMessage function returns true -->
                            <input type="submit" name="save_statement_btn" value="Save statement" class="btn" onclick="return validateMessage()">


                        </form>

                    </section>
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