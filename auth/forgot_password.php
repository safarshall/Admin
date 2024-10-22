<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar di database
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    if ($result) {
        // Set session untuk reset email
        $_SESSION['reset_email'] = $email;

        // Redirect ke halaman reset password
        header('Location: reset_password.php');
        exit();
    } else {
        $error_message = 'Email tidak ditemukan!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
</head>
<body>
    <h2>Lupa Kata Sandi</h2>

    <?php if (isset($error_message)): ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Masukkan email Anda" required>
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
