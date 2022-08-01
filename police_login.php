<?php

include 'config.php';

session_start();
$errors = array();

if (isset($_POST['submit'])) {

    $workid = mysqli_real_escape_string($conn, $_POST['workid']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    //workid should contain only numbers and should be exactly 8 digits long
    if (empty($workid)) {
        array_push($errors, "workid is required");
    } else if (!preg_match("/^[0-9]{8}$/", $workid)) {
        array_push($errors, "workid should contain only numbers and should be exactly 8 digits long");
    }

    if (empty($pass)) {
        array_push($errors, "Password is required");
    }

    //check if idno exists in database, if yes retreive the encrypted password
    $query = "SELECT * FROM police WHERE workid='$workid'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

 //encrypt new password with php md5() function
    if ($user) {
        if (md5($pass) == $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['workid'] = $user['workid'];
            $_SESSION['name'] = $user['fullname'];
            header('location: police_index.php');
        } else {
            array_push($errors, "Wrong password");
        }
    } else {
        array_push($errors, "workid number does not exist");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="form-container">

        <form action="" method="post">
            <?php
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    //print an error message with red color
                    echo "<p style='color:red;'>$error</p>";
                }
            }
            ?>
            <h3>login now</h3>
            <input type="number" name="workid" placeholder="enter your workid" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <!--forgot password link-->
            <p>forgot password? <a href="forgot_password.php">click here</a></p>
        </form>

    </div>

</body>

</html>