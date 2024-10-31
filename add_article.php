<?php
include 'db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$title = $data['title'] ?? '';
$content = $data['content'] ?? '';
$category = $data['category'] ?? 1; // Default ke kategori 1 jika tidak ada

if ($title && $content && $category) {
    $stmt = $conn->prepare("INSERT INTO articles (title, content, category_id, created_at, view_count) VALUES (?, ?, ?, NOW(), 0)");
    $stmt->bind_param("ssi", $title, $content, $category);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
