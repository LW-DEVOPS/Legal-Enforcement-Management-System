<?php

include 'config.php';

session_start();

$public_id = $_SESSION['id'];

if (!isset($public_id)) {
    header('location:login.php');
}


if (isset($_POST['send'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $msg = mysqli_real_escape_string($conn, $_POST['message']);
    $user_id = $_SESSION['id'];

    //check if the case has already been added
    $sql = "SELECT * FROM `cases` WHERE `userid` = '$user_id' AND `title` = '$name' AND `statement` = '$msg'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        echo '<script>alert("Case already added")</script>';
    } else {
        //generate random name for the case obnumber starting with OB/, followed by random letters and numbers, they are unique and cannot be duplicated in the database (this is to prevent the same case being added twice) and should be 10 characters long
        $obnumber = 'OB/' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

        //get the current date and time
        $date = date('Y-m-d H:i:s');

        //default status is pending
        $status = 'pending';

        //insert the case into the database
        $sql = "INSERT INTO `cases` (`id`, `userid`, `obnumber`, `title`, `statement`, `date`, `status`) VALUES (NULL, '$user_id', '$obnumber', '$name', '$msg', '$date', '$status')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script>alert("Case added")</script>';
        } else {
            echo '<script>alert("Case not added")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File case</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <script>
        //function validateTitle is can contain only letters and spaces
        function validateTitle() {
            var title = document.getElementById("title").value;
            var title_regex = /^[a-zA-Z' ]*$/;
            var title_error = document.getElementById("title_error");
            if (title == "") {
                title_error.innerHTML = "Please enter a title";
                return false;
            } else if (!title_regex.test(title)) {
                title_error.innerHTML = "Please enter a valid title";
                return false;
            } else {
                title_error.innerHTML = "";
                return true;
            }
        }

        //function validate message
        function validateStatement() {
            var message = document.getElementById("message").value;
            var message_error = document.getElementById("message_error");
            if (message == "") {
                message_error.innerHTML = "Please enter your message";
                return false;
            } else {
                message_error.innerHTML = "";
                return true;
            }
        }

        //function validate all fields
        function validate() {
            if (validateTitle() && validateStatement()) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</head>

<body>

    <?php include 'public_header.php'; ?>
    <section class="contact">

        <form action="" method="post">
            <h3>New case</h3>
            <input type="text" id="title" name="name" required placeholder="enter your case title" class="box" onblur="validateTitle()">
            <span id="title_error"></span>
            <textarea name="message" class="box" placeholder="enter your case statement" id="message" cols="30" rows="10" onblur="validateStatement()"></textarea>
            <span id="message_error"></span>
            <input type="submit" value="File Case" name="send" class="btn" onclick="return validate()">
        </form>


    </section>


    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>