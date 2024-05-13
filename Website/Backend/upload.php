<?php

// Database configuration
include('Database_Quiz.php'); 



// Process CSV file upload
if (isset($_POST["submit"])) {
    $file = $_FILES["csvFile"]["tmp_name"];

    // Read CSV file
    $handle = fopen($file, "r");

    // Read the header row
    $header = fgetcsv($handle);

    // Loop through the rest of the rows
    while (($data = fgetcsv($handle)) !== false) {
        $questionData = array_combine($header, $data);

        // Insert data into the database
        $query = "INSERT INTO your_table_name (id, question_text, question_image, marks, option1, option2, option3, option4, correct_answer) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);

        // Bind parameters
        $stmt->bind_param(
            'isssssssi',
            $questionData['id'],
            $questionData['question_text'],
            $questionData['question_image'],
            $questionData['marks'],
            $questionData['option1'],
            $questionData['option2'],
            $questionData['option3'],
            $questionData['option4'],
            $questionData['correct_answer']
        );

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }

    // Close the file handle
    fclose($handle);

    echo "Data imported successfully.";
}

// Close the database connection
$mysqli->close();
?>
