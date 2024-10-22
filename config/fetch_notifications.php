<?php
// Include your database connection file
include 'database.php';

// Fetch unread notifications
$sql = "SELECT * FROM notifications WHERE is_read = FALSE ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$notifications = [];
while ($row = mysqli_fetch_assoc($result)) {
    $notifications[] = $row;
}

// Return notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);

