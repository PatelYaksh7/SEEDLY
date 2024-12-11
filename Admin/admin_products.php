<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['add_product'])) {
    $product_type = mysqli_real_escape_string($conn, $_POST['product_type']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $table_name = ($product_type == 'seeds') ? 'seeds' : 'plants';

    $select_product_name = mysqli_query($conn, "SELECT name FROM `$table_name` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists!';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $insert_product = mysqli_query($conn, "INSERT INTO `$table_name` (name, details, price, image) VALUES ('$name', '$details', '$price', '$image')") or die('query failed');
            if ($insert_product) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Product added successfully!';
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $table_name = $_GET['table'];

    $select_delete_image = mysqli_query($conn, "SELECT image FROM `$table_name` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);

    if (file_exists('uploaded_img/' . $fetch_delete_image['image'])) {
        unlink('uploaded_img/' . $fetch_delete_image['image']);
    }

    mysqli_query($conn, "DELETE FROM `$table_name` WHERE id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');

    header('location:admin_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <section class="add-products">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add New Product</h3>
            <select name="product_type" class="box" required>
                <option value="" disabled selected>Select product type</option>
                <option value="seeds">Seeds</option>
                <option value="plants">Plants</option>
            </select>
            <input type="text" class="box" required placeholder="Enter product name" name="name">
            <input type="number" min="0" class="box" required placeholder="Enter product price as per KG" name="price">
            <textarea name="details" class="box" required placeholder="Enter product details" cols="30" rows="10"></textarea>
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
            <input type="submit" value="Add Product" name="add_product" class="btn">
        </form>
    </section>

    <section class="show-products">
        <div class="box-container">
            <?php
            $tables = ['seeds', 'plants'];
            foreach ($tables as $table) {
                $select_products = mysqli_query($conn, "SELECT * FROM `$table`") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                        <div class="box">
                            <div class="price">
                                Rs. <?php echo $fetch_products['price']; ?>/-
                                <?php echo ($table == 'seeds') ? 'Per KG' : 'Per Plant'; ?>
                            </div>
                            <img style="width: 90%;height:100%;" class="image" src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                            <div class="name"><?php echo $fetch_products['name']; ?> (<?php echo ucfirst($table); ?>)</div>
                            <div class="details"><?php echo $fetch_products['details']; ?></div>
                            <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>&type=<?php echo $table; ?>" class="option-btn">Update</a>
                            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>&table=<?php echo $table; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </section>

    <script src="../js/admin_script.js"></script>

</body>

</html>