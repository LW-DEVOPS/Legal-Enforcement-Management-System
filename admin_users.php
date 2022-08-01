<?php

include 'config.php';
include 'log.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   //only admin with admin_id=1 can delete other admins except himself
   if ($admin_id == 1) {
      $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$delete_id'");
      $row = mysqli_fetch_array($query);
      $name = $row['username'];

      $log = "Admin " . $_SESSION['admin_username'] . " deleted user id " . $delete_id . " with username " . $name;
      logger($log);

      $sql = "DELETE FROM users WHERE id = '$delete_id' AND user_type = 'admin'";
      $result = mysqli_query($conn, $sql);
      //show message if delete is successful
      $message[] = 'Admin deleted successfully';
      header('location:admin_users.php');
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="users">

      <h1 class="title"> police accounts </h1>

      <div class="box-container">
         <?php
         $select_police =   mysqli_query($conn, "SELECT * FROM police") or die('query failed');
         while ($fetch_police = mysqli_fetch_assoc($select_police)) {
         ?>
            <div class="box">
               <p> Police work_id : <span><?php echo $fetch_police['workid']; ?></span> </p>
               <p> Fullname : <span><?php echo $fetch_police['fullname']; ?></span> </p>
               <p> email : <span><?php echo $fetch_police['email']; ?></span> </p>
               <p> phone : <span><?php echo $fetch_police['phone']; ?></span> </p>
               <p> station : <span><?php echo $fetch_police['station']; ?></span> </p>
               <p> address : <span><?php echo $fetch_police['postaladdress']; ?></span> </p>
               <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this police?');" class="delete-btn">delete police</a>

            </div>
         <?php
         };
         ?>
      </div>

   </section>

   

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>