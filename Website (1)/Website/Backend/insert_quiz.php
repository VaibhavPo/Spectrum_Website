<?php
include('Database_Quiz.php'); // Include your database connection file

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $quiz_table_name = $_POST['quiz_name'];
    $marks = $_POST['marks'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];
    $question_text = $_POST['question_text'];

    // Check if a file was uploaded
    if (isset($_FILES["question_image"]) && $_FILES["question_image"]["size"] > 0) {
        $targetDir = "../quizImg/"; // Specify the folder where you want to store uploaded images
    
        $targetFile =$targetDir. basename($_FILES["question_image"]["name"]);
        $name=basename($_FILES["question_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["question_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        // if (file_exists($targetFile)) {
        //     echo "Sorry, the file already exists.";
        //     header("Location: Quizbck.php?quiz_name=" . $quiz_table_name);
        //     $uploadOk = 0;
        // }

        // Check file size (you can adjust this limit)
        if ($_FILES["question_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats (you can add more if needed)
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is okay, try to upload the file
            if (move_uploaded_file($_FILES["question_image"]["tmp_name"], $targetFile)) {
                // Insert data into the quiz-specific table, including the image data
                $imagePath = $targetFile;
                $insert_data_query = "INSERT INTO `$quiz_table_name` (question_text, question_image, marks, option1, option2, option3, option4, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $mysqli->prepare($insert_data_query);

                // Bind parameters
                $stmt->bind_param('ssssssss', $question_text, $name, $marks, $option1, $option2, $option3, $option4, $correct_answer);

                if ($stmt->execute()) {
                    echo "Quiz question inserted successfully.";
                    header("Location: Quizbck.php?quiz_name=" . $quiz_table_name);
                    exit(); // Terminate script execution after the redirect
                } else {
                    echo "Error inserting quiz question: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // If no file was uploaded, insert data without an image path
        $insert_data_query = "INSERT INTO `$quiz_table_name` (question_text, marks, option1, option2, option3, option4, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($insert_data_query);

        // Bind parameters without the image path
        $stmt->bind_param('sssssss', $question_text, $marks, $option1, $option2, $option3, $option4, $correct_answer);

        if ($stmt->execute()) {
            echo "Quiz question inserted successfully (without image).";
            header("Location: Quizbck.php?quiz_name=" . $quiz_table_name);
            exit(); // Terminate script execution after the redirect
        } else {
            echo "Error inserting quiz question (without image): " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    // Close the database connection
    $mysqli->close();
} else {
    echo "Form not submitted.";
}
?>
