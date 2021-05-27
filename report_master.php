<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
if (isset($_GET['idMaster'])) {
    $id_master_data=$_GET['idMaster'];
}else{
    $id_master_data=0;
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



    <div class="wrapper">
        <?php include "./view/common/navbar.php" ?>

        <?php include "./view/common/aside.php" ?>
        <form class="form-horizontal" action="controller/conn_add_pesanan.php" method="post">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Data Master Data
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
                                    <label for="idMaster" class="col-sm-3 col-form-label">ID Master Data</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" style="width: 100%;" name="idMaster"
                                            id="idMaster" onChange="setKonsumen()">
                                            <option value="" disabled selected>ID Master Data</option>
                                            <?php 
                                            $no = 1;
                                            $temp_id_master =0;
                                            $result_head = mysqli_query($db2,"SELECT * from `master_data` INNER JOIN barang on master_data.id_barang = barang.id_barang order by id_master_data");
                                            while($d_head = mysqli_fetch_array($result_head)){
                                                
                                                if($temp_id_master!=$d_head['id_master_data']){
                                            ?>
                                            <option <?php if($id_master_data==$d_head['id_master_data']){echo "selected";} ?>
                                                value="<?php echo $d_head['id_master_data']; ?>/<?php echo $d_head['id_barang']; ?>/<?php echo $d_head['nama_barang']; ?>">
                                                <?php echo $d_head['id_master_data']; ?></option>
                                            <?php } $temp_id_master = $d_head['id_master_data']; } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputWarna" class="col-sm-3 col-form-label">ID Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idKonsumen" name="idKonsumen"
                                            placeholder="ID Konsumen" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="namaKonsumen" class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="namaKonsumen" name="namaKonsumen"
                                            placeholder="Nama Konsumen" value="" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <h3 style="padding-left: 20px;">Data Kebutuhan Bahan Baku</h3>
                    <div class="card" style="margin-left: 20px;">


                        <!-- /.card-header -->
                        <div id="wrapper2" class="card-body" style="overflow-x:auto">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th style="width: 25%">ID Bahan Baku</th>
                                        <th style="width: 15%">Nama Bahan Baku</th>
                                        <th style="width: 15%">Jumlah Bahan Baku</th>
                                        <th style="width: 10%">UOM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sqlJurnal= mysqli_query($db2,"SELECT * FROM bahan_baku 
                                    INNER JOIN master_data 
                                    ON bahan_baku.id_bahan_baku = master_data.id_bahan_baku
                                    WHERE master_data.id_master_data = '$id_master_data'");
                                    $no=0;
                                    while($dataJurnal = mysqli_fetch_array($sqlJurnal)){
                                        $no++;
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $dataJurnal['id_bahan_baku']; ?></td>
                                        <td><?php echo $dataJurnal['nama_bahan_baku']; ?></td>
                                        <td style="text-align: right;"><?php echo $dataJurnal['jumlah_kebutuhan']; ?></td>
                                        <td><?php echo $dataJurnal['uom']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>


                            <a class="btn btn-info" id="btnAddCol" href="master_data_edit.php?id_master_data=<?php echo $id_master_data; ?>"
                                style="width: 150px; margin-top: 10px; margin-right: 20px;">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>


                            <a type="submit" class="btn btn-danger" href="controller/conn_delete_master_data.php?id_master_data=<?php echo $id_master_data; ?>"
                                style="width: 150px; margin-top: 10px; right: 0px;">
                                <i class="fas fa-times"></i> Delete
                            </a>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

            </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->
    </div>
    </form>
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
            var testX = "<?php echo $id_master_data;?>";
            if (testX !="0") {
                var x = document.getElementById("idMaster").value;
                var arr_dataK = x.split('/');
            document.getElementById("idKonsumen").value = arr_dataK[1];
            document.getElementById("namaKonsumen").value = arr_dataK[2];
            }else{
                document.getElementById("idMaster").value = "";
            }
            

        }, false);

        function setKonsumen() {
            var x = document.getElementById("idMaster").value;
            var arr_dataK = x.split('/');
            window.location.href = 'report_master.php?idMaster='+arr_dataK[0];
        }



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