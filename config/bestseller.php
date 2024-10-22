<?php
//produk terlaris
$sql = "SELECT p.name, SUM(o.quantity) as total_ordered
        FROM orders o
        JOIN products p ON o.product_id = p.id
        GROUP BY p.name
        ORDER BY total_ordered DESC
        LIMIT 1";
$result = $conn->query($sql);

// Mengecek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Mengambil data produk terlaris
    $row = $result->fetch_assoc();
    $product_name = $row['name'];
    $total_ordered = $row['total_ordered'];
} else {
    $product_name = "No product found";
    $total_ordered = 0;
}