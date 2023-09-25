<?php
session_start();
$username = $_SESSION['username'];
?>
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
                echo "<h5 class='text-center text-dark'>Laporan</h5>";

                        // Fetch and display the records based on the 'kode' value
                $sql = mysqli_query($con, "SELECT * FROM inputberita WHERE kode='$kode'");
                while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements

                    echo "Edisi: " . $data['edisi'] . "<br>";
                    echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                    echo "Halaman: " . $data['halaman'] . "<br>";
                    echo "Kode: " . $data['kode'] . "<br>";
                    echo "Judul Berita: " . $data['judulberita'] . "<br>";
                    echo "Wartawan: " . $data['wartawan'] . "<br>";
                    echo "Honor: " . $data['honor'] . "<br>";
                    echo "Point: " . $data['point'] . "<br>";
                }
            }
            ?>

            <div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Input Berita</h5>
                </div>
                <div class="card-body ">
                    <?php
                    function getinputberitaByID($con, $id)
                    {
                     $sql = mysqli_query($con,"SELECT * FROM laporan WHERE id = '$id'");
                     return mysqli_fetch_assoc($sql);
                 }
                 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
                     $edisi = $_POST['edisi'];
                     $hari_tanggal = $_POST['hari_tanggal'];
                     $halaman = $_POST['halaman'];
                     $kode = $_POST['kode'];
                     $honor = $_POST['honor'];
                     $poin = $_POST['poin'];
                     $judul = $_POST['judulberita'];

                     $sql = mysqli_query($con,"INSERT INTO laporan 
                        (edisi, tgl_dibuat, judul, halaman, kode_berita, user_wartawan) VALUES 
                        ('$edisi', '$hari_tanggal', '$judul', '$halaman', '$kode', '$username')");
                     if ($sql) {
                         echo 'Data berhasil ditambahkan.';
                     } else {
                         echo 'Terjadi kesalahan saat menambahkan data.';
                     }
                 }
                 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
                    $edisi = $_POST['edisi'];
                    $hari_tanggal = $_POST['hari_tanggal'];
                    $halaman = $_POST['halaman'];
                    $kode = $_POST['kode'];
                    $honor = $_POST['honor'];
                    $poin = $_POST['poin'];
                    $judulberita = $_POST['judulberita'];                    

                    $sql = mysqli_query($con,"UPDATE laporan SET edisi='$edisi',hari_tanggal='$hari_tanggal', halaman='$halaman', kode='$kode', honor='$honor', poin='$poin', judulberita='$judulberita', wartawan='$username'");
                    if ($sql) {
                        echo 'Data berhasil diupdate.';
                    } else {
                        echo 'Terjadi kesalahan saat mengupdate data.';
                    }
                }


                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                    $id = $_GET['delete'];

                    $sql = mysqli_query($con,"DELETE FROM laporan WHERE id='$id'");
                    if ($sql) {
                        echo 'Data berhasil dihapus.';
                    } else {
                        echo 'Terjadi kesalahan saat menghapus data.';
                    }
                }


                $inputberitaToEdit = null;

                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
                    $id = $_GET['edit'];
                    $inputberitaToEdit = getinputberitaByID($con, $id);
                }
                ?>
                
                <div>
                    <a href="../laporan/index.php" class="btn btn-danger mb-3">Laporan</a>
                    <a href="../honor/index.php" class="btn btn-danger mb-3">Honor</a>
                    <a href="../prod/index.php" class="btn btn-danger mb-3">Prod</a>
                </div>
                <!-- Bagian form -->        
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Edisi :</label>
                        <input type="text" class="form-control" id="edisi" name="edisi" placeholder="Masukan edisi" autocomplete="off" value="<?= isset($inputberitaToEdit['edisi']) ? $inputberitaToEdit['edisi'] : ''; ?>">
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="nama">Hari/tanggal :</label>
                        <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" placeholder="Masukkan hari/tanggal" autocomplete="off" value="<?= isset($inputberitaToEdit['hari_tanggal']) ? $inputberitaToEdit['hari_tanggal'] : ''; ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nama">Judul Berita :</label>
                        <input type="text" class="form-control" id="judulberita" name="judulberita" placeholder="masukkan judul berita" autocomplete="off" value="<?= isset($inputberitaToEdit['judulberita']) ? $inputberitaToEdit['judulberita'] : ''; ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="nama">Halaman :</label>
                        <input type="number" class="form-control" id="halaman" name="halaman" placeholder="masukkan halaman" autocomplete="off" value="<?= isset($inputberitaToEdit['halaman']) ? $inputberitaToEdit['halaman'] : ''; ?>">
                    </div>

                    <br>

                    <div class="form-group">
                        <?php
                        $findKode = mysqli_query($con, "select * from berita");
                        $kodeData = array();
                        while ($result = mysqli_fetch_assoc($findKode)) {
                            $kodeData[$result['kode']] = array("honor" => $result['honor'], "poin" => $result['poin']);
                        }
                        ?>
                        <label for="kode">Kode :</label>
                        <select name="kode" id="kode" class="form-select mb-3">
                            <option value="kosong">---</option>
                            <?php foreach ($kodeData as $kode => $data) { ?>
                                <option value="<?= $kode ?>"><?= $kode ?></option>
                            <?php } ?>
                        </select>
                        <label for="honor">Honor :</label>
                        <input type="text" name="honor" id="honor" class="form-control mb-3"  value="<?= isset($inputberitaToEdit['honor']) ? $inputberitaToEdit['honor'] : ''; ?>" readonly>
                        <label for="honor">Point :</label>
                        <input type="text" name="poin" id="poin" class="form-control mb-3"  value="<?= isset($inputberitaToEdit['poin']) ? $inputberitaToEdit['poin'] : ''; ?>"  readonly>
                        <script>
                            document.getElementById("kode").addEventListener("change", function() {
                                var selectedKode = this.value;
                                var kodeData = <?= json_encode($kodeData) ?>;
                                document.getElementById("honor").value = kodeData[selectedKode].honor || "";
                                document.getElementById("poin").value = kodeData[selectedKode].poin || "";
                            });
                        </script>
                    </div>
                    <br>
                    <div class="form-group">
                        <?php
                        if (isset($inputberitaToEdit['id'])) {
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
                            <th>Edisi</th>
                            <th>Hari/Tanggal</th>
                            <th>Judul Berita</th>
                            <th>Halaman</th>
                            <th>Kode</th>
                            <th>Poin</th>
                            <th>Wartawan</th>
                            <th>Honor</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT laporan.id, laporan.edisi, laporan.tgl_dibuat, laporan.judul, laporan.halaman, laporan.kode_berita, berita.honor, berita.poin, laporan.user_wartawan FROM laporan INNER JOIN berita ON berita.kode = laporan.kode_berita WHERE user_wartawan = '$username';");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>

                                <tr>
                                    <td><?= $data['edisi'] ?></td>
                                    <td><?= $data['tgl_dibuat'] ?></td>
                                    <td><?= $data['judul'] ?></td>
                                    <td><?= $data['halaman'] ?></td>
                                    <td><?= $data['kode_berita'] ?></td>
                                    <td><?= $data['poin'] ?></td>
                                    <td><?= $data['user_wartawan'] ?></td>
                                    <td><?= $data['honor'] ?></td>
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