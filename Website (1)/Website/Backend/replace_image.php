<?php
$imagesDirectory = 'images'; // Relative path to images folder

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index']) && isset($_FILES['newImage'])) {
    $index = $_POST['index'];
    $newImage = $_FILES['newImage'];
    
    $images = scandir($imagesDirectory);
    if (isset($images[$index + 2])) { // +2 to account for "." and ".." entries
        $existingImage = $images[$index + 2];
        $imagePath = $imagesDirectory . '/' . $existingImage;
        
        // Delete the existing image
        unlink($imagePath);
        
        // Move the new image to the images directory
        move_uploaded_file($newImage['tmp_name'], $imagePath);
        
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
} else {
    echo json_encode(array('success' => false));
}
?>
