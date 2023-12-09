<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute the SQL query
$sql = "SELECT products.*, users.username
        FROM products
        INNER JOIN users ON products.added_by = users.username";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $products = array();

    // Fetch the data into an array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Output the products array as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} else {
    echo json_encode(array('message' => '0 results'));
}

// Close the database connection
$conn->close();
?>
