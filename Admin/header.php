<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

    <div class="flex">

        <a href="home.php"  class="logo">Seedly.</a>

        <nav class="navbar">
            <ul>
                <li><a href="#">shop</a>
                <ul>
                    <li><a href="seeds.php">Seeds</a></li>
                    <li><a href="plants.php">Plants</a></li>
                    <li><a href="sell_seeds.php">Sell Seeds</a></li>
                    <li><a href="sell_plant.php">Sell Plants</a></li>
                    <li><a href="manage_requests.php">Manage Requests</a></li>
                </ul>
                <li><a href="contact.php">contact</a></li>
            </li>
            <li><a href="soil_quality.php">Predictions</a></li>

            <li><a href="#">Order</a>
                <ul>
                <li><a href="orders.php">orders</a></li>
                    <li><a href="manage_req.php">Researcher Request</a></li>

                </ul>
            </li>

                <li><a href="workshope.php">Workshope</a></li>
                <li><a href="tips.php">Tips</a></li>
                <li><a href="#">account +</a>
    <ul>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <li><a href="login.php">login</a></li>
            <li><a href="register.php">register</a></li>
        <?php else: ?>
            <li><a href="profile.php">profile</a></li>
            <li><a href="logout.php">logout</a></li>
        <?php endif; ?>
    </ul>
</li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>