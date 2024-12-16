let cart = [];

session_start();


// tab selection js
function showTab(tabName) {
    const tabs = document.querySelectorAll('.menu-container');
    tabs.forEach(tab => tab.classList.remove('active'));
    document.getElementById(tabName).classList.add('active');

    const tabButtons = document.querySelectorAll('.tab');
    tabButtons.forEach(button => button.classList.remove('active'));
    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
}


// add cart
function addToCart(itemName, itemPrice, quantityId) {

    // quantity
    const quantity = parseInt(document.getElementById(quantityId).textContent);

    let cart = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    let total = parseFloat(sessionStorage.getItem('cartTotal')) || 0;

    // item already exists
    const existingItemIndex = cart.findIndex(item => item.name === itemName);

    if (existingItemIndex !== -1) {

        // quantity and price
        cart[existingItemIndex].quantity += quantity;
        cart[existingItemIndex].price += itemPrice * quantity;
    } else {

        // new item
        cart.push({ name: itemName, quantity: quantity, price: itemPrice * quantity });
    }

    // update total price
    total += itemPrice * quantity;

    // save the updated cart
    sessionStorage.setItem('cartItems', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', total.toFixed(2));

    // update the cart display
    updateCartDisplay();

    alert(`${quantity} ${itemName}(s) added to cart!`);
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    const totalContainer = document.getElementById('cart-total');

    // retrieve cart data
    const items = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const total = parseFloat(sessionStorage.getItem('cartTotal')) || 0;

    // clear the cart display
    cartContainer.innerHTML = '';

    if (items.length === 0) {
        cartContainer.innerHTML = '<p>Your cart is empty.</p>';
        totalContainer.textContent = 'Total: ₱0.00';
        return;
    }

    // Populate the cart with items and "Remove" buttons
    items.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.innerHTML = `
            <p>${item.name} - Quantity: ${item.quantity} - Price: ₱${item.price.toFixed(2)}
                <button onclick="removeFromCart(${index})">Remove</button>
            </p>
        `;
        cartContainer.appendChild(cartItem);
    });

    // Update the total
    totalContainer.textContent = `Total: ₱${total.toFixed(2)}`;

    // Add a "Clear All" button
    const clearButton = document.createElement('button');
    clearButton.textContent = 'Clear All';
    clearButton.onclick = clearCart;
    cartContainer.appendChild(clearButton);
}

function removeFromCart(index) {
    let cart = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    let total = parseFloat(sessionStorage.getItem('cartTotal')) || 0;

    // update price
    total -= cart[index].price;

    // remove item from cart
    cart.splice(index, 1);

    // update session
    sessionStorage.setItem('cartItems', JSON.stringify(cart));
    sessionStorage.setItem('cartTotal', total.toFixed(2));

    // update display
    updateCartDisplay();
}

function clearCart() {
    // Clear the cart data from sessionStorage
    sessionStorage.removeItem('cartItems');
    sessionStorage.removeItem('cartTotal');

    // Update the cart display
    updateCartDisplay();
}

function changeQuantity(quantityId, change) {
    const quantityElement = document.getElementById(quantityId);
    let currentQuantity = parseInt(quantityElement.textContent);

    // Ensure quantity doesn't go below 1
    currentQuantity = Math.max(1, currentQuantity + change);

    quantityElement.textContent = currentQuantity;
}

function decreaseQuantity(id) {
    const input = document.getElementById(id);
    if (input.value > 1) {
        input.value--;
    }
}

function increaseQuantity(id) {
    const input = document.getElementById(id);
    input.value++;
}