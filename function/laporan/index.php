<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/datatable/datatables.min.css">
    <title>Document</title>
    <style>
        @media print{
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
<section id="page-login">
        <div class=" container-fluid p-3" style="height: 100vh;">
                
                   <?php
                   include '../koneksi.php';
                   
                   if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['kode'])) {
                       $kode = $_GET['kode'];
                       $sql = mysqli_query($con, "SELECT * FROM inputberita WHERE id='$kode'");
                       while ($data = mysqli_fetch_array($sql)) {
                           echo "<div class='card mb-3'> ";
                           echo "<div class='card-header bg-white'>";
                           echo "<h5 class='text-center text-dark'>Laporan</h5>";
                   
                           // Display the report records here based on your requirements
                   
                           echo "Edisi: " . $data['edisi'] . "<br>";
                           echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                           echo "Halaman: " . $data['halaman'] . "<br>";
                           echo "Kode: " . $data['kode'] . "<br>";
                           echo "Judul Berita: " . $data['judulberita'] . "<br>";
                           echo "Wartawan: " . $data['wartawan'] . "<br>";
                           echo "Honor: " . $data['honor'] . "<br>";
                           echo "poin: " . $data['poin'] . "<br>";
                           echo "<button onclick='window.print()' class='btn btn-warning mb-3 no-print'>Print</button>";
                           echo "</div></div>";
                       }
                   }
                   ?>

                <div class="card-body ">
                    <?php
                    
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                        $id = $_GET['delete'];

                        $sql = mysqli_query($con,"DELETE FROM inputberita WHERE id='$id'");
                        if ($sql) {
                            echo 'Data berhasil dihapus.';
                        } else {
                            echo 'Terjadi kesalahan saat menghapus data.';
                        }
                    }
 
                
                    ?>
                
                   
                </div>
          
            <div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Laporan</h5>
                </div>
                <div class="card-body">
                    <table id="data" class="table">
                        <thead>
                            <th>Edisi</th>
                            <th>Hari/Tanggal</th>
                            <th>Halaman</th>
                            <th>Kode</th>
                            <th>Judul Berita</th>
                            <th>Wartawan</th>
                            <th>Honor</th>
                            <th>poin</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT * FROM inputberita");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
        
                                <tr>
                                    <td><?= $data['edisi'] ?></td>
                                    <td><?= $data['hari_tanggal'] ?></td>
                                    <td><?= $data['halaman'] ?></td>
                                    <td><?= $data['kode'] ?></td>
                                    <td><?= $data['judulberita'] ?></td>
                                    <td><?= $data['wartawan'] ?></td>
                                    <td><?= $data['honor'] ?></td>
                                    <td><?= $data['poin'] ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                        <a href="index.php?kode=<?=$data['id']?>" class="btn btn-warning">Cetak</a>
                                            <a href="index.php?delete=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>
                        <a href="../inputbrt/index.php" class="btn btn-danger mb-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
                            </div>

    </section>
    <script src="../../assets/datatable/datatables.min.js"></script>
    <script>
        let table = new DataTable('#data');
    </script>
</body>
</html>