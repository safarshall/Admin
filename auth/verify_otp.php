<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['reset_email'])) {
    header('Location: forgot_password.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];
    $email = $_SESSION['reset_email'];

    // Cek apakah OTP valid dan belum kadaluarsa
    $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND otp_code = ? AND otp_expiry >= NOW()");
    $query->bind_param('ss', $email, $otp);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    if ($result) {
        // Jika OTP valid, alihkan ke halaman reset password
        header('Location: reset_password.php');
        exit();
    } else {
        echo "OTP tidak valid atau sudah kadaluarsa!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="otp" placeholder="Masukkan OTP" required>
        <button type="submit">Verifikasi</button>
    </form>
</body>
</html>
