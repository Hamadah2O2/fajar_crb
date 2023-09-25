<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
    session_start();
    include 'function/koneksi.php';
    //Sesuaikan post dengan name yang ada di form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipe = ($_POST['admin']=="yes") ? "admin" : "wartawan" ;

    if ($tipe == 'admin') {
        // code...
        $sql = mysqli_query($con,"SELECT * FROM admin where username='$username' and password='$password'");
    } else {   
        $sql = mysqli_query($con,"SELECT * FROM wartawan where username='$username' and password='$password'");
    }

    $cek = mysqli_num_rows($sql);

    if($cek > 0){
        //kondisi ketika berhasil
        $data = mysqli_fetch_assoc($sql);
        $_SESSION['username'] = $data['username'];
        $_SESSION['user'] = $tipe;
        header('location:function/dashboard/index.php');
    }else{
        header('location:index.php?pesan=gagal');
    }
}
?>