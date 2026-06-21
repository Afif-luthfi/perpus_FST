<?php
include 'koneksi.php';

// Menerima data JSON dari Frontend
$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->pass) && isset($data->name) && isset($data->role)) {
    $id = $conn->real_escape_string($data->id);
    $pass = $conn->real_escape_string($data->pass);
    $name = $conn->real_escape_string($data->name);
    $role = $conn->real_escape_string($data->role);

    // Cek apakah ID sudah terdaftar
    $cek_query = "SELECT * FROM users WHERE id='$id'";
    if ($conn->query($cek_query)->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "NIM/ID sudah terdaftar!"]);
        exit;
    }

    // Olah data jurusan & inisial
    $dept = ($role === 'Mahasiswa') ? 'Fakultas Sains dan Teknologi' : 'Dosen FST';
    $words = explode(" ", $name);
    $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ""));

    // Masukkan ke Database
    $query = "INSERT INTO users (id, pass, name, role, dept, initials) VALUES ('$id', '$pass', '$name', '$role', '$dept', '$initials')";
    
    if ($conn->query($query) === TRUE) {
        echo json_encode(["success" => true, "message" => "Pendaftaran berhasil!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
}
?>