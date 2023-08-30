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
                        echo "<div class='card mb-3'> ";
                        echo "<div class='card-header bg-white'>";
                            echo "<h5 class='text-center text-dark'>Laporan Listing</h5>";
                    
                        // Fetch and display the records based on the 'kode' value
                        $sql = mysqli_query($con, "SELECT * FROM listing WHERE id='$kode'");
                        while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements
                           
                           
                            echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                            echo "Nama : " . $data['nama'] . "<br>";
                            echo "Berita : " . $data['berita'] . "<br>";
                            echo "Waktu : " . $data['waktu'] . "<br>";
                            echo "<button onclick='window.print()'  class='btn btn-warning mb-3 no-print'>Print</button>
                            ";
                        }
                    }
                   

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['listinga'])) {
                        $listing = $_GET['listing'];
                        echo "<div class='card mb-3'> ";
                        echo "<div class='card-header bg-white'>";
                            echo "<h5 class='text-center text-dark'>laporanlisting</h5>";
                    
                        // Fetch and display the records based on the 'berita' value
                        $sql = mysqli_query($con, "SELECT * FROM listing WHERE id='$id'");
                        while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements
                           
                       
                            echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                            echo "nama: " . $data['nama'] . "<br>";
                            echo "berita: " . $data['berita'] . "<br>";
                            echo "waktu: " . $data['waktu'] . "<br>";
                        }
                    }
                    ?>
                <div class="card-body ">
                    <?php
                    
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                        $id = $_GET['delete'];

                        $sql = mysqli_query($con,"DELETE FROM listing WHERE id='$id'");
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
                    <h5 class="text-white text-center ">Laporan Listing</h5>
                </div>
                <div class="card-body">
                    <table id="data" class="table">
                        <thead>
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Berita</th>
                            <th>Waktu</th>
                            <th>Aksi</th>

                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT * FROM listing");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
        
                                <tr>
                                    <td><?= $data['hari_tanggal'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['berita'] ?></td>
                                    <td><?= $data['waktu'] ?></td>
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
                        <a href="../listing/index.php" class="btn btn-danger mb-3">Kembali</a>
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