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
}
?>

<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="home.php" class="logo">I.L.E.M.S</a>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="admin_login.php">Admin</a>
                <a href="police_login.php">Police</a>
                <a href="login.php">Public</a>
                <a href="faqs.php">FAQs</a>
            </nav>
        </div>

    </div>

    </div>

</header>