<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
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
    </style>
		<style>
        .hidden{
            display: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <?php include "./view/common/navbar.php" ?>

        <?php include "./view/common/aside.php" ?>
        <form class="form-horizontal" action="controller/conn_add_kerusakan.php" method="post">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Kerusakan Bahan Baku
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
                            <h3 class="card-title">Input Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3> Pihak yang Melakukan Pelaporan Kerusakan Bahan Baku </h3>
                                    <div class="form-group row">
                                        <label for="id_karyawan" class="col-sm-3 col-form-label">Nomor ID Karyawan</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" style="width: 100%;" name="id_karyawan" id="id_karyawan" onChange="setKaryawan()" required>
                                            <option value="" disabled selected>ID Karyawan</option>
                                                <?php 
                                                $no = 1;
                                                $result_head = mysqli_query($db2,"select * from `user`");
                                                while($d_head = mysqli_fetch_array($result_head)){
                                                ?>
                                                <option value="<?php echo $d_head['nik']; ?>/<?php echo $d_head['nama']; ?>">
                                                    <?php echo $d_head['nik']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_karyawan" class="col-sm-3 col-form-label">Nama Karyawan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="ID Master Data" readonly>
                                        </div>
                                    </div>
                                    <h3> Waktu Pelaporan Kerusakan Bahan Baku </h3>
                                    <div class="form-group row">
                                        <label for="tanggal_pelaporan" class="col-sm-3 col-form-label">Tanggal Kerusakan:</label>
                                        <div class="col-sm-3">
                                            <input type="date" class="form-control" id="tanggal_pelaporan" name="tanggal_pelaporan" value="" required/>
                                        </div>
                                    </div>
                                    <h3> Daftar Kerusakan Bahan Baku </h3>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12">
                                    <table id="listKerusakan" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Bahan Baku</th>
                                                <th>Nama Bahan Baku</th>
                                                <th>Jumlah Kerusakan Bahan Baku</th>
                                                <th>UOM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										    <?php 
										    $sql = mysqli_query($db2,"select * from `bahan_baku`");
										    for ($i=0; $i <= 50; $i++) { 
										    	$no = 0;
                                                $no = $no + 1;
                                            ?>
                                            <tr class="hidden">
                                                <td style="text-align: center;">
                                                    <a class="btn btn-danger btn-sm delete_another" onClick=" $(this).closest('tr').remove();">
                                                        <i class="fas fa-times">
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="form-group">
															<select name="account[<?php echo $i;?>]" id="account[<?php echo $i;?>]" class="form-control"
															style="width: 100%;" onChange="setKerusakan(this)">
                                                            <option value="" disabled selected>Pilih Bahan Baku</option>
                                                            <?php 
                                                            $result_head = mysqli_query($db2,"select * from `bahan_baku`");
                                                            while($d_head = mysqli_fetch_array($result_head)){
                                                            ?>
                                                            <option value="<?php echo $d_head['id_bahan_baku'];?>/<?php echo $d_head['nama_bahan_baku']; ?>/<?php echo $d_head['uom']; ?>/<?php echo $i; ?>">
                                                                <?php echo $d_head['id_bahan_baku']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="deskripsi[<?php echo $i;?>]" name="deskripsi[<?php echo $i;?>]" placeholder="Pilih ID Bahan Baku agar Nama Bahan Baku terisi" value="" readonly>
                                                </td>
                                                <td>
														<div class="row" style="margin:auto;"><input type="number" style="width: 80%;"
                                            			id="inputHargaD<?php echo $i;?>" name="Debit[<?php echo $i;?>]"
                                           				class="form-control" value="" min=0> <p style="margin:auto;">Pcs</p>
														</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="uom[<?php echo $i;?>]" name="uom[<?php echo $i;?>]" placeholder="Pilih ID Bahan Baku agar UOM terisi" value="" readonly>
                                                </td>
                                            </tr>
											<?php }?>																				
                                        </tbody>
                                    </table>
										<a class="btn btn-primary add_another" id="btnAddCol" onClick="$('#listKerusakan').find('tr.hidden:first').removeClass('hidden');"
												style="width: 150px; margin-top: 10px; margin-right: 20px;">
												+ New Column
										</a>


										<button type="submit" class="btn btn-success"
												style="width: 150px; margin-top: 10px; right: 0px;">
												<i class="fas fa-check"></i> Simpan
										</button>
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
        </form>
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
    
    <script>
        $(function() {
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#tanggal_pelaporan').datetimepicker({
                format: 'L'
            })
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              locale: {
                format: 'MM/DD/YYYY hh:mm A'
              }
            })
        });
    </script>

    <!-- Page specific script -->
    <script type="text/javascript">

        function setKerusakan(t) {
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

