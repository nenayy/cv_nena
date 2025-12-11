<?php
require_once 'config.php';

// Function to get all published articles
function getAllArticles($status = 'published') {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE status = ? ORDER BY created_at DESC");
    $stmt->execute([$status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get a single article by ID
function getArticleById($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to create a new article
function createArticle($title, $content, $author, $image_path = null) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, author, image_path, status) VALUES (?, ?, ?, ?, 'draft')");
    return $stmt->execute([$title, $content, $author, $image_path]);
}

// Function to update an existing article
function updateArticle($id, $title, $content, $author, $status, $image_path = null) {
    $pdo = getConnection();
    if ($image_path) {
        // Update with new image
        $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, author = ?, status = ?, image_path = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $author, $status, $image_path, $id]);
    } else {
        // Update without changing image
        $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, author = ?, status = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $author, $status, $id]);
    }
}

// Function to delete an article
function deleteArticle($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    return $stmt->execute([$id]);
}

// Function to get draft articles
function getDraftArticles() {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE status = 'draft' ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to publish an article
function publishArticle($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE articles SET status = 'published' WHERE id = ?");
    return $stmt->execute([$id]);
}

// Function to save as draft
function saveAsDraft($id) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE articles SET status = 'draft' WHERE id = ?");
    return $stmt->execute([$id]);
}

// Function to upload an image
function uploadImage($file, $target_dir = "uploads/articles/") {
    // Check if file was uploaded without errors
    if (!isset($file) || !is_array($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    // Check temporary file exists
    if (!file_exists($file["tmp_name"])) {
        return false;
    }
    
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $uploadOk = 1;
    
    // Check if image file is a actual image or fake image
    $check = @getimagesize($file["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        return false;
    }
    
    // Check file size (max 5MB)
    if ($file["size"] > 5000000) {
        return false;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return false;
    }
    
    // Generate unique filename
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}
?>