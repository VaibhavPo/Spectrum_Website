<?php
$connection = mysqli_connect('localhost', 'root', '', 'chemistry website');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageId = $_POST['imageId'];  // Received from AJAX request
    $newPosition = $_POST['newPosition'];  // Received from AJAX request

    // Update the position in the database
    $updateQuery = "UPDATE image_order SET position = '$newPosition' WHERE id = '$imageId'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
