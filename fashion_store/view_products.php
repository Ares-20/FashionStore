<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffe6f0;
            text-align: center;
        }
        .heading {
            font-size: 32px;
            color: #c2185b;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .product-container {
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
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            opacity: 1;
            transition: opacity 0.3s;
        }
        .product-card.deleted {
            opacity: 0.6;
            background-color: #f8d7da;
        }
        .product-card img {
            width: 200px;
            height: auto;
            border-radius: 8px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .product-card h3 {
            font-size: 20px;
            color: #c2185b;
            margin: 10px 0;
        }
        .product-card p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
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
        }
        .button-group button:hover {
            background-color: #d81b60;
        }
        @media (max-width: 768px) {
            .product-card {
                flex: 1 1 calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .product-card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="content-container">
        <h1 class="heading">Latest Products</h1>
        
        <div class="product-container">
            <?php
            // Fetch all products, including deleted ones
            $sql = "SELECT p.id, p.name, p.price, c.name AS category_name, p.image, p.is_deleted 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_path = !empty($row['image']) ? $row['image'] : 'placeholder.jpg';
                    $isDeleted = $row['is_deleted'] == 1;
                    $productClass = $isDeleted ? 'product-card deleted' : 'product-card';

                    echo "<div class='" . htmlspecialchars($productClass) . "'>";
                    echo "<img src='" . htmlspecialchars($image_path) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
                    echo "<p>Category: " . htmlspecialchars($row['category_name']) . "</p>";
                    
                    // Show "Delete" button if not deleted, otherwise show "Retrieve" button
                    echo "<div class='button-group'>";
                    if ($isDeleted) {
                        echo "<a href='retrieve_product.php?id=" . htmlspecialchars($row['id']) . "'><button>Retrieve</button></a>";
                    } else {
                        echo "<a href='edit_product.php?id=" . htmlspecialchars($row['id']) . "'><button>Edit</button></a>";
                        echo "<a href='delete_product.php?id=" . htmlspecialchars($row['id']) . "'><button>Delete</button></a>";
                    }
                    echo "</div>";

                    echo "</div>";
                }
            } else {
                echo "<p style='text-align: center; color: #666;'>No products available.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
