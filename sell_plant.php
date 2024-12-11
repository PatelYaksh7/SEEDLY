<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

$message = []; 

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $plant_type = mysqli_real_escape_string($conn, $_POST['plant_type']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $Address = mysqli_real_escape_string($conn, $_POST['Address']);
    
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image_name;

    $select_message = mysqli_query($conn, "SELECT * FROM `requests` WHERE name = '$name' AND email = '$email' AND number = '$number' AND category = '$category' AND quantity = '$quantity' AND price = '$price' AND Address = '$Address'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'Request already sent!';
    }else{
        if(move_uploaded_file($image_tmp_name, $image_folder)){
            mysqli_query($conn, "INSERT INTO `requests`(user_id, name, email, number, category, item_type, seed_type, quantity, price, Address, image) VALUES('$user_id', '$name', '$email', '$number', '$category', 'Plant', '$plant_type', '$quantity', '$price', '$Address', '$image_name')") or die('query failed');
            $message[] = 'Request sent successfully!';
        } else {
            $message[] = 'Failed to upload image!';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sell Plants</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
         const plantTypes = {
            "Vegetables": ["Tomato", "Carrot", "Broccoli", "Spinach"],
            "Fruits": ["Apple", "Banana", "Cherry", "Grapes"],
            "Herbs": ["Basil", "Cilantro", "Dill", "Mint"],
            "Flowers": ["Rose", "Lily", "Daisy", "Tulip"],
            "Small Trees": ["Bonsai", "Juniper", "Maple", "Pine"]
         };

         $('#category').change(function() {
            let category = $(this).val();
            let types = plantTypes[category] || [];
            $('#plant_type').empty().append('<option value="" disabled selected>Select plant type</option>');
            types.forEach(function(type) {
               $('#plant_type').append('<option value="' + type + '">' + type + '</option>');
            });
         });

      });
   </script>
   
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Sell Plants</h3>
    <p> <a href="home.php">home</a> / Sell Plants </p>
</section>

<section class="contact">

    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Sell Your Plants!</h3>
        <input type="text" name="name" placeholder="Enter your name" class="box" required> 
        <input type="email" name="email" placeholder="Enter your email" class="box" required>
        <input type="number" name="number" placeholder="Enter your number" class="box" required>
        <select name="category" id="category" class="box" required>
            <option value="" disabled selected>Select category</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Fruits">Fruits</option>
            <option value="Herbs">Herbs</option>
            <option value="Flowers">Flowers</option>
            <option value="Small Trees">Small Trees</option>
        </select>
        <select name="plant_type" id="plant_type" class="box" required>
            <option value="" disabled selected>Select plant type</option>
        </select>
        <input type="text" name="quantity" id="quantity" placeholder="Enter quantity" class="box" required>
        <input type="text" name="price" id="price" placeholder="Price" class="box">
        <textarea name="Address" class="box" placeholder="Enter Address" required cols="30" rows="10"></textarea>
        <input type="file" name="image" class="box" required>
        <input type="submit" value="Send Request" name="send" class="btn">
    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
