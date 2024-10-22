<?php
session_start();
include '../config/database.php';

// Cek apakah user adalah admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

// Ambil ID produk dari query parameter
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

// Proses update produk jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $query = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?");
    $query->bind_param('ssdii', $name, $description, $price, $stock, $id);
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
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
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

<div class="card">
    <h1>Edit Produk</h1>
    <form method="POST">
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        <input type="number" name="price" value="<?= $product['price'] ?>" required>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="index.php">Kembali ke Daftar Produk</a>
</div>

</body>
</html>
