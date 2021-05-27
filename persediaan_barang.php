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
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="modal fade" id="modal-cancel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">PERHATIAN !!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin menghapus data Barang ini ?<br>
                        ID Barang &nbsp; :<b id="nik"></b><br>
                        Nama Barang &nbsp; :<b id="namaKaryawan"></b><br>
                        Harga &nbsp; :<b id="jabatan"></b></p>
                </div>
                <form action="controller/conn_delete_barang.php" method="post">
                    <input class="codeC" type="hidden" name="codeC">
                    <input class="nameC" type="hidden" name="nameC">
                    <input class="nik" type="hidden" name="nik">
                    <input class="typeC" type="hidden" name="typeC">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-edit-header">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/conn_edit_barang.php" method="post">
                    <div class="modal-body">
                    <div class="form-group row">
                            <label for="nik1" class="col-sm-12 col-form-label">ID Barang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nik1" name="nik1"
                                    placeholder="ID Barang" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama1" class="col-sm-12 col-form-label">Nama Barang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama1" name="nama1"
                                    placeholder="Nama Barang" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan1" class="col-sm-12 col-form-label">Harga Barang</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="jabatan1" name="jabatan1"
                                    value="">
                            </div>
                        </div>


                        <input class="idKon1" type="hidden" id="idKon1" name="idKon1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add - New Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="controller/conn_add_barang.php" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-12 col-form-label">ID Barang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nik2" name="nik2"
                                    placeholder="ID Barang" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-12 col-form-label">Nama Barang</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama2" name="nama2"
                                    placeholder="Nama Barang" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-12 col-form-label">Harga Barang</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="jabatan2" name="jabatan2"
                                    value="">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="wrapper">
        <?php include "./view/common/navbar.php" ?>

        <?php include "./view/common/aside.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Persediaan Barang
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
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Nama Bahan Baku</th>
                                                <th rowspan="2">ID Bahan Baku</th>
                                                <th rowspan="2">UOM</th>
                                                <th colspan="2">Jumlah Stok Bahan Baku</th>
                                                <th rowspan="2">Stok Minimum Bahan Baku</th>
                                            </tr>
                                            <tr>
                                                <th>Baik</th>
                                                <th>Buruk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            $sql = mysqli_query($db2,"SELECT b.id_bahan_baku, b.nama_bahan_baku, b.stok_bahan_baku, b.uom, b.minimum_stock, kerusakan.TotalKerusakan, (penyimpanan.TotalPenyimpanan-pengambilan.TotalPengambilan-kerusakan.TotalKerusakan) TotalStok
                                            from (SELECT id_bahan_baku, sum(jumlah_kerusakan) TotalKerusakan FROM `kerusakan_bahan_baku` group by id_bahan_baku) kerusakan 
                                            join (SELECT id_bahan_baku, sum(jumlah_pengambilan) TotalPengambilan FROM `pengambilan_bahan_baku` group by id_bahan_baku) pengambilan on kerusakan.id_bahan_baku = pengambilan.id_bahan_baku
                                            join (SELECT id_bahan_baku, sum(jumlah_penyimpanan) TotalPenyimpanan FROM `penyimpanan_bahan_baku` group by id_bahan_baku) penyimpanan on pengambilan.id_bahan_baku = penyimpanan.id_bahan_baku
                                            join bahan_baku b on kerusakan.id_bahan_baku = b.id_bahan_baku");
                                            while($result = mysqli_fetch_array($sql)){
                                            $no = $no + 1;
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $result['nama_bahan_baku']; ?></td>
                                                <td><?php echo $result['id_bahan_baku']; ?></td>
                                                <td><?php echo $result['uom']; ?></td>
                                                <td><?php echo $result['TotalStok']; ?></td>
                                                <td><?php echo $result['TotalKerusakan']; ?></td>
                                                <td><?php echo $result['minimum_stock']; 
                                                if ($result['minimum_stock']>$result['TotalStok']) {
                                                    echo "<b style='color: red;'> (Stock Perlu di Tambah !)</b>";
                                                }
                                                ?></td>
                                            </tr>   
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
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
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.nik1').val(recipient_c);
            modal.find('.nama1').val(recipient_e);
            modal.find('.jabatan1').val(recipient_v);

            modal.find('.idKon1').val(recipient_c);

            document.getElementById("nik1").value = recipient_c;
            document.getElementById("nama1").value = recipient_e;
            document.getElementById("jabatan1").value = recipient_v;


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
</body>

</html>