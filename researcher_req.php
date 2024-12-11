<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit; // Always call exit after header to stop further script execution
}

// Fetch research types and their prices from the database
$query = "SELECT * FROM research_types";
$result = mysqli_query($conn, $query);
$research_types = [];
while ($row = mysqli_fetch_assoc($result)) {
    $research_types[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_request'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $Address = $_POST['Address'];

    $research_type = $_POST['research_type'];

    if (empty($name) || empty($email) || empty($mobile) || empty($research_type)) {
        echo "<p class='empty'>Error: All fields are required.</p>";
        exit;
    }

    // Insert the request into the database
    $query = "INSERT INTO researcher_requests (user_id, name, email, mobile_number,Address, research_type, status, request_date) 
              VALUES ('$user_id', '$name', '$email', '$mobile','$Address', '$research_type', 'Pending', NOW())";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Your research request has been successfully submitted.'); window.location.href = 'home.php';</script>";
        exit; // Ensure no further script execution
    } else {
        echo "<p class='empty'>Error: Could not submit request. Please try again later.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hire Researcher</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <script>
      function updatePrice() {
          var researchType = document.getElementById('research_type').value;

          var researchTypes = <?php echo json_encode($research_types); ?>;
          var selectedResearch = researchTypes.find(function(item) {
              return item.research_type === researchType;
          });

          if (selectedResearch) {
            document.getElementById('price').value = selectedResearch.price + " Rs";
          } else {
              document.getElementById('price').value = '';
          }
      }
   </script>
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Hire Researcher for Soil Check</h3>
    <p> <a href="home.php">home</a> / Hire Researcher </p>
</section>

<section class="contact">
    <form action="" method="POST">
        <h3>Request Researcher Services</h3>
        
        <input type="text" name="name" placeholder="Enter Your Name" class="box" required>
        <input type="email" name="email" placeholder="Enter Your Email" class="box" required>
        <input type="text" name="mobile" placeholder="Enter Your Mobile Number" class="box" required>
        <input type="textarea" name="Address" placeholder="Enter Your Address" class="box" required>
        
        <select name="research_type" id="research_type" class="box" required onchange="updatePrice()">
            <option value="">Select Check Type</option>
            <?php
            foreach ($research_types as $research) {
                echo "<option value='{$research['research_type']}'>{$research['research_type']}</option>";
            }
            ?>
        </select>

        <input type="text" id="price" name="price" placeholder="Price" class="box" disabled >

        <input type="submit" value="Submit Request" name="submit_request" class="btn">
    </form>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
