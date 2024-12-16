<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
    <link rel="stylesheet" href="css/confirm_order.css">
</head>
<body>
<div class="container">
        <h1>Confirm Order</h1>

        <div id="order-summary" class="summary"></div>

        <div id="map"></div>
        <input type="text" id="address-coordinates" placeholder="Selected address coordinates" readonly style="width: 100%; padding: 10px; margin-bottom: 20px;">

        <div class="form-group">
            <label for="customer-name">Name:</label>
            <input type="text" id="customer-name" placeholder="Enter your name">
        </div>

        <div class="form-group">
            <label for="customer-contact">Contact Number:</label>
            <input type="text" id="customer-contact" placeholder="Enter your contact number">
        </div>

        <div class="form-group">
            <label for="delivery-instructions">Delivery Instructions:</label>
            <textarea id="delivery-instructions" rows="4" placeholder="Any additional delivery instructions"></textarea>
        </div>

        <div class="payment-section">
            <h2>Payment Method</h2>
            <div class="payment-method">
                <label>
                    <input type="radio" name="payment_method" value="Cash">
                    Cash
                </label>
            </div>
            <div class="payment-method">
                <label>
                    <input type="radio" name="payment_method" value="PayPal">
                    PayPal
                </label>
            </div>
            <div class="payment-method">
                <label>
                    <input type="radio" name="payment_method" value="Venmo">
                    Venmo
                </label>
            </div>
        </div>
        <button onclick="confirmOrder()">Confirm Order</button>
        <button onclick="window.location.href='menu.php'">Back to Menu</button>
    </div>

    <script src="js/confirm_order.js"></script>
</body>
</html>