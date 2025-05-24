<?php
require("connect.php");
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

    $sql = "SELECT * FROM tb_prodi";
    $hasil = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Halaman Prodi</title>
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
                        <a class="nav-link active" href="#">Prodi</a>
                    </li>
                </ul>
                <form action="logout.php" method="post" class="d-flex ms-auto">
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- isi bro -->
    <div class="container container-md container-fluid">

        <!-- button -->
        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahprod">Tambah Prodi</button>

        <!-- modal -->
        <div class="modal fade" id="tambahprod" tabindex="-1" aria-labelledby="tambahprodLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="tambahprodi.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahprodLabel">Tambah Prodi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama_prodi" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- tabel -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($hasil) > 0) {
                    while ($row = mysqli_fetch_assoc($hasil)) {
                ?>

                        <tr>
                            <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                            <td>
                                <a href='editprodi.php?id=<?= $row['id_prod'] ?>' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='deleteprodi.php?id=<?= $row['id_prod'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Yakin ingin menghapus?")'>Hapus</a>
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