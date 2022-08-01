<?php

include 'config.php';

session_start();
$errors = array();

if (isset($_POST['submit'])) {

   $idno = mysqli_real_escape_string($conn, $_POST['idno']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   //idno should contain only numbers and should be exactly 8 digits long
   if (empty($idno)) {
      array_push($errors, "ID number is required");
   } else if (!preg_match("/^[0-9]{8}$/", $idno)) {
      array_push($errors, "ID number should contain only numbers and should be exactly 8 digits long");
   }

   if (empty($pass)) {
      array_push($errors, "Password is required");
   }

   //check if idno exists in database, if yes retreive the encrypted password
   $query = "SELECT * FROM public WHERE idnumber='$idno'";
   $result = mysqli_query($conn, $query);
   $user = mysqli_fetch_assoc($result);


 //encrypt new password with php md5() function
   if ($user) {
      if (md5($pass) == $user['password']) {
         $_SESSION['id'] = $user['id'];
         $_SESSION['idno'] = $user['idnumber'];
         $_SESSION['name'] = $user['firstname'] . " " . $user['lastname'];
         header('location: public_index.php');
      } else {
         array_push($errors, "Wrong password");
      }
   } else {
      array_push($errors, "ID number does not exist");
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

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
         <h3>Login Now</h3>
         <input type="number" name="idno" placeholder="enter your id number" required class="box">
         <input type="password" name="password" placeholder="enter your password" required class="box">
         <input type="submit" name="submit" value="login now" class="btn">
         <!--forgot password link-->
         <p>Forgot Password? <a href="forgot_password.php">Click Here</a></p>
         <p>Don't have an Account? <a href="register.php">Register Now</a></p>
      </form>

   </div>

</body>

</html>