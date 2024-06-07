 <?php
include('Database_Quiz.php'); 
$table =$_GET['quiz_name'];
echo $table;
$query = "SELECT * FROM `$table`";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question Deletion</title>
    <style>
        body {

            margin: 0;
            padding: 0;
        }

        h1 {
            
          
            padding: 10px;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Data Extraction and Deletion</h1>
    <form method="post" action="process.php">
        <label for="data">Select Question to Delete:</label>
        <select name="data" id="data">
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['question_text']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="hidden" name="table_name" value="<?php echo $table; ?>">
        <input type="submit" value="Delete">
    </form>
        <?php     $stmt->close();
    $conn->close();?>
</body>
</html>
