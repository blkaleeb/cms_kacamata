<?php 
    if($_SESSION['status_ca'] !="login"){
        header("location:login.php");
    }
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[2];
if (isset($_GET['periode']) && isset($_GET['outlet_x'])) {
$peroide_x = $_GET['periode'];
$outlet_x = $_GET['Outlet'];
}else{
    $peroide_x = "";
    $outlet_x = "";
}
if (isset($_GET['periode']) && !isset($_GET['outlet_x'])) {
    $peroide_x = $_GET['periode'];

    }else{
        $peroide_x = "";

    }

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">Kacamata</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!--<li class="nav-header">Master Data</li>-->
                <li class="nav-item">
                    <a href="artikel.php"
                        class="nav-link <?php if ($first_part=="artikel.php") {echo "active"; } else  {echo "noactive";}?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Artikel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="konsumen.php"
                        class="nav-link <?php if ($first_part=="konsumen.php") {echo "active"; } else  {echo "noactive";}?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Contact Us
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="supplier.php"
                        class="nav-link <?php if ($first_part=="supplier.php") {echo "active"; } else  {echo "noactive";}?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Supplier
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="karyawan.php"
                        class="nav-link <?php if ($first_part=="karyawan.php") {echo "active"; } else  {echo "noactive";}?>">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Karyawan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php if ($first_part=="pesanan_barang.php" || $first_part=="report_pesanan.php" 
                    || $first_part=="detail_pesanan.php") {echo "active"; } else  {echo "noactive";}?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Banner
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pesanan_barang.php"
                                class="nav-link <?php if ($first_part=="pesanan_barang.php") {echo "active"; } else  {echo "noactive";}?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="detail_pesanan.php"
                                class="nav-link <?php if ($first_part=="detail_pesanan.php") {echo "active"; } else  {echo "noactive";}?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report_pesanan.php"
                                class="nav-link <?php if ($first_part=="report_pesanan.php") {echo "active"; } else  {echo "noactive";}?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>