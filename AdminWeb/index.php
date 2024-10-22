<?php

include('../config/database.php'); 

session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    echo "User belum login. Arahkan ke login.";
    header('Location: ../auth/login.php');
    exit;
}
?>
<?php include 'page/dashboard/start.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Beranda </title>
    <?php include 'page/dashboard/headglobal.php'; ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'page/dashboard/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'page/dashboard/conten-wrap.php'; ?> 
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Dynamic Content Loaded Here -->
                    <?php 
                    // Tangkap parameter halaman dari sidebar
                    $page = isset($_GET['page']) ? $_GET['page'] : 'main-content';
                    $page = basename($page);
                    // Bangun path file berdasarkan halaman yang dipilih
                    $paths = [
                        __DIR__ . '/page/dashboard/' . $page . '.php',
                        __DIR__ . '/../page/' . $page . '.php',
                        __DIR__ . '/../products/' . $page . '.php',
                        __DIR__ . '/../orders/' . $page . '.php',
                    ];
                    
                    $file = null;
                    foreach ($paths as $path) {
                        if (file_exists($path)) {
                            $file = $path;
                            break;
                        }
                    }
                    if ($file) {
                        include $file;
                    } else {
                        echo "<p>Halaman tidak ditemukan: ";
                    }
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <?php include 'page/dashboard/logout-modal.php'; ?>
    <?php include 'page/dashboard/foot-scripts.php'; ?>

</body>
</html>
