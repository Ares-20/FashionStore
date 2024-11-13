<!-- navbar.php -->
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="view_products.php">Products</a>
    <a href="orders.php">Orders</a>
    <a href="admin.php">Admin Dashboard</a>
    <?php if (isset($_SESSION['admin_logged_in'])): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Admin Login</a>
    <?php endif; ?>
</div>

<style>
.navbar {
    background-color: #8e24aa;
    padding: 15px;
    text-align: center;
}

.navbar a {
    color: #fff;
    margin: 0 15px;
    text-decoration: none;
}

.navbar a:hover {
    color: #f48fb1;
}
</style>
