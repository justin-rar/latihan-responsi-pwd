<?php
require("connect.php");
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id_prod'])) {
    header("Location: prodi.php");
    exit();
}

$id_prod = $_GET['id_prod'];

$query = "DELETE FROM tb_prodi WHERE id_prod = '$id_prod'";

if (mysqli_query($conn, $query)) {
    $_SESSION['log_hapus'] = "Data prodi berhasil dihapus";
    header("Location: editprodi.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal menghapus data prodi: " . mysqli_error($conn);
    header("Location: editprodi.php");
    exit();
}

header("Location: editprodi.php");
exit();
?>