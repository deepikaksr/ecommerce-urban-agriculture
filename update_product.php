<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you're using POST method in your form
$productId = $_POST['product-id']; // Assuming you have an input field for product ID
$newProductPrice = $_POST['new-product-price'];

$sql = "UPDATE products SET price = $newProductPrice WHERE id = $productId";

if ($conn->query($sql) === TRUE) {
    echo "Product updated successfully!";
} else {
    echo "Error updating product: " . $conn->error;
}

$conn->close();
?>
