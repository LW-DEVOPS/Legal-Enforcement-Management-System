<?php

include 'config.php';

session_start();
$errors = array();

if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    //username should contain only letters and numbers
    if (empty($username)) {
        array_push($errors, "Username is required");
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        array_push($errors, "Username should contain only letters and numbers");
    }


    if (empty($pass)) {
        array_push($errors, "Password is required");
    }

    //check if username exists in database, if yes retreive the password
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($pass == $user['password']) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('location: admin_page.php');
        } else {
            array_push($errors, "Wrong password");
        }
    } else {
        array_push($errors, "Username does not exist");
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
            <input type="text" name="username" placeholder="enter your username" required class="box">
            <input type="password" name="password" placeholder="enter your password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
        </form>

    </div>

</body>

</html>