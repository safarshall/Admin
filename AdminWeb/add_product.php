<?php
session_start();
include '../config/database.php';

// Cek apakah user adalah admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = $conn->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
    $query->bind_param('ssdi', $name, $description, $price, $stock);
    $query->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        input, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Tambah Produk Baru</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Produk" required><br>
        <textarea name="description" placeholder="Deskripsi" required></textarea><br>
        <input type="number" name="price" placeholder="Harga" required><br>
        <input type="number" name="stock" placeholder="Stok" required><br>
        <button type="submit">Tambah Produk</button>
    </form>
    <a href="index.php">Kembali ke Daftar Produk</a>
</div>

</body>
</html>
