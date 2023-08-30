<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <section id="page-login">
        <div class=" container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card " style="width: 30vw; min-height: 30vh; ">
                <div class="card-header bg-dark ">
                    <h5 class="text-white text-center ">Silahkan Login</h5>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == 'gagal'){
                            echo 'Akun yang anda masukan salah';
                        }
                    }
                    ?>
                    <!-- Bagian form login -->
                    <form action="login.php" method="post">
                        <input type="text " class="form-control mb-3 mt-2" placeholder="Masukan Username" name="username">
                        <input type="password" class="form-control mb-3" placeholder="Masukan Password" name="password">
                        <button class="btn btn-danger mb-3 d-block mx-auto w-100" type="submit" name="login">Login</button>
                    </form>
                    <!-- Bagian form login -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>