<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
<!-- Card Example for Best-Selling Product -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Produk Terlaris</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $product_name; ?> (<?php echo $total_ordered; ?> Pesanan)
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-box fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Card Example for Newly Released Product -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Produk Terbaru</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $new_product_name; ?>
                    </div>
                    <div class="text-xs text-gray-500">
                        Dirilis pada: <?php echo $release_date; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-box-open fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card Example for Orders in Progress -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Sedang Berlangsung</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $total_in_progress; ?> Pesanan
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Card Example for Completed Orders -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Selesai</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $total_completed; ?> Pesanan
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->

</div>