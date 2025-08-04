<?php
// Same DB connection as above
include 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    echo "Article introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?> - Blog </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main-container">
        <nav>
            <div class="logo">BLOG UM6P</div>
            <ul class="nav-links">
                <li><a href="index.php">ACCUEIL</a></li>
            </ul>
        </nav>

        <section class="hero">
            <div class="hero-title"><?= htmlspecialchars($post['title']) ?></div>
        </section>

        <div class="posts-container">
            <div class="post-card" style="width: 100%;">
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; Blog</p>
        </footer>
    </div>
</body>
</html>
