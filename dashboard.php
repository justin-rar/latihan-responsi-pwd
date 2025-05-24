<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require("connect.php");

$sql = "SELECT * FROM tb_mhs";
$result = mysqli_query($conn, $sql);

$sqlprd = "SELECT m.nim, m.nama, m.angkatan, p.nama_prodi 
        FROM tb_mhs m
        JOIN tb_prodi p ON m.id_prod = p.id_prod";
$hasilprd = mysqli_query($conn, $sqlprd);

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " WHERE m.nama LIKE '%$search%'";

    $sqlprod = "SELECT * FROM tb_prodi";
    $hasilprod = mysqli_query($conn, $sqlprod);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Dashboard Mahasigma</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item fw-normal">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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

    <div class="container-fluid container-md">
        <!-- alert php -->
        <?php
        if (isset($_SESSION['log_tambah'])) {
        ?>
            <div class="alert alert-success fade show mt-2" role="alert">
                <strong>Berhasil!</strong> data telah ditambahkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['log_tambah']);
        }
        ?>
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
        <?php
        if (isset($_SESSION['log_hapus'])) {
        ?>
            <div class="alert alert-success fade show mt-2" role="alert">
                <strong>Berhasil</strong> data telah dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['log_hapus']);
        }
        ?>

        <!-- Tambah -->
        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahmhs">
            Tambah Mahasigma
        </button>

        <!-- Cari -->
        <form class="d-flex mt-2" role="search" method="GET" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="cari nama mahasiswa" aria-label="Search" value="<?php
                                                                                                                                        if (isset($_GET['search'])) {
                                                                                                                                            echo htmlspecialchars($_GET['search']);
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        }
                                                                                                                                        ?>">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="tambahmhs" tabindex="-1" aria-labelledby="tambahmhsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="savedata.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahmhsLabel">Tambah Data Mahasigma</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="number" class="form-control" id="angkatan" name="angkatan" required>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <select class="form-select" id="prodi" name="prodi" required>
                                    <option value="" selected disabled>Pilih Prodi</option>
                                    <?php
                                    if (mysqli_num_rows($hasilprod) > 0) {
                                        while ($rowprod = mysqli_fetch_assoc($hasilprod)) {
                                    ?>
                                            <option value="<?= htmlspecialchars($rowprod['id_prod']) ?>">
                                                <?= htmlspecialchars($rowprod['nama_prodi']) ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Prodi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($hasilprd) > 0) {
                    while ($row = mysqli_fetch_assoc($hasilprd)) {
                ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['angkatan']) ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi'] ?? '-') ?></td>
                            <td>
                                <a href='edit.php?nim=<?= $row['nim'] ?>' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete.php?nim=<?= $row['nim'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Yakin ingin menghapus?")'>Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='5' class='text-center'>Tidak ada data mahasiswa</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>
<?php
$conn->close();
?>