

<?php
include "config/config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <style>
    th,
    td {
      padding: 15px;
      text-align: left;
      color: black;
    }

    select {
      width: 100%;
      padding: 4px;
      outline: none;
    }

    input {
      padding: 4px;
      outline: none;
    }

    .button-1 {
      background-color: #3d5af1;
      border-radius: 8px;
      border-style: none;
      box-sizing: border-box;
      color: #FFFFFF;
      cursor: pointer;
      display: inline-block;
      font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 14px;
      font-weight: 500;
      width: 100%;
      height: 40px;
      line-height: 20px;
      list-style: none;
      margin: 0;
      outline: none;
      padding: 10px 16px;
      position: relative;
      text-align: center;
      text-decoration: none;
      transition: color 100ms;
      vertical-align: baseline;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
    }

    .button-1:hover,
    .button-1:focus {
      background-color: #3d5af1;
    }

    .btn {
      padding: 8px;
      background-color: green;
      border-radius: 5px;
      outline: none;
      border: none;
      color: white;
    }
  </style>
</head>

<body>
  <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="./img/logo.png" class="logo" alt="">
      <h3 class="hide">Researcher</h3>
    </div>

<br><br>

    <div class="sidebar-links">
      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="index.php" class="active" data-active="0">
          <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Dashbord</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="Crop_Rotation.php" data-active="3">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Report Genrate</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="add_research.php" data-active="3">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Add Research Type</span>
          </a>
        </li>
      </ul>
      <ul>
        <div class="tooltip">
          <span class="show">Tasks</span>
          <span>Help</span>
          <span>Settings</span>
        </div>

      </ul>
    </div>

  </nav>
  <main>
    <h1>Researche Request's</h1>
    <div class="row">
      <div class="column" style="width: 100%;">
        <div class="card" style="background-color: white;border-radius: 5px;">
        <table class="table" border="1" cellspacing="0" cellpadding="10">
  <thead>
    <tr>
      <th>Name</th>
      <th>Service Type</th>
      <th>Date</th>
      <th>Location</th>
      <th>Price</th>
      <th>Status</th>
      <th>Approve</th>
      <th>Reject</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT r.request_id, r.user_id, r.research_type, r.request_date, r.email, r.mobile_number, r.Address, r.status, rt.price 
    FROM researcher_requests r
    JOIN research_types rt ON r.research_type = rt.research_type";      
    $result = mysqli_query($conn, $sql);
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $userId = $row["user_id"];
        $serviceName = htmlspecialchars($row["research_type"]);
        $date = htmlspecialchars($row["request_date"]);
        $email = htmlspecialchars($row["email"]);
        $mobile = htmlspecialchars($row["mobile_number"]);
        $Address = htmlspecialchars($row["Address"]);
        $price = htmlspecialchars($row["price"]);
        
        $status = $row["status"];
        $status_text = ($status == 'Pending') ? "Pending" : (($status == 'Reject') ? "Reject" : "Approved");

        // Fetching user's full name
        $userResult = mysqli_query($conn, "SELECT * FROM users WHERE id='$userId'");
        $userName = mysqli_fetch_assoc($userResult)['name'];

        echo "
        <tr>
          <td>".htmlspecialchars($userName)."</td>
          <td>$serviceName</td>
          <td>$date</td>
          <td>$Address</td>
          <td>$price Rs.</td>
          <td>$status_text</td>
          <td><a href='approve.php?request_id={$row["request_id"]}'><button class='btn'>Approve</button></a></td>
          <td><a href='reject.php?request_id={$row["request_id"]}'><button class='btn' style='background-color:red;'>Reject</button></a></td>
        </tr>";
      }
    } else {
      echo "<tr><td colspan='8'>Error fetching data</td></tr>";
    }
    ?>
  </tbody>
</table>

        </div>
      </div>
    </div>
  </main>

  <script src="app.js"></script>
</body>

</html>