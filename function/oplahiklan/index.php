<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/datatable/datatables.min.css">
    <title>Document</title>
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
                            echo "<h5 class='text-center text-dark'>Oplah & Iklan</h5>";
                    
                        // Fetch and display the records based on the 'kode' value
                        $sql = mysqli_query($con, "SELECT * FROM oplah WHERE kode='$kode'");
                        while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements
                           
                            echo "Hari/Tanggal: " . $data['tgl_pemesanan'] . "<br>";
                            echo "pemesan: " . $data['pemesan'] . "<br>";
                            echo "Judul Berita: " . $data['uraian'] . "<br>";
                            echo "jumlah_ukuran: " . $data['jumlah_ukuran'] . "<br>";
                        }
                    }
                    ?>

<div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Oplah & Iklan</h5>
                </div>
                <div class="card-body ">
                    <?php
                   function getoplahByID($con, $id)
                   {
                       $sql = mysqli_query($con,"SELECT * FROM oplah WHERE id = '$id'");
                       return mysqli_fetch_assoc($sql);
                   }
                   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
                    
                       $tgl_pemesanan = $_POST['tgl_pemesanan'];
                       $pemesan = $_POST['pemesan'];
                       $uraian = $_POST['uraian'];
                       $jumlah_ukuran = $_POST['jumlah_ukuran'];


                       $sql = mysqli_query($con,"INSERT INTO oplah (tgl_pemesanan, pemesan, uraian, jumlah_ukuran) VALUES ('$tgl_pemesanan', '$pemesan', '$uraian', '$jumlah_ukuran')");
                       if ($sql) {
                           echo 'Data berhasil ditambahkan.';
                       } else {
                           echo 'Terjadi kesalahan saat menambahkan data.';
                       }
                   }
                   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
              
                    $tgl_pemesanan = $_POST['tgl_pemesanan'];
                    $pemesan = $_POST['pemesan'];
                    $uraian = $_POST['uraian'];
                    $jumlah_ukuran = $_POST['jumlah_ukuran'];
                    

                    $sql = mysqli_query($con,"UPDATE oplah SET tgl_pemesanan='$tgl_pemesanan', pemesan='$pemesan', uraian='$uraian', jumlah_ukuran='$jumlah_ukuran'");
                    if ($sql) {
                        echo 'Data berhasil diupdate.';
                    } else {
                        echo 'Terjadi kesalahan saat mengupdate data.';
                    }
                }
                    
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                        $id = $_GET['delete'];

                        $sql = mysqli_query($con,"DELETE FROM oplah WHERE id='$id'");
                        if ($sql) {
                            echo 'Data berhasil dihapus.';
                        } else {
                            echo 'Terjadi kesalahan saat menghapus data.';
                        }
                    }
 
                    
                    $oplahToEdit = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
                        $id = $_GET['edit'];
                        $oplahToEdit = getoplahByID($con, $id);
                    }
                    ?>

                    <!-- Bagian form -->        
                    <form action="" method="post">
                    <div class="form-group">
            <div class="form-group">
                    <label for="nama">Tangal Pemesanan :</label>
                    <input type="date" class="form-control" id="tgl_pemesanan" name="tgl_pemesanan" autocomplete="off" value="<?= isset($oplahToEdit['tgl_pemesanan']) ? $oplahToEdit['tgl_pemesanan'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Pemesan :</label>
                    <input type="text" class="form-control" id="pemesan" name="pemesan" placeholder="masukkan nama pemesan" autocomplete="off" value="<?= isset($oplahToEdit['pemesan']) ? $oplahToEdit['pemesan'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Uraian :</label>
                    <input type="text" class="form-control" id="uraian" name="uraian" placeholder="masukkan uraian berita" autocomplete="off" value="<?= isset($oplahToEdit['uraian']) ? $oplahToEdit['uraian'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Jumlah Ukuran :</label>
                    <input type="text" class="form-control" id="jumlah_ukuran" name="jumlah_ukuran" placeholder="masukkan jumlah ukuran" autocomplete="off" value="<?= isset($oplahToEdit['jumlah_ukuran']) ? $oplahToEdit['jumlah_ukuran'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                        <?php
                        if (isset($oplahToEdit['id'])) {
                            echo "<button class='btn btn-primary mb-3' type='submit' name='update'>Update Data</button>";
                        }  else {
                            echo "<button class='btn btn-success mb-3' type='submit' name='tambah'>SIMPAN</button>";
                       }
                
                        ?>
                        <div>
                        <a href="../dashboard/index.php" class="btn btn-danger mb-3">Kembali</a>
                    </div>
                    </form>
                    <!-- Bagian form -->
                </div>
            </div>
            <div class="card mt-3" >
                    <div class="card-body">
                    <table id="data" class="table">
                        <thead>
                            <th>Tanggal Pemesanan</th>
                            <th>Pemesan</th>
                            <th>Uraian</th>
                            <th>jumlah_ukuran</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT * FROM oplah");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
        
                                <tr>
                                    <td><?= $data['tgl_pemesanan'] ?></td>
                                    <td><?= $data['pemesan'] ?></td>
                                    <td><?= $data['uraian'] ?></td>
                                    <td><?= $data['jumlah_ukuran'] ?></td>
                                   
                                    
                                    <td>
                                        <div class="d-flex gap-2">
                                        <a href="index.php?delete=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                                        <a href="index.php?edit=<?= $data['id'] ?>" class="btn btn-success">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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