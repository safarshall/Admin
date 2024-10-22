<!-- Modal untuk Profil Pengguna -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Informasi Umum Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <div class="modal-body">
        <h6>Nama: <?= htmlspecialchars($username) ?></h6>
        <h6>Email: <?= htmlspecialchars($email) ?></h6>
        <!-- Tambahkan informasi lain di sini -->
        <hr>
        <!-- Tombol untuk aksi pengguna -->
        <button type="button" class="btn btn-primary" onclick="location.href='update-profile.php';">Perbarui Data Diri</button>
        <button type="button" class="btn btn-warning" onclick="location.href='change-password.php';">Ganti Kata Sandi</button>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    </div>
    </div>
</div>