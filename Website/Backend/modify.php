<?php
include('Database_Quiz.php'); // Include your database connection file
    // Query to drop the selected quiz table
    if (isset($_POST['delete'])) {
        // Get the selected quiz name from the form
        $quiz_name = $_POST['quiz_name'];
    $query = "DROP TABLE IF EXISTS `$quiz_name`";

    if ($mysqli->query($query) === TRUE) {
        echo "Quiz '$quiz_name' deleted successfully.";
        header("Location: Modify quiz.php");
        exit;
    } else {
        echo "Error deleting quiz: " . $mysqli->error();
    }}



    if (isset($_POST['create_table'])){
        $table_name = $_POST['table_name'];
        $create_table_query = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `question_text` TEXT NOT NULL,
            `question_image` TEXT NOT NULL,
            `marks` INT NOT NULL,
            `option1` TEXT NOT NULL,
            `option2` TEXT NOT NULL,
            `option3` TEXT NOT NULL,
            `option4` TEXT NOT NULL,
            `correct_answer` INT NOT NULL
        ) ENGINE = InnoDB";
            if ($mysqli->query($create_table_query) === TRUE) {
                echo "Quiz '$quiz_name' Created successfully.";
                header("Location: Modify quiz.php");
                exit;
            } else {
                echo "Error deleting quiz: " . $mysqli->error();
            }

    }
    // Close the database connection
    $mysqli->close();


?>