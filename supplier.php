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
                    <p>Apakah anda yakin menghapus data Supplier ini ?<br>
                        ID Supplier &nbsp; :<b id="nik"></b><br>
                        Nama  &nbsp; :<b id="namaKaryawan"></b><br>
                </div>
                <form action="controller/conn_delete_supplier.php" method="post">
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
                    <h4 class="modal-title" id="exampleModalLabel">Edit Data Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/conn_edit_supplier.php" method="post">
                    <div class="modal-body">
                    <div class="form-group row">
                            <label for="nik1" class="col-sm-12 col-form-label">ID Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nik1" name="nik1"
                                    placeholder="ID Supplier" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-12 col-form-label">Nama Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama1" name="nama1"
                                    placeholder="Nama Supplier" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-12 col-form-label">No Telp Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="notelp1" name="notelp1"
                                    placeholder="No Telp Supplier" value=""  data-inputmask='"mask": "9999999999999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="noTelp" class="col-sm-12 col-form-label">Alamat Toko</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="alamat1" name="alamat1"
                                    placeholder="Alamat Toko" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email1" name="email1"
                                    placeholder="Email" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-12 col-form-label">No Rekening</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="norek1" name="norek1"
                                    placeholder="No Rekening" value="" data-inputmask='"mask": "9999999999999"' data-mask>
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
                    <h4 class="modal-title" id="exampleModalLabel">Add - New Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="controller/conn_add_supplier.php" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nik2" class="col-sm-12 col-form-label">ID Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nik2" name="nik2"
                                    placeholder="ID Supplier" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-12 col-form-label">Nama Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama2" name="nama2"
                                    placeholder="Nama Supplier" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-12 col-form-label">No Telp Supplier</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="notelp2" name="notelp2"
                                    placeholder="No Telp Supplier" value=""  data-inputmask='"mask": "9999999999999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="noTelp" class="col-sm-12 col-form-label">Alamat Toko</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="alamat2" name="alamat2"
                                    placeholder="Alamat Toko" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email2" name="email2"
                                    placeholder="Email" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-12 col-form-label">No Rekening</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="norek2" name="norek2"
                                    placeholder="No Rekening" value="" data-inputmask='"mask": "9999999999999"' data-mask>
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
                            <h1 class="m-0">Data Supplier
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
                                <div style="text-align: right;">
                                    <button class="btn btn-success float-sm-right" data-toggle="modal"
                                        data-target="#modal-add"
                                        style="right: 0px; width: 150px; margin-top: 10px; margin-right: 20px;">
                                        + Add Supplier
                                    </button>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID Supplier</th>
                                                <th>Nama Toko</th>
                                                <th>No Telp Toko</th>
                                                <th>Alamat Toko</th>
                                                <th>Email</th>
                                                <th>No Rekening</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $result_head = mysqli_query($db2,"select * from `supplier`");
                                            while($d_head = mysqli_fetch_array($result_head)){
                                            ?>
                                            <tr>
                                                <td><?php echo $d_head['id_supplier']; ?></td>
                                                <td><?php echo $d_head['nama_toko']; ?></td>
                                                <td><?php echo $d_head['no_telp_toko']; ?></td>
                                                <td><?php echo $d_head['alamat_toko']; ?></td>
                                                <td><?php echo $d_head['email']; ?></td>
                                                <td><?php echo $d_head['no_rekening']; ?></td>
                                                <td>
                                                    <div class="row">

                                                        <button class="btn btn-info btn-sm" name="id_ev"
                                                            data-c="<?php echo $d_head['id_supplier']; ?>"
                                                            data-e="<?php echo $d_head['nama_toko']; ?>"
                                                            data-v="<?php echo $d_head['no_telp_toko']; ?>"
                                                            data-i="<?php echo $d_head['alamat_toko']; ?>"
                                                            data-a="<?php echo $d_head['email']; ?>"
                                                            data-b="<?php echo $d_head['no_rekening']; ?>"
                                                            data-toggle="modal" data-target="#modal-edit-header">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Edit
                                                        </button>

                                                        <button class="btn btn-danger btn-sm"
                                                            data-c="<?php echo $d_head['id_supplier']; ?>"
                                                            data-e="<?php echo $d_head['nama_toko']; ?>"
                                                            data-v="<?php echo $d_head['no_telp_toko']; ?>"
                                                            data-i="<?php echo $d_head['alamat_toko']; ?>"
                                                            data-toggle="modal" data-target="#modal-cancel">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
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
            var recipient_i = button.data('i');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.namaKaryawan').val(recipient_e);
            modal.find('.nik').val(recipient_c);

            document.getElementById("namaKaryawan").innerHTML = recipient_e;
            document.getElementById("nik").innerHTML = recipient_c;

        })

        $('#modal-edit-header').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient_e = button.data('e'); // Extract info from data-* attributes
            var recipient_v = button.data('v');
            var recipient_c = button.data('c');
            var recipient_i = button.data('i');
            var recipient_a = button.data('a');
            var recipient_b = button.data('b');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.nik1').val(recipient_c);
            modal.find('.nama1').val(recipient_e);
            modal.find('.notelp1').val(recipient_v);
            modal.find('.alamat1').val(recipient_i);
            modal.find('.email1').val(recipient_a);
            modal.find('.norek1').val(recipient_b);
            modal.find('.idKon1').val(recipient_c);

            document.getElementById("nik1").value = recipient_c;
            document.getElementById("nama1").value = recipient_e;
            document.getElementById("notelp1").value = recipient_v;
            document.getElementById("alamat1").value = recipient_i;
            document.getElementById("email1").value = recipient_a;
            document.getElementById("norek1").value = recipient_b;

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