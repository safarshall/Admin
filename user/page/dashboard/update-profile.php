<?php
// Ambil informasi pengguna dari session atau database
$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';

// Cek apakah ada pesan dari proses update
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>

<h2>Perbarui Profil</h2>
<?php if ($message): ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<form method="POST" action="update-profile.php">
    <label for="username">Nama:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

    <button type="submit">Perbarui</button>
</form>
