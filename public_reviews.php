<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}


if (isset($_POST['send'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = $_POST['number'];
      $msg = mysqli_real_escape_string($conn, $_POST['message']);
      $user_id = $_SESSION['id'];

      $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

      if (mysqli_num_rows($select_message) > 0) {
         $message[] = 'message sent already!';
      } else {
         mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
         $message[] = 'message sent successfully!';
      }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reviews and Recommendations</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <script>
      //function validate name
      function validateName() {
         var name = document.getElementById("name").value;
         var name_regex = /^[a-zA-Z' ]*$/;
         var name_error = document.getElementById("name_error");
         if (name == "") {
            name_error.innerHTML = "Please enter your name";
            return false;
         } else if (!name_regex.test(name)) {
            name_error.innerHTML = "Please enter a valid name";
            return false;
         } else {
            name_error.innerHTML = "";
            return true;
         }
      }

      //function validate email
      function validateEmail() {
         var email = document.getElementById("email").value;
         var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
         var email_error = document.getElementById("email_error");
         if (email == "") {
            email_error.innerHTML = "Please enter your email";
            return false;
         } else if (!email_regex.test(email)) {
            email_error.innerHTML = "Please enter a valid email";
            return false;
         } else {
            email_error.innerHTML = "";
            return true;
         }
      }

      //function validate phone number
      function validatePhone() {
         var phone = document.getElementById("phone").value;
         var phone_regex = /^[0-9]{10}$/;
         var phone_error = document.getElementById("phone_error");
         if (phone == "") {
            phone_error.innerHTML = "Please enter your phone number";
            return false;
            //check if length is less than 10
         } else if (phone.length < 10) {
            phone_error.innerHTML = "Please enter a valid phone number with 10 digits";
            return false;
            //check if length is greater than 10
         } else if (phone.length > 10) {
            phone_error.innerHTML = "Please enter a valid phone number with 10 digits";
            return false;
            //check if phone number is valid
         } else if (!phone_regex.test(phone)) {
            phone_error.innerHTML = "Please enter a valid phone number";
            return false;
         } else {
            phone_error.innerHTML = "";
            return true;
         }
      }

      //function validate message
      function validateMessage() {
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
         if (validateName() && validatePhone() && validateEmail() && validateMessage()) {
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
         <h3>say something!</h3>
         <input type="text" id="name" name="name" required placeholder="enter your name" class="box" onblur="validateName()">
         <span id="name_error"></span>
         <input type="email" id="email" name="email" required placeholder="enter your email" class="box" onblur="validateEmail()">
         <span id="email_error"></span>
         <input type="number" id="phone" name="number" required placeholder="enter your number" class="box" onblur="validatePhone()">
         <span id="phone_error"></span>
         <textarea name="message" class="box" placeholder="enter your message" id="message" cols="30" rows="10" onblur="validateMessage()"></textarea>
         <span id="message_error"></span>
         <input type="submit" value="send message" name="send" class="btn" onclick="return validate()">
      </form>


   </section>


   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>