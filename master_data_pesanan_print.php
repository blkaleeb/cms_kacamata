<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}
if (isset($_GET['idPesanan'])) {
    $id_pesanan=$_GET['idPesanan'];
}else{
    $id_pesanan=0;
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
    <script>
    window.print();
    (function () {

    var beforePrint = function () {
        
    };

    var afterPrint = function () {
        window.location.href = "master_data_pesanan.php?idPesanan=<?php echo $id_pesanan;?>";
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
                                <h1 class="m-0">Report Master Data Pesanan
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
                                    <label for="idPesanan" class="col-sm-3 col-form-label">Nomor ID Pesanan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" style="width: 100%;" name="idPesanan"
                                            id="idPesanan" onChange="setKonsumen()">
                                            <option value="" disabled selected>ID Pesanan</option>
                                            <?php 
                                            $no = 1;
                                            $result_head = mysqli_query($db2,"select * from `pesanan` inner join konsumen on pesanan.id_konsumen = konsumen.id_konsumen");
                                            while($d_head = mysqli_fetch_array($result_head)){
                                            ?>
                                            <option <?php if($id_pesanan==$d_head['id_pesanan']){echo "selected";} ?>
                                                value="<?php echo $d_head['id_pesanan']; ?>/<?php echo $d_head['id_konsumen']; ?>/<?php echo $d_head['nama_perusahaan']; ?>
                                                /<?php echo $d_head['tanggal_pesan']; ?>/<?php echo $d_head['batas_waktu']; ?>">
                                                <?php echo $d_head['id_pesanan']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggalMasuk" class="col-sm-3 col-form-label">Tanggal Pesanan
                                        Masuk</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="tanggalMasuk" name="tanggalMasuk"
                                            placeholder="Tanggal Masuk" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="batasWaktu" class="col-sm-3 col-form-label">Batas Waktu Pengiriman
                                        </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="batasWaktu" name="batasWaktu"
                                            placeholder="Batas Waktu" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputWarna" class="col-sm-3 col-form-label">ID Konsumen</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idKonsumen" name="idKonsumen"
                                            placeholder="ID Konsumen" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="namaKonsumen" class="col-sm-3 col-form-label">Nama Konsumen</label>
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

                    <div class="card" style="margin-left: 20px;">


                        <!-- /.card-header -->
                        <div id="wrapper2" class="card-body" style="overflow-x:auto">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th style="text-align: center;">Jumlah Pesanan</th>
                                        <th>ID Bahan Baku</th>
                                        <th>Nama Bahan Baku</th>
                                        <th style="text-align: center;">Jumlah Bahan Baku</th>
                                        <th>UOM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sqlJurnal= mysqli_query($db2,"SELECT * FROM barang 
                                    INNER JOIN detail_pesanan 
                                    ON barang.id_barang = detail_pesanan.id_barang
                                    WHERE detail_pesanan.id_pesanan = '$id_pesanan'");
                                    $no=0;
                                    while($dataJurnal = mysqli_fetch_array($sqlJurnal)){
                                        $no++;
                                        $temp_id_barang = $dataJurnal['id_barang'];
                                        $result = mysqli_query($db2,"SELECT count(*) FROM bahan_baku
                                        inner join master_data
                                        on master_data.id_bahan_baku = bahan_baku.id_bahan_baku
                                        inner join detail_pesanan
                                        on detail_pesanan.id_barang = master_data.id_barang
                                        where id_pesanan = '$id_pesanan' AND master_data.id_barang = '$temp_id_barang'");
                                        $row = mysqli_fetch_array($result);
                                        $total = $row[0]+1;
                                ?>
                                    <tr>
                                        <td rowspan="<?php echo $total; ?>"><?php echo $no; ?></td>
                                        <td rowspan="<?php echo $total; ?>"><?php echo $dataJurnal['id_barang']; ?></td>
                                        <td rowspan="<?php echo $total; ?>"><?php echo $dataJurnal['nama_barang']; ?></td>
                                        <td style="text-align: center;" rowspan="<?php echo $total; ?>"><?php echo $dataJurnal['jumlah_barang']; ?> Pcs</td>
                                    </tr>
                                    <?php 
                                        $resultX = mysqli_query($db2,"SELECT *, b.id_bahan_baku, b.nama_bahan_baku, b.stok_bahan_baku, b.uom, b.minimum_stock, kerusakan.TotalKerusakan, (penyimpanan.TotalPenyimpanan-pengambilan.TotalPengambilan-kerusakan.TotalKerusakan) TotalStok
                                        from (SELECT id_bahan_baku, sum(jumlah_kerusakan) TotalKerusakan FROM `kerusakan_bahan_baku` group by id_bahan_baku) kerusakan 
                                        join (SELECT id_bahan_baku, sum(jumlah_pengambilan) TotalPengambilan FROM `pengambilan_bahan_baku` group by id_bahan_baku) pengambilan on kerusakan.id_bahan_baku = pengambilan.id_bahan_baku
                                        join (SELECT id_bahan_baku, sum(jumlah_penyimpanan) TotalPenyimpanan FROM `penyimpanan_bahan_baku` group by id_bahan_baku) penyimpanan on pengambilan.id_bahan_baku = penyimpanan.id_bahan_baku
                                        join bahan_baku b on kerusakan.id_bahan_baku = b.id_bahan_baku
                                        inner join master_data
                                        on master_data.id_bahan_baku = b.id_bahan_baku
                                        inner join detail_pesanan
                                        on detail_pesanan.id_barang = master_data.id_barang
                                        where id_pesanan = '$id_pesanan' AND master_data.id_barang = '$temp_id_barang'"); 
                                            $array_id[]="";
                                            $array_jumlah[]="";
                                            $array_uom[]="";
                                            $array_nama[]="";
                                            $array_stock[]="";
                                        while($dataJurnalX = mysqli_fetch_array($resultX)){
                                            $temp_xxx = $dataJurnalX['id_bahan_baku'];
                                            if (!in_array($temp_xxx, $array_id)) {
                                                array_push($array_id,$temp_xxx);
                                                $array_jumlah[$temp_xxx]=$dataJurnalX['jumlah_kebutuhan']*$dataJurnal['jumlah_barang'];
                                                $array_uom[$temp_xxx]=$dataJurnalX['uom'];
                                                $array_nama[$temp_xxx]=$dataJurnalX['nama_bahan_baku'];
                                                $array_stock[$temp_xxx]=$dataJurnalX['TotalStok'];
                                            }else{
                                                $array_jumlah[$temp_xxx]=($array_jumlah[$temp_xxx]+($dataJurnalX['jumlah_kebutuhan']*$dataJurnal['jumlah_barang']));
                                            }
                                            

                                            ?>
                                    <tr>
                                        <td><?php echo $dataJurnalX['id_bahan_baku']; ?></td>
                                        <td><?php echo $dataJurnalX['nama_bahan_baku']; ?></td>
                                        <td style="text-align: center;"><?php echo $dataJurnalX['jumlah_kebutuhan']*$dataJurnal['jumlah_barang']; ?></td>
                                        <td><?php echo $dataJurnalX['uom']; ?></td>
                                    </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>

                            </table>





                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

  


                    <div class="card" style="margin-left: 20px;">

                        
                        <!-- /.card-header -->
                        <div id="wrapper2" class="card-body" style="overflow-x:auto">
                        <h2>Kesimpulan</h2>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th>ID Bahan Baku</th>
                                        <th>Nama Bahan Baku</th>
                                        <th style="text-align: center;">Jumlah Bahan Baku</th>
                                        <th>UOM</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                    $no=0;
                                    foreach ($array_id as $value) {   
                                      $no++;
                                      if($value!="" && $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value; ?></td>
                                        <td><?php echo $array_nama[$value]; ?></td>
                                        <td style="text-align: center;"><?php echo $array_jumlah[$value]; ?></td>
                                        <td><?php echo $array_uom[$value]; ?></td>
                                        <td><?php 
                                        if ($array_stock[$value]<($array_jumlah[$value])) {
                                            echo "Stock Kurang : <b style='color:red;'>".(($array_stock[$value])-$array_jumlah[$value])."</b>";
                                        }else{
                                            echo "Tersedia.";
                                        }   ?></td>
                                    </tr>
                                        <?php }} ?>
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
            var testX = "<?php echo $id_pesanan;?>";
            if (testX !="0") {
                var x = document.getElementById("idPesanan").value;
                var arr_dataK = x.split('/');
            document.getElementById("idKonsumen").value = arr_dataK[1];
            document.getElementById("namaKonsumen").value = arr_dataK[2];
            document.getElementById("tanggalMasuk").value = arr_dataK[3];
            document.getElementById("batasWaktu").value = arr_dataK[4];
            }else{
                document.getElementById("idPesanan").value = "";
            }
            

        }, false);
        function setKonsumen() {
            var x = document.getElementById("idPesanan").value;
            var arr_dataK = x.split('/');
            document.getElementById("idKonsumen").value = arr_dataK[1];
            document.getElementById("namaKonsumen").value = arr_dataK[2];
            document.getElementById("tanggalMasuk").value = arr_dataK[3];
            document.getElementById("batasWaktu").value = arr_dataK[4];
            window.location.href = 'master_data_pesanan.php?idKonsumen='+arr_dataK[1]+'&idPesanan='+arr_dataK[0];
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