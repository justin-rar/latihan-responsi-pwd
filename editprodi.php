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
$query = "SELECT * FROM tb_prodi WHERE id_prod = '$id_prod'";
$result = mysqli_query($conn, $query);
$prodi = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_prodi = $_POST['nama_prodi'];

    $update_query = "UPDATE tb_prodi SET nama_prodi = '$nama_prodi' WHERE id_prod = '$id_prod'";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = "Program studi berhasil diperbarui";
        header("Location: prodi.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memperbarui program studi: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Edit Prodi</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="dashboard.php">Dashboard Mahasigma</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item fw-normal">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item fw-normal">
                        <a class="nav-link active" href="prodi.php">Prodi</a>
                    </li>
                </ul>
                <form action="logout.php" method="post" class="d-flex ms-auto">
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <form action="updateprodi.php?id_prod=<?= $id_prod ?>" method="post">
    <div class="container container-md container-fluid">
        <?php
        if (isset($_SESSION['log_update'])) {
        ?>
            <div class="alert alert-success fade show mt-2" role="alert">
                <strong>Berhasil!</strong> data telah diedit.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['log_update']);
        }
        ?>
        <?php
        if (isset($_SESSION['log_update_gagal'])) {
        ?>
            <div class="alert alert-danger fade show mt-2" role="alert">
                <strong>Gagal!!</strong> gagal edit data.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['log_update_gagal']);
        }
        ?>
        <div class="mb-3">
            <label for="nama_prodi" class="form-label mt-3">Nama</label>
            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">
            Submit
        </button>
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>