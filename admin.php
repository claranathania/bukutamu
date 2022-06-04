   <!-- panggil file header -->
   <?php include "header.php"; ?>

<?php 

// uji jika tombol simpan diklik
if(isset($_POST['bsimpan'])){
    $tgl = date('Y-m-d');
 //htmlspecialchars agar inputan lebih aman dari injection 
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    //persiapan query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO ppengunjung VALUES ('', '$tgl', '$nama',
    '$alamat', '$tujuan', '$nope')");

 //uji jika simpan data sukses
  if ($simpan) {
       echo "<script>alert('Simpan data Sukses, Terima kasih..!'); 
              document.location= '?'</script>";
   }else{
    echo "<script>alert('Simpan data GAGAL!!!'); 
    document.location= '?'</script>";
   }

}

?>



    <!-- Head -->
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Buku Tamu</title>

    <!-- Custom fonts for this template -->
    <link href="assests/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <head>

    <body class="bg-gradient-succes"> 

    <div class="container">
        <!-- head -->
    <div class="head text-center">
        <img src="assets/img/Logo Digiclass New 3.png" width= "130">
        <h2 class="text-white" > Sistem Informasi Buku Tamu <br> </h2>
    </div>
    <!-- end Head-->

    <!-- Awal Row -->
    <div class="row mt-2">
        <!-- Awal Col-lg-7 -->
        <div class="col-lg-7 mb-3">
            <div class="card shadow bg-gradient-light">
                <!-- card body -->
                <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method= "POST" action="">
                                <div class="from-group"> 
                                   <input type="text" class="form control form-control form-control-user"
                                    name="nama" placeholder="nama pengunjung" required>
                                </div>
                                <div class="from-group"> 
                                   <input type="text" class="form control form-control form-control-user" 
                                   name="Alamat" placeholder="alamat pengunjung" required>
                                </div>
                                <div class="from-group"> 
                                   <input type="text" class="form control form-control form-control-user" 
                                   name="Tujuan" placeholder="tujuan pengunjung" required>
                                </div>
                                <div class="from-group"> 
                                   <input type="text" class="form control form-control form-control-user" 
                                   name="No.id" placeholder="no.id pengunjung" required>
                                </div>

                               
                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                                
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">by. Kelompok 3 2021- <?= date('Y')?></a>
                            </div>
                            
                         </div>
                <!-- end card body -->
            </div>
        </div>
        <!-- Awal Col-lg-5 -->

        <div class="col-lg-5 mb-3">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Statik Pengunjung</h1>
                            </div>
                            <?php
                            // deklarasi tanggal

                            // menampilkan tanggal sekarang
                            $tgl_sekarang = date('Y-m-d');

                            // menampilkan tanggal kemarin
                            $kemarin = date ('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))  )
                            ;
                            // mendapatkan  hari sebelum tgl skrg
                            $seminggu = date('Y-m-d h:i:s', strtotime(' -1 week + 1 day', strtotime
                            ($tgl_sekarang)));

                            $sekarang = date('Y-m-d h:i:s');

                            // persiapan query tampilkan data jumlah pengunjung

                            $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                                 $koneksi, 
                                 "SELECT count(*) FROM ppengunjung where tanggal like '%$tgl_sekarang%' 
                            "));

                             $tgl_kemarin = mysqli_fetch_array(mysqli_query(
                                 $koneksi, 
                                 "SELECT count(*) FROM ppengunjung where tanggal like '%$kemarin%' 
                            "));

                            $seminggu = mysqli_fetch_array(mysqli_query(
                                 $koneksi, 
                                 "SELECT count(*) FROM ppengunjung where tanggal BETWEEN '$seminggu'  and
                                  '$sekarang'"
                             ));

                            $bulan_ini = date('m');


                            $sebulan = mysqli_fetch_array(mysqli_query(
                                $koneksi, 
                                "SELECT count(*) FROM ppengunjung where month(tanggal) =  '$bulan_ini '"
                           ));

                           $keseluruhan = mysqli_fetch_array(mysqli_query(
                            $koneksi, 
                            "SELECT count(*) FROM ppengunjung"
                        ));
                            ?>
                            <table class="table table-bordered" 
                  
                        </tr>
                            </tr>
                                <td> Hari ini<td>
                                <td>: <?= $tgl_sekarang[0]?></td>
                            </tr>
                            <tr>
                                <td> Kemarin<td>
                                <td>: <?= $kemarin[0]?></td>
                            </tr>
                            <tr>
                            <tr>
                                <td> minggu ini<td>
                                <td>: <?= $seminggu[0]?></td>
                            </tr>
                                <td> Bulan ini<td>
                                <td>: <?= $bulan_ini[0]?></td>
                            </tr>
                            <tr>
                                <td> keseluruhan<td>
                                <td>: <?= $keseluruhan[0]?></td>
                            </tr>
                        </tr>

                            </table>
            <!-- card body -->
        </div>
        <!-- card -->
    </div>
    <!-- end Col-lg-5 -->


    </div>
    <!-- end row -->
     
       <!-- card -->
       <div class="card shadow">
           <div class="card title">
          
                <!-- DataTales Example -->
                <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data pengunjung Hari Ini [<?=date('d-m-Y')?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href ="rekapitulasi.php" class="btn btn-success mb-3"><i class= "fa 
                            fa-table"></i> Rekapitulasi pengunjung</a>
                             <a herf = "Logout.php" class="btn btn-danger success mb-3"><i class= "fa fa-sign-outalt"> <i>Logout</a>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>Nope</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Alamat</th>
                                            <th>Tujuan</th>
                                            <th>Nope</th>
                                            
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $tgl = date ('Y-m-d'); //2022-05-02
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ppengunjung where
                                         tanggal like '%$tgl%' order by id desc");
                                        $No = 1;

                                        while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                           <tr>
                                                <td><?= $No++ ?></td>
                                                <td><?= $data ['tanggal']?></td>
                                                <td><?= $data ['nama']?></td>
                                                <td><?= $data ['alamat']?></td>
                                                <td><?= $data ['tujuan']?></td>
                                                <td><?= $data ['nope']?></td>
                                           </tr>
                                       <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap core JavaScript-->

                    <div>
                </div>


</div>
    <!-- Bootstrap core JavaScript-->
    <script src="assest/vendor/jquery/jquery.min.js"></script>
    <script src="assest/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assest/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assest/js/sb-admin-2.min.js"></script>

                     <!-- Page level plugins -->
    <script src="assest/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assest/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assest/js/demo/datatables-demo.js"></script>

     </body>
    
     <html>

        <!-- panggil file footer -->
        <?php include "footer.php"; ?>