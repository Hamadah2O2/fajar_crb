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
            <div class="card ">
                <div class="card-header bg-dark ">
                    <h5 class="text-white text-center ">Ubah Password</h5>
                </div>
                <div class="card-body ">
                <?php
                    include '../koneksi.php';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ubah'])) {
                        $username = $_POST['username'];
                        $passlama = $_POST['ps_lama'];
                        $passbaru = $_POST['ps_baru'];
                        $kfpass = $_POST['ps_kf'];

                        $checkUser = mysqli_query($con,"SELECT * FROM user where username='$username' and password='$passlama'");
                        $cek = mysqli_num_rows($checkUser);

                        if($cek >= 1){
                            if($_POST['ps_baru'] != $_POST['ps_kf']){
                                echo 'Konfirmasi Tidak Sesuai';
                            }else{
                                $sqlUpdate = mysqli_query($con,"update user set password='$passbaru' where username='$username'");
                                $cek = mysqli_affected_rows($con);
                                if($cek == true){
                                    echo 'Password Berhasil Diubah';
                                }
                            }
                        }else{
                            echo 'Password Gagal Diubah';
                        }
                    }
                    ?>
                    
                    <form action="" method="post">
                        <input type="text" class="form-control mb-3" placeholder="Masukan Username" name="username" value="<?php session_start(); echo $_SESSION['username'];?>" hidden>
                        <input type="text" class="form-control mb-3" placeholder="Masukan Password Lama" name="ps_lama">
                        <input type="text" class="form-control mb-3" placeholder="Masukan Password Baru" name="ps_baru">
                        <input type="text" class="form-control mb-3" placeholder="Konfirmasi Password" name="ps_kf">
                    <button class='btn btn-primary mb-3' type='submit' name='ubah'>Ubah Password</button>
                    </form>
                    
                </div>
            </div>
    </section>
    <script src="../../assets/datatable/datatables.min.js"></script>
    <script>
        let table = new DataTable('#data');
    </script>
</body>

</html>