  <?php
  $result = '';
  $imagesDirectory = 'images'; // Relative path to images folder
  
  // Handle image upload
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['newImage']) && isset($_POST['imageName'])) {
      $newImage = $_FILES['newImage'];
      $imageName = $_POST['imageName'];

      $destinationPath = $imagesDirectory . '/' . $imageName;
      move_uploaded_file($newImage['tmp_name'], $destinationPath);
    }
  }
  // Handle image deletion
  if (isset($_POST['deleteImage'])) {
    $imageToDelete = $_POST['deleteImage'];
    $imagePathToDelete = $imagesDirectory . '/' . $imageToDelete;
    if (file_exists($imagePathToDelete)) {
      unlink($imagePathToDelete);
      // Respond with a JSON object containing the result and message
      $response = array(
        'result' => 'green',
        'message' => 'Deletion success'
      );
      header('Content-Type: application/json');
      echo json_encode($response);
      exit;
    }
  }
  header("Location: SeMoreImg_bck.php");
  ?>