<?php
include('Database_Quiz.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected data to delete from the form
    $dataToDelete = $_POST["data"];
    $table = $_POST['table_name'];

    // SQL query to delete the selected row
    $query = "DELETE FROM `$table` WHERE `$table`.`id` = $dataToDelete";
    $result = $mysqli->query($query);

    if ($result) {
        // Redirect to another page on success
        header("Location: ques_delete.php?quiz_name=$table");
        exit;
    } else {
        // Handle the case where the query failed
        echo "Error deleting data: " . $mysqli->error;
    }
}

// Close the database connection outside of the if block
$mysqli->close();
?>
