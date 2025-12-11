<?php
require_once 'config.php';

try {
    $pdo = getConnection();
    
    // Check if image_path column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM articles LIKE 'image_path'");
    if ($stmt->rowCount() == 0) {
        // Add image_path column
        $sql = "ALTER TABLE articles ADD COLUMN image_path VARCHAR(255)";
        $pdo->exec($sql);
        echo "Kolom 'image_path' berhasil ditambahkan ke tabel articles.<br>";
    } else {
        echo "Kolom 'image_path' sudah ada di tabel articles.<br>";
    }
    
    echo "Struktur tabel articles berhasil diperbarui.";
    
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>