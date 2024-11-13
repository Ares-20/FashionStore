<?php
include 'db.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Category</h1>
        <form action="add_category.php" method="POST">
            <input type="text" name="name" placeholder="Category Name" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit" name="submit">Add Category</button>
        </form>
    </div>
</body>
</html>
