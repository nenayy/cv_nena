<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
require_once 'articles.php';

echo "Mencoba mengambil artikel...\n";

$articles = getAllArticles();
echo "Jumlah artikel: " . count($articles) . "\n";

if (count($articles) > 0) {
    foreach ($articles as $article) {
        echo "ID: " . $article['id'] . "\n";
        echo "Judul: " . $article['title'] . "\n";
        echo "Status: " . $article['status'] . "\n";
        echo "---\n";
    }
} else {
    echo "Tidak ada artikel ditemukan\n";
}
?>