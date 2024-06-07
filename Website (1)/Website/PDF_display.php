<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($userAgent, 'Mobile') !== false) {
    // This is a mobile device
    // You can redirect, display a message, or perform other actions
    header("Location:/Website/startbootstrap-coming-soon-gh-pages/index.html");
  exit;
    
} else {
    // This is not a mobile device (e.g., desktop)
    // You can serve the regular desktop content
}
?>

<!DOCTYPE html>
<!-- ... rest of your HTML code ... -->

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">

  <title>View PDF</title>
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/Favicons">
    <link rel="icon" type="image/png" sizes="32x32" href="Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Assets/Favicons/favicon-16x16.png">
  <!-- To edit and display pdf and toolbar -->
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="button.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="PDF_display.css">
  <link rel="stylesheet" href="See more css.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,700,600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js"
    integrity="sha512-hoZmP5l0sJQzHzkXQS3ZCj/H7bOn8JKmbHd/s2trPUoMcvPaBfLSE9/92cpwYzcXBaEtVT/aCQ9P97rkTSWqcw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    // Redirect mobile users to a different page
    window.location.href = "mobile-not-supported.html";
}
</script>


</head>

<body oncontextmenu="return false" ;, onbeforeprint="return false" ; user-select: none;>

<div class="nav-secondary">
    <a href="home.html" class="logo">
      <img src="Assets/icon.png" alt="Logo" width="30" height="30" id="logo-secondary">
    </a>
    <h2>PDF Display</h2>
  </div>
  <a href="see more img.php" style="color:rgb(121, 152, 195);">Back to PDF Gallery</a>


  <?php
if (isset($_GET['image'])) {
    $imageFilename = $_GET['image'];
    $imagesDirectory = 'PDF'; // Relative path to images folder
    $imagePath = $imagesDirectory . '/' . $imageFilename;

    // Encode the PDF URL
    $encodedPdfUrl = base64_encode($imagePath);

    // Display the embedded image
    echo '<div class="imgContainer bgcolor-white" id="container">';
    echo '<div id="overlay">';
    echo "<script>var pdfUrl = atob('$encodedPdfUrl');</script>"; // Decode the URL in JavaScript
    echo '<div id="pdf-container" class="pdf_canvas"></div>';
    echo '</div>';
}
?>

  <!-- <iframe src="your_pdf_file.pdf#toolbar=0" width="100%" height="800px"></iframe> -->


  <button class=" full-screen primary padd_5-5" onclick="toggleFullscreen()">
    <i class="fa-solid fa-expand fa-xl" style="color: #ffffff;"></i> <!-- Font Awesome expand icon -->
  </button>
  <div class="pdf_control">
    <div class="pdf-controls-left">
      <button id="prev-page" class="primary" >
        <</button>
          
          <input id="pageno" class="search-input"type="text" size="1" placeholder="Page No.">
          <button id="next-page" class="primary" >></button>
    </div>
    <div class="pdf-controls-right">
      <button id="zoom-in" class="primary padd-10-10">Zoom In</button>
      <button id="zoom-out" class="primary padd-10-10">Zoom Out</button>
    </div>
  </div>



  <div id="pdf-container"></div>
  </div>



  <script src="pdf_viewer.js"></script>
  <div class="bgcolor-bluish" style=" height: 50px;"></div>
  <footer class="footer" style="margin-top:auto">
    <div class="social-icons">
      <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
      <!-- Add more social media icons as needed -->
    </div>
    <div class="footerText">
      Thank You For visiting us.

    </div>
    <div class="footerText">
      <a href="mailto:bc@gmail.com" class="mail">For support</a>
    </div>
  </footer>


  <script>
    console.log("pdfUrl :", pdfUrl);

    const overlay = document.getElementById('overlay');
    function screennot() {
      overlay.classList.add('active');
      setTimeout(() => {
        alert("Please do not take ScreenShot.")
        overlay.classList.remove('active');
      }, 3000);
    }

    button.addEventListener('click', () => {
      overlay.classList.add('active');
      setTimeout(() => {
        overlay.classList.remove('active');

      }, 1000); // 3000 milliseconds = 3 seconds
      // alert("Say no to PrintScreen");
    });
  </script>

  <script>


    let keyState = {};

    document.addEventListener("keydown", e => {
      keyState[e.key] = true;

      // Check if 'A' key is being held down
      if (keyState['Meta']) {
        screennot();

      }
    });

    document.addEventListener("keyup", e => {
      keyState[e.key] = false;
    });

    window.addEventListener('beforeprint', function (e) {
      e.preventDefault();

      alert("Printing is discouraged for this page.\nIf you still want than please contact to the owner.");
    });
  </script>
  <script>

    // Function to toggle full screen
    function toggleFullscreen() {
      const element = document.documentElement; // Full page
      const Container = document.getElementById('container')

      if (document.fullscreenElement) {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      } else {
        if (Container.requestFullscreen) {
          Container.requestFullscreen();
        }
      }
    }
  </script>
<script>var decodedPdfUrl = window.atob(pdfUrl);</script>

</body>

</html>