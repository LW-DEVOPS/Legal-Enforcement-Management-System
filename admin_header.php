<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <img src="images/arrow.png" alt="remove" onclick="this.parentElement.remove();">
      </div>
      ';
    }

    if (isset($errors)) {
        foreach ($errors as $error) {
            echo '
        <div class="message">
             <span>' . $error . '</span>
             <img src="images/arrow.png" alt="remove" onclick="this.parentElement.remove();">
        </div>
        ';
        }
    }
}
?>

<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">AdminPanel</a>

        <nav class="navbar">
            <a href="admin_page.php">home</a>
            <a href="admin_stations.php">Stations</a>
            <a href="admin_create_user.php">police</a>
            <a href="admin_cases.php">cases</a>
            <a href="admin_reviews.php">Reviews</a>
            <!-- <a href="system_logs.php">System Logs</a> -->
        </nav>

        <div class="icons">
            <div id="menu-btn"><img src="images/menu.png"> </div>
            <div id="user-btn"><img src="images/user.png"></div>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['username']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>