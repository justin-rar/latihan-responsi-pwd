<?php
require("connect.php");
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $angkatan = $_POST['angkatan'];
    $id_prod= $_POST['id_prod'];

    $sqlnim = "SELECT * FROM tb_mhs WHERE nim = '$nim'";
    $querynim = mysqli_query($conn, $sqlnim);

    if (mysqli_num_rows($querynim) > 0) {
        echo "
                <script>
                    alert('NIM sudah digunakan');
                    window.location.href = 'dashboard.php';
                </script>";
    }

    $sql_prodi = "SELECT nama FROM tb_prodi WHERE id_prod= '$id_prod'";
    $result_prodi = mysqli_query($conn, $sql_prodi);

    $query = "INSERT INTO tb_mhs(nim, nama, angkatan, id_prod) 
            VALUES ('$nim', '$nama', '$angkatan', '$nama_prodi')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['log_tambah'] = "Data berhasil ditambahkan!";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "
                <script>
                    alert('Terjadi kesalahan');
                    window.location.href = 'dashboard.php';
                </script>";
    }
    $conn->close();
} else {
    header("Location: dashboard.php");
    exit();
}
