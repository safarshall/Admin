<style>
    table {
        width: 100%; 
        border-collapse: collapse; 
    }

    th, td {
        text-align: center;
        padding: 5px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2; 
    }

    th:nth-child(1), td:nth-child(1) { 
        width: 10%; 
    }
    
    th:nth-child(2), td:nth-child(2) { 
        width: 35%; 
    }
    
    th:nth-child(3), td:nth-child(3) { 
        width: 25%; 
    }
    
    th:nth-child(4), td:nth-child(4) { 
        width: 15%; 
    }

    th:nth-child(5), td:nth-child(5) { 
        width: 15%; 
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <!-- Tombol Tambah Produk -->
                            <a href="add_product.php">Tambah Produk</a>
                        </div>

                        <!-- Tabel Daftar Produk -->
                        <?php 
                        $host = 'localhost';
                        $user = 'root';
                        $pass = '';
                        $db   = 'umkm';

                        $conn = new mysqli($host, $user, $pass, $db);
                        if ($conn->connect_error) {
                            die('Koneksi Gagal: ' . $conn->connect_error);
                        }  
                        $query = "SELECT * FROM products"; 
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            // Jika ada produk, tampilkan
                            echo '<table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['price'] . '</td>
                                    <td>' . $row['stock'] . '</td>
                                    <td>
                                        <a href="edit_product.php?id=' . $row['id'] . '">Edit</a> |
                                        <a href="delete_product.php?id=' . $row['id'] . '" 
                                        onclick="return confirm(\'Hapus produk ini?\')">Hapus</a>
                                    </td>
                                </tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo "<p>Tidak ada produk yang tersedia</p>";
                        }
                        ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
