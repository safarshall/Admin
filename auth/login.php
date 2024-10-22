<?php
session_start();
include '../config/database.php';

$error_message = '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$show_reset_form = false; // Inisialisasi flag untuk menampilkan form reset password

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
    // Pastikan kolom email dan password telah diisi
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query untuk mengambil user berdasarkan email
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        // Cek apakah user ditemukan dan password cocok (tanpa hash)
        if ($result && $password === $result['password']) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['role'] = $result['role'];

            // Redirect berdasarkan peran user
            if ($result['role'] === 'admin') {
                header('Location: ../AdminWeb/index.php');
            } else {
                header('Location: ../user/index.php');
            }
            exit();
        } else {
            $error_message = 'Email atau Password salah';
        }
    } else {
        $error_message = 'Harap masukkan email dan password.';
    }
}

// Reset password logic without OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'forgot_password') {
    $email = $_POST['forgot_email'];

    // Cek apakah email terdaftar
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    if ($result) {
        // Jika email valid, set flag untuk menampilkan form reset password
        $show_reset_form = true;
        $_SESSION['reset_email'] = $email; // Simpan email di session untuk digunakan saat mereset password
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}

// Proses pembaruan password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'update_password') {
    if (isset($_POST['new_password'])) {
        $new_password = $_POST['new_password'];
        $email = $_SESSION['reset_email'];

        // Update password di database (TANPA HASHING)
        $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update->bind_param('ss', $new_password, $email);
        $update->execute();

        // Hapus sesi dan alihkan ke halaman login
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <!-- Form Login -->
    <form method="POST">
        <input type="hidden" name="form_type" value="login"> 
        <?php if (!empty($error_message)) : ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="forgot-password">
            <a href="#" id="forgotPasswordLink">Lupa kata sandi?</a>
        </div>
    </form>
    
    <!-- Form untuk Mengubah Password -->
    <?php if ($show_reset_form) : ?>
        <div class="reset-password-card">
            <form method="POST" type="hidden">
                <input type="hidden" name="form_type" value="update_password"> 
                <input type="password" name="new_password" placeholder="Masukkan kata sandi baru" required>
                <button type="submit">Ubah Sandi</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Popup untuk "Lupa Sandi" -->
<div id="forgotPasswordModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h4>Lupa Kata Sandi</h4>
        <h5>Silahkan Reset Password Anda<br> Masukkan email Anda untuk melanjutkan</h5>
        <form method="POST" class="otp">
            <input type="hidden" name="form_type" value="forgot_password"> 
            <input type="email" name="forgot_email" placeholder="Masukkan email Anda" required>
            <button type="submit" class="btn-reset">Kirim</button>
        </form>
    </div>
</div>

<script src="js/resetpass.js"></script>
</body>
</html>
