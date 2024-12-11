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
   <title>Farming Tips</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

   <style>
      .section {
          padding: 3rem 0;
          background: #f4f4f4;
      }

      .section .title {
          text-align: center;
          font-size: 2.5rem;
          margin-bottom: 2rem;
          color: #333;
      }

      .container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
          gap: 2rem;
          padding: 0 2rem;
      }

      .box1 {
          background: #fff;
          border-radius: 10px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
          overflow: hidden;
          transition: transform 0.3s ease;
      }

      .box1:hover {
          transform: translateY(-10px);
      }

      .box-content {
          padding: 2rem;
      }

      .box1 h3 {
          font-size: 1.8rem;
          color: #27ae60;
          margin-bottom: 1rem;
      }

      .box1 p {
          font-size: 1rem;
          color: #555;
          margin-bottom: 1.5rem;
      }

      .btn {
          display: inline-block;
          padding: 0.75rem 2rem;
          font-size: 1rem;
          color: #fff;
          background: #27ae60;
          border-radius: 5px;
          transition: background 0.3s ease;
          text-decoration: none;
      }

      .btn:hover {
          background: #2ecc71;
      }

      .icon {
          font-size: 2rem;
          color: #27ae60;
          margin-bottom: 1rem;
      }
   </style>
</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Farming Tips</h3>
    <p> <a href="home.php">home</a> / Farming Tips </p>
</section>

<section class="section tips">

    <h1 class="title">Farming Tips</h1>

    <div class="container">

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-leaf icon"></i>
                <h3>Tip 1: Soil Health</h3>
                <p>Maintain soil health by regularly testing soil quality and using organic compost and fertilizers to ensure your crops get the best nutrients.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-sync-alt icon"></i>
                <h3>Tip 2: Crop Rotation</h3>
                <p>Practice crop rotation to avoid soil depletion and reduce pests and diseases, which helps maintain soil fertility and crop health.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-tint icon"></i>
                <h3>Tip 3: Water Management</h3>
                <p>Implement efficient water management techniques like drip irrigation to conserve water and ensure your crops receive adequate hydration.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-bug icon"></i>
                <h3>Tip 4: Pest Control</h3>
                <p>Use integrated pest management (IPM) strategies to control pests in an eco-friendly manner, minimizing the use of harmful chemicals.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-seedling icon"></i>
                <h3>Tip 5: Sustainable Practices</h3>
                <p>Adopt sustainable farming practices to enhance productivity and protect the environment, ensuring long-term agricultural success.</p>
            </div>
        </div>

    </div>

</section>

<section class="section issues">

    <h1 class="title">Common Issues & Solutions</h1>

    <div class="container">

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-exclamation-triangle icon"></i>
                <h3>Issue: Soil Erosion</h3>
                <p>Solution: Use cover crops and contour plowing to reduce soil erosion and maintain soil structure.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-bug icon"></i>
                <h3>Issue: Pest Infestation</h3>
                <p>Solution: Introduce natural predators and use IPM techniques to control pest populations effectively.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-water icon"></i>
                <h3>Issue: Water Scarcity</h3>
                <p>Solution: Implement rainwater harvesting and drip irrigation to optimize water use and reduce waste.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-thermometer-half icon"></i>
                <h3>Issue: Climate Change</h3>
                <p>Solution: Grow climate-resilient crops and adopt sustainable farming practices to mitigate climate impact.</p>
            </div>
        </div>

    </div>

</section>

<section class="section success-stories">

    <h1 class="title">Success Stories</h1>

    <div class="container">

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-award icon"></i>
                <h3>John Doe's Organic Farm</h3>
                <p>John transformed his farm by adopting organic practices, leading to higher yields and healthier crops.</p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-award icon"></i>
                <h3>Jane Smith's Sustainable Practices</h3>
                <p>Jane implemented sustainable farming techniques, which significantly reduced her farm's carbon footprint.</p>
            </div>
        </div>

    </div>

</section>

<section class="section resources">

    <h1 class="title">Resource Links</h1>

    <div class="container">

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-book icon"></i>
                <h3>Farming Guide</h3>
                <p><a href="https://www.example.com/farming-guide" class="btn">Read More</a></p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-video icon"></i>
                <h3>Video Tutorials</h3>
                <p><a href="https://www.example.com/video-tutorials" class="btn">Watch Now</a></p>
            </div>
        </div>

        <div class="box1">
            <div class="box-content">
                <i class="fas fa-file-alt icon"></i>
                <h3>Research Papers</h3>
                <p><a href="https://www.example.com/research-papers" class="btn">Explore</a></p>
            </div>
        </div>

    </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
