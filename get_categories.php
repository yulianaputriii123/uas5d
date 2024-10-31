<?php
include 'db_connection.php';

$query = "SELECT id, name FROM categories ORDER BY name";
$result = $conn->query($query);

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

// Mengembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($categories);
?>
