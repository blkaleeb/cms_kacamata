<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
$id_master_data = $_GET['id_master_data'];

$result_head = mysqli_query($db2,"SELECT * FROM master_data p INNER JOIN barang k
ON p.id_barang = k.id_barang where id_master_data = '$id_master_data' ");
while($d_head = mysqli_fetch_array($result_head)){
   $id_barang= $d_head['id_barang'];
   $nama_barang= $d_head['nama_barang'];

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
        .hidden{
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
                                <input type="text" class="form-control" id="nik1" name="nik1" placeholder="ID Barang"
                                    value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
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
                                <input type="number" class="form-control" id="jabatan1" name="jabatan1" value="">
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
                                <input type="text" class="form-control" id="nik2" name="nik2" placeholder="ID Barang"
                                    value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
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
                                <input type="number" class="form-control" id="jabatan2" name="jabatan2" value="">
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
        <form class="form-horizontal" action="controller/conn_edit_master_data.php" method="post">
        <input type="hidden" class="form-control" name="idAwal" value="<?php echo $id_master_data;?>">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add Master Data Barang
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
                                    <label for="idPesanan" class="col-sm-3 col-form-label">Nomor ID Master Data</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idPesanan" name="idPesanan"
                                            placeholder="Masukan ID Master Data" value="<?php echo $id_master_data; ?>" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputWarna" class="col-sm-3 col-form-label">ID Barang</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" style="width: 100%;" name="idKonsumen" id="idKonsumen" onChange="setKonsumen()">
                                        <option value="" disabled selected>ID Barang</option>
                                            <?php 
                                            $no = 1;
                                            $result_head = mysqli_query($db2,"select * from `barang`");
                                            while($d_head = mysqli_fetch_array($result_head)){
                                            ?>
                                            <option value="<?php echo $d_head['id_barang']; ?>/<?php echo $d_head['nama_barang']; ?>"
                                            <?php if ($d_head['id_barang']== $id_barang) {echo "selected";}?>>
                                                <?php echo $d_head['id_barang']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="namaKonsumen" class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="namaKonsumen" name="namaKonsumen"
                                            placeholder="Pilih ID Barang agar nama barang terisi" value="<?php echo $nama_barang; ?>" readonly>
                                    </div>
                                </div><br><br>
                                

                           

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
                                    <th style="width: 5%; text-align: center;"><i class="fas fa-times"></i></th>
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
                                    $x=0;
                                    while($dataJurnal = mysqli_fetch_array($sqlJurnal)){
                                    ?>
                                <tr class=''>
                                    <td style="text-align: center;">
                                        <a class="btn btn-danger btn-sm delete_another" onClick=" $(this).closest('tr').remove();">
                                            <i class="fas fa-times">
                                            </i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="account[<?php echo $x;?>]" id="account[<?php echo $x;?>]" class="form-control"
                                                style="width: 100%;" onChange="setBarang(this),setUOM(this)">
                                                <option value="" disabled selected>ID Bahan Baku</option>
                                                <?php 
                                                    $no = 1;
                                                    $result_head = mysqli_query($db2,"select * from `bahan_baku`");
                                                    while($d_head = mysqli_fetch_array($result_head)){
                                                ?>
                                                <option value="<?php echo $d_head['id_bahan_baku']; ?>/<?php echo $d_head['nama_bahan_baku']; ?>/<?php echo $x; ?>/<?php echo $d_head['uom']; ?>"
                                                <?php if ($d_head['id_bahan_baku']==$dataJurnal['id_bahan_baku']) { echo "selected";}?>><?php echo $d_head['id_bahan_baku']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="deskripsi[<?php echo $x;?>]" id="deskripsi[<?php echo $x;?>]"
                                        value="<?php echo $dataJurnal['nama_bahan_baku']; ?>" class="form-control" readonly>
                                    </td>
                                    <td><input type="number"
                                            id="inputHargaD<?php echo $x;?>" name="Debit[<?php echo $x;?>]"
                                            class="form-control" value="<?php echo $dataJurnal['jumlah_kebutuhan']; ?>" min=0> <p style="margin:auto;">
                                    </td>
                                    <td>
                                        <input type="text" name="uom[<?php echo $x;?>]" id="uom[<?php echo $x;?>]"
                                        value="<?php echo $dataJurnal['uom']; ?>" class="form-control" readonly>
                                    </td>
                                </tr>
                                <?php $x++;} for ($i=$x; $i <= 50; $i++) { ?>
                                <tr class='hidden'>
                                    <td style="text-align: center;">
                                        <a class="btn btn-danger btn-sm delete_another" onClick=" $(this).closest('tr').remove();">
                                            <i class="fas fa-times">
                                            </i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="account[<?php echo $i;?>]" id="account[<?php echo $i;?>]" class="form-control"
                                                style="width: 100%;" onChange="setBarang(this),setUOM(this)">
                                                <option value="" disabled selected>ID Bahan Baku</option>
                                                <?php 
                                                    $no = 1;
                                                    $result_head = mysqli_query($db2,"select * from `bahan_baku`");
                                                    while($d_head = mysqli_fetch_array($result_head)){
                                                ?>
                                                <option value="<?php echo $d_head['id_bahan_baku']; ?>/<?php echo $d_head['nama_bahan_baku']; ?>/<?php echo $i; ?>/<?php echo $d_head['uom']; ?>"><?php echo $d_head['id_bahan_baku']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="deskripsi[<?php echo $i;?>]" id="deskripsi[<?php echo $i;?>]" class="form-control" readonly>
                                    </td>
                                    <td><input type="number"
                                            id="inputHargaD<?php echo $i;?>" name="Debit[<?php echo $i;?>]"
                                            class="form-control" value="" min=0> <p style="margin:auto;">
                                    </td>
                                    <td>
                                        <input type="text" name="uom[<?php echo $i;?>]" id="uom[<?php echo $i;?>]" class="form-control" readonly>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>

                        </table>


                        <a class="btn btn-primary add_another" id="btnAddCol" onClick="$('#example1').find('tr.hidden:first').removeClass('hidden');"
                            style="width: 150px; margin-top: 10px; margin-right: 20px;">
                            + New Column
                        </a>


                        <button type="submit" class="btn btn-success"
                            style="width: 150px; margin-top: 10px; right: 0px;">
                            <i class="fas fa-check"></i> Simpan
                        </button>

                        
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
        function setKonsumen() {
        var x = document.getElementById("idKonsumen").value;
        var arr_dataK = x.split('/');
        document.getElementById("namaKonsumen").value = arr_dataK[1];
        }

        function setBarang(t) {
        var y = t.value;
        var arr_dataB = y.split('/');
        document.getElementById("deskripsi["+arr_dataB[2]+"]").value = arr_dataB[1];;
        }

        function setUOM(z) {
        var y = z.value;
        var arr_uom = y.split('/');
        document.getElementById("uom["+arr_uom[2]+"]").value = arr_uom[3];
        }

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
                "info" : false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
  

    </script>
</body>

</html>