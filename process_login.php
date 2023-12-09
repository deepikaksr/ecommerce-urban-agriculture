<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your actual database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "shopping_cart";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize user input (prevent SQL injection)
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query to check username and password against the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Authentication successful
            $_SESSION["username"] = $username;
            header("Location: home.html");
            exit();
        } else {
            // Authentication failed
            echo "Invalid username or password";
        }
    } else {
        // User not found
        echo "Invalid username or password";
    }

    $conn->close();
}
?>
