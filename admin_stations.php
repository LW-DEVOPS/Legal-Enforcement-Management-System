<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

//initializing variables
$errors = array();

if (isset($_POST['add_car'])) {
   $stationname = mysqli_real_escape_string($conn, $_POST['stationname']);
   $county = mysqli_real_escape_string($conn, $_POST['county']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);

   $select_station_name = mysqli_query($conn, "SELECT name FROM `police_station` WHERE name = '$stationname'") or die('query failed');

   //station name validation, it can contain letters, numbers,underscore, dash and space only and should not be empty , it should be unique in the database
   if (empty($stationname)) {
      array_push($errors, "station name is required");
   } else if (!preg_match("/^[a-zA-Z0-9_\-\s]*$/", $stationname)) {
      array_push($errors, "station name should contain only letters, numbers, underscore, dash and space");
   } else if (mysqli_num_rows($select_station_name) > 0) {
      array_push($errors, "station name already exists");
   }

   //county validation, it can contain letters
   if (empty($county)) {
      array_push($errors, "county is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $county)) {
      array_push($errors, "county should contain only letters");
   }

   //location validation, it can contain letters
   if (empty($location)) {
      array_push($errors, "location is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $location)) {
      array_push($errors, "location should contain only letters");
   }

   //phone validation, it can contain numbers and should be between 6 and 15 digits long
   if (empty($phone)) {
      array_push($errors, "phone is required");
   } else if (!preg_match("/^[0-9]{6,15}$/", $phone)) {
      array_push($errors, "phone should contain only numbers and should be between 6 and 15 digits long");
   }

   //genarate a random five letter or number code for the station
   $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

   //check if there are no errors in the form and if there are no errors in the form, insert the data into the database

   if (count($errors) == 0) {
      //capitalize the first letter of the station name, county and location
      $stationname = ucfirst($stationname);
      $county = ucfirst($county);
      $location = ucfirst($location);
      $query = "INSERT INTO `police_station` (`name`, `county`, `location`, `phone`, `code`) VALUES ('$stationname', '$county', '$location', '$phone', '$code')";
      $result = mysqli_query($conn, $query);
      if ($result) {
         echo "<script>alert('station added successfully');</script>";
      } else {
         echo "<script>alert('error adding station');</script>";
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $query = "SELECT name FROM `police_station` WHERE id = '$delete_id'";
   $result = mysqli_query($conn, $query);
   while ($row = mysqli_fetch_array($result)) {
      $name = $row['name'];
   }

   mysqli_query($conn, "DELETE FROM `police_station` WHERE id = '$delete_id'") or die('query failed');
   $message[] = "station deleted successfully";
   header('location:admin_stations.php');
}

if (isset($_POST['update_station'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_county = $_POST['update_county'];
   $update_location = $_POST['update_location'];
   $update_phone = $_POST['update_phone'];

   //station name validation, it can contain letters, numbers,underscore, dash and space only and should not be empty , it should be unique in the database
   if (empty($update_name)) {
      array_push($errors, "station name is required");
   } else if (!preg_match("/^[a-zA-Z0-9_\-\s]*$/", $update_name)) {
      array_push($errors, "station name should contain only letters, numbers, underscore, dash and space");
   }

   //county validation, it can contain letters
   if (empty($update_county)) {
      array_push($errors, "county is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $update_county)) {
      array_push($errors, "county should contain only letters");
   }

   //location validation, it can contain letters
   if (empty($update_location)) {
      array_push($errors, "location is required");
   } else if (!preg_match("/^[a-zA-Z]*$/", $update_location)) {
      array_push($errors, "location should contain only letters");
   }

   //phone validation, it can contain numbers and should be between 10 and 15 digits long
   if (empty($update_phone)) {
      array_push($errors, "phone is required");
   } else if (!preg_match("/^[0-9]{10,15}$/", $update_phone)) {
      array_push($errors, "phone should contain only numbers and should be between 10 and 15 digits long");
   }

   //check if there are no errors in the form and if there are no errors in the form, update the data in the database
   if (count($errors) == 0) {
      //capitalize the first letter of the station name, county and location
      $update_name = ucfirst($update_name);
      $update_county = ucfirst($update_county);
      $update_location = ucfirst($update_location);

      $query = "UPDATE `police_station` SET `name` = '$update_name', `county` = '$update_county', `location` = '$update_location', `phone` = '$update_phone' WHERE `id` = '$update_p_id'";
      $result = mysqli_query($conn, $query);
      if ($result) {
         echo "<script>alert('station updated successfully');</script>";
      } else {
         echo "<script>alert('error updating station');</script>";
      }
   }

   header('location:admin_stations.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Police Station</title>
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <!-- station CRUD section starts  -->

   <section class="add-products">

      <h1 class="title">Police station</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <?php if (count($errors) > 0) : ?>
            <div class="error">
               <?php foreach ($errors as $error) : ?>
                  <p><?php echo $error ?></p>
               <?php endforeach ?>
            </div>
         <?php endif ?>
         <h3>add station</h3>
         <input type="text" name="stationname" class="box" placeholder="station Name">
         <input type="county" name="county" class="box" placeholder="county">
         <input type="text" name="location" class="box" placeholder="location">
         <input type=number name="phone" class="box" placeholder="phone">
         <input type="submit" value="add station" name="add_car" class="btn">
      </form>

   </section>

   <!-- station CRUD section ends -->

   <!-- show police stations  -->

   <section class="services-container">

      <?php
      $select_station = mysqli_query($conn, "SELECT * FROM `police_station`") or die('query failed');
      if (mysqli_num_rows($select_station) > 0) {
         while ($fetch_station = mysqli_fetch_assoc($select_station)) {
      ?>
            <div class="box">
               <div class="form-box">

                  <div class="box-content">

                     <h1 class="name"><?php echo $fetch_station['name']; ?></h1>
                     <h3 class="price">County: <?php echo $fetch_station['county']; ?></h3>
                     <h3 class="plateNumber">station location: <?php echo $fetch_station['location']; ?></h3>
                     <h3 class="description">station code: <?php echo $fetch_station['code']; ?></h3>
                     <h3 class="mileage">station phone: <?php echo $fetch_station['phone']; ?></h3>
                  </div>
               </div>
               <a href="admin_stations.php?update=<?php echo $fetch_station['id']; ?>" class="option-btn">update</a>
               <a href="admin_stations.php?delete=<?php echo $fetch_station['id']; ?>" class="delete-btn" onclick="return confirm('delete this police station?');">delete</a>
            </div>
      <?php
         }
      } else {
         echo '<p class="empty">no police station added yet!</p>';
      }
      ?>
      </div>

   </section>

   <section class="edit-product-form">

      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `police_station` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">

                  <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter station name">
                  <input type="text" name="update_county" value="<?php echo $fetch_update['county']; ?>" class="box" required placeholder="enter vehicle plate number">
                  <input type="text" name="update_location" value="<?php echo $fetch_update['location']; ?>" class="box" required placeholder="enter location">
                  <input type=number name="update_phone" value="<?php echo $fetch_update['phone']; ?>" class="box" required placeholder="enter phone">
                  <input type="submit" value="update" name="update_station" class="btn">
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
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>