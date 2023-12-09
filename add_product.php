<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];
    $productVariety = $_POST['variety'];

    // Assume the 'image' is a file upload, handle it accordingly
    if (isset($_FILES['image'])) {
        $productImage = $_FILES['image']['name'];
        $target_path = "uploads/"; // You may need to create this folder
        $target_path = $target_path . basename($productImage);

        // Move the uploaded file to the specified folder
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            echo "The file ". basename($productImage). " has been uploaded";
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    } else {
        $productImage = ""; // Set default value if image is not uploaded
    }

    $sql = "INSERT INTO products (name, price, quantity, variety, image) VALUES ('$productName', $productPrice, $productQuantity, '$productVariety', '$productImage')";

    if ($conn->query($sql) === TRUE) {
        $response = array("message" => "Product added successfully");
    } else {
        $response = array("message" => "Error adding product: " . $conn->error . " SQL: " . $sql);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
}
?>
