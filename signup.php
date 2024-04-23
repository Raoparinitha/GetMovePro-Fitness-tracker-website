<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "signup_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
// ... add more variables for other form fields

// Hash the password before storing it (for security)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert data into the database
$sql = "INSERT INTO users (firstName, lastName, email, password, gender, dob, phoneNumber, address, fitnessGoal, targetWeight, activityLevel, exercisePreferences, height, medicalConditions) 
        VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$_POST[gender]', '$_POST[dob]', '$_POST[phoneNumber]', '$_POST[address]', '$_POST[fitnessGoal]', '$_POST[targetWeight]', '$_POST[activityLevel]', '$_POST[exercisePreferences]', '$_POST[height]', '$_POST[medicalConditions]')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>



