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
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no,shrink-to-fit=no">

  <title>Image Display</title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="button.css">
  <link rel="stylesheet" href="style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/Favicons">
    <link rel="icon" type="image/png" sizes="32x32" href="Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Assets/Favicons/favicon-16x16.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,700,600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    .imgContainer {
      position: relative;
      /* Add positioning */
      width: 90%;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;

      overflow: hidden;
      border: border: 1px solid #ccc;
      border-radius: 1%;
      box-shadow: 4px 4px rgb(173, 224, 220, .5);
    }

    .imgContainer img {
      max-width: 90%;
      max-height: 90%;
      width: auto;
      height: auto;
      border: border: 1px solid rgb(129, 208, 200);
      border-radius: 5px;
      box-shadow: 2px 2px rgb(129, 208, 200, .8);
    }

    .full-screen {
      position: absolute;
      /* Position the button */
      top: 10px;
      right: 10px;

    }

    @media print {
      body {
        display: none;
      }

    }

    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      user-select: none;
      -webkit-user-select: none;
      /* For Safari */
      -moz-user-select: none;
      /* For older Firefox versions */
      -ms-user-select: none;
      /* For Internet Explorer/Edge */
    }

    img.no-select-drag {
      user-select: none;
      -webkit-user-select: none;
      /* For Safari */
      -moz-user-select: none;
      /* For older Firefox versions */
      -ms-user-select: none;
      /* For Internet Explorer/Edge */
      pointer-events: none;

    }

    #overlay {
      position: absolute;
      display: flex;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      align-items: center;
      justify-content: center;
      opacity: 1;
      pointer-events: none;



    }

    #overlay.active {
      opacity: 0;
      pointer-events: auto;
    }
  </style>



<!-- <script>if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    // Redirect mobile users to a different page
    window.location.href = "mobile-not-supported.html";
}
</script> -->
</head>

<body oncontextmenu="return false" ;, onbeforeprint="return false" ; user-select: none;>

<div class="nav-secondary">
    <a href="home.html" class="logo">
      <img src="Assets/icon.png" alt="Logo" width="30" height="30" id="logo-secondary">
    </a>
    <h2>Image Display</h2>
  </div>
  <a href="see more img.php" style="color:rgb(121, 152, 195);">Back to Image Gallery</a>


  <!-- <form action="Image_display.php" method="POST">
  <input type="text" name="image" value="your_image_filename.jpg">
  <input type="submit" value="Get Image">
</form> -->

  <?php
  if (isset($_GET['image'])) {
    $imageFilename = $_GET['image'];
    $imagesDirectory = 'images'; // Relative path to images folder
    $imagePath = $imagesDirectory . '/' . $imageFilename;

    // Encode the PDF URL
    $encodedPdfUrl = base64_encode($imagePath);

    // Display the embedded image
    echo '<div class="imgContainer bgcolor-white" id="container">';
    echo '<div id="overlay">';
    echo "<img id='pdfImage' alt='image'>"; // Decode the URL in JavaScript
    echo '<div id="pdf-container" class="pdf_canvas"></div>';
    echo '</div>';
}  ?> 
<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['image'])) {
//         $imageFilename = $_POST['image'];
//         $imagesDirectory = 'image'; // Relative path to images folder
//         $imagePath = $imagesDirectory . '/' . $imageFilename;

//         // Display the embedded image
//         echo '<div class="imgContainer bgcolor-white " id="container">';
//         echo ' <div id="overlay">';
//         // Output the image using an <img> tag
//         echo "<script>var pdfUrl = atob('$encodedPdfUrl');</script>";
//         echo '</div>';
//     }
// }
// ?>

  <button class=" full-screen primary padd_10-10" onclick="toggleFullscreen()">
    <i class="fa-solid fa-expand fa-xl" style="color: #ffffff;"></i><!-- Font Awesome expand icon -->
  </button>

  </div>

  <div class="bg-color-bluish"style="height: 20px;"></div>

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
    let keyState = {};

    document.addEventListener("keydown", e => {
      keyState[e.key] = true;

      // Check if 'A' key is being held down
      if (keyState['Meta'] || keyState['Shift'] || keyState['Alt'] || keyState['PrintScreen']) {
        screennot();
        // console.log("key pressed")

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
  <script>


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
    var encodedPdfUrl = '<?php echo $encodedPdfUrl; ?>'; // Get the encoded PDF URL from PHP
    var pdfUrl = atob(encodedPdfUrl); // Decode the URL in JavaScript
    document.getElementById("pdfImage").src = pdfUrl; // Set the src attribute of the img element
</script>
</body>

</html>