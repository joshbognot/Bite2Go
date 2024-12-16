<?php

// di na kaya ng chatgpt to :p

session_start();
header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in.']);
    exit();
}

// Retrieve order data from the request body
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid order data.']);
    exit();
}

include "conn.php";

try {
    // Extract order details
    $user_id = $_SESSION['user_id'];
    $name = $data['name'];
    $contact = $data['contact'];
    $address = $data['address'];
    $instructions = $data['instructions'];
    $payment_method = $data['payment_method'];
    $items = $data['items'];
    $total_price = $data['total'];

    // Insert order into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, name, contact, address, delivery_instructions, payment_method, total_amount, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isssssd", $user_id, $name, $contact, $address, $instructions, $payment_method, $total_price);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Get the inserted order ID

        // Insert items into the order_items table
        $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($items as $item) {
            $item_name = $item['name'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $item_stmt->bind_param("isid", $order_id, $item_name, $quantity, $price);
            $item_stmt->execute();
        }

        echo json_encode(['success' => true, 'order_id' => $order_id]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to place order.']);
    }

    $stmt->close();
    $item_stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
