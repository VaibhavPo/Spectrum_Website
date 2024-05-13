<!DOCTYPE html>
<html>
<head>
  <title>File Links</title>
  <style>
    .linkCon{
       padding: 0px;
    }
    </style>
</head>
<body>
  <h1>File Links</h1>

  <?php
  $filesDirectory = __DIR__; // Replace 'files' with your folder name
  $files = scandir($filesDirectory);

  foreach ($files as $filename) {
    if ($filename !== '.' && $filename !== '..') {
      $filePath = 'http://localhost/website/' . $filename;
      echo '<a href="' . $filePath . '"><div class="linkCon">' . $filename . '</div></a><br>';
    }
  }
  ?>

</body>
</html>
