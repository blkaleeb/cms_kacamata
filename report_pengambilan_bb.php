<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
if (isset($_GET['idBahanBaku'])) {
    $id_bahan_baku=$_GET['idBahanBaku'];
}else{
    $id_bahan_baku=0;
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
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed"
    onLoad="$('#example1').find('tr.hidden:first').removeClass('hidden');">

    <div class="modal fade" id="modal-edit-header">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Edit Data Pengambilan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/conn_edit_pengambilan.php" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-12 col-form-label">ID Bahan Baku</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="idBahanBaku1" name="idBahanBaku1"
                                    placeholder="ID Bahan Baku" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah_pengambilan" class="col-sm-12 col-form-label">Jumlah Pengambilan</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="jumlah_pengambilan1" name="jumlah_pengambilan1"
                                    placeholder="Jumlah Pengambilan" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uom" class="col-sm-12 col-form-label">UOM</label>
                            <div class="col-sm-12">
                                    <input type="text" class="form-control" id="uom1" name="uom1"
                                    placeholder="UOM" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_pengambilan" class="col-sm-12 col-form-label">Tanggal Pengambilan:</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tanggal_pengambilan1" name="tanggal_pengambilan1" value=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-12 col-form-label">NIK User</label>
                            <div class="col-sm-12">
                                <select class="form-control" style="width: 100%;" name="nik1" id="nik1">
                                <option value="" disabled selected>ID Karyawan</option>
                                    <?php 
                                    $no = 1;
                                    $result_head = mysqli_query($db2,"select * from `user`");
                                    while($d_head = mysqli_fetch_array($result_head)){
                                    ?>
                                    <option value="<?php echo $d_head['nik']; ?>">
                                        <?php echo $d_head['nik']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Current Value -->
                        <input class="idBahanBaku2" type="hidden" id="idBahanBaku2" name="idBahanBaku2">
                        <input class="jumlah_pengambilan2" type="hidden" id="jumlah_pengambilan2" name="jumlah_pengambilan2">
                        <input class="tanggal_pengambilan2" type="hidden" id="tanggal_pengambilan2" name="tanggal_pengambilan2">
                        <input class="nik2" type="hidden" id="nik2" name="nik2">
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
                    <p>Apakah anda yakin menghapus data Penyimpanan ini ?<br>
                        ID Bahan Baku &nbsp; : &nbsp; <b id="idBahanBaku3"> </b><br>
                        Nama Bahan Baku &nbsp; : &nbsp; <b id="text_namabahanbaku"> </b><br>
                        Tanggal Penyimpanan &nbsp; : &nbsp; <b id="tanggal_pengambilan3"></b><br>
                        Nama User &nbsp; : &nbsp; <b id="nama3"> </b> </p>
                </div>
                <form action="controller/conn_delete_pengambilan.php" method="post">
                    <input class="idBahanBaku3" type="hidden" name="idBahanBaku3">
                    <input class="jumlah_pengambilan3" type="hidden" name="jumlah_pengambilan3">
                    <input class="tanggal_pengambilan3" type="hidden" name="tanggal_pengambilan3">
                    <input class="nik3" type="hidden" id="nik3" name="nik3">

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
                            <h1 class="m-0"> Pengambilan Bahan Baku
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
                <div class="row">
                    <div class="col-12">


                        <div class="card-body col-sm-10 p-30">

                            <div class="form-group row">
                                <label for="idBahanBaku" class="col-sm-3 col-form-label">ID Bahan Baku</label>
                                <div class="col-sm-9">
                                    <select class="form-control" style="width: 100%;" name="idBahanBaku"
                                        id="idBahanBaku" onChange="setBahanBaku()">
                                        <option value="" disabled selected>ID Bahan Baku</option>
                                        <?php 
                                        $no = 1;
                                        $result_head = mysqli_query($db2,"select * from `bahan_baku`");
                                        while($d_head = mysqli_fetch_array($result_head)){
                                        ?>
                                        <option <?php if($id_bahan_baku==$d_head['id_bahan_baku']){echo "selected";} ?>
                                            value="<?php echo $d_head['id_bahan_baku']; ?>/<?php echo $d_head['nama_bahan_baku']; ?>">
                                            <?php echo $d_head['id_bahan_baku']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_bahan_baku" class="col-sm-3 col-form-label"> Nama Bahan Baku </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="nama_bahan_baku" name="nama_bahan_baku"
                                        placeholder="Tanggal Masuk" value="" readonly>
                                </div>
                            </div>                                
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <h3 style="padding-left: 20px;">Data Pengambilan Bahan Baku</h3>
                <div class="card" style="margin-left: 20px;">


                    <!-- /.card-header -->
                    <div id="wrapper2" class="card-body" style="overflow-x:auto">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Jumlah Pengambilan Bahan Baku</th>
                                    <th rowspan="2">UOM</th>
                                    <th rowspan="2">Tanggal Pengambilan Bahan Baku</th>
                                    <th colspan="2">Pihak yang Bertanggung Jawab</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>NIK User</th>
                                    <th>Nama User</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sqlJurnal= mysqli_query($db2,"SELECT p.id_bahan_baku, b.nama_bahan_baku, p.nik, p.jumlah_pengambilan, b.uom, p.tanggal_pengambilan, u.nama
                                FROM pengambilan_bahan_baku as p
                                INNER JOIN bahan_baku as b
                                ON p.id_bahan_baku = b.id_bahan_baku
                                INNER JOIN user as u
                                ON p.nik = u.nik
                                WHERE p.id_bahan_baku = '$id_bahan_baku'");
                                $no=0;
                                while($dataJurnal = mysqli_fetch_array($sqlJurnal)){
                                    $no++;
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $dataJurnal['jumlah_pengambilan']; ?></td>
                                    <td><?php echo $dataJurnal['uom']; ?></td>
                                    <td><?php echo date_format(date_create($dataJurnal['tanggal_pengambilan']),"d F Y"); ?></td>
                                    <td><?php echo $dataJurnal['nik']; ?></td>
                                    <td><?php echo $dataJurnal['nama']; ?></td>
                                    <td>
                                        <div class="row">
                                            <button class="btn btn-info btn-sm" name="id_ev"
                                                data-c="<?php echo $dataJurnal['id_bahan_baku']; ?>"
                                                data-e="<?php echo $dataJurnal['jumlah_pengambilan']; ?>"
                                                data-v="<?php echo $dataJurnal['uom']; ?>"
                                                data-i="<?php echo $dataJurnal['tanggal_pengambilan']; ?>"
                                                data-a="<?php echo $dataJurnal['nik']; ?>"
                                                data-toggle="modal" data-target="#modal-edit-header">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                data-c="<?php echo $dataJurnal['id_bahan_baku']; ?>"
                                                data-e="<?php echo $dataJurnal['jumlah_pengambilan']; ?>"
                                                data-v="<?php echo $dataJurnal['nama']; ?>"
                                                data-i="<?php echo $dataJurnal['tanggal_pengambilan']; ?>"
                                                data-a="<?php echo $dataJurnal['nik']; ?>"
                                                data-b="<?php echo $dataJurnal['nama_bahan_baku']; ?>"
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
            <!-- /.row -->
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
        document.addEventListener('DOMContentLoaded', function() {
            var testX = "<?php echo $id_bahan_baku;?>";
            if (testX !="0") {
                var x = document.getElementById("idBahanBaku").value;
                var arr_dataK = x.split('/');
            document.getElementById("nama_bahan_baku").value = arr_dataK[1];
            }else{
                document.getElementById("idBahanBaku").value = "";
            }
            

        }, false);

        function setBahanBaku() {
            var x = document.getElementById("idBahanBaku").value;
            var arr_dataK = x.split('/');
            document.getElementById("nama_bahan_baku").value = arr_dataK[1];
            window.location.href = 'report_pengambilan_bb.php?idBahanBaku='+arr_dataK[0];
        }

        $('#modal-cancel').on('show.bs.modal', function (event) {
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
            modal.find('.idBahanBaku3').val(recipient_c);
            modal.find('.jumlah_pengambilan3').val(recipient_e);
            modal.find('.nama3').val(recipient_v);
            modal.find('.tanggal_pengambilan3').val(recipient_i);
            modal.find('.nik3').val(recipient_a);
            modal.find('.text_namabahanbaku').val(recipient_b);

            document.getElementById("idBahanBaku3").innerHTML = recipient_c;
            document.getElementById("nama3").innerHTML = recipient_v;
            document.getElementById("tanggal_pengambilan3").innerHTML = recipient_i;
            document.getElementById("text_namabahanbaku").innerHTML = recipient_b;

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
            modal.find('.idBahanBaku1').val(recipient_c);
            modal.find('.jumlah_pengambilan1').val(recipient_e);
            modal.find('.uom1').val(recipient_v);
            modal.find('.tanggal_pengambilan1').val(recipient_i);
            modal.find('.nik1').val(recipient_a);

            document.getElementById("idBahanBaku1").value = recipient_c;
            document.getElementById("jumlah_pengambilan1").value = recipient_e;
            document.getElementById("uom1").value = recipient_v;
            document.getElementById("tanggal_pengambilan1").value = recipient_i;
            document.getElementById("nik1").value = recipient_a;

            // current value:
            document.getElementById("idBahanBaku2").value = recipient_c;
            document.getElementById("jumlah_pengambilan2").value = recipient_e;
            document.getElementById("tanggal_pengambilan2").value = recipient_i;
            document.getElementById("nik2").value = recipient_a;


        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        $(function () {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "searching": false,
                "ordering": false,
                "info": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>