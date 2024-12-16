<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <div class="menu-section">
        <h1>Menu</h1>
        <div class="tab-container">
            <div class="tab active" data-tab="food" onclick="showTab('food')">Food</div>
            <div class="tab" data-tab="drinks" onclick="showTab('drinks')">Drinks</div>
            <div class="tab" data-tab="dessert" onclick="showTab('dessert')">Dessert</div>
        </div>

        <div id="food" class="menu-container active">
            <div class="food-card">
                <img src="assets/bbq.jpg" alt="bbq">
                <h3>Barbeque</h3>
                <p>Price: ₱15</p>
                <div>
                    <button onclick="changeQuantity('bbq-quantity', -1)">-</button>
                    <span id="bbq-quantity">1</span>
                    <button onclick="changeQuantity('bbq-quantity', 1)">+</button>
                </div>
                <button onclick="addToCart('Barbeque', 15, 'bbq-quantity')">Add to Cart</button>
            </div>

            <div class="food-card">
                <img src="assets/siopao.webp" alt="siopao">
                <h3>Siopao</h3>
                <p>Price: ₱40</p>
                <div>
                    <button onclick="changeQuantity('siopao-quantity', -1)">-</button>
                        <span id="siopao-quantity">1</span>
                        <button onclick="changeQuantity('siopao-quantity', 1)">+</button>
                </div>
                <button onclick="addToCart('Siopao', 40, 'siopao-quantity')">Add to Cart</button>
            </div>
            
        </div>

        <div id="drinks" class="menu-container">
            <div class="food-card">
                <img src="assets/bbq.jpg" alt="bbq">
                <h3>Barbeque</h3>
                <p>Price: ₱15</p>
                <div>
                    <button onclick="changeQuantity('bbq-quantity', -1)">-</button>
                    <span id="bbq-quantity">1</span>
                    <button onclick="changeQuantity('bbq-quantity', 1)">+</button>
                </div>
                <button onclick="addToCart('Barbeque', 15, 'bbq-quantity')">Add to Cart</button>
            </div>
        </div>

        <div id="dessert" class="menu-container">
            <div class="food-card">
                <img src="assets/bbq.jpg" alt="bbq">
                <h3>Barbeque</h3>
                <p>Price: ₱15</p>
                <div>
                    <button onclick="changeQuantity('bbq-quantity', -1)">-</button>
                    <span id="bbq-quantity">1</span>
                    <button onclick="changeQuantity('bbq-quantity', 1)">+</button>
                </div>
                <button onclick="addToCart('Barbeque', 15, 'bbq-quantity')">Add to Cart</button>
            </div>
        </div>
    </div>

    <div class="cart-section">
        <h2>Your Cart</h2>
        <div id="cart-items" class="cart"></div>
        <div class="cart-total">
            Total: <span id="total-price">₱0.00</span>
        </div>
        <div class="cart-buttons">
            <button id="order-button" onclick="window.location.href='confirm_order.php'">Order</button>
            <button onclick="window.location.href='homepage.php'">Back</button>
        </div>
    </div>

    <script src="js/menu.js"></script>\
    <script>document.addEventListener('DOMContentLoaded', updateCartDisplay);</script>
</body>
</html>
