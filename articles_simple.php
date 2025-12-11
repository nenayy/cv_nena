<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html><body>";
echo "<h1>Debug: Masuk ke file articles_page.php</h1>\n";

require_once 'config.php';

try {
    $pdo = getConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h2>Koneksi database berhasil</h2>\n";
    
    // Ambil artikel langsung
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE status = ? ORDER BY created_at DESC");
    $stmt->execute(['published']);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Jumlah artikel: " . count($articles) . "</h2>\n";
    
    foreach($articles as $article) {
        echo "<h3>" . htmlspecialchars($article['title']) . "</h3>\n";
        echo "<p>" . htmlspecialchars(substr($article['content'], 0, 100)) . "...</p>\n";
        echo "<hr>\n";
    }
    
} catch(Exception $e) {
    echo "<h2>Error: " . $e->getMessage() . "</h2>\n";
}

echo "</body></html>";
?>