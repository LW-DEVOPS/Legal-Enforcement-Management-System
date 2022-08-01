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

        <a href="police_index.php" class="logo">police panel</a>

        <nav class="navbar">
            <a href="police_index.php">home</a>
            <a href="police_view_case.php">View case</a>
            <a href="police_statement_report.php">Investigation statement</a>
        </nav>

        <div class="icons">
            <div id="menu-btn"><img src="images/menu.png"> </div>
            <div id="user-btn"><img src="images/user.png"></div>
        </div>

        <div class="account-box">
            <p>fullname : <span><?php echo $_SESSION['name']; ?></span></p>
            <p>workid number : <span><?php echo $_SESSION['workid']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>