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

$nim = $_GET['nim'];
$query = "SELECT m.*, p.nama_prodi 
          FROM tb_mhs m
          LEFT JOIN tb_prodi p ON m.id_prod = p.id_prod
          WHERE m.nim = '$nim'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$sqlprod = "SELECT * FROM tb_prodi";
$hasilprod = mysqli_query($conn, $sqlprod);


if (!$row) {
    $_SESSION['log_update_gagal'] = "Data mahasiswa tidak ditemukan";
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Edit Page</title>
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

    <!-- header edit -->
    <form action="update.php?nim=<?= htmlspecialchars($row['nim']) ?>" method="POST">
        <div class="container container-md container-fluid">
            <h1>Halaman Edit Mahasigma</h1>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="number" class="form-control" id="angkatan" name="angkatan" value="<?= htmlspecialchars($row['angkatan']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-select" id="prodi" name="id_prod" required>
                    <option value="" disabled>Pilih Prodi</option>
                    <?php
                    if (mysqli_num_rows($hasilprod) > 0) {
                        while ($rowprod = mysqli_fetch_assoc($hasilprod)) {
                            $selected = ($rowprod['id_prod'] == $row['id_prod']) ? 'selected' : '';
                    ?>
                            <option value="<?= htmlspecialchars($rowprod['id_prod']) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($rowprod['nama']) ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">
                Submit
            </button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>