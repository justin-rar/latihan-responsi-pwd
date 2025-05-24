<?php
session_start();
require("connect.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['nim'])) {
    header("Location: dashboard.php");
    exit();
}

$nim = mysqli_real_escape_string($conn, $_GET['nim']);

// Check if record exists
$check = "SELECT * FROM tb_mhs WHERE nim = '$nim'";
$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Data mahasiswa tidak ditemukan";
    header("Location: dashboard.php");
    exit();
}

$query = "DELETE FROM tb_mhs WHERE nim = '$nim'";

if (mysqli_query($conn, $query)) {
    $_SESSION['log_hapus'] = "Data mahasiswa berhasil dihapus";
    header("Location: dashboard.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal menghapus data: " . mysqli_error($conn);
    header("Location: dashboard.php");
    exit();
}

header("Location: dashboard.php");
exit();
