<?php
require_once 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password for security
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $fitnessGoal = $_POST["fitnessGoal"];
    $targetWeight = $_POST["targetWeight"];
    $activityLevel = $_POST["activityLevel"];
    $exercisePreferences = isset($_POST["exercisePreferences"]) ? implode(", ", $_POST["exercisePreferences"]) : "";
    $height = $_POST["height"];
    $medicalConditions = isset($_POST["medicalConditions"]) ? implode(", ", $_POST["medicalConditions"]) : "";

    // Calculate BMI
    $bmi = calculateBMI($height, $targetWeight);

    // Store data in the database
    $conn = new mysqli("localhost", "root", " ", "signup_details");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (first_name, last_name, email, password, gender, dob, phone_number, address, fitness_goal, target_weight, activity_level, exercise_preferences, height, medical_conditions, bmi)
            VALUES ('$firstName', '$lastName', '$email', '$password', '$gender', '$dob', '$phoneNumber', '$address', '$fitnessGoal', $targetWeight, '$activityLevel', '$exercisePreferences', $height, '$medicalConditions', $bmi)";

    if ($conn->query($sql) === TRUE) {
        echo "User data has been successfully stored in the database.<br>";
        echo "BMI: $bmi";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function calculateBMI($height, $weight)
{
    // BMI formula: weight (kg) / (height (m))^2
    $heightInMeters = $height / 100; // Convert height from cm to meters
    return round($weight / ($heightInMeters * $heightInMeters), 2);
}
?>

