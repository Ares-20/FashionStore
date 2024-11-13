<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the SQL query to retrieve the product
    $sql = "UPDATE products SET is_deleted = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the product list page if the update was successful
        header("Location: view_products.php");
        exit();
    } else {
        // If there's an error, output it for debugging
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Product ID not set!";
}
?>
