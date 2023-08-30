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
                            echo "<h5 class='text-center text-dark'>listing & Iklan</h5>";
                    
                        // Fetch and display the records based on the 'kode' value
                        $sql = mysqli_query($con, "SELECT * FROM listing WHERE kode='$kode'");
                        while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements
                           
                            echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                            echo "nama: " . $data['nama'] . "<br>";
                            echo "Judul Berita: " . $data['berita'] . "<br>";
                            echo "waktu: " . $data['waktu'] . "<br>";
                        }
                    }
                    ?>

<div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Listing</h5>
                </div>
                <div class="card-body ">
                    <?php
                   function getlistingByID($con, $id)
                   {
                       $sql = mysqli_query($con,"SELECT * FROM listing WHERE id = '$id'");
                       return mysqli_fetch_assoc($sql);
                   }
                  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $hari_tanggal = $_POST['hari_tanggal'];
    $nama = $_POST['nama'];
    $berita = $_POST['berita'];
    $waktu = $_POST['waktu'];

    $sql = mysqli_query($con,"INSERT INTO listing (hari_tanggal, nama, berita, waktu) VALUES ('$hari_tanggal', '$nama', '$berita', '$waktu')");
    if ($sql) {
        echo 'Data berhasil ditambahkan.';
    } else {
        echo 'Terjadi kesalahan saat menambahkan data.';
     }
}
                   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id']; // Make sure to get the ID of the record to be updated

    $hari_tanggal = $_POST['hari_tanggal'];
    $nama = $_POST['nama'];
    $berita = $_POST['berita'];
    $waktu = $_POST['waktu'];

    // Add the WHERE clause to specify the record to update based on the ID
    $sql = mysqli_query($con, "UPDATE listing SET hari_tanggal='$hari_tanggal', nama='$nama', berita='$berita', waktu='$waktu' WHERE id='$id'");
    if ($sql) {
        echo 'Data berhasil diupdate.';
    } else {
        echo 'Terjadi kesalahan saat mengupdate data.';
    }
}
                
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                        $id = $_GET['delete'];

                        $sql = mysqli_query($con,"DELETE FROM listing WHERE id='$id'");
                        if ($sql) {
                            echo 'Data berhasil dihapus.';
                        } else {
                            echo 'Terjadi kesalahan saat menghapus data.';
                        }
                    }
 
                    
                    $listingToEdit = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
                        $id = $_GET['edit'];
                        $listingToEdit = getlistingByID($con, $id);
                    }
                    ?>

                    <!-- Bagian form -->        
                    <form action="" method="post">
    <!-- ... (existing form fields) ... -->
    <input type="hidden" id="id" name="id" value="<?= isset($listingToEdit['id']) ? $listingToEdit['id'] : ''; ?>">
            <div class="form-group">
                    <label for="nama">Hari/Tanggal :</label>
                    <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" autocomplete="off" value="<?= isset($listingToEdit['hari_tanggal']) ? $listingToEdit['hari_tanggal'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="masukkan nama" autocomplete="off" value="<?= isset($listingToEdit['nama']) ? $listingToEdit['nama'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Berita :</label>
                    <input type="text" class="form-control" id="berita" name="berita" placeholder="masukkan judul berita" autocomplete="off" value="<?= isset($listingToEdit['berita']) ? $listingToEdit['berita'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                    <label for="nama">Waktu :</label>
                    <input type="time" class="form-control" id="waktu" name="waktu" autocomplete="off" value="<?= isset($listingToEdit['waktu']) ? $listingToEdit['waktu'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                <?php
    if (isset($listingToEdit['id'])) {
        echo "<button class='btn btn-primary mb-3' type='submit' name='update'>Update Data</button>";
    } else {
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
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Berita</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </thead>
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