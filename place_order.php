<?php
session_start();
$conn = new mysqli("localhost", "root", "", "organic_oasis");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid or empty cart data']);
    exit;
}

$cart = $data['cart'];
$total_price = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $cart));

$order_query = $conn->prepare("INSERT INTO orders (user_id, total_price, created_at) VALUES (?, ?, NOW())");
$order_query->bind_param("id", $user_id, $total_price);

if ($order_query->execute()) {
    $order_id = $order_query->insert_id;
    $item_query = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($cart as $item) {
        $product_name = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $item_query->bind_param("isid", $order_id, $product_name, $quantity, $price);
        $item_query->execute();
    }

    echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to place order']);
}

$conn->close();
?>
