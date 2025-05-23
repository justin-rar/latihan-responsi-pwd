<?php
require('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_akun WHERE username = '$username'";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        if ($password === $result['password']) {    
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['log_login'] = "Login gagal, password salah";
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['log_login'] = "Login gagal, username tidak ditemukan";
        header('Location: login.php');
        exit;
    }
    $conn->close();
}
?>