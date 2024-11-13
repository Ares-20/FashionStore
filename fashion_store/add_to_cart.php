<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $_SESSION['cart'][] = $product_id;
    echo "Product added to cart!";
    header("Location: view_products.php"); // Redirect back to the product page
} else {
    echo "Invalid product ID.";
}
?>
