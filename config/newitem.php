<?php
// Query untuk mengambil produk terbaru
$sql = "SELECT name, created_at
        FROM products
        ORDER BY created_at DESC
        LIMIT 1";
$result = $conn->query($sql);

// Mengecek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Mengambil data produk terbaru
    $row = $result->fetch_assoc();
    $new_product_name = $row['name'];
    $release_date = $row['created_at'];
} else {
    $new_product_name = "No new product";
    $release_date = "";
}