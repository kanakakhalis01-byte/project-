<?php 
require '../config/database.php';
include 'templates/header.php';

// Ambil semua produk
$products = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<h1>Manage Products</h1>

<div class="form-container">
    <h2>Add New Product</h2>
    <form action="actions/product_actions.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea id="desc" name="desc" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="img">Product Image</label>
            <input type="file" id="img" name="img" accept="image/*" required>
        </div>
        <button type="submit" class="btn">Add Product</button>
    </form>
</div>

<h2>Existing Products</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop setiap baris produk yang diambil dari database di atas -->
        <?php while($product = $products->fetch_assoc()): ?> 
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><img src="../<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" width="50"></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td>$<?php echo number_format($product['price'], 2); ?></td>
            <td class="action-links">
                <a href="actions/product_actions.php?action=delete&id=<?php echo $product['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

