<?php

//GET DATABASE CONNECTION
include 'config.php';

$errors = array();
$message = array();


//REGISTER USER
if (isset($_POST['submit'])) {

   //receive data from form
   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $town = mysqli_real_escape_string($conn, $_POST['town']);
   $postal_address = mysqli_real_escape_string($conn, $_POST['postal_address']);
   $dob = mysqli_real_escape_string($conn, $_POST['dob']);
   $idno = mysqli_real_escape_string($conn, $_POST['idno']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
   $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);

   //form validation: ensure that the form is correctly filled
   // adding (array_push()) corresponding error into $errors array
   if (empty($first_name)) {
      array_push($errors, "First name is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
      array_push($errors, "First name should contain only letters");
   }

   if (empty($last_name)) {
      array_push($errors, "Last name is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
      array_push($errors, "Last name should contain only letters");
   }

   if (empty($email)) {
      array_push($errors, "Email is required");
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email format");
   }

   if (empty($phone)) {
      array_push($errors, "Phone number is required");
   } else if (!preg_match("/^[0-9]{10}$/", $phone)) {
      array_push($errors, "Phone number should contain only numbers and should be exactly 10 digits long");
   }

   if (empty($town)) {
      array_push($errors, "Town is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $town)) {
      array_push($errors, "Town should contain only letters");
   }

   if (empty($postal_address)) {
      array_push($errors, "Postal address is required");
   } else if (!preg_match("/^[a-zA-Z0-9]*$/", $postal_address)) {
      array_push($errors, "Postal address should contain only letters and numbers");
   }

   if (empty($dob)) {
      array_push($errors, "Date of birth is required");
   }

   if (empty($idno)) {
      array_push($errors, "ID number is required");
   } else if (!preg_match("/^[0-9]{8}$/", $idno)) {
      array_push($errors, "ID number should contain only numbers and should be exactly 8 digits long");
   }

   //password sholud be at least 8 characters long and contain at least one number, one uppercase letter and one lowercase letter
   if (empty($pass)) {
      array_push($errors, "Password is required");
   } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $pass)) {
      array_push($errors, "Password should be at least 8 characters long and contain at least one number, one uppercase letter and one lowercase letter");
   }

   if (empty($cpass)) {
      array_push($errors, "Confirm password is required");
   } else if ($pass != $cpass) {
      array_push($errors, "Passwords do not match");
   }


   //validation of security question
   if (empty($_POST['security_question'])) {
      array_push($errors, "Security question is required");
   }


   //validation of security answer
   if (empty($_POST['security_answer'])) {
      array_push($errors, "Security answer is required");
   }


   //first check the database to make sure a user does not already exist with the same idno and/or email
   $user_check_query = "SELECT * FROM public WHERE idnumber='$idno' OR email='$email' LIMIT 1";
   $result = mysqli_query($conn, $user_check_query);
   $user = mysqli_fetch_assoc($result);

   if ($user) { // if user exists
      if ($user['idno'] === $idno) {
         array_push($errors, "ID number already exists");
      }

      if ($user['email'] === $email) {
         array_push($errors, "Email already exists");
      }
   }

   //if there are no errors, save user to database while encrypting password with md5()
   if (count($errors) == 0) {
      $password = md5($pass); //encrypt password before storing in database (security)
      $query = "INSERT INTO public (firstname, lastname, email, phone, town, postaladdress, dob, idnumber, password, security_question, security_answer) VALUES ('$first_name', '$last_name', '$email', '$phone', '$town', '$postal_address', '$dob', '$idno', '$password', '$security_question', '$security_answer')";
      mysqli_query($conn, $query);
      $_SESSION['success'] = "You are now registered";
      header('location: login.php');
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script>
      function ValidateDOB() {
         var lblError = document.getElementById("lblError");

         //Get the date from the TextBox.
         var dateString = document.getElementById("txtDate").value;

         var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;

         //Check whether valid dd/MM/yyyy Date Format.
         if (regex.test(dateString)) {
            var parts = dateString.split("/");
            var dtDOB = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
            var dtCurrent = new Date();
            lblError.innerHTML = "Eligibility 18 years ONLY."
            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
               return false;
            }

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {

               //CD: 11/06/2018 and DB: 15/07/2000. Will turned 18 on 15/07/2018.
               if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                  return false;
               }
               if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                  //CD: 11/06/2018 and DB: 15/06/2000. Will turned 18 on 15/06/2018.
                  if (dtCurrent.getDate() < dtDOB.getDate()) {
                     return false;
                  }
               }
            }
            lblError.innerHTML = "";
            document.getElementById("dob").value = dtDOB.getDate() + "/" + (dtDOB.getMonth() + 1) + "/" + dtDOB.getFullYear();
            return true;
         } else {
            lblError.innerHTML = "Enter date in dd/MM/yyyy format ONLY."
            return false;
         }
      }
   </script>

</head>

<body>
   <?php include 'header.php'; ?>
   <?php if (count($message) > 0) : ?>
      <div class="error">
         <?php foreach ($message as $messag) : ?>
            <p><?php echo $messag ?></p>
         <?php endforeach ?>
      </div>
   <?php endif ?>
   </br>

   <div class="form-container">

      <form action="" method="post" autocomplete="off">
         <?php if (count($errors) > 0) : ?>
            <div class="error">
               <?php foreach ($errors as $error) : ?>
                  <p><?php echo $error ?></p>
               <?php endforeach ?>
            </div>
         <?php endif ?>
         </br>

         <h3>register now</h3>
         <input type="text" name="first_name" placeholder="enter your first name" class="box">
         <input type="text" name="last_name" placeholder="enter your last name" class="box">
         <input type="email" name="email" placeholder="enter your email" class="box">
         <input type="number" name="phone" placeholder="enter your number" class="box">
         <input type="text" name="town" placeholder="enter your town" class="box">
         <input type="text" name="postal_address" placeholder="enter your postal address" class="box">
         <input type="text" class="box" name="dob" id="txtDate" placeholder="dd/mm/yyyy" onblur="ValidateDOB()">
         <span class="error" id="lblError"></span>
         <input type="number" name="idno" placeholder="enter your id number" class="box">
         <input type="password" name="password" placeholder="enter your password" class="box">
         <input type="password" name="cpassword" placeholder="confirm your password" class="box">
         <!--security question options incase user forgets password-->
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

         <input type="submit" name="submit" value="register now" class="btn">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </div>

</body>

</html>