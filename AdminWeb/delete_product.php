<?php
session_start();
include '../config/database.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id = $id");

header('Location: index.php');
