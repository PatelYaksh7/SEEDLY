   <?php

   @include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id'];

   if(!isset($user_id)){
      header('location:login.php');
   }

   if(isset($_POST['add_to_wishlist'])){

      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_type = $_POST['product_type']; 

      $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if(mysqli_num_rows($check_wishlist_numbers) > 0){
         $message[] = 'already added to wishlist';
      }else{
         mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
         $message[] = 'product added to wishlist';
      }

   }

   if(isset($_POST['add_to_cart'])){

      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
      $product_type = $_POST['product_type']; 


      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if(mysqli_num_rows($check_cart_numbers) > 0){
         $message[] = 'already added to cart';
      }else{

         $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

         if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
         }

         mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image, product_type) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image', '$product_type')") or die('query failed'); // Include product_type
         $message[] = 'product added to cart';
      }

   }

   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>home</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <link rel="stylesheet" href="css/style.css">

   </head>
   <body>
      
   <?php @include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>new collections</h3>
         <p>Discover the freshest selections in seeds and plants curated just for you. Our new collections feature a variety of high-quality seeds and vibrant plants that cater to all types of gardeners, whether you're a beginner or an experienced farmer.</p>
         <a href="about.php" class="btn">discover more</a>
      </div>

   </section>

      <section class="products">

         <h1 class="title">latest products</h1>

         <div class="box-container">

            <?php
               $select_plants = mysqli_query($conn, "SELECT * FROM `plants` LIMIT 3") or die('query failed');
               if(mysqli_num_rows($select_plants) > 0){
                  while($fetch_plants = mysqli_fetch_assoc($select_plants)){
            ?>
            <form action="" method="POST" class="box">
               <a href="view_page.php?pid=<?php echo $fetch_plants['id']; ?>&type=plants" class="fas fa-eye"></a>
               <div class="price">Rs. <?php echo $fetch_plants['price']; ?>/- Per Plant</div>
               <img src="uploaded_img/<?php echo $fetch_plants['image']; ?>" alt="" class="image">
               <div class="name"><?php echo $fetch_plants['name']; ?></div>
               <input type="number" name="product_quantity" value="1" min="0" class="qty">
               <input type="hidden" name="product_id" value="<?php echo $fetch_plants['id']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $fetch_plants['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_plants['price']; ?>">
               <input type="hidden" name="product_type" value="plants">
               <input type="hidden" name="product_image" value="<?php echo $fetch_plants['image']; ?>">
               <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
                  }
               }

               $select_seeds = mysqli_query($conn, "SELECT * FROM `seeds` LIMIT 3") or die('query failed');
               if(mysqli_num_rows($select_seeds) > 0){
                  while($fetch_seeds = mysqli_fetch_assoc($select_seeds)){
            ?>
            <form action="" method="POST" class="box">
               <a href="view_page.php?pid=<?php echo $fetch_seeds['id']; ?>&type=seeds" class="fas fa-eye"></a>
               <div class="price">Rs. <?php echo $fetch_seeds['price']; ?>/- Per Kg</div>
               <img src="uploaded_img/<?php echo $fetch_seeds['image']; ?>" alt="" class="image">
               <div class="name"><?php echo $fetch_seeds['name']; ?></div>
               <input type="number" name="product_quantity" value="1" min="0" class="qty">
               <input type="hidden" name="product_id" value="<?php echo $fetch_seeds['id']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $fetch_seeds['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_seeds['price']; ?>">
               <input type="hidden" name="product_type" value="seeds">
               <input type="hidden" name="product_image" value="<?php echo $fetch_seeds['image']; ?>">
               <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
                  }
               } else {
                  echo '<p class="empty">no products added yet!</p>';
               }
            ?>

         </div>

         <div class="more-btn">
            <a href="shop.php" class="option-btn">load more</a>
         </div>

      </section>

   <section class="home-contact">

      <div class="content">
         <h3>have any questions?</h3>
         <p>If you have any questions or need further assistance, feel free to reach out to us through our contact form or directly via email. We look forward to hearing from you!</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </section>

   <?php @include 'footer.php'; ?>

   <script src="js/script.js"></script>

   </body>
   </html>
