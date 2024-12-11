<?php
include "config/config.php";

// Get the request_id from the URL
$request_id = $_GET["request_id"];

// Update the status of the request to 'In Progress' (or any other desired status)
$sql = "UPDATE `researcher_requests` SET `status`='Approved' WHERE request_id='$request_id'";

$result = mysqli_query($conn, $sql);

if($result) {
    // Redirect to the index page after successful update
    header("Location: index.php");
    exit();
} else {
    // Display an error message if the update fails
    echo "Error updating record: " . mysqli_error($conn);
}
?>
