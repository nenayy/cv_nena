<?php
require_once 'articles.php';

// Get all published articles
$articles = getAllArticles();

// Get a specific article if ID is provided
$article = null;
if (isset($_GET['id'])) {
    $article = getArticleById($_GET['id']);
    
    // If article not found or not published, redirect
    if (!$article || $article['status'] !== 'published') {
        header('Location: articles.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - CV Nena</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .article-list {
            margin-top: 20px;
        }
        .article-item {
            padding: 15px;
            border: 1px solid #eee;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .article-title {
            font-size: 1.4em;
            margin: 0 0 10px 0;
            color: #333;
        }
        .article-title a {
            text-decoration: none;
            color: #007bff;
        }
        .article-title a:hover {
            text-decoration: underline;
        }
        .article-meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .article-excerpt {
            line-height: 1.6;
            color: #555;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .article-content {
            line-height: 1.6;
            color: #333;
        }
        .no-articles {
            text-align: center;
            color: #666;
            padding: 40px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Articles</h1>
        
        <?php if ($article): ?>
            <!-- Single Article View -->
            <div class="single-article">
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <div class="article-meta">
                    By <?php echo htmlspecialchars($article['author']); ?> | 
                    Published on <?php echo date('F j, Y', strtotime($article['created_at'])); ?>
                </div>
                <div class="article-content">
                    <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                </div>
                <p><a href="articles.php" class="back-link">&larr; Back to all articles</a></p>
            </div>
        <?php else: ?>
            <!-- Articles List View -->
            <?php if (empty($articles)): ?>
                <div class="no-articles">
                    <p>No articles available at the moment.</p>
                </div>
            <?php else: ?>
                <div class="article-list">
                    <?php foreach ($articles as $articleItem): ?>
                        <div class="article-item">
                            <h3 class="article-title">
                                <a href="articles.php?id=<?php echo $articleItem['id']; ?>">
                                    <?php echo htmlspecialchars($articleItem['title']); ?>
                                </a>
                            </h3>
                            <div class="article-meta">
                                By <?php echo htmlspecialchars($articleItem['author']); ?> | 
                                Published on <?php echo date('F j, Y', strtotime($articleItem['created_at'])); ?>
                            </div>
                            <div class="article-excerpt">
                                <?php echo nl2br(htmlspecialchars(substr($articleItem['content'], 0, 200))); ?>
                                <?php if (strlen($articleItem['content']) > 200): ?>...<?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>