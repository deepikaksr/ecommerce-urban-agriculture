<?php
include 'database.php'; 

$sql = "SELECT DISTINCT variety, 
        (SELECT COUNT(*) FROM products p WHERE p.variety = products.variety) AS total_products
        FROM products";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = array(
            'variety' => $row['variety'],
            'total_products' => $row['total_products']
        );
    }
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'No products found'));
}

$conn->close();
?>
