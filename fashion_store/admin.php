<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <a href="add_category.php"><button>Add New Category</button></a>
        <a href="add_product.php"><button>Add New Product</button></a>
        <a href="view_products.php"><button>View Products</button></a>
    </div>
</body>
</html>
