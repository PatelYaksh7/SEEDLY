<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Farming Workshop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Workshop</h3>
    <p> <a href="home.php">home</a> / Workshop </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="https://img.freepik.com/free-photo/greenhouse-farmer-holding-laptop-talking-with-african-american-worker-holding-crate-with-fresh-lettuce-talking-about-delivery-bio-farm-plant-growers-preparing-deliver-online-order-client_482257-47493.jpg" alt="Farming Workshop">
        </div>

        <div class="content">
            <h3>Why choose our farming workshop?</h3>
            <p>Join our farming workshop to learn the latest sustainable farming practices. Our expert instructors will guide you through hands-on activities and provide valuable insights into modern farming techniques.</p>
            <a href="join.php" class="btn">Join Now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>What we provide?</h3>
            <p>Our workshop covers a wide range of topics including organic farming, crop rotation, soil health, and more. We provide all necessary materials and resources to ensure a comprehensive learning experience.</p>
            <a href="contact.php" class="btn">Contact Us</a>
        </div>

        <div class="image">
            <img src="https://www.shutterstock.com/image-photo/apprentice-greenhouse-learning-about-organic-600nw-1609314088.jpg" alt="Farming Tools">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="https://www.shutterstock.com/image-photo/apprentice-greenhouse-learning-about-organic-600nw-1609314088.jpg" alt="Farming Community">
        </div>

        <div class="content">
            <h3>Who we are?</h3>
            <p>We are a community of farmers and agricultural experts dedicated to promoting sustainable farming practices. Our mission is to educate and empower farmers to achieve better yields and improve their livelihoods.</p>
            <a href="#reviews" class="btn">Client Reviews</a>
        </div>

    </div>

</section>

<section class="workshop-details">

    <h1 class="title">Upcoming Workshops</h1>

    <div class="box-container">

        <div class="box1">
            <div class="box-content">
                <h3>Workshop on Organic Farming</h3>
                <p><strong>Date:</strong> 25th July 2024</p>
                <p><strong>Time:</strong> 10:00 AM - 2:00 PM</p>
                <a href="join.php" class="btn">Join Now</a>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <h3>Soil Health and Management</h3>
                <p><strong>Date:</strong> 1st August 2024</p>
                <p><strong>Time:</strong> 11:00 AM - 3:00 PM</p>
                <a href="join.php" class="btn">Join Now</a>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <h3>Modern Crop Rotation Techniques</h3>
                <p><strong>Date:</strong> 15th August 2024</p>
                <p><strong>Time:</strong> 9:00 AM - 1:00 PM</p>
                <a href="join.php" class="btn">Join Now</a>
            </div>
        </div>

    </div>

</section>

<style>
.workshop-details {
    padding: 2rem 0;
    background: #f9f9f9;
}

.workshop-details .title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 2rem;
    color: #333;
}

.box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
}

.box1 {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    max-width: 300px;
    width: 100%;
}

.box1:hover {
    transform: translateY(-10px);
}

.box-content {
    padding: 1.5rem;
    text-align: center;
}

.box1 h3 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 1rem;
}

.box1 p {
    font-size: 1rem;
    color: #777;
    margin-bottom: 1rem;
}

.box1 p strong {
    color: #333;
}


</style>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
