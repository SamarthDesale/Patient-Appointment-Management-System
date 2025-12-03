<?php
$host = 'localhost';
$username = 'root';
$passward = '';
$dbname = 'clinic_db';

$conn = new mysqli($host,$username,$passward,$dbname);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>