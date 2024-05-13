<?php
$imagesDirectory = 'path_to_your_images_folder'; // Replace with the actual path to your images folder

$images = array();
if ($handle = opendir($imagesDirectory)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $images[] = $imagesDirectory . '/' . $entry;
        }
    }
    closedir($handle);
}

echo json_encode(array('images' => $images));
?>
