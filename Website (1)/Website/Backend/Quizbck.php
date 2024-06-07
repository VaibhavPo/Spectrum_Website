<!DOCTYPE html>
<html>

<head>
    <title>Quiz Form</title>
    <style>
        /* Reset default margins and padding */
        body, h1, p, ul {
            margin: 0;
            padding: 0;
        }

        /* Style for the container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Style for tabs */
        .tab {
            display: none;
        }

        /* Style for the tab buttons */
        .tab-button {
            cursor: pointer;
            padding: 10px 20px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
            margin-right: 5px;
        }

        /* Active tab button */
        .active {
            background-color: #fff; /* Change background color for the active tab */
            border-bottom: none; /* Remove the bottom border for active tab */
        }

        /* Style for the tab content */
        .tab-content {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }

        /* Style for the form elements */
        label, textarea, input[type="file"], input[type="number"], input[type="text"] {
            display: block;
            margin-bottom: 10px;
        }

        /* Style for the submit button */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Center the submit button */
        .submit-button-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quiz Form</h1>
            <form action="insert_quiz.php" method="post" enctype=multipart/form-data>
        <?php
        $quiz_name = $_GET['quiz_name'];
        echo "<input type='hidden' name='quiz_name' value='$quiz_name'>";

        ?>
        <div class="tab-container">
            <div class="tab-button active" onclick="openTab('textTab')">Text</div>
            <div class="tab-button" onclick="openTab('imageTab')">Image</div>
        </div>

        <div id="textTab" class="tab">
            <label for="question_text">Question Text:</label>
            <textarea name="question_text" rows="8" cols="100"></textarea>
        </div>

        <div id="imageTab" class="tab">
            <label for="question_image">Upload Image:</label>
            <input type="file" name="question_image" accept="image/*">
        </div>

        <label for="marks">Marks:</label>
        <input type="number" name="marks" value="1">

        <label for="option1">Option 1:</label>
        <input type="text" name="option1" value="A">

        <label for="option2">Option 2:</label>
        <input type="text" name="option2" value="B">

        <label for="option3">Option 3:</label>
        <input type="text" name="option3" value="C">

        <label for="option4">Option 4:</label>
        <input type="text" name="option4" value="D">

        <label for="correct_answer">Correct Answer (Option Number):</label>
        <input type="number" name="correct_answer" required>

        <div class="submit-button-container">
            <input type="submit" value="Submit">
        </div>
        </form>
    </div>
      
    <script>
        function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.classList.add("active");
        }
        // Show the text tab by default
        openTab('textTab');
    </script>
</body>

</html>
