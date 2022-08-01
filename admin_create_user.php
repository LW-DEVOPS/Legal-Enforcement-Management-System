<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

//initializing variables
$errors = array();
$message = array();

//REGISTER USER
if (isset($_POST['submit'])) {

   //receive data from form
   $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $workid = mysqli_real_escape_string($conn, $_POST['workid']);
   $station = mysqli_real_escape_string($conn, $_POST['station']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $postaladdress = mysqli_real_escape_string($conn, $_POST['postaladdress']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $security_question = mysqli_real_escape_string($conn, $_POST['security_question']);
   $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);

   //form validation: ensure that the form is correctly filled
   //fullname should contain only letters and whitespace
   if (empty($fullname)) {
      array_push($errors, "Fullname is required");
   } else if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
      array_push($errors, "Fullname should contain only letters and whitespace");
   }

   if (empty($email)) {
      array_push($errors, "Email is required");
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email format");
   }

   //phone should contain only number  and should be 10 digits long
   if (empty($phone)) {
      array_push($errors, "Phone is required");
   } else if (!preg_match("/^[0-9]{10}$/", $phone)) {
      array_push($errors, "Phone should contain only numbers and should be 10 digits long");
   }

   //workid should contain only numbers and should be 8 digits long
   if (empty($workid)) {
      array_push($errors, "Work ID is required");
   } else if (!preg_match("/^[0-9]{8}$/", $workid)) {
      array_push($errors, "Work ID should contain only numbers and should be 8 digits long");
   }

   //station should contain only letters and whitespace
   if (empty($station)) {
      array_push($errors, "Station is required");
   } else if (!preg_match("/^[a-zA-Z ]*$/", $station)) {
      array_push($errors, "Station should contain only letters and whitespace");
   }

   //gender should be either male or female
   if (empty($gender)) {
      array_push($errors, "Gender is required");
   }

   if (empty($postaladdress)) {
      array_push($errors, "Postal address is required");
   } else if (!preg_match("/^[a-zA-Z0-9]*$/", $postaladdress)) {
      array_push($errors, "Postal address should contain only letters and numbers");
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

   //first check the database to make sure a police does not already exist with the same workid and/or email
   $user_check_query = "SELECT * FROM police WHERE workid='$workid' OR email='$email' LIMIT 1";
   $result = mysqli_query($conn, $user_check_query);
   $user = mysqli_fetch_assoc($result);

   if ($user) { //if user exists
      if ($user['workid'] === $workid) {
         array_push($errors, "Work ID already exists");
      }

      if ($user['email'] === $email) {
         array_push($errors, "Email already exists");
      }
   }

   //if there are no errors, save the police to the database and encryt the password using password_hash()
   if (count($errors) == 0) {
      $password = md5($pass); //encrypt the password before saving in the database
      $query = "INSERT INTO police(fullname, email, phone, workid, station, gender, postaladdress, password, security_question, security_answer) VALUES('$fullname', '$email', '$phone', '$workid', '$station', '$gender', '$postaladdress', '$password', '$security_question', '$security_answer')";
      mysqli_query($conn, $query);
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   mysqli_query($conn, "DELETE FROM `police` WHERE id = '$delete_id'") or die('query failed');
   $message[] = "police deleted successfully";
   header('location:admin_create_user.php');
}

//when the user clicks the update button, update the data in the database
if (isset($_POST['update_police'])) {
   $update_p_id = $_POST['update_id'];
   $update_fullname = $_POST['update_fullname'];
   $update_email = $_POST['update_email'];
   $update_phone = $_POST['update_phone'];
   $update_station = $_POST['update_phone'];
   $update_postaladdress = $_POST['update_postaladdress'];

   if (empty($update_fullname)) {
      array_push($errors, "fullname name is required");
   } else if (!preg_match("/^[a-zA-Z0-9_\-\s]*$/", $update_name)) {
      array_push($errors, "fullname name should contain only letters, numbers, underscore, dash and space");
   }

   if (empty($update_email)) {
      array_push($errors, "email is required");
   } else if (!filter_var($update_email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email format");
   }

   //phone validation, it can contain numbers and should be 10 digits long
   if (empty($update_phone)) {
      array_push($errors, "phone is required");
   } else if (!preg_match("/^[0-9]{10}$/", $update_phone)) {
      array_push($errors, "phone should contain only numbers and should be between 10 and 15 digits long");
   }

   //station validation, it can contain letters
   if (empty($update_station)) {
      array_push($errors, "station is required");
   } else if (!preg_match("/^[a-zA-Z ]*$/", $update_station)) {
      array_push($errors, "station should contain only letters");
   }

   //postal address validation, it can contain letters, numbers and dash
   if (empty($update_postaladdress)) {
      array_push($errors, "postal address is required");
   } else if (!preg_match("/^[a-zA-Z0-9-]*$/", $update_postaladdress)) {
      array_push($errors, "postal address should contain only letters, numbers and dash");
   }

   //check if there are no errors in the form and if there are no errors in the form, update the data in the database
   if (count($errors) == 0) {
      //capitalize the first letter of the fullname, station and postal address
      $update_fullname = ucwords($update_fullname);
      $update_station = ucwords($update_station);
      $update_postaladdress = ucwords($update_postaladdress);

      $query = "UPDATE police SET fullname='$update_fullname', email='$update_email', phone='$update_phone', station='$update_station', postaladdress='$update_postaladdress' WHERE id='$update_p_id'";
      mysqli_query($conn, $query);
   }

   header('location:admin_create_user.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add police profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">


</head>

<body>

   <?php include 'admin_header.php'; ?>

   <div class="form-container">

      <form action="" method="post">


         <h3>Create police profile</h3>
         <input type="text" name="fullname" placeholder="enter your fullname" class="box">
         <input type="email" name="email" placeholder="enter your email" class="box">
         <input type="number" name="phone" placeholder="enter your phone number" class="box">
         <input type="number" name="workid" placeholder="enter your work id" class="box">
         <input type="text" name="station" placeholder="enter your station" class="box">
         <select name="gender" class="box">
            <option value="">Select Police Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
         </select>
         <input type="text" name="postaladdress" placeholder="enter your postal address" class="box">
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
            <option value="What was your dream job as a child?">What was your dream job as a child?</option>
            <option value="What are the last 5 digits of your credit card?">What are the last 5 digits of your credit card?</option>
            <option value="What is your grandmother's first name?">What is your grandmother's first name?</option>
            <option value="In what year was your mother born?">In what year was your mother born?</option>
            <option value="What time of the day were you born?">What time of the day were you born?</option>
            <option value="What is your current car registration number?">What is your current car registration number?</option>
         </select>
         <input type="text" name="security_answer" placeholder="enter your answer" class="box">
         <input type="submit" name="submit" value="Add User" class="btn">
      </form>

   </div>

   <section class="services-container">

      <?php
      $select_police = mysqli_query($conn, "SELECT * FROM `police`") or die('query failed');
      if (mysqli_num_rows($select_police) > 0) {
         while ($fetch_police = mysqli_fetch_assoc($select_police)) {
      ?>
            <div class="box">
               <div class="form-box">

                  <div class="box-content">

                     <h1 class="name"><?php echo $fetch_police['fullname']; ?></h1>
                     <h3 >ID: <?php echo $fetch_police['id']; ?></h3>
                     <h3 class="price">Police email: <?php echo $fetch_police['email']; ?></h3>
                     <h3 class="plateNumber">Police phone number: <?php echo $fetch_police['phone']; ?></h3>
                     <h3 class="description">Police workid: <?php echo $fetch_police['workid']; ?></h3>
                     <h3 class="mileage">Police station: <?php echo $fetch_police['station']; ?></h3>
                     <h3 class="mileage">Police gender: <?php echo $fetch_police['gender']; ?></h3>
                     <h3 class="mileage">Police postaladdress: <?php echo $fetch_police['postaladdress']; ?></h3>

                  </div>
               </div>
               <a href="admin_create_user.php?update=<?php echo $fetch_police['id']; ?>" class="option-btn">update</a>
               <a href="admin_create_user.php?delete=<?php echo $fetch_police['id']; ?>" class="delete-btn" onclick="return confirm('delete this police profile?');">delete</a>
            </div>
      <?php
         }
      } else {
         echo '<p class="empty">no police added yet!</p>';
      }
      ?>
      </div>

   </section>

   <section class="edit-product-form">

      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `police` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                  <input type="number" name="update_id" placeholder="enter id" class="box" value="<?php echo $fetch_update['id']; ?>">

                  <input type="text" name="update_fullname" value="<?php echo $fetch_update['fullname']; ?>" class="box" required placeholder="enter police name">
                  <input type="text" name="update_email" value="<?php echo $fetch_update['email']; ?>" class="box" required placeholder="enter police email">

                  <input type=number name="update_phone" value="<?php echo $fetch_update['phone']; ?>" class="box" required placeholder="enter phone">
                  <input type="text" name="update_station" value="<?php echo $fetch_update['station']; ?>" class="box" required placeholder="enter station">
                  <input type="text" name="update_postaladdress" value="<?php echo $fetch_update['postaladdress']; ?>" class="box" required placeholder="enter postaladdress">
                  <input type="submit" value="update" name="update_police" class="btn">
                  <input type="reset" value="cancel" id="close-update" class="option-btn">
               </form>

      <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>

   </section>
   <script src="js/admin_script.js"></script>

</body>

</html>