<?php
// config/database.php

// variable nyimpen detail server database
$servername = "localhost";
$username = "root"; // Username default XAMPP
$password = "password"; // 
$dbname = "pizzeria_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>