<?php
include 'database.php'; // Ensure you include your database connection

// Assuming you have a column named 'variety' in your products table
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Define the allowed sorting options
$allowedSortOptions = ['default', 'fruit', 'vegetable', 'greens'];

// Validate the sorting option
if (!in_array($sortOption, $allowedSortOptions)) {
    die(json_encode(['error' => 'Invalid sorting option']));
}

// Construct the SQL query with the ORDER BY clause
$sql = "SELECT * FROM products";

if ($sortOption !== 'default') {
    $sql .= " WHERE variety = '$sortOption'";
}

$sql .= " ORDER BY name"; // You can change 'name' to the column you want to sort by

$result = $conn->query($sql);

if ($result === FALSE) {
    die(json_encode(['error' => 'Error executing query: ' . $conn->error]));
}

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = [
        'name' => $row['name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'variety' => $row['variety'],
        'image' => $row['image'],
    ];
}

echo json_encode($products);

$conn->close();
?>
