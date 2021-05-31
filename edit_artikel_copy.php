<!DOCTYPE html>
<?php 
include 'controller/conn.php';
session_start();
if($_SESSION['status_ca'] !="login"){
    header("location:login.php");
}

$id_artikel = $_GET['id_artikel'];

$result_head = mysqli_query($db2,"select * from `artikel` a join kategori k on a.id_kategori = k.id_kategori where id_article = $id_artikel");
while($d_head = mysqli_fetch_array($result_head)){
   $judul= $d_head['judul'];
   $deskripsi= $d_head['deskripsi'];
   $tanggal_posting= $d_head['tanggal_posting'];
   $id_kategori= $d_head['id_kategori'];
   $tags= $d_head['tags'];
   $kategori= $d_head['kategori'];
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kacamata</title>

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
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
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
                    <p>Apakah anda yakin menghapus Konsumen ini ?<br>
                        Nama Perusahaan &nbsp; :<b id="namaPerusahaan"></b><br>
                        Alamat Perusahaan &nbsp; :<b id="alamatPerusahaan"></b></p>
                </div>
                <form action="controller/conn_delete_konsumen.php" method="post">
                <input class="codeC" type="hidden" name="codeC">
                <input class="nameC" type="hidden" name="nameC">
                <input class="idKon" type="hidden" name="idKon">
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
                    <h4 class="modal-title" id="exampleModalLabel">Edit Konsumen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/conn_edit_konsumen.php" method="post">
                <div class="modal-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-12 col-form-label">Id Konsumen</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="idKonE" name="idKonE"
                                    placeholder="Id Konsumen" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="namaPerusahaan" class="col-sm-12 col-form-label">Nama Perusahaan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="namaPerusahaan1" name="namaPerusahaan1"
                                placeholder="Nama Perusahaan" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamatPerusahaan" class="col-sm-12 col-form-label">Alamat Perusahaan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="alamatPerusahaan1" name="alamatPerusahaan1"
                                placeholder="Alamat Perusahaan" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="noTelp" class="col-sm-12 col-form-label">No Telphone Perusahaan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="noTelp1" name="noTelp1" data-inputmask='"mask": "9999999999999"' data-mask
                                placeholder="No Telp Perusahaan" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="emailPerusahaan" class="col-sm-12 col-form-label">Email Perusahaan</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="emailPerusahaan1" name="emailPerusahaan1"
                                placeholder="Email Perusahaan" value="">
                        </div>
                    </div>
                    <input class="idKon1" type="hidden" name="idKon1">
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
                    <h4 class="modal-title" id="exampleModalLabel">Add - New Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="controller/conn_add_konsumen.php" method="post">
                    <div class="modal-body">

                    <div class="form-group row">
                            <label for="nik" class="col-sm-12 col-form-label">Id Konsumen</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="idKonE2" name="idKonE2"
                                    placeholder="Id Konsumen" value="" data-inputmask='"mask": "a{1,4}-9999"' data-mask>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namaPerusahaan" class="col-sm-12 col-form-label">Nama Perusahaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="namaPerusahaan" name="namaPerusahaan"
                                    placeholder="Nama Perusahaan" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamatPerusahaan" class="col-sm-12 col-form-label">Alamat Perusahaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="alamatPerusahaan" name="alamatPerusahaan"
                                    placeholder="Alamat Perusahaan" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="noTelp" class="col-sm-12 col-form-label">No Telphone Perusahaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="noTelp" name="noTelp" data-inputmask='"mask": "9999999999999"' data-mask
                                    placeholder="No Telp Perusahaan" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailPerusahaan" class="col-sm-12 col-form-label">Email Perusahaan</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="emailPerusahaan" name="emailPerusahaan"
                                    placeholder="Account Name" value="">
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
                            <h1 class="m-0">Artikel
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Article - Index</li>
                            </ol>
                        </div>
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
                                <div class="card-header">
                                    <h3 class="card-title">Edit Artikel</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="../cms_kacamata/controller/conn_edit_produk.php" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputIDProduk">ID Produk</label>
                                                    <input type="text" id="inputIDProduk" name="produk" class="form-control" required autocomplete="off" value="<?php echo $judul; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputUrlGambar">URL Gambar</label>
                                                    <textarea class="lampiran" id="inputContent" name="lampiran" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required autocomplete="off">
                                                        <?php echo "Gambar belum beres"; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputContent">Content</label>
                                                    <textarea class="konten" id="inputContent" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required autocomplete="off">
                                                        <?php echo $deskripsi; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputCategory">Category</label>
                                                    <select class="form-control" style="width: 100%;" name="kategori" id="kategori" onChange="setKategori()">
                                                        <option value="" disabled selected>Category</option>
                                                            <?php 
                                                            $no = 1;
                                                            $result_head = mysqli_query($db2,"select * from `kategori`");
                                                            while($d_head = mysqli_fetch_array($result_head)){
                                                            ?>
                                                            <option value="<?php echo $d_head['id_kategori']; ?>/<?php echo $d_head['kategori']; ?>"
                                                            <?php if ($d_head['id_kategori']== $id_kategori) {echo "selected";}?>>
                                                                <?php echo $d_head['kategori']; ?></option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="inputTags">Tags</label>
                                                    <input type="text" id="inputTags" name="tags" class="form-control" required autocomplete="off" value="<?php echo $tags; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="inputTgl" name="tglPosting" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="readonly">
                                        <input type="hidden" id="idKategori" name="idKategori" class="form-control" value="" readonly="readonly">
                                        <input type="hidden" id="id_article" name="id_article" class="form-control" value="<?php echo $id_artikel; ?>" readonly="readonly">
                                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                    </form>        
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
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
        $('#lampiran').summernote({
            height: 200,
            onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
            data: data,
            type: "POST",
            url: "/../cms_kacamata/controller/conn_add_artikel.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.insertImage(welEditable, url);
            }
            });
        }
        });
        
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
            modal.find('.namaPerusahaan').val(recipient_e);
            modal.find('.alamatPerusahaan').val(recipient_v);
            modal.find('.idKon').val(recipient_c);
            modal.find('.emailPerusahaan').val(recipient_i);
            document.getElementById("namaPerusahaan").innerHTML = recipient_e;
            document.getElementById("alamatPerusahaan").innerHTML = recipient_i;
            document.getElementById("noTelp").innerHTML = recipient_c;
            document.getElementById("emailPerusahaan").innerHTML = recipient_v;
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
            modal.find('.idKon1').val(recipient_c);
            modal.find('.namaPerusahaan1').val(recipient_e);
            modal.find('.noTelp1').val(recipient_v);
            modal.find('.alamatPerusahaan1').val(recipient_i);
            modal.find('.emailPerusahaan1').val(recipient_a);

            document.getElementById("idKonE").value = recipient_c;
            document.getElementById("namaPerusahaan1").value = recipient_e;
            document.getElementById("noTelp1").value = recipient_v;
            document.getElementById("alamatPerusahaan1").value = recipient_i;
            document.getElementById("emailPerusahaan1").value = recipient_a;
            
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

        $(function() {
            // Summernote
            $('.opening').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            // Summernote
            $('.konten').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });

            // Summernote
            $('.lampiran').summernote({
                toolbar: [
                    ['insert', ['picture']],
                ]
            });
        })
        
        function setKategori() {
        var x = document.getElementById("kategori").value;
        var arr_dataK = x.split('/');
        document.getElementById("idKategori").value = arr_dataK[0];
        }
    </script>
</body>

</html>