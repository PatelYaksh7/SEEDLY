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
          <a href="Crop_Rotation.php" class="active" data-active="3">
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
    <h1>Total Report Genrate</h1>
    <div class="row">
      <div class="column" style="width: 100%;">
        <div class="card" style="background-color: white; border-radius: 5px;">
          <?php
          $farming_api_url = 'http://localhost:5000/predict';

          function call_api($data) {
              global $farming_api_url;
              
              $ch = curl_init($farming_api_url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
              
              $response = curl_exec($ch);

              if (curl_errno($ch)) {
                  $error_msg = curl_error($ch);
                  curl_close($ch);
                  return ['error' => "cURL Error: $error_msg"];
              }

              curl_close($ch);
              
              return json_decode($response, true);
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $input_data = [
                  'N' => (int)$_POST['N'],
                  'P' => (int)$_POST['P'],
                  'K' => (int)$_POST['K'],
                  'temperature' => (int)$_POST['temperature'],
                  'humidity' => (int)$_POST['humidity'],
                  'ph' => (float)$_POST['ph'],
                  'rainfall' => (int)$_POST['rainfall'],
              ];

              $response = call_api($input_data);

              $data_to_send = [
                  'input_data' => $input_data,
                  'response' => $response
              ];

              header('Location: ../test_pdf.php?' . http_build_query($data_to_send));
              exit;
          } else {
              echo '<form method="POST">';
              echo '<table>';
              echo '<tr><td>N (Nitrogen):</td><td><input type="number" name="N" required></td></tr>';
              echo '<tr><td>P (Phosphorus):</td><td><input type="number" name="P" required></td></tr>';
              echo '<tr><td>K (Potassium):</td><td><input type="number" name="K" required></td></tr>';
              echo '<tr><td>Temperature (°C):</td><td><input type="number" name="temperature" required></td></tr>';
              echo '<tr><td>Humidity (%):</td><td><input type="number" name="humidity" required></td></tr>';
              echo '<tr><td>pH:</td><td><input type="number" step="0.1" name="ph" required></td></tr>';
              echo '<tr><td>Rainfall (mm):</td><td><input type="number" name="rainfall" required></td></tr>';
              echo '<tr><td colspan="2" style="text-align:center;"><input type="submit" class="button-1" value="Submit"></td></tr>';
              echo '</table>';
              echo '</form>';
          }
          ?>
        </div>
      </div>
    </div>
  </main>

  <script src="app.js"></script>
</body>

</html>
