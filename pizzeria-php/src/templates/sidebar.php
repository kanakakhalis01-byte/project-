<div id="product-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <img id="modal-img" src="" alt="product image">
            <h2 id="modal-name"></h2>
            <p id="modal-desc"></p>
            <h3 id="modal-price"></h3>
            <div class="modal-buttons">
                <form action="src/actions/cart_action.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" id="modal-product-id">
                    <button type="submit" class="btn add-to-cart-btn">Add to Cart</button>
                </form>
                <form action="src/actions/cart_action.php" method="POST">
                     <input type="hidden" name="action" value="buy_now">
                     <input type="hidden" name="product_id" id="modal-buy-now-id">
                     <button type="submit" class="btn buy-now-btn">Buy Now</button>
                </form>
            </div>
        </div>
    </div>

    <div id="cart-sidebar" class="sidebar">
        <div class="sidebar-header">
            <h3>Shopping Cart</h3>
            <span class="close-sidebar">&times;</span>
        </div>
        <div id="cart-items">
            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $total += $item['price'] * $item['quantity'];
                ?>
                <div class="cart-item">
                    <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="cart-item-details">
                        <h4><?php echo $item['name']; ?></h4>
                        <p>$<?php echo number_format($item['price'], 2); ?></p>
                        <form action="src/actions/cart_action.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" onchange="this.form.submit()">
                        </form>
                        <form action="src/actions/cart_action.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit">Remove</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="sidebar-footer">
            <h4>Total: $<span id="cart-total"><?php echo isset($total) ? number_format($total, 2) : '0.00'; ?></span></h4>
            <form action="src/actions/cart_action.php" method="POST">
                <input type="hidden" name="action" value="checkout">
                <button type="submit" class="btn checkout-btn">Checkout</button>
            </form>
        </div>
    </div>

    <div class="last-text">
        <p>© Developed 2023 by Lavasky Company</p>
    </div>

    <a href="#home" class="scroll-top">
        <i class='bx bx-up-arrow-alt'></i>
    </a>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="public/js/Pizza website.js"></script>
</body>
</html>