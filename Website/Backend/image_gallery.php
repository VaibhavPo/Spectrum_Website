<!DOCTYPE html>
<html>

<head>
  <title>Image Gallery</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-wrap: wrap;
      text-align: center;
    }

    h1 {
      margin-left: 35vw;
      margin-right: 35vw;
    }

    .image-container {
      width: 200px;
      margin: 10px;
      text-align: center;

    }

    .image {
      max-width: 100%;
      border: 1px solid #ccc;
    }

    .centered_div {
      text-align: center;
      /* border: 1px solid #000; */
      padding: 20px;
    }
    .message{
      position: fixed;
      color: green;
    }
  </style>
</head>

<body>
  <h1>Image Gallery Backend</h1>
  <div id="message-container" class="message"></div>
  <div class='centered_div'>
    <script>
      async function loadImages() {
        const imageContainer = document.getElementById('image-container');

        try {
          const response = await fetch('images_get.php');
          const data = await response.json();

          imageContainer.innerHTML = '';

          data.images.forEach((imageData, index) => {
            const imageDiv = document.createElement('div');
            imageDiv.className = 'image-container';

            const image = document.createElement('img');
            image.src = imageData.url;
            image.className = 'image';

            const serialNumber = document.createElement('p');
            serialNumber.textContent = 'Image ' + (index + 1);

            const replaceButton = document.createElement('button');
            replaceButton.textContent = 'Replace';
            replaceButton.onclick = function () {
              if (!replaceButton.dataset.clicked) {
                const newImageInput = document.createElement('input');
                newImageInput.type = 'file';
                newImageInput.accept = 'image/*';
                newImageInput.onchange = function (event) {
                  handleImageReplace(event, index, replaceButton);
                };
                imageDiv.appendChild(newImageInput);
                replaceButton.dataset.clicked = true;
              }
            };

            imageDiv.appendChild(image);
            // imageDiv.appendChild(serialNumber);
            imageDiv.appendChild(replaceButton);

            imageContainer.appendChild(imageDiv);
          });
        } catch (error) {
          console.error('Error fetching images:', error);
        }
      }

      async function handleImageReplace(event, index, replaceButton) {
        const newImageFile = event.target.files[0];
        if (newImageFile) {
          const formData = new FormData();
          formData.append('index', index);
          formData.append('newImage', newImageFile);

          try {
            const response = await fetch('replace_image.php', {
              method: 'POST',
              body: formData
            });
            const data = await response.json();

            if (data.success) {
              // Refresh images after replacement
              loadImages();
              showMessage('Image replaced successfully!', 'success');
            } else {
              console.error('Image replacement failed.');
            }
          } catch (error) {
            console.error('Image replacement error:', error);
          }
        }
      }

      function showMessage(message, type) {
        const messageContainer = document.getElementById('message-container');
        messageContainer.textContent = message;
        messageContainer.className = 'message ' + type;
        setTimeout(() => {
          messageContainer.textContent = '';
          messageContainer.className = 'message';
        }, 3000);
      }

      window.onload = loadImages;
    </script>

    <div id="image-container"></div>
    
  </div>
</body>

</html>