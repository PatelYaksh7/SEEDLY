<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $product_type = $_POST['product_type'];
    $table_name = ($product_type == 'seeds') ? 'seeds' : 'plants';

    mysqli_query($conn, "UPDATE `$table_name` SET name = '$name', details = '$details', price = '$price' WHERE id = '$update_p_id'") or die('query failed');

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $old_image = $_POST['update_p_image'];

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $message[] = 'Image file size is too large!';
        } else {
            mysqli_query($conn, "UPDATE `$table_name` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($image_tmp_name, $image_folder);
            if (file_exists('uploaded_img/' . $old_image)) {
                unlink('uploaded_img/' . $old_image);
            }
            $message[] = 'Image updated successfully!';
        }
    }

    $message[] = 'Product updated successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="update-product">
    <?php
    $update_id = isset($_GET['update']) ? $_GET['update'] : '';
    $product_type = isset($_GET['type']) ? $_GET['type'] : '';

    $table_name = ($product_type == 'seeds') ? 'seeds' : 'plants';

    $select_products = mysqli_query($conn, "SELECT * FROM `$table_name` WHERE id = '$update_id'") or die('query failed');
    if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image" alt="">
                <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
                <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
                <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="Update product name" name="name">
                <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="Update product price" name="price">
                <textarea name="details" class="box"  placeholder="Update product details" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>

                <select name="product_type" class="box" required>
                    <option value="" disabled>Select type</option>
                    <option value="plants" <?php if ($product_type == 'plants') { echo 'selected'; } ?>>Plants</option>
                    <option value="seeds" <?php if ($product_type == 'seeds') { echo 'selected'; } ?>>Seeds</option>
                </select>

                <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
                <input type="submit" value="Update Product" name="update_product" class="btn">
                <a href="admin_products.php" class="option-btn">Go back</a>
            </form>
            <?php
        }
    } else {
        echo '<p class="empty">No update product selected</p>';
    }
    ?>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
