<?php
session_start();
include '../config/database.php';

$user_id = $_SESSION['user_id'];
$orders = $conn->query("SELECT orders.id, products.name, orders.quantity, orders.total_price, orders.status 
                        FROM orders 
                        JOIN products ON orders.product_id = products.id 
                        WHERE orders.user_id = $user_id");
?>

<h1>Riwayat Pesanan Anda</h1>
<table border="1">
    <tr>
        <th>ID</th><th>Produk</th><th>Jumlah</th><th>Total</th><th>Status</th>
    </tr>
    <?php while ($order = $orders->fetch_assoc()) { ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= $order['name'] ?></td>
        <td><?= $order['quantity'] ?></td>
        <td><?= $order['total_price'] ?></td>
        <td><?= $order['status'] ?></td>
    </tr>
    <?php } ?>
</table>
