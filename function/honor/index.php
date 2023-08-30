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
 
                    
                    $inputberitaToEdit = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $inputberitaToEdit = getinputberitaByID($con, $id);
                    }
                    ?>
                
                   
                </div>
                <div class="card no-print" hidden-print>
                <div class="card-header bg-danger ">
                    <h5 class="text-white text-center ">Honor</h5>
                </div>
                <div class="card-body">
                    <table id="data" class="table">
                        <thead>
                            <th>Hari/Tanggal</th>
                            <th>Wartawan</th>
                            <th>Halaman</th>
                            <th>Honor</th>
                           
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($con, "SELECT * FROM inputberita");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
        
                                <tr>
                                    <td><?= $data['hari_tanggal'] ?></td>
                                    <td><?= $data['wartawan'] ?></td>
                                    <td><?= $data['halaman'] ?></td>
                                    <td><?= $data['honor'] ?></td>
                        
                                    
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
    </section>
    <script src="../../assets/datatable/datatables.min.js"></script>
    <script>
        let table = new DataTable('#data');
    </script>
</body>

</html>