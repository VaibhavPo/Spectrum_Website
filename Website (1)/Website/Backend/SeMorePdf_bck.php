<!DOCTYPE html>
<html>
<head>
    <title>PDF Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Background color */
        }

        h1 {
            color: #333;
        }

        .pdf-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 20px; /* Add some top margin for spacing */
        }

        .link-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
        }

        .link-container a {
            text-decoration: none;
            color: #333;
        }

        .link-container:hover {
            background-color: #f0f0f0; /* Hover background color */
        }

        .upload-form {
            margin: 20px 0;
            text-align: center;
        }

        .upload-form label {
            font-weight: bold;
        }

        .upload-form input[type="file"],
        .upload-form input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .upload-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-form button:hover {
            background-color: #0056b3;
        }

        .deletion-form {
            margin: 20px 0;
            text-align: center;
        }

        .deletion-form label {
            font-weight: bold;
        }

        .deletion-form select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .deletion-form button {
            background-color: #ff3333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .deletion-form button:hover {
            background-color: #ff0000;
        }

        .alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4CAF50;
            color: #fff;
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
        alertMessage.textContent = message;
        alertMessage.style.backgroundColor = color;
        alertMessage.style.display = "block";

        setTimeout(function() {
            alertMessage.style.display = "none";
        }, 3000); // Display for 3 seconds
    }
</script>

<h1>PDF Management</h1>
<div class="pdf-links">
    <?php
    $pdfDirectory = '../PDF'; // Updated path to PDF folder (one directory back)

    // Get the list of PDF files in the directory
    $pdfFiles = scandir($pdfDirectory);

    foreach ($pdfFiles as $filename) {
        if ($filename !== '.' && $filename !== '..') {
            // Display a link for each PDF file
            echo '<div class="link-container">';
            echo '<a href="' . $pdfDirectory . '/' . $filename . '">' . $filename . '</a>';
            echo '</div>';
        }
    }
    ?>
</div>

<?php
$pdfDirectory = '../PDF'; // Updated path to PDF folder (one directory back)

// Handle PDF upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['newPDF']) && isset($_POST['pdfName'])) {
        $newPDF = $_FILES['newPDF'];
        $pdfName = $_POST['pdfName'];

        $destinationPath = $pdfDirectory . '/' . $pdfName;
        move_uploaded_file($newPDF['tmp_name'], $destinationPath);
        echo "<script>showAlert('Upload Success...', 'green')</script>";
    }
}

// Handle PDF deletion
if (isset($_POST['deletePDF'])) {
    $pdfToDelete = $_POST['deletePDF'];
    $pdfPathToDelete = $pdfDirectory . '/' . $pdfToDelete;
    if (file_exists($pdfPathToDelete)) {
        unlink($pdfPathToDelete);

        echo "<script>showAlert('Deletion Success...', 'green')</script>";
    }
}
?>

<h2>Upload New PDF</h2>
<form class="upload-form" method="post" enctype="multipart/form-data">
    <label for="newPDF">Select PDF:</label>
    <input type="file" id="newPDF" name="newPDF" accept="application/pdf" required>
    <br>
    <label for="pdfName">PDF Name:</label>
    <input type="text" id="pdfName" name="pdfName" required>
    <br>
    <button type="submit">Upload</button>
</form>

<h2>Deletion</h2>
<form class="deletion-form" method="post" enctype="multipart/form-data">
    <label for="deletePDF">Select PDF to Delete:</label>
    <select id="deletePDF" name="deletePDF" required>
        <?php
        foreach ($pdfFiles as $filename) {
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
