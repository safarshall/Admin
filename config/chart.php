<?php
// Query untuk menghitung pesanan berdasarkan status
$sql_completed = "SELECT COUNT(*) AS total_completed FROM orders WHERE status = 'completed'";
$sql_in_progress = "SELECT COUNT(*) AS total_in_progress FROM orders WHERE status = 'in_progress'";
$sql_canceled = "SELECT COUNT(*) AS total_canceled FROM orders WHERE status = 'canceled'";

$result_completed = $conn->query($sql_completed);
$result_in_progress = $conn->query($sql_in_progress);
$result_canceled = $conn->query($sql_canceled);

$total_completed = ($result_completed->num_rows > 0) ? $result_completed->fetch_assoc()['total_completed'] : 0;
$total_in_progress = ($result_in_progress->num_rows > 0) ? $result_in_progress->fetch_assoc()['total_in_progress'] : 0;
$total_canceled = ($result_canceled->num_rows > 0) ? $result_canceled->fetch_assoc()['total_canceled'] : 0;
