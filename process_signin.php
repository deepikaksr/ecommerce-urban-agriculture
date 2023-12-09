<?php
// Connect to the MySQL database (adjust these parameters based on your XAMPP configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the users table using prepared statement
$sql = "INSERT INTO users (username, password, gender, email, birthdate) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Check if the prepared statement is successful
if ($stmt) {
    $stmt->bind_param("sssss", $username, $hashedPassword, $gender, $email, $birthdate);
    $stmt->execute();

    // Check if the execution is successful
    if ($stmt->affected_rows > 0) {
        header("Location: Login.html");
        exit();
    } else {
        echo "Error: Unable to insert data into the database.";
    }

    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>