<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mhsupn";

$conn = new mysqli($host, $user, $password, $dbname);

if($conn->connect_error){
    die("Connection Error");
}

?>