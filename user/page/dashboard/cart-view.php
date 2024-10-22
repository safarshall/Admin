<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil data keranjang dari session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Hapus item dari keranjang jika ada permintaan hapus
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $idToRemove = intval($_GET['id']);
    
    foreach ($cart as $key => $item) {
        if ($item['id'] === $idToRemove) {
            unset($cart[$key]); 
        }
    }
    
    $_SESSION['cart'] = array_values($cart); 
    
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
    exit; 
}
?>


<h1>Keranjang Belanja</h1>
<div class="product-list">
    <?php if (empty($cart)) { ?>
        <p>Keranjang belanja kosong.</p>
    <?php } else { ?>
        <?php foreach ($cart as $item) { ?>
            <div class="product-item" data-id="<?= $item['id'] ?>">
                <h3><?= htmlspecialchars($item['name']) ?></h3>
                <p>Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                <button class="btn btn-danger" onclick="removeItem(<?= $item['id'] ?>)">Hapus</button>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<a href="javascript:void(0)" onclick="showPaymentMethods()" class="btn btn-primary">Lanjutkan ke Pembayaran</a>

<div id="payment-methods" style="display:none;">
    <h2>Pilih Metode Pembayaran</h2>
    <form id="payment-form">
        <label>
            <input type="radio" name="payment_method" value="credit_card" required> Kartu Kredit
        </label><br>
        <label>
            <input type="radio" name="payment_method" value="bank_transfer" required> Transfer Bank
        </label><br>
        <label>
            <input type="radio" name="payment_method" value="cash" required> Bayar di Tempat
        </label><br>
        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
    </form>
</div>


<script>
function removeItem(itemId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'page/dashboard/cart-view.php?action=remove&id=' + itemId, true);
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        console.log('Item berhasil dihapus.');
                        
                        const productItem = document.querySelector(`.product-item[data-id="${itemId}"]`);
                        if (productItem) {
                            productItem.remove();
                        }
                        
                        console.log('Keranjang saat ini:', response.cart);
                    }
                } catch (e) {
                    console.error('Gagal memparsing JSON: ', e);
                    console.log('Respons dari server:', xhr.responseText);
                }
            } else {
                console.error('Terjadi kesalahan saat menghapus item: ' + xhr.statusText);
            }
        }
    };

    xhr.onerror = function () {
        console.error('Request failed.');
    };
    
    xhr.send();
};
function showPaymentMethods() {
    // Tampilkan form metode pembayaran
    document.getElementById('payment-methods').style.display = 'block';
}

document.getElementById('payment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Ambil metode pembayaran yang dipilih
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'page/dashboard/process-payment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            alert('Pembayaran berhasil dengan metode: ' + paymentMethod);
        } else if (xhr.readyState === XMLHttpRequest.DONE) {
            alert('Gagal memproses pembayaran.');
        }
    };
    
    xhr.send('payment_method=' + encodeURIComponent(paymentMethod));
});
</script>
