<?php
include '../config/database.php';

$registration_status = ''; // Untuk menyimpan status pendaftaran

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Password tidak di-hash
    $role = 'user'; // Set default role as "user"

    // Cek apakah username sudah terdaftar
    $check_username = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($check_username->num_rows > 0) {
        $registration_status = "Username sudah terdaftar. Silakan gunakan username lain.";
    } else {
        // Masukkan data user baru ke database tanpa hash password
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $registration_status = "Pendaftaran berhasil. <a href='login.php'>Login sekarang</a>";
        } else {
            $registration_status = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User - Toko UMKM</title>
    <link rel="stylesheet" href="css/daftar.css">
</head>
<body>

    <div class="container">
        <div class="form">
        <h2>Daftar Akun Baru</h2>
        <?php if ($registration_status): ?>
            <p class="status-message"><?= $registration_status; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Daftar</button>
            </div>
            <div class="form-group">
                <a href="login.php">Sudah punya akun? Login di sini</a>
            </div>
        </div>
        
        </form>
    </div>

</body>
</html>
