<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    // Logic to handle the buy now action, e.g., redirect to checkout
    header("Location: checkout.php?id=$product_id");
} else {
    echo "Invalid product ID.";
}
?>
