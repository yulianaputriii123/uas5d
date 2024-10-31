<?php
include 'db_connection.php';

$type = $_GET['type'] ?? 'recent'; // 'recent' atau 'popular'
$category = $_GET['category'] ?? null; // ID kategori (null jika tidak diset)
$page = $_GET['page'] ?? 1;
$articlesPerPage = 6;
$offset = ($page - 1) * $articlesPerPage;

// Query dasar
$query = "SELECT * FROM articles";
$params = [];

// Menambahkan filter kategori jika disediakan
if ($category) {
    $query .= " WHERE category_id = ?";
    $params[] = $category;
}

// Menentukan urutan berdasarkan tipe
if ($type === 'popular') {
    $query .= " ORDER BY view_count DESC, created_at DESC";
} else {
    $query .= " ORDER BY created_at DESC";
}

$query .= " LIMIT ? OFFSET ?";
$params[] = $articlesPerPage;
$params[] = $offset;

// Siapkan statement
$stmt = $conn->prepare($query);

// Bind parameter jika ada kategori
if ($category) {
    $stmt->bind_param("iii", $params[0], $params[1], $params[2]);
} else {
    // Bind parameter untuk LIMIT dan OFFSET saja
    $stmt->bind_param("ii", $params[0], $params[1]);
}

$stmt->execute();
$articles = $stmt->get_result();

// Mengembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($articles->fetch_all(MYSQLI_ASSOC));
?>
