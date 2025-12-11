<?php
require_once 'config.php';

try {
    $pdo = getConnection();
    
    // Cek apakah tabel articles ada
    $result = $pdo->query("SHOW TABLES LIKE 'articles'");
    if($result->rowCount() == 0) {
        echo "Tabel 'articles' tidak ditemukan!\n";
    } else {
        echo "Tabel 'articles' ditemukan.\n";
        
        // Hitung jumlah artikel
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM articles");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Jumlah artikel dalam database: " . $result['count'] . "\n";
        
        // Ambil semua artikel
        $stmt = $pdo->query("SELECT * FROM articles");
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($articles as $article) {
            echo "ID: " . $article['id'] . ", Judul: " . $article['title'] . ", Status: " . $article['status'] . "\n";
        }
    }
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>