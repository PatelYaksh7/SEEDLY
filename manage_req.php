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
   <title>My Requests</title>

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
           background-color: #A4DD25;
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
    <h3>My Requests</h3>
    <p><a href="home.php">Home</a> / My Requests</p>
</section>

<!-- Researcher Requests Section -->
<section class="manage-requests">
<?php
$query = "SELECT * FROM `researcher_requests` WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
if (isset($_POST['action']) && $_POST['action'] == 'Cancel') {
    $request_id = $_POST['request_id'];
    $delete_query = "DELETE FROM `researcher_requests` WHERE `request_id` = '$request_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if (!$delete_result) {
        die('Deletion failed: ' . mysqli_error($conn));
    }

    if (!$delete_result) {
        die('Cancellation failed: ' . mysqli_error($conn));
    } else {
        header("Location: manage_req.php");
        exit();
    }
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='request-box1'>";
        echo "<h2>{$row['name']}'s Research Request</h2>";
        echo "<p>Name: <span>{$row['name']}</span></p>";
        echo "<p>Email: <span>{$row['email']}</span></p>";
        echo "<p>Mobile: <span>{$row['mobile_number']}</span></p>";
        echo "<p>Address: <span>{$row['Address']}</span></p>";
        echo "<p>Research Type: <span>{$row['research_type']}</span></p>";
        echo "<p>Status: <span>{$row['status']}</span></p>";
        echo "<p>Request Date: <span>{$row['request_date']}</span></p>";

        if ($row['status'] == 'Pending') {
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='request_id' value='{$row['request_id']}'>";
            echo "<input type='submit' name='action' value='Cancel' class='btn btn-approve'>";
            echo "</form>";
        } elseif ($row['status'] == 'Reject') {
            echo "<p>Your research request is Reject.</p>";
        } elseif ($row['status'] == 'Approved') {
            echo "<p>Your research request is Approved. We Will Contact You Soon</p>";
        }
        echo "</div>";
    }
} else {
    echo '<p class="empty">No Researcher Requests Found</p>';
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
