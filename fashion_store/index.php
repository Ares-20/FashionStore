<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Fashion Store</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            background-color: #fff;
            max-width: 300px;
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .button-group {
            margin-top: 10px;
        }
        .button-group button {
            padding: 10px;
            font-size: 14px;
            color: #fff;
            background-color: #e91e63;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
        }
        .button-group button:hover {
            background-color: #d81b60;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1 style="text-align: center; color: #c2185b;">Latest Products</h1>
        <div class="product-grid">
            <?php
            $sql = "SELECT id, name, price, image FROM products ORDER BY id DESC LIMIT 9";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_path = !empty($row['image']) ? $row['image'] : 'placeholder.jpg';

                    echo "<div class='product-card'>";
                    echo "<img src='" . htmlspecialchars($image_path) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                    echo "<div class='button-group'>";
                    echo "<a href='buy_now.php?id=" . $row['id'] . "'><button>Buy Now</button></a>";
                    echo "<a href='add_to_cart.php?id=" . $row['id'] . "'><button>Add to Cart</button></a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products available at the moment.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
