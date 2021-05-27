<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
$id_pembelian = $_GET['id_pembelian'];

$sql = mysqli_query($db2,"
select p.id_pembelian, p.tanggal_pembelian, p.tanggal_pengiriman, s.id_supplier, s.nama_toko, s.no_telp_toko, s.alamat_toko, s.email, d.id_bahan_baku, b.nama_bahan_baku, d.jumlah_pembelian, b.uom, u.nik, u.nama
from `pembelian` AS p 
inner join detail_pembelian as d on p.id_pembelian = d.id_pembelian 
inner join bahan_baku as b on d.id_bahan_baku = b.id_bahan_baku
inner join user as u on p.nik = u.nik 
inner join supplier as s on p.id_supplier = s.id_supplier 
where p.id_pembelian = '$id_pembelian'
");
while($d_head = mysqli_fetch_array($sql)){
   $nik= $d_head['nik'];
   $nama= $d_head['nama'];
   $id_supplier= $d_head['id_supplier'];
   $nama_toko= $d_head['nama_toko'];
   $tanggal_pembelian= $d_head['tanggal_pembelian'];
   $tanggal_pengiriman= $d_head['tanggal_pengiriman'];
   $no_telp_toko= $d_head['no_telp_toko'];
   $alamat_toko= $d_head['alamat_toko'];
   $email= $d_head['email'];
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Persediaan Barang</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- icon -->
    <link rel="icon" href="dist/img/logogram.png">
    <style>
        .none {
            display: none;
        }

        .hidden{
            display: none;
        }
    </style>
    <script>
    window.print();
    (function () {

    var beforePrint = function () {
        // window.location.href = "pembelian_bb_print.php?id_pembelian=<?php echo $id_pembelian; ?>";
    };

    var afterPrint = function () {
        window.location.href = "report_detail_pembelian_bb.php?id_pembelian=<?php echo $id_pembelian; ?>";
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');

        mediaQueryList.addListener(function (mql) {
            //alert($(mediaQueryList).html());
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

    }());
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <?php include "./view/common/navbar.php" ?>

        <?php include "./view/common/aside.php" ?>
        <input type="hidden" class="form-control" name="idAwal" value="<?php echo $id_pembelian;?>">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Pembelian Bahan Baku
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 style="text-align:center ; font-weight:'bold'">FORM CHECKLIST PEMBELIAN BAHAN BAKU</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="id_pembelian" class="col-sm-3 col-form-label">Nomor ID Pembelian</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="id_pembelian" name="id_pembelian" placeholder="ID Master Data" value="<?php echo $id_pembelian?>"><?php echo $id_pembelian?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" placeholder="ID Master Data" value="<?php echo $tanggal_pembelian?>"><?php echo $tanggal_pembelian?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_Pengiriman" class="col-sm-3 col-form-label">Tanggal Pengiriman</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="tanggal_Pengiriman" name="tanggal_Pengiriman" placeholder="ID Master Data" value="<?php echo $tanggal_pengiriman?>"><?php echo $tanggal_pengiriman?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="nama_supplier" name="nama_supplier" placeholder="ID Master Data" value="<?php echo $nama_toko?>"><?php echo $nama_toko?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="alamat" name="alamat" placeholder="ID Master Data" value="<?php echo $alamat_toko?>"><?php echo $alamat_toko?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_tlp" class="col-sm-3 col-form-label">No Telp</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="no_tlp" name="no_tlp" placeholder="ID Master Data" value="<?php echo $no_telp_toko?>"><?php echo $no_telp_toko?></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <p class="form-control" id="email" name="email" placeholder="ID Master Data" value="<?php echo $email?>"><?php echo $email?></p>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12">
                                    <table id="listPembelian" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">ID Bahan Baku</th>
                                                <th rowspan="2">Nama Bahan Baku</th>
                                                <th colspan="2">Jumlah Bahan Baku</th>
                                                <th rowspan="2">UOM</th>
                                                <th rowspan="2">Validasi</th>
                                            </tr>
                                            <tr>
                                                <th>Dibeli</th>
                                                <th>Diterima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										    <?php
                                            $sqlJurnal= mysqli_query($db2,"
                                            select p.id_pembelian, p.tanggal_pembelian, p.tanggal_pengiriman, s.id_supplier, s.nama_toko, d.id_bahan_baku, b.nama_bahan_baku, d.jumlah_pembelian, b.uom, u.nik, u.nama
                                            from `pembelian` AS p 
                                            inner join detail_pembelian as d on p.id_pembelian = d.id_pembelian 
                                            inner join bahan_baku as b on d.id_bahan_baku = b.id_bahan_baku
                                            inner join user as u on p.nik = u.nik 
                                            inner join supplier as s on p.id_supplier = s.id_supplier 
                                            where p.id_pembelian = '$id_pembelian'
                                            ");
                                            $x=0;
                                            while($dataJurnal = mysqli_fetch_array($sqlJurnal)){
                                            ?>
                                            <tr class=''>
                                                <td style="text-align: center;">
                                                    <?php echo $x+1;?>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="account[<?php echo $x;?>]" id="account[<?php echo $x;?>]" class="form-control"
															style="width: 100%;" onChange="setBahanbaku(this)" readonly>
                                                            <option value="" disabled selected>ID Barang</option>
                                                            <?php 
                                                                $no = 1;
                                                                $result_head = mysqli_query($db2,"select * from `bahan_baku`");
                                                                while($d_head = mysqli_fetch_array($result_head)){
                                                            ?>
                                                            <option value="<?php echo $d_head['id_bahan_baku']; ?>/<?php echo $d_head['nama_bahan_baku']; ?>/<?php echo $d_head['uom']; ?>/<?php echo $x; ?>"
                                                            <?php if ($d_head['id_bahan_baku']==$dataJurnal['id_bahan_baku']) { echo "selected";}?>><?php echo $d_head['id_bahan_baku']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input value="<?php echo $dataJurnal['nama_bahan_baku']; ?>" type="text" name="deskripsi[<?php echo $x;?>]" id="deskripsi[<?php echo $x;?>]" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <div class="row" style="margin:auto;"><input type="number" style="width: 100%;"
                                                        id="inputHargaD<?php echo $x;?>" name="Debit[<?php echo $x;?>]"
                                                        class="form-control" value="<?php echo $dataJurnal['jumlah_pembelian']; ?>" min=0>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row" style="margin:auto;">
                                                        <input type="number" style="width: 100%;" id="" name="" class="form-control" value="" min=0>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="uom[<?php echo $x;?>]" name="uom[<?php echo $x;?>]" placeholder="Pilih ID Konsumen agar nama konsumen terisi" value="<?php echo $dataJurnal['uom']; ?>" readonly>
                                                </td>
                                                <td>
                                                    <div class="row" style="margin:auto;">
                                                        <input type="number" style="width: 100%;" id="" name="" class="form-control" value="" min=0>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $x++; 
                                            }?>																				
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                        <!-- /.row -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="#">Michael William</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> Beta
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>

    <!-- Page specific script -->
    <script type="text/javascript">

        function setBahanbaku(t) {
        var x = t.value;
        var arr_dataB = x.split('/');
		document.getElementById("deskripsi["+arr_dataB[3]+"]").value = arr_dataB[1];
		document.getElementById("uom["+arr_dataB[3]+"]").value = arr_dataB[2];
        // document.getElementById("nama_bahanbaku").value = arr_dataB[1];
        // document.getElementById("uom").value = arr_dataB[2];
        }

        function setKaryawan() {
        var x = document.getElementById("id_karyawan").value;
        var arr_dataK = x.split('/');
        document.getElementById("nama_karyawan").value = arr_dataK[1];
        }

        function setSupplier() {
        var x = document.getElementById("id_supplier").value;
        var arr_dataK = x.split('/');
        document.getElementById("nama_toko").value = arr_dataK[1];
        }
    </script>

</body>

