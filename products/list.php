<?php
// Membuat koneksi ke database
$db = new mysqli('localhost', 'root', '', 'umkm');

// Cek apakah koneksi berhasil
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// Query untuk mengambil data produk
$query = "SELECT * FROM products";
$products = $db->query($query);

// Cek apakah query berjalan dengan sukses
if (!$products) {
    die("Error pada query: " . $db->error);
}
?>

<style>
    .product-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }

    .product-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        background-color: #fff;
    }
    .card-body{
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }

    

</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
<!-- Card Example for Best-Selling Product -->
<div class="col-12">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Daftar Produk
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <div class="product-list">
                            <?php while ($product = $products->fetch_assoc()) { ?>
                                <div class="product-item">
                                    <h3><?= $product['name'] ?></h3>
                                    <p><?= $product['description'] ?></p>
                                    <p>Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                                    <a href="../products/detail.php?id=<?= $product['id'] ?>">Lihat Detail</a>
                                    <form action="../products/cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <i class="fas fa-box fa-2x text-gray-300"></i>
    </div>
</div>
