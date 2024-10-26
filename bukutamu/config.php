<?php
$server = "localhost"; //kita buat varibel nama server 
$user = "root"; //kita buat default user root
$password = ""; //kita buat default password
$dbname = "bukutamu"; //kita hubungkan database yang di buat

$conn = mysqli_connect($server, $user, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 
?>