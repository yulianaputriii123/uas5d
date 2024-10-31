<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Mengirim pesan error dalam format JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}
?>
