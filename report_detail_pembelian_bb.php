<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
if (isset($_GET['idPembelian'])) {
    $id_pembelian=$_GET['idPembelian'];
}else{
    $id_pembelian=0;
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

</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
	<?php include "./view/common/navbar.php" ?>
	<?php include "./view/common/aside.php" ?>
    <form class="form-horizontal" action="controller/conn_delete_pembelian.php" method="post">
    <input type="hidden" class="form-control" name="idAwal" value="<?php echo $id_pembelian;?>">
    <div class="content-wrapper">
		<!-- Content Header (Page header) -->
			<div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard Pembelian Bahan Baku 
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
			  <div class="row">
              <div class="col-12">
                    <div class="card-body col-sm-10 p-30">
                        <div class="form-group row">
                            <label for="idPembelian" class="col-sm-3 col-form-label">ID Pembelian</label>
                            <div class="col-sm-9">
                                <select class="form-control" style="width: 100%;" name="idPembelian" id="idPembelian" onChange="setPembelian()">
                                <option value="" disabled selected>ID Pembelian</option>
                                    <?php 
                                    $no = 1;
                                    $result_head = mysqli_query($db2,"select * from `pembelian` inner join supplier on supplier.id_supplier = pembelian.id_supplier");
                                    while($d_head = mysqli_fetch_array($result_head)){
                                    ?>
                                    <option <?php if($id_pembelian==$d_head['id_pembelian']){echo "selected";} ?>
                                        value="<?php echo $d_head['id_pembelian']; ?>/<?php echo $d_head['tanggal_pembelian']; ?>/<?php echo $d_head['tanggal_pengiriman']; ?>/<?php echo $d_head['id_supplier']; ?>/<?php echo $d_head['nama_toko']; ?>">
                                        <?php echo $d_head['id_pembelian']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                    placeholder="Pilih ID Konsumen agar tanggal pembelian terisi" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_pengiriman" class="col-sm-3 col-form-label">Tanggal Pengiriman:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman"
                                    placeholder="Pilih ID Konsumen agar tanggal pengiriman terisi" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_supplier" class="col-sm-3 col-form-label">ID Supplier</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_supplier" name="id_supplier"
                                    placeholder="Pilih ID Konsumen agar nama konsumen terisi" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Supplier Pemasok</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                    placeholder="Pilih ID Konsumen agar Nama Supplier Pemasok terisi" value="" readonly>
                            </div>
                        </div>
                    </div>
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>ID Bahan Baku</th>
                              <th>Nama Bahan Baku</th>
                              <th>Jumlah Pembelian Bahan Baku</th>
                              <th>UOM</th>
                            </tr>
                          </thead>
                            <tbody>
                            <?php
                            $no = 0;
                            $sql = mysqli_query($db2,"
                            select p.id_pembelian, p.tanggal_pembelian, p.tanggal_pengiriman, s.id_supplier, s.nama_toko, d.id_bahan_baku, b.nama_bahan_baku, d.jumlah_pembelian, b.uom
                            from `pembelian` AS p 
                            inner join detail_pembelian as d on p.id_pembelian = d.id_pembelian 
                            inner join bahan_baku as b on d.id_bahan_baku = b.id_bahan_baku
                            inner join user as u on p.nik = u.nik 
                            inner join supplier as s on p.id_supplier = s.id_supplier 
                            where p.id_pembelian = '$id_pembelian'
                            ");
                            while($result = mysqli_fetch_array($sql)){
                            $no = $no + 1;
                            ?>
                          		<tr>
                          		  <td><?php echo $no; ?></td>
                          		  <td><?php echo $result['id_bahan_baku']; ?></td>
                          		  <td><?php echo $result['nama_bahan_baku']; ?></td>
                          		  <td><?php echo $result['jumlah_pembelian']; ?></td>
                          		  <td><?php echo $result['uom']; ?></td>
                          		</tr>   
                            <?php } ?>                              
						    </tbody>
                        </table>
                     	</div>
                      <!-- /.card-body -->
                  	</div>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-info" name="id_ev" style="width: 150px; margin-top: 10px; margin-right: 15px; right: 0px;"
                            href="pengisian_pembelian_bb_edit.php?id_pembelian=<?php echo $id_pembelian; ?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <button type="submit" class="btn btn-danger"
                                style="width: 150px; margin-top: 10px; right: 0px; margin-right: 15px;">
                                <i class="fas fa-times"></i> Delete
                            </button>
                            <a class="btn btn-success" name="id_ev" style="width: 150px; margin-top: 10px; margin-right: 15px; right: 0px;"
                            href="pembelian_bb_print.php?id_pembelian=<?php echo $id_pembelian; ?>">
                                <i class="fas fa-print">
                                </i>
                                Print
                            </a>
                        </div>
                    </div>
                  <!-- /.card -->
             		 </div>
          		</div>
            </div>
        </section>
        <!-- /.content -->
    </div>   
	</div>
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

    <!-- Page specific script -->
    <script>
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "sorting": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });
        });

        $('#modal-cancel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient_e = button.data('e'); // Extract info from data-* attributes
            var recipient_v = button.data('v');
            var recipient_c = button.data('c');
            var recipient_i = button.data('i');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.namaKaryawan').val(recipient_e);
            modal.find('.jabatan').val(recipient_v);
            modal.find('.nik').val(recipient_c);

            document.getElementById("namaKaryawan").innerHTML = recipient_e;
            document.getElementById("jabatan").innerHTML = recipient_v;
            document.getElementById("nik").innerHTML = recipient_c;

        })

        $('#modal-edit-header').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient_e = button.data('e'); // Extract info from data-* attributes
            var recipient_v = button.data('v');
            var recipient_c = button.data('c');
            var recipient_i = button.data('i');
            var recipient_a = button.data('a');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.nik1').val(recipient_c);
            modal.find('.nama1').val(recipient_e);
            modal.find('.jabatan1').val(recipient_v);
            modal.find('.noTelp1').val(recipient_i);
            modal.find('.stockMin1').val(recipient_a);
            modal.find('.idKon1').val(recipient_c);

            document.getElementById("nik1").value = recipient_c;
            document.getElementById("nama1").value = recipient_e;
            document.getElementById("jabatan1").value = recipient_v;
            document.getElementById("noTelp1").value = recipient_i;
            document.getElementById("stockMin1").value = recipient_a;


        })


        $('#modal-add').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)
        })

        $("#accountHead").removeClass("none");
        $("#selectid").on("change", function () {
            $("#accountHead").addClass("none");
            if (this.value == "0") {
                $("#accountHead").removeClass("none");
            }
        });
    </script>

    <!-- Page specific script -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var testX = "<?php echo $id_pembelian;?>";
            if (testX !="0") {
                var x = document.getElementById("idPembelian").value;
                var arr_dataK = x.split('/');
                document.getElementById("tanggal_pembelian").value = arr_dataK[1];
                document.getElementById("tanggal_pengiriman").value = arr_dataK[2];
                document.getElementById("id_supplier").value = arr_dataK[3];
                document.getElementById("nama_supplier").value = arr_dataK[4];
            }else{
                document.getElementById("idPembelian").value = "";
            }
            

        }, false);

        function setPembelian() {
        var x = document.getElementById("idPembelian").value;
        var arr_dataK = x.split('/');
        document.getElementById("tanggal_pembelian").value = arr_dataK[1];
        document.getElementById("tanggal_pengiriman").value = arr_dataK[2];
        document.getElementById("id_supplier").value = arr_dataK[3];
        document.getElementById("nama_supplier").value = arr_dataK[4];
        window.location.href = 'report_detail_pembelian_bb.php?idPembelian='+arr_dataK[0];
        }
    </script>
</body>

