<?php
ob_start();

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    exit();
}

include 'config.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Selling Requests</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <style>
       .manage-requests {
           display: flex;
           flex-wrap: wrap;
           gap: 20px;
       }
       
       .request-box1 {
           background-color: #f2f2f2;
           padding: 15px;
           border-radius: 8px;
           width: calc(33.33% - 20px);
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           border: 1px solid #ccc;
       }
       
       .request-box1 h2 { 
           font-size: 1.2rem;
           margin-bottom: 10px;
           border-bottom: 1px solid #ccc;
           padding-bottom: 5px;
       }
       
       .request-box1 p {
           margin: 8px 0;
           font-size: small;
       }
       
       .btn-group {
           display: flex;
           justify-content: space-between;
           margin-top: 10px;
       }
       
       .btn {
           padding: 8px 20px;
           border: none;
           border-radius: 4px;
           cursor: pointer;
       }
       
       .btn-approve {
           background-color: #4CAF50;
           color: white;
       }
       
       .btn-reject {
           background-color: #f44336;
           color: white;
       }
   </style>
</head>
<body>
   
<section class="heading">
    <h3>My Selling Requests</h3>
    <p> <a href="home.php">Home</a> / My Selling Requests </p>
</section>

<section class="manage-requests">
<?php

$conn = mysqli_connect('localhost', 'root', '', 'shop_db');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function deleteRequest($conn, $request_id) {
    $delete_query = "DELETE FROM `requests` WHERE `id` = '$request_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if (!$delete_result) {
        die('Deletion failed: ' . mysqli_error($conn));
    }

    return $delete_result;
}

function updateStatus($conn, $request_id, $status) {
    $update_query = "UPDATE `requests` SET `status` = '$status' WHERE `id` = '$request_id'";
    $update_result = mysqli_query($conn, $update_query);

    if (!$update_result) {
        die('Update failed: ' . mysqli_error($conn));
    }

    return $update_result;
}

if (isset($_POST['action']) && $_POST['action'] == 'Cancel') {
    $request_id = $_POST['request_id'];
    $delete_result = deleteRequest($conn, $request_id);

    if (!$delete_result) {
        die('Cancellation failed: ' . mysqli_error($conn));
    } else {
        header("Location: home.php");
        exit();
    }
}

$query = "SELECT * FROM `requests`";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='request-box1'>"; 
        echo "<h2>{$row['name']}'s Request</h2>";
        echo "<p>Name: <span>{$row['name']}</span></p>";
        echo "<p>Email: <span>{$row['email']}</span></p>";
        echo "<p>Number: <span>{$row['number']}</span></p>";
        echo "<p>Category: <span>{$row['category']}</span></p>";
        echo "<p>Seed Type: <span>{$row['seed_type']}</span></p>";
        echo "<p>Quantity: <span>{$row['quantity']}</span> Kg</p>";
        echo "<p>Price: <span>Rs. {$row['price']}</span></p>";
        echo "<p>Address: <span>{$row['Address']}</span></p>";
        echo "<p>Status: <span>{$row['status']}</span></p>";
        echo "<p>Created At: <span>{$row['created_at']}</span></p>";

        if ($row['status'] == 'pending') {
            echo "<form action='' method='POST' onsubmit=\"return confirm('Are you sure you want to cancel this request?');\">";
            echo "<input type='hidden' name='request_id' value='{$row['id']}'>";
            echo "<input type='submit' name='action' value='Cancel' class='btn'>";
            echo "</form>";
        } elseif ($row['status'] == 'approved') {
            echo "<p>Payment Method: <span>Cash on Delivery (COD)</span></p>";
            echo "<p>Pickup Schedule: <span>We will pick up the items in 4 days</span></p>";
        }

        echo "</div>";
    }
} else {
    echo '<p style="margin-left: 530px;" class="empty">Your Selling Request is empty</p>';
}

if (isset($_POST['action']) && $_POST['action'] == 'Approve') {
    $request_id = $_POST['request_id'];
    $update_result = updateStatus($conn, $request_id, 'approved');

    if (!$update_result) {
        die('Approval failed: ' . mysqli_error($conn));
    } else {
        header("Location: my_selling_requests.php");
        exit();
    }
}

mysqli_free_result($result);

mysqli_close($conn);
?>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>

<?php
ob_end_flush();
?>
