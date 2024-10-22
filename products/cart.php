<?php
session_start();

// Cek apakah product_id ada di POST request
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $db = new mysqli('localhost', 'root', '', 'umkm');
    // Pastikan koneksi ke database (misalkan menggunakan $db)
    // Gunakan prepared statements untuk mencegah SQL injection
    $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id); // i untuk integer
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Tambah produk ke session 'cart'
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $product;

    // Redirect kembali ke halaman produk
    header("Location: ../user/index.php?page=list");
    exit;
} else {
    // Jika tidak ada product_id, kembalikan ke halaman produk
    header("Location: ../user/index.php?page=list");
    exit;
}

