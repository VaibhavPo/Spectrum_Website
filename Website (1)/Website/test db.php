<?php
include('Database_Quiz.php');
$image_path = "C:\\Users\\vaibh\\Downloads\\6.png"; // Escape backslashes
// Use forward slashes
;// Change this to your image file's path

// Read the image file and convert it to binary data
$image_data = base64_encode(file_get_contents($image_path));
$new="hii";
echo $image_data;

if ($image_data === false) {
    echo "Error reading image file.";
    exit;
}


// Prepare an SQL query to insert the image into the database
$sql = "INSERT INTO `dc` (`question_image`) VALUES ($new)";

if($mysqli->query($sql) === TRUE){
    echo "Image inserted successfully.";
} else {
    echo "Error inserting image: ";
}





?>