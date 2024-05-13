<!DOCTYPE html>
<html>

<head>
    <title>Edit Quiz</title>
</head>

<body>
<h1>Open Quiz</h1>
    <form action="Quizbck.php" method="get">
        <label for="quiz_name">Select a Quiz:</label>
        <select name="quiz_name">
            <?php
            include('Database_Quiz.php'); // Include your database connection file
            
            // Query to fetch all table names from the database
            $query = "SHOW TABLES";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $table_name = $row['Tables_in_' . $database];
                    echo "<option value='$table_name'>$table_name</option>";
                }
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </select>
        <input type="submit" value="OPEN">
    </form>
    <h1>Create Quiz</h1>
    <form action="modify.php" method="post">
        <label for="table_name">Quiz Name:</label>
        <input type="text" name="table_name" required><br><br>

        <input type="submit" name="create_table" value="Create">
    </form>
    <h1>Delete Quiz</h1>
    <form action="modify.php" method="post">
        <label for="quiz_name">Select a Quiz:</label>
        <select name="quiz_name">
            <?php
            include('Database_Quiz.php'); // Include your database connection file
            
            // Query to fetch all table names from the database
            $query = "SHOW TABLES";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $table_name = $row['Tables_in_' . $database];
                    echo "<option value='$table_name'>$table_name</option>";
                }
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </select>
        <input type="submit" name="delete" value="Delete">
    </form>


</body>

</html>