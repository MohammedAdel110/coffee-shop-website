<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// Check if the customer is logged in
if (!isset($_SESSION['customer_name'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

$customer_name = $_SESSION['customer_name']; // Get the logged-in customer's name

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'coffe_shop_reg');

if (!$conn) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . mysqli_connect_error()]);
    exit();
}

// Get the cart data from the POST request (sent via AJAX)
$cart = json_decode(file_get_contents("php://input"), true);

// Check if the cart is empty
if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Cart is empty."]);
    exit();
}

// Calculate total price
$total_price = 0;
foreach ($cart as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// Insert the order into the orders table with the logged-in user's name
$sql = "INSERT INTO `orders`(`customer_name`, `total_price`) VALUES ('$customer_name', '$total_price')";
if (mysqli_query($conn, $sql)) {
    $order_id = mysqli_insert_id($conn); // Get the last inserted order ID

    // Insert each item into the order_details table
    foreach ($cart as $item) {
        $product_name = mysqli_real_escape_string($conn, $item['product']);
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);
        $sql_details = "INSERT INTO order_details (order_id, product_name, quantity, price) VALUES ('$order_id', '$product_name', '$quantity', '$price')";

        if (!mysqli_query($conn, $sql_details)) {
            echo json_encode(["success" => false, "message" => "Failed to insert order details."]);
            exit();
        }
    }

    echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "please login first " . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
