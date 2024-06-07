<!DOCTYPE html>
<html>

<head>
    <title>Edit Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 10px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            background-color: #fff;
            color: #333;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            font-weight: bold;
        }

        /* Style for disabled dropdown option */
        select[disabled] {
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Open Quiz</h1>
        <form action="Quizbck.php" method="get">
            <label for="quiz_name"> <h3>Select a Quiz to create Question:</h3></label>
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
                } else {
                    echo "<option value='' disabled>No quizzes available</option>";
                }

                // Close the database connection
                $mysqli->close();
                ?>
            </select>
            <input type="submit" value="Create_new_question">
        </form>
        
                <form action="ques_delete.php" method="get">
            <label for="quiz_name"> <h3>Select a Quiz to Delete Question:</h3></label>
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
                } else {
                    echo "<option value='' disabled>No quizzes available</option>";
                }

                // Close the database connection
                $mysqli->close();
                ?>
            </select>
            <input type="submit" value="Delete Question">
        </form>

        <h1>Create Quiz</h1>
        <form action="modify.php" method="post">
            <label for="table_name">Quiz Name:</label>
            <input type="text" name="table_name" required>
            <input type="submit" name="create_table" value="Create">
        </form>

        <h1>Delete Quiz</h1>
        <form action="modify.php" method="post">
            <label for="quiz_name">Select a Quiz:</label>
            <select name="quiz_name">
                <?php
                include('Database_Quiz.php'); // Include your database connection file

                // Reuse the same query as above to fetch all table names
                $result = $mysqli->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $table_name = $row['Tables_in_' . $database];
                        echo "<option value='$table_name'>$table_name</option>";
                    }
                } else {
                    echo "<option value='' disabled>No quizzes available</option>";
                }

                // Close the database connection
                $mysqli->close();
                ?>
            </select>
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</body>

</html>
