<?php
session_start();
if (!isset($_SESSION["username"])) { 
    header("Location: login.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>HALO</h1>
    <form action="logout.php" method="post">
        <button>logout</button>
    </form>
</body>
</html>