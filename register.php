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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid justify-conten-center d-flex justify-content-center align-items-center vh-100">
        <form action="regist.php" class="form-login" method="POST">
            <h3 class="fw-normal text-center">Register</h3>
            <?php 
                if(isset($_SESSION['log'])){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Register gagal!</strong> username sudah terdaftar, silahkan <a href="login.php">login</a>.
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
            <div class="form-floating mb-2">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            <button class="btn btn-primary mb-2 w-100">Register</button>
            <p>Sudah punya akun? <a href="login.php">login</a> disini</p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>