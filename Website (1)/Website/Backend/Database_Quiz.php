<?php
// Database configuration
$host = "localhost"; // Database host
$username = "pectrumc_chemistry_quiz"; // Database username
$password = "cwWG)o86x{=5"; // Database password
$database = "pectrumc_chemistry_quiz"; // Database name

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected to the database successfully.";

// Close the database connection when done

?>
