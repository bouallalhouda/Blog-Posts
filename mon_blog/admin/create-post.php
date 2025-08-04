<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../includes/db.php';
    
    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) {
        $targetDir = "../assets/images/uploads/";
        $imageName = uniqid() . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        $imagePath = "assets/images/uploads/" . $imageName;
    }

    // Insert post
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, excerpt, image_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'],
        $_POST['content'],
        $_POST['excerpt'],
        $imagePath
    ]);
    
    header("Location: ../index.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Post Title" required>
    <textarea name="excerpt" placeholder="Short excerpt"></textarea>
    <textarea name="content" placeholder="Post Content" required></textarea>
    <input type="file" name="image">
    <button type="submit">Publish Post</button>
</form>