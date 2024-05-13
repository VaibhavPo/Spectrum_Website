<!DOCTYPE html>
<html>

<head>
    <title>Quiz Form</title>
    <style>
        /* Style for tabs */
        .tab {
            display: none;
        }

        /* Style for the tab buttons */
        .tab-button {
            cursor: pointer;
            padding: 10px 20px;

        }

        /* Active tab button */
        .active {
            background-color: #f1f1f1;
        }

        .tab-container {
            display: flex;
            align-items: center;
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1>Create a Quiz Question</h1>


    <form action="insert_quiz.php" method="post" enctype=multipart/form-data>
        <?php
        $quiz_name = $_GET['quiz_name'];
        echo "<input type='hidden' name='quiz_name' value='$quiz_name'>";

        ?>

        <div class="tab-container">
            <div class="tab-button" onclick="openTab('textTab')">Text</div>
            <div class="tab-button" onclick="openTab('imageTab')">Image</div>
        </div>

        <div id="textTab" class="tab">
            <label for="question_text">Question Text:</label><br>
            <textarea name="question_text" rows="4" cols="50" ></textarea><br>
        </div>

        <div id="imageTab" class="tab">
            <label for="question_image">Upload Image:</label><br>
            <input type="file" name="question_image" accept="image/*" ><br>
        </div>

        <label for="marks">Marks:</label><br>
        <input type="number" name="marks"><br>

        <label for="option1">Option 1:</label><br>
        <input type="text" name="option1"><br>

        <label for="option2">Option 2:</label><br>
        <input type="text" name="option2"><br>

        <label for="option3">Option 3:</label><br>
        <input type="text" name="option3"><br>

        <label for="option4">Option 4:</label><br>
        <input type="text" name="option4"><br>

        <label for="correct_answer">Correct Answer (Option Number):</label><br>
        <input type="number" name="correct_answer" required><br>
        </div>

        <input type="submit" value="Submit">
    </form>

    <script>
        function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }
        // Show the text tab by default
        openTab('textTab');
    </script>
</body>

</html>