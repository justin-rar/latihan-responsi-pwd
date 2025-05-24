<?php
session_start();
require("connect.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id_prod'])) {
    header("Location: prodi.php");
    exit();
}

$sql = "SELECT * FROM tb_prodi WHERE id_prod = '$id_prod'";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_prod = $_GET['id_prod'];
    $nama_prodi = $_POST['nama_prodi'];

    $query = "UPDATE tb_prodi SET nama_prodi = '$nama_prodi' WHERE id_prod = '$id_prod'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['log_update'] = "Data prodi berhasil diupdate";
        header("Location: editprodi.php");
        exit();
    } else {
        $_SESSION['log_update_gagal'] = "Gagal mengupdate data: " . mysqli_error($conn);
        header("Location: editprodi.php");
        exit();
    }
} else {
    $_SESSION['log_update_gagal'] = "Permintaan tidak valid.";
    header("Location: editprodi.php");
    exit();
}


?>