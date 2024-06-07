<!DOCTYPE html>
<html>
<head>
  <title>Image Gallery</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    
    .image-container {
      display: inline-block;
      margin: 10px;
      text-align: center;
    }

    .image {
      max-width: 100%;
      border: 1px solid #ccc;
    }

    .serial-number {
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <h1>Image Gallery margin</h1>

  <?php
    $imageFiles = glob('images/*.*'); // Get all image files in the "images" folder

    foreach ($imageFiles as $index => $imageFile) {
      echo '<div class="image-container">';
      echo '<img class="image" src="' . $imageFile . '" alt="Image ' . ($index + 1) . '">';
      echo '<p class="serial-number">Image ' . ($index + 1) . '</p>';
      echo '</div>';
    }
  ?>
</body>
</html>
