<?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
                    session_start();
                    include 'function/koneksi.php';
                    //Sesuaikan post dengan name yang ada di form
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $sql = mysqli_query($con,"SELECT * FROM user where username='$username' and password='$password'");
                    $cek = mysqli_num_rows($sql);

                    if($cek > 0){
                        //kondisi ketika berhasil
                        $data = mysqli_fetch_assoc($sql);
                        $_SESSION['username'] = $data['username'];
                        header('location:function/dashboard/index.php');
                    }else{
                        header('location:index.php?pesan=gagal');
                    }
                }
                    ?>