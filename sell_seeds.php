<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

$message = [];

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $seed_type = mysqli_real_escape_string($conn, $_POST['seed_type']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $Address = mysqli_real_escape_string($conn, $_POST['Address']);

    $select_message = mysqli_query($conn, "SELECT * FROM `requests` WHERE name = '$name' AND email = '$email' AND number = '$number' AND category = '$category'  AND seed_type = '$seed_type' AND quantity = '$quantity' AND price = '$price' AND Address = '$Address'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'Request already sent!';
    }else{
        mysqli_query($conn, "INSERT INTO `requests`(user_id, name, email, number, category, item_type, seed_type, quantity, price, Address) VALUES('$user_id', '$name', '$email', '$number', '$category', 'Seeds', '$seed_type', '$quantity', '$price', '$Address')") or die('query failed');
        $message[] = 'Request sent successfully!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sell Seeds or Plants</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
      $(document).ready(function() {
         const seedTypes = {
            "Grains": ["Wheat", "Rice", "Corn", "Barley", "Oats"],
            "Legumes": ["Soybeans", "Lentils", "Peas", "Chickpeas"],
            "Vegetables": ["Tomato", "Carrot", "Broccoli", "Spinach"],
            "Fruits": ["Apple", "Banana", "Cherry", "Grapes"],
            "Herbs": ["Basil", "Cilantro", "Dill", "Mint"]
         };

         $('#category').change(function() {
            let category = $(this).val();
            let types = seedTypes[category] || [];
            $('#seed_type').empty().append('<option value="" disabled selected>Select seed type</option>');
            types.forEach(function(type) {
               $('#seed_type').append('<option value="' + type + '">' + type + '</option>');
            });
         });

      });
   </script>

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Sell Seeds or Plants</h3>
    <p> <a href="home.php">home</a> / Sell Seeds or Plants </p>
</section>

<section class="contact">

    <form action="" method="POST">
        <h3>Sell Your Seeds or Plants!</h3>
        <input type="text" name="name" placeholder="Enter your name" class="box" required> 
        <input type="email" name="email" placeholder="Enter your email" class="box" required>
        <input type="number" name="number" placeholder="Enter your number" class="box" required>
        <select name="category" id="category" class="box" required>
            <option value="" disabled selected>Select category</option>
            <option value="Grains">Grains</option>
            <option value="Legumes">Legumes</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Fruits">Fruits</option>
            <option value="Herbs">Herbs</option>
        </select>
        <select name="seed_type" id="seed_type" class="box" required>
            <option value="" disabled selected>Select seed type</option>
        </select>
        <input type="text" name="quantity" id="quantity" placeholder="Enter quantity (e.g., grams)" class="box" required>
        <input type="text" name="price" id="price" placeholder="Price" class="box" >
        <textarea name="Address" class="box" placeholder="Enter Address" required cols="30" rows="10"></textarea>
        <input type="submit" value="Send Request" name="send" class="btn">
    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
