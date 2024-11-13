<?php
session_start();

if (isset($_GET['id']) && in_array($_GET['id'], $_SESSION['cart'])) {
    $product_id = $_GET['id'];
    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$product_id]);
}

header("Location: orders.php");
exit();
?>
