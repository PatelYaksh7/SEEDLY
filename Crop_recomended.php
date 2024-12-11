
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
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Crop Recommendation</h3>
    <p><a href="home.php">home</a> / Crop Recommendation</p>
</section>

<section class="contact">
    <form action="" method="POST">
        <h3>Crop Recommendation Check</h3>

        <input type="number" id="nitrogen" name="nitrogen" placeholder="Enter Nitrogen Level (N)" class="box" required>
        <input type="number" id="phosphorus" name="phosphorus" placeholder="Enter Phosphorus Level (P)" class="box" required>
        <input type="number" id="potassium" name="potassium" placeholder="Enter Potassium Level (K)" class="box" required>
        <input type="number" id="temperature" name="temperature" placeholder="Enter Temperature (°C)" class="box" required>
        <input type="number" id="humidity" name="humidity" placeholder="Enter Humidity (%)" class="box" required>
        <input type="number" id="ph" name="ph" placeholder="Enter pH Level" class="box" required>
        <input type="number" id="rainfall" name="rainfall" placeholder="Enter Rainfall (mm)" class="box" required>

        <input type="submit" value="Check Next Crop For Plant" name="send" class="btn">
    </form>
    <form action="" method="post" style="border:none; background: none;box-shadow:none;">
        <input type="submit" value="Hire The Researcher For Soil Reports" name="send_researcher" class="btn">
    </form>

    <br><br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['send_researcher'])) {
            header('Location: researcher_req.php');
            exit();
        }

        $nitrogen = $_POST['nitrogen'] ?? null;
        $phosphorus = $_POST['phosphorus'] ?? null;
        $potassium = $_POST['potassium'] ?? null;
        $temperature = $_POST['temperature'] ?? null;
        $humidity = $_POST['humidity'] ?? null;
        $ph = $_POST['ph'] ?? null;
        $rainfall = $_POST['rainfall'] ?? null;

        if (is_null($nitrogen) || is_null($phosphorus) || is_null($potassium) || 
            is_null($temperature) || is_null($humidity) || is_null($ph) || 
            is_null($rainfall)) {
            echo "<p class='empty'>Error: Missing required input data.</p>";
            exit;
        }

        // Prepare data to send to the Flask API
        $data = json_encode([
            'N' => $nitrogen,
            'P' => $phosphorus,
            'K' => $potassium,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'ph' => $ph,
            'rainfall' => $rainfall,
        ]);
        
        // Send data to Flask API using cURL
        $ch = curl_init('http://127.0.0.1:5000/predict');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        if ($result === FALSE) {
            $error = curl_error($ch);
            echo "<p class='empty'>Error: {$error}</p>";
        } else {
            $response = json_decode($result, true);

            // Check if the necessary prediction data is present
            if (isset($response['soil_quality_prediction'])) {
                echo "<p class='empty'>The recommended crop for you is: {$response['soil_quality_prediction']}</p>";
              
            } else {
                echo "<p class='empty'>Error: No prediction received. Response: " . print_r($response, true) . "</p>";
            }
        }
        
        curl_close($ch);
    }
    ?>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
