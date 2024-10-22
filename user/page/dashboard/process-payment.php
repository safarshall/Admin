<?php
session_start();

// Periksa apakah metode pembayaran telah dikirimkan
if (isset($_POST['payment_method'])) {
    $paymentMethod = $_POST['payment_method'];
    
    // Lakukan logika untuk memproses pembayaran berdasarkan metode yang dipilih
    // Misalnya, buat pesanan, proses pembayaran dengan API gateway, dll.
    
    // Contoh sederhana:
    if ($paymentMethod == 'credit_card') {
        // Proses pembayaran kartu kredit (logika Anda di sini)
    } elseif ($paymentMethod == 'bank_transfer') {
        // Proses pembayaran transfer bank
    } elseif ($paymentMethod == 'cash') {
        // Proses bayar di tempat
    }
    
    // Berikan respon sukses
    http_response_code(200);
    echo json_encode(['status' => 'success', 'message' => 'Pembayaran berhasil']);
    exit;
} else {
    // Jika tidak ada metode pembayaran yang dipilih
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Metode pembayaran tidak dipilih']);
    exit;
}
