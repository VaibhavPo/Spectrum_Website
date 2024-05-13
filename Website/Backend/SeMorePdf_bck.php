<?php
// Set initial values for result and result_msg
$result = 'blue';
$result_msg = '5';
?>

<!DOCTYPE html>
<html>
<head>
  <title>PDF Management</title>
  <style>
    .image-links {
      display: flex;
      flex-direction: column;
      text-align: center;
      gap: .5rem;
    }  

    .alert {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
   
      text-align: center;
      padding: 10px;
      font-size: 18px;
      display: none;
    }
  </style>
</head>
<body>
<div class="alert" id="alertMessage"></div> <!-- Here the alert message will reflect. -->

<script>
    // JavaScript function to show alert message
    function showAlert(message, color) {
      const alertMessage = document.getElementById("alertMessage");
      // alertMessage.textContent = "";
      // alertMessage.style.color = "";
      alertMessage.textContent = message;
      alertMessage.style.color = color;
      alertMessage.style.display = "block";

      setTimeout(function() {
        alertMessage.style.display = "none";
      }, 3000); // Display for 3 seconds
    }

 </script>

  <h1>PDF Management</h1>
  <div class="image-links">
    <?php
    $imagesDirectory = '../PDF'; // Updated path to images folder (one directory back)

    // Get the list of image files in the directory
    $images = scandir($imagesDirectory);

    foreach ($images as $filename) {
      if ($filename !== '.' && $filename !== '..') {
        // Display a link for each image file
        echo '<div class="link-container">';
        echo '<a href="' . $imagesDirectory . '/' . $filename . '">' . $filename . '</a>';
        echo '</div>';
      }
    }
    ?>
  </div>

  <?php
  $imagesDirectory = '../PDF'; // Updated path to images folder (one directory back)

  // Handle image upload
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['newImage']) && isset($_POST['imageName'])) {
      $newImage = $_FILES['newImage'];
      $imageName = $_POST['imageName'];

      $destinationPath = $imagesDirectory . '/' . $imageName;
      move_uploaded_file($newImage['tmp_name'], $destinationPath);
      echo "<script>showAlert('Upload Success...','green')</script>";
    }
  }

  // Handle image deletion
  if (isset($_POST['deleteImage'])) {
    $imageToDelete = $_POST['deleteImage'];
    $imagePathToDelete = $imagesDirectory . '/' . $imageToDelete;
    if (file_exists($imagePathToDelete)) {
      unlink($imagePathToDelete);

      echo "<script>showAlert('Deletion Success...','green')</script>";
    }
 
  }
  ?>

  <h2>Upload New PDF</h2>
  <form method="post" enctype="multipart/form-data">
    <label for="newImage">Select PDF:</label>
    <input type="file" id="newImage" name="newImage" accept="application/pdf" required>
    <br>
    <label for="imageName">File Name:</label>
    <input type="text" id="imageName" name="imageName" required>
    <br>
    <button type="submit">Upload</button>
  </form>

  <h2>Deletion</h2>
  <form method="post" enctype="multipart/form-data">
    <label for="deleteImage">Select PDF to Delete:</label>
    <select id="deleteImage" name="deleteImage" required>
      <?php
      foreach ($images as $filename) {
        if ($filename !== '.' && $filename !== '..') {
          echo '<option value="' . $filename . '">' . $filename . '</option>';
        }
      }
      ?>
    </select>
    <br>
    <button type="submit">Delete</button>
  </form>
</body>
</html>
