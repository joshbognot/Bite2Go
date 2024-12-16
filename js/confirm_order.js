let selectedPaymentMethod = null;
let marker;

// Google Maps API
function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        // Mcdo default
        center: { lat: 15.486278887202605, lng: 120.58683153512341  },
        zoom: 13,
    });

    google.maps.event.addListener(map, 'click', function (event) {
        placeMarker(event.latLng, map);
    });
}

function placeMarker(location, map) {
    if (marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map,
        });
    }

    // Address cords
    document.getElementById('address-coordinates').value = `${location.lat()}, ${location.lng()}`;
}


// choosing of payment method
function selectPaymentMethod(method) {
    selectedPaymentMethod = method;
    const buttons = document.querySelectorAll('.payment-method button');
    buttons.forEach(button => button.disabled = false);
    document.getElementById(`${method}-button`).disabled = true;
}

// Order summary
function loadOrderSummary() {
    const items = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const total = sessionStorage.getItem('cartTotal') || 0;

    let summaryHtml = '<h2>Order Summary</h2>';
    if (items.length > 0) {
        summaryHtml += '<ul>';
        items.forEach(item => {
            summaryHtml += `<li>${item.name} - Quantity: ${item.quantity} - Price: ₱${item.price.toFixed(2)}</li>`;
        });
        summaryHtml += '</ul>';
        summaryHtml += `<p><strong>Total: ₱${total}</strong></p>`;
    } else {
        summaryHtml += '<p>Your cart is empty.</p>';
    }

    document.getElementById('order-summary').innerHTML = summaryHtml;
}

document.addEventListener('DOMContentLoaded', loadOrderSummary);


function confirmOrder() {
    const address = document.getElementById('address-coordinates').value;
    const name = document.getElementById('customer-name').value.trim();
    const contact = document.getElementById('customer-contact').value.trim();
    const instructions = document.getElementById('delivery-instructions').value.trim();
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const cartTotal = sessionStorage.getItem('cartTotal') || 0;

    // selected payment method
    const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

    // validation
    if (!name || !contact || !address || cartItems.length === 0) {
        alert('Please fill out all required fields and ensure your cart is not empty.');
        return;
    }

    // payment method is selected
    if (!selectedPaymentMethod) {
        alert('Please select a payment method.');
        return;
    }

    const paymentMethod = selectedPaymentMethod.value; // radio value

    // Prepare order data
    const orderData = {
        name: name,
        contact: contact,
        address: address,
        instructions: instructions,
        payment_method: paymentMethod,
        items: cartItems,
        total_price: cartTotal,
    };

    // Submit order to the server
    fetch('submit_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(orderData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order successfully placed!');
            window.location.href = `receipts.php?order_id=${data.order_id}`;
        } else {
            alert('Error placing order: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while placing the order.');
    });
}