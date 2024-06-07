<?php
$imagesDirectory = 'images'; // Relative path to images folder

$images = array();
if ($handle = opendir($imagesDirectory)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $images[] = array(
                'url' => $imagesDirectory . '/' . $entry,
                'filename' => $entry
            );
        }
    }
    closedir($handle);
}

echo json_encode(array('images' => $images));
?>
