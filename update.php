<?php
session_start();
require("connect.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['nim'])) {
    $_SESSION['log_update_gagal'] = "NIM tidak ditemukan.";
    header("Location: dashboard.php");
    exit();
}


$sql = "SELECT * FROM tb_mhs WHERE nim = '$nim'";
$querynim = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($querynim);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_GET['nim'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    $id_prod = $_POST['id_prod'];

    $query = "UPDATE tb_mhs SET 
          nama = '$nama', 
          angkatan = '$angkatan', 
          id_prod = '$id_prod' 
          WHERE nim = '$nim'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['log_update'] = "Data mahasiswa berhasil diupdate";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['log_update_gagal'] = "Gagal mengupdate data: " . mysqli_error($conn);
        header("Location: dashboard.php");
        exit();
    }
} else {
    $_SESSION['log_update_gagal'] = "Permintaan tidak valid.";
    header("Location: dashboard.php");
    exit();
}
