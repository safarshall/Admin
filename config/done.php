<?php
$sql = "SELECT COUNT(*) AS total_completed
        FROM orders
        WHERE status = 'completed'";
$result = $conn->query($sql);

// Mengecek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Mengambil jumlah pesanan yang selesai
    $row = $result->fetch_assoc();
    $total_completed = $row['total_completed'];
} else {
    $total_completed = 0;
}