<?php

include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
    $total_price = $product['price'] * $quantity;

    $query = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
    $query->bind_param('iiid', $user_id, $product_id, $quantity, $total_price);
    $query->execute();

    echo 'Pesanan berhasil dibuat!';
}
