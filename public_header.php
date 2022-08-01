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

        <a href="public_index.php" class="logo">Public User Panel</a>

        <nav class="navbar">
            <a href="public_index.php">Home</a>
            <a href="public_add_case.php">File case</a>
            <a href="public_cases.php">View cases</a>
            <a href="public_reviews.php">Reviews and Recommendations</a>
            <!-- <a href="system_logs.php">System Logs</a> -->
        </nav>

        <div class="icons">
            <div id="menu-btn"><img src="images/menu.png"> </div>
            <div id="user-btn"><img src="images/user.png"></div>
        </div>

        <div class="account-box">
            <p>Full name : <span><?php echo $_SESSION['name']; ?></span></p>
            <p>Id number : <span><?php echo $_SESSION['idno']; ?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
        </div>

    </div>

</header>