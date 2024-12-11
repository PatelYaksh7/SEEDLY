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
    p {
      color: black;
    }

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
          <a href="index.php"  data-active="0">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Dashboard</span>
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
          <a href="add_research.php"  class="active" data-active="3">
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
    <h1>Add Research Type</h1>
    <div class="row">
      <div class="column" style="width: 100%;">
        <div class="card" style="background-color: white; border-radius: 5px;">
        <form action="" method="post">
  <table>
    <tr>
      <th><label for="research_type">Research Type:</label></th>
      <td><input type="text" id="research_type" name="research_type" placeholder="Enter research type" required></td>
    </tr>
    <tr>
      <th><label for="price">Price:</label></th>
      <td><input type="number" id="price" name="price" placeholder="Enter price" required></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center;">
        <button type="submit" class="button-1" name="submit">Add Research Type</button>
      </td>
    </tr>
  </table>
</form>

        </div>
      </div>
    </div>
  </main>
  <?php
    @include './config/config.php';

    if (isset($_POST['submit'])) {
      $research_type = mysqli_real_escape_string($conn, $_POST['research_type']);
      $price = mysqli_real_escape_string($conn, $_POST['price']);

      $query = "INSERT INTO `research_types`(`research_type`, `price`) VALUES ('$research_type', '$price')";
      
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Research type added successfully!');</script>";
      } else {
        echo "<script>alert('Error: Could not add research type.');</script>";
      }
    }
?>

  <script src="app.js"></script>
</body>

</html>
