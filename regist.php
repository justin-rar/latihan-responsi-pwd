<?php
require('connect.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $cekusn = "SELECT * FROM tb_akun WHERE username = '$username'";
    $hasilusn = mysqli_query($conn, $cekusn);
    $result = mysqli_fetch_assoc($hasilusn);

    if ($password !== $confirm_password) {
        $_SESSION['log_notmatch'] = "Password dan konfirmasi password tidak cocok!";
        header('Location: register.php');
        exit;
    }

    if($result){
        $_SESSION['log'] = "username sudah digunakan!";
        header('Location: register.php');
        exit;
    } else {
        $query = "INSERT INTO tb_akun(username, password) VALUES ('$username', '$password')";
        if($conn->query($query) === TRUE){
            echo "
                <script>
                    alert('akun berhasil didaftarkan, silahkan login');
                    window.location.href = 'login.php';
                </script>";
            exit;
        }
    }
    $conn->close();
}
?>