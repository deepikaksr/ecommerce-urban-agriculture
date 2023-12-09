<?php
include 'database.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product-id'];

    // Perform the deletion
    $sql = "DELETE FROM products WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $conn->close();
} else {
    // Handle the case where the request method is not POST
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
}
?>
