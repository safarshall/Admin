<?php
session_start();
include '../config/database.php';

// Cek apakah sesi reset_email ada, jika tidak arahkan ke halaman lupa password
if (!isset($_SESSION['reset_email'])) {
    header('Location: forgot_password.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'];
    $email = $_SESSION['reset_email'];

    // Update password di database, hapus kolom otp_code dan otp_expiry (karena tidak diperlukan)
    $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $update->bind_param('ss', $new_password, $email);
    $update->execute();

    // Hapus sesi reset_email dan alihkan ke halaman login
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Sandi</title>
</head>
<body>
    <form method="POST">
        <input type="password" name="password" placeholder="Masukkan sandi baru" required>
        <button type="submit">Reset Sandi</button>
    </form>
</body>
</html>
