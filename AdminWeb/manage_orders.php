<?php
session_start();
include '../config/database.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$orders = $conn->query("SELECT orders.id, users.username, products.name, orders.quantity, orders.total_price, orders.status 
                        FROM orders 
                        JOIN users ON orders.user_id = users.id 
                        JOIN products ON orders.product_id = products.id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $query->bind_param('si', $status, $order_id);
    $query->execute();

    header('Location: manage_orders.php');
}
?>

<h1>Manajemen Pesanan</h1>
<table border="1">
    <tr>
        <th>ID</th><th>User</th><th>Produk</th><th>Jumlah</th><th>Total</th><th>Status</th><th>Aksi</th>
    </tr>
    <?php while ($order = $orders->fetch_assoc()) { ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= $order['username'] ?></td>
        <td><?= $order['name'] ?></td>
        <td><?= $order['quantity'] ?></td>
        <td><?= $order['total_price'] ?></td>
        <td><?= $order['status'] ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                <select name="status">
                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="paid" <?= $order['status'] === 'paid' ? 'selected' : '' ?>>Paid</option>
                    <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
