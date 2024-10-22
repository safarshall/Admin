<?php
include '../config/database.php';
include '../config/bestseller.php';
include '../config/newitem.php';
include '../config/progres.php';
include '../config/done.php';
include '../config/search.php';


// Ambil daftar produk dari database
$products = $conn->query("SELECT * FROM products");
