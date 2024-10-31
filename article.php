<?php
include 'db_connection.php';

$articleId = $_GET['id'];

$updateViewCountQuery = "UPDATE articles SET view_count = view_count + 1 WHERE id = ?";
$stmt = $conn->prepare($updateViewCountQuery);
$stmt->bind_param("i", $articleId);
$stmt->execute();

$getArticleQuery = "SELECT * FROM articles WHERE id = ?";
$stmt = $conn->prepare($getArticleQuery);
$stmt->bind_param("i", $articleId);
$stmt->execute();
$result = $stmt->get_result();

$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $article['title'] ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?= $article['title'] ?></h1>
    </header>
    <main>
        <article>
            <p><?= $article['content'] ?></p>
        </article>
    </main>
    <footer>
        <p>&copy; 2024 My Blog</p>
    </footer>
</body>
</html>
