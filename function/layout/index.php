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
                            echo "<h5 class='text-center text-dark'>Layout</h5>";
                    
                        // Fetch and display the records based on the 'kode' value
                        $sql = mysqli_query($con, "SELECT * FROM layout WHERE kode='$kode'");
                        while ($data = mysqli_fetch_array($sql)) {
                            // Display the report records here based on your requirements
                           
                           
                            echo "Hari/Tanggal: " . $data['hari_tanggal'] . "<br>";
                            echo "selesai: " . $data['selesai'] . "<br>";
                            echo "kirim: " . $data['kirim'] . "<br>";
                          
                        }
                    }
                    ?>

<div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Rata - Rata Waktu Redaksi Selesai</h5>
                </div>
                <div class="card-body ">
                    <?php
                   function getlayoutByID($con, $id)
                   {
                       $sql = mysqli_query($con,"SELECT * FROM layout WHERE id = '$id'");
                       return mysqli_fetch_assoc($sql);
                   }
                   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
                      
                       $hari_tanggal = $_POST['hari_tanggal'];
                       $selesai = $_POST['selesai'];
                       $kirim = $_POST['kirim'];

                       $sql = mysqli_query($con,"INSERT INTO layout (hari_tanggal, selesai, kirim) VALUES ('$hari_tanggal', '$selesai', '$kirim')");
                       if ($sql) {
                           echo 'Data berhasil ditambahkan.';
                       } else {
                           echo 'Terjadi kesalahan saat menambahkan data.';
                       }
                   }
                   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            
                    $hari_tanggal = $_POST['hari_tanggal'];
                    $selesai = $_POST['selesai'];
                    $kirim = $_POST['kirim'];
                    

                    $sql = mysqli_query($con,"UPDATE layout SET hari_tanggal='$hari_tanggal', selesai='$selesai', kirim='$kirim'");
                    if ($sql) {
                        echo 'Data berhasil diupdate.';
                    } else {
                        echo 'Terjadi kesalahan saat mengupdate data.';
                    }
                }
                    
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
                        $id = $_GET['delete'];

                        $sql = mysqli_query($con,"DELETE FROM layout WHERE id='$id'");
                        if ($sql) {
                            echo 'Data berhasil dihapus.';
                        } else {
                            echo 'Terjadi kesalahan saat menghapus data.';
                        }
                    }
 
                    
                    $layoutToEdit = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
                        $id = $_GET['edit'];
                        $layoutToEdit = getlayoutByID($con, $id);
                    }
                    ?>
                
                    <!-- Bagian form -->        
                    <form action="" method="post">
                    <div class="form-group">
                    
                    <label for="nama">Hari/tanggal :</label>
                    <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" autocomplete="off" value="<?= isset($layoutToEdit['hari_tanggal']) ? $layoutToEdit['hari_tanggal'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                <label for="nama">Selesai Layout :</label>
                <input type="time" class="form-control" id="selesai" name="selesai" autocomplete="off" value="<?= isset($layoutToEdit['selesai']) ? $layoutToEdit['selesai'] : ''; ?>">
            </div>

            <br>
                <div class="form-group">
                    <label for="nama">Kirim Pdf :</label>
                    <input type="time" class="form-control" id="kirim" name="kirim" autocomplete="off" value="<?= isset($layoutToEdit['kirim']) ? $layoutToEdit['kirim'] : ''; ?>">
                </div>

                <br>
                <div class="form-group">
                        <?php
                        if (isset($layoutToEdit['id'])) {
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
                            
                            <th>Hari/Tanggal</th>
                            <th>Selesai Layout</th>
                            <th>Kirim Pdf</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT * FROM layout");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
        
                                <tr>
                                    
                                    <td><?= $data['hari_tanggal'] ?></td>
                                    <td><?= $data['selesai'] ?></td>
                                    <td><?= $data['kirim'] ?></td>
                                    
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