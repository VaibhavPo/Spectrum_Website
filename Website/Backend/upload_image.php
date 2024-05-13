<?php
 $connection = mysqli_connect('localhost', 'root', '', 'chemistry website');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['newImage'])) {
    $imagesDirectory = 'images';

    $newImage = $_FILES['newImage'];
    $filename = $newImage['name'];
    $uploadPath = $imagesDirectory . '/' . $filename;
    
    $imageName = $_POST['imageName']; // Get the image name from the text box

    // Upload the image to the server
    if (move_uploaded_file($newImage['tmp_name'], $uploadPath)) {
        // Insert image details into the database with an initial position
        $insertQuery = "INSERT INTO image_order (filename, position, image_name) VALUES ('$filename', 9999, '$imageName')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
            header("Location: bck testingimg.php"); // Redirect back to the main page
            exit;
        } else {
            echo "Error inserting data into the database.";
        }
    } else {
        echo "Error uploading the image.";
    }
}
?>
