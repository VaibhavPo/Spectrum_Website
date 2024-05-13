<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "email_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL to create a table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
<?php

$email_to_insert = $_POST['email'];

$sql = "INSERT INTO emails (email) VALUES ('$email_to_insert')";

if ($conn->query($sql) === TRUE) {
    echo "Email inserted successfully";
    header("Location:home.html");
} else {
    echo "Error inserting email: " . $conn->error;
}
// Close the database connection
$conn->close();
?>