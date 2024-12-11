<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_request'])){
   $request_id = $_POST['request_id'];
   $update_status = $_POST['update_status'];
   mysqli_query($conn, "UPDATE `requests` SET status = '$update_status' WHERE id = '$request_id'") or die('Query failed');
   $message[] = 'Request status has been updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `requests` WHERE id = '$delete_id'") or die('Query failed');
   header('location:admin_sell_requests.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Sell Requests</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      .request-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
      }

      .card {
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         padding: 20px;
         width: 300px;
         position: relative;
         transition: transform 0.3s;
      }

      .card:hover {
         transform: translateY(-10px);
      }

      .card img {
         width: 100%;
         height: 150px;
         object-fit: cover;
         border-radius: 10px;
         margin-bottom: 15px;
      }

      .card p {
         margin: 10px 0;
         font-size: 14px;
      }

      .card .status {
         font-weight: bold;
         margin-top: 10px;
      }

      .card .action-buttons {
         display: flex;
         justify-content: space-between;
         margin-top: 15px;
      }

      .card .option-btn,
      .card .delete-btn {
         padding: 8px 15px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
         font-size: 14px;
         text-align: center;
      }

      .card .option-btn {
         background-color: #28a745;
         color: #fff;
      }

      .card .option-btn:hover {
         background-color: #218838;
      }

      .card .delete-btn {
         background-color: #dc3545;
         color: #fff;
      }

      .card .delete-btn:hover {
         background-color: #c82333;
      }

      .card select {
         padding: 8px;
         border-radius: 5px;
         border: 1px solid #ccc;
         font-size: 14px;
         width: 100%;
         margin-top: 10px;
      }
   </style>
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="placed-requests">

   <h1 class="title">Manage Sell Requests</h1>

   <div class="request-container">

      <?php
      $select_requests = mysqli_query($conn, "SELECT * FROM `requests`") or die('query failed');
      if(mysqli_num_rows($select_requests) > 0){
         while($fetch_request = mysqli_fetch_assoc($select_requests)){
      ?>
      <div class="card">
         <p>User ID: <span><?php echo $fetch_request['user_id']; ?></span></p>
         <p>Name: <span><?php echo $fetch_request['name']; ?></span></p>
         <p>Email: <span><?php echo $fetch_request['email']; ?></span></p>
         <p>Number: <span><?php echo $fetch_request['number']; ?></span></p>
         <p>Category: <span><?php echo $fetch_request['category']; ?></span></p>
         <p>Item Type: <span><?php echo $fetch_request['item_type']; ?></span></p>
         <p>Seed Type: <span><?php echo $fetch_request['seed_type']; ?></span></p>
         <p>Quantity: <span><?php echo $fetch_request['quantity']; ?> per Kg</span></p>
         <p>Price: <span>Rs. <?php echo $fetch_request['price']; ?></span></p>
         <p>Address: <span><?php echo $fetch_request['Address']; ?></span></p>
         <p class="status">Status: <span><?php echo $fetch_request['status']; ?></span></p>
         
         <form action="" method="post">
            <input type="hidden" name="request_id" value="<?php echo $fetch_request['id']; ?>">
            <select name="update_status">
               <option disabled selected><?php echo $fetch_request['status']; ?></option>
               <option value="pending">Pending</option>
               <option value="approved">Approved</option>
               <option value="rejected">Rejected</option>
            </select>
            <div class="action-buttons">
               <input type="submit" name="update_request" value="Update" class="option-btn">
               <a href="admin_sell_requests.php?delete=<?php echo $fetch_request['id']; ?>" class="delete-btn" onclick="return confirm('Delete this request?');">Delete</a>
            </div>
         </form>
      </div>
      <?php
         }
      } else {
         echo '<p class="empty">No sell requests found!</p>';
      }
      ?>
   </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>