<?php
session_start();
if (isset($_SESSION["username"])) { 
    header("Location: dashboard.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container justify-conten-center d-flex justify-content-center align-items-center vh-100">
        <form action="log.php" class="form-login" method="POST">
            <h3 class="fw-normal text-center">Login</h3>
            <?php 
                if(isset($_SESSION['log_login'])){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Login gagal!</strong> username atau password salah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                session_unset();
                }
            ?>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" placeholder="Username" name="username" required>
                <label>Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <label>Password</label>
            </div>
            <button class="btn btn-primary mb-2 w-100">Login</button>
            <p>Belum punya akun? <a href="register.php">register</a> disini</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>