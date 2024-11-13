<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get products in the cart
$cart = $_SESSION['cart'];
$cart_products = [];
if (!empty($cart)) {
    $ids = implode(',', $cart);
    $sql = "SELECT id, name, price, image FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cart_products[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders - Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .order-container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .order-container h1 {
            color: #c2185b;
        }
        .order-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .order-card {
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            background-color: #fff;
            max-width: 300px;
        }
        .order-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .order-button-group {
            margin-top: 10px;
        }
        .order-button-group button {
            padding: 10px;
            font-size: 14px;
            color: #fff;
            background-color: #4caf50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
        }
        .order-button-group .remove-btn {
            background-color: #e91e63;
        }
        .order-button-group button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="order-container">
        <h1>Your Orders</h1>
        <?php if (!empty($cart_products)) : ?>
            <div class="order-grid">
                <?php foreach ($cart_products as $product) : ?>
                    <div class="order-card">
                        <img src="<?php echo htmlspecialchars($product['image'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <div class="order-button-group">
                            <a href="checkout.php?id=<?php echo $product['id']; ?>"><button>Checkout</button></a>
                            <a href="remove_from_cart.php?id=<?php echo $product['id']; ?>"><button class="remove-btn">Remove</button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Your cart is empty. <a href="index.php">Browse products</a>.</p>
        <?php endif; ?>
    </div>
</body>
</html>
