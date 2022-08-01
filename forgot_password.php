<?php
include 'config.php';

//initializing variables
$email = "";
$errors = array();
$message = array();


//check if form data is correct
if (isset($_POST['submit'])) {
    //receive data from form
    $idnumber = mysqli_real_escape_string($conn, $_POST['idnumber']);
    $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
    $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);
    //receive new password
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $cnew_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);


    //form validation: ensure that the form is correctly filled
    // adding (array_push()) corresponding error into $errors array
    //validate idnumber
    if (empty($idnumber)) {
        array_push($errors, "ID number is required");
    } else if (!preg_match("/^[0-9]{8}$/", $idnumber)) {
        array_push($errors, "ID number should contain only numbers and should be exactly 8 digits long");
    }

    //check if email exists in database
    $select_users = mysqli_query($conn, "SELECT * FROM public WHERE idnumber = '$idnumber'") or die('query failed');
    if (mysqli_num_rows($select_users) == 0) {
        array_push($errors, "idnumber does not exist");
    }

    //validation of security question
    if (empty($_POST['security_question'])) {
        array_push($errors, "Security question is required");
    }

    //validation of security answer
    if (empty($_POST['security_answer'])) {
        array_push($errors, "Security answer is required");
    }

    //check if security question and answer match
    $select_users = mysqli_query($conn, "SELECT * FROM public WHERE idnumber = '$idnumber'") or die('query failed');
    $row = mysqli_fetch_array($select_users);
    if ($row['security_question'] != $security_question || $row['security_answer'] != $security_answer) {
        array_push($errors, "Security question and answer do not match");
    }

    //new password and confirm password validation
    if (empty($_POST['new_password'])) {
        array_push($errors, "New password is required");
    }
    //check if confirm password is empty
    if (empty($_POST['confirm_password'])) {
        array_push($errors, "Confirm password is required");
    }
    //check if new password and confirm password match
    if ($new_password != $cnew_password) {
        array_push($errors, "Passwords do not match");
    }

    //if there are no errors, update password
    if (count($errors) == 0) {
        //encrypt new password with php md5() function
        $new_password = md5($new_password);
        $update_password = mysqli_query($conn, "UPDATE public SET password = '$new_password' WHERE email = '$email'") or die('query failed');
        if ($update_password) {
            array_push($message, "Password updated successfully");
            header('location:login.php');
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
    <title>Forgot password</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="form-container">
        <form action="" method="post">

            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    echo '
      <div class="message">
         <span>' . $error . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
                }
            }
            ?>

            <h3>Forgot password</h3>
            <input type="number" name="idnumber" placeholder="enter your id number" class="box">
            <select name="security_question" class="box">
                <option value="">Select a security question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What is your favorite color?">What is your favorite color?</option>
                <option value="What is your favorite food?">What is your favorite food?</option>
                <option value="What is your favorite sport?">What is your favorite sport?</option>
                <option value="What is your favorite movie?">What is your favorite movie?</option>
                <option value="What is your favorite book?">What is your favorite book?</option>
            </select>
            <input type="text" name="security_answer" placeholder="enter your answer" class="box">

            <!--new password-->
            <input type="password" name="new_password" placeholder="enter new password" class="box">
            <input type="password" name="confirm_password" placeholder="confirm password" class="box">

            <input type="submit" name="submit" value="submit" class="btn">
            <!--go back to login page-->
            <a href="login.php">Go back to login page</a>

        </form>


</body>

</html>