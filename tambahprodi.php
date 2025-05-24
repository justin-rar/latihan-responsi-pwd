<?php
require("connect.php");
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama_prodi = $_POST['nama_prodi'];

    $query = "INSERT INTO tb_prodi(nama_prodi) VALUES ('$nama_prodi')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['log_'] = "prodi berhasil ditambahkan!";
        header("Location: prodi.php");
        exit();
    } else {
        echo "
                <script>
                    alert('Terjadi kesalahan');
                    window.location.href = 'prodi.php';
                </script>";
    }
    $conn->close();
} else {
    header("Location: prodi.php");
    exit();
}





?>