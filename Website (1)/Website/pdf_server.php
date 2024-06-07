<?php
if (isset($_GET['image'])) {
    $imageFilename = $_GET['image'];
    $imagesDirectory = 'http://localhost/website/PDF'; // Relative path to PDF files (outside web root)
    $imagePath = $imagesDirectory . '/' . $imageFilename;

    if (file_exists($imagePath)) {
        // Set appropriate headers for PDF file
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $imageFilename . '"');
        readfile($imagePath);
    } else {
        // File not found, handle the error (e.g., display an error message)
        echo 'File not found. ';
        echo $imagePath;
    }
}
?>
