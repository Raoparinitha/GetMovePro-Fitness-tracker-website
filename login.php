<?php
// Establish database connection (same as signup.php)
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $row['password'])) {
        // Password is correct, perform BMI calculation
        $bmi = $row['weight'] / (($row['height'] / 100) ** 2);

        // Display user information
        echo "Welcome, " . $row['name'] . "!<br>";
        echo "Age: " . $row['age'] . "<br>";
        echo "Height: " . $row['height'] . " cm<br>";
        echo "Weight: " . $row['weight'] . " kg<br>";
        echo "BMI: " . $bmi . "<br>";

        // Display weight status
        if ($bmi < 18.5) {
            echo "Weight Status: Underweight";
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            echo "Weight Status: Healthy weight";
        } else {
            echo "Weight Status: Overweight";
        }
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$conn->close();
?>

