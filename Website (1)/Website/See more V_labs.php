<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 ,shrink-to-fit=no">
  <title>Image Links with Search</title>
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/Favicons">
  <link rel="icon" type="image/png" sizes="32x32" href="Assets/Favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="Assets/Favicons/favicon-16x16.png">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="button.css">
  <link rel="stylesheet" href="See more css.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,700,600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body style="min-height: 100vh;">
  <div class="nav-secondary">
    <a href="home.html" class="logo">
      <img src="Assets/icon.png" alt="Logo" width="30" height="30" id="logo-secondary">
    </a>
    <h2>V Labs Gallery</h2>
  </div>

  <div id="search-container">
    <input type="text" class="search-input" id="search-input" placeholder="Search for image...">
    <button id="search-icon" class="primary" style="height:43px;"><i class="fas fa-search"></i></button>
  </div>

  <?php
  $imagesDirectory = '../Simulations'; // Relative path to images folder
  
  // Get the list of image files in the directory
  $images = scandir($imagesDirectory);

  foreach ($images as $filename) {
    if ($filename !== '.' && $filename !== '..') {
      // Create links that lead to the image display page
      echo '<div class="slider-box">';
      echo '<a href="'.$imagesDirectory.'/'.$filename.'">' . $filename . '</a></div>';
    }
  }
  ?>
  <div id="nosearch" style=" display: none;">
    <img src="Assets/nF.gif" class="img" alt="No Match" />
  </div>
  <script>
    const searchInput = document.getElementById('search-input');
    const sliderBoxes = document.querySelectorAll('.slider-box');
    const noFound = document.getElementById('nosearch');
    // let no_match=1;

    // Create an array to store the content of each slider box
    const sliderBoxContent = Array.from(sliderBoxes).map(sliderBox => ({
      sliderBox,
      link: sliderBox.querySelector('a'),
      linkText: sliderBox.querySelector('a').textContent.toLowerCase()
    }));

    const performSearch = () => {
      const searchTerm = searchInput.value.toLowerCase();
      let match_found = false;
      sliderBoxContent.forEach(({ sliderBox, link, linkText }) => {
        const linkMatches = linkText.includes(searchTerm);

        if (linkMatches) {
          link.style.display = 'block';
          sliderBox.style.display = 'block';
          match_found = true;
        } else {
          link.style.display = 'none';
          sliderBox.style.display = 'none';
        }

      });
      if (!match_found) {

        noFound.style.display = 'block';
        console.log("No match found");
      }
      else {
        noFound.style.display = 'none';
      }
    };



    searchInput.addEventListener('keyup', event => {
      if (event.key === 'Enter') {
        performSearch();
      }
    });

    // Initial display on page load
    sliderBoxContent.forEach(({ sliderBox }) => {
      sliderBox.style.display = 'block';
    });
  </script>
  <div style="background-color:#F4F8FC; height: 20px;"></div>

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

</body>

</html>