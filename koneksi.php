<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// UBAH 4 BARIS INI SESUAI DATA DARI INFINITYFREE (TAHAP 1)
$host = "sql102.infinityfree.com"; // Ganti dengan MySQL Host Name
$user = "if0_42236967";            // Ganti dengan MySQL User Name
$pass = "4qMisQIkGQZbJmo";    // Ganti dengan Account Password (yang bintang-bintang)
$db   = "if0_42236967_perpus";     // Ganti dengan MySQL DB Name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Koneksi database gagal!"]));
}
?>