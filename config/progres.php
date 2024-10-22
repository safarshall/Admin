<?php
// Query untuk mengambil jumlah pesanan yang sedang berlangsung
$sql = "SELECT COUNT(*) AS total_in_progress
        FROM orders
        WHERE status = 'in_progress'";
$result = $conn->query($sql);

// Mengecek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Mengambil jumlah pesanan yang sedang berlangsung
    $row = $result->fetch_assoc();
    $total_in_progress = $row['total_in_progress'];
} else {
    $total_in_progress = 0;
}