<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <section id="page-login">
        <div class=" container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card " style="width: 30vw; min-height: 30vh; ">
                <div class="card-header bg-dark">
                    <h5 class="text-white text-center ">Silahkan Pilih</h5>
                </div>
                <div class="card-body">
                    <!-- Bagian menu -->
                    <?php 
                    if ($_SESSION['user'] == "admin") { ?>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../inputbrt/index.php">Input Berita</a>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../oplahiklan/index.php">Oplah dan Iklan</a>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../listingg/index.php">Listing</a>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../layout/index.php">Layout</a>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../opini/index.php">Opini</a>
                    <a class="btn btn-dark mb-3 d-block mx-auto w-100" href="../../logout.php">Logout</a>    
                    <?php 
                    } else { ?>
                    <a class="btn btn-danger mb-3 d-block mx-auto w-100" href="../inputbrt/index.php">Input Berita</a>
                    <a class="btn btn-dark mb-3 d-block mx-auto w-100" href="../../logout.php">Logout</a>
                    <?php 
                    }
                    ?>
                    <!-- Bagian menu -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>