<?php
include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id) && isset($data->pass)) {
    $id = $conn->real_escape_string($data->id);
    $pass = $conn->real_escape_string($data->pass);

    $query = "SELECT * FROM users WHERE id='$id' AND pass='$pass'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode([
            "success" => true, 
            "message" => "Login Berhasil", 
            "data" => $user
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "NIM/ID atau Kata Sandi salah!"]);
    }
}
?>