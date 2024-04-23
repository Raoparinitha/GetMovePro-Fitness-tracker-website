<?php
// Replace these values with your actual database credentials
$host = "localhost";
$username = "root";
$password = " ";
$database = "signup_credentials";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a simple query (example)
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Process the result (example)
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
        // Add more fields as needed...
    }
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
