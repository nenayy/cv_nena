<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Nena Fernanda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23667eea' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            position: relative;
        }
        
        .header-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .article-card {
            transition: all 0.5s ease;
            border-left: 4px solid #667eea;
            opacity: 0;
            transform: scale(0.8);
            animation: popIn 0.6s forwards;
        }
        
        .article-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }
        
        .article-content {
            line-height: 1.8;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 0 2px;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            background-color: rgba(102, 126, 234, 0.1);
        }
        
        .article-meta {
            color: #666;
            font-size: 0.85em;
        }
        
        .article-excerpt {
            line-height: 1.6;
        }
        
        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(20px);
            }
            70% {
                transform: scale(1.02) translateY(-5px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        .article-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .single-article {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header-bg py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start">
                    <img src="img/nena.jpg" alt="Nena Fernanda" class="profile-img rounded-circle pulse">
                </div>
                <div class="col-md-8 mt-4 mt-md-0">
                    <h1 class="display-4 fw-bold white-text">Nena Fernanda</h1>
                    <p class="lead">Web Developer & Programmer</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="personal.php"><i class="bi bi-person me-1"></i> Data Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="education.php"><i class="bi bi-mortarboard me-1"></i> Pendidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="skills.php"><i class="bi bi-tools me-1"></i> Keahlian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="projects.php"><i class="bi bi-briefcase me-1"></i> Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="articles_redirect.php"><i class="bi bi-newspaper me-1"></i> Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i> Kontak</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="admin.php"><i class="bi bi-person-lock me-1"></i> Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card p-4 card-float">
                        <h2 class="section-title text-center">Artikel Terbaru</h2>
                        
                        <?php if ($article): ?>
                            <!-- Single Article View -->
                            <div class="single-article">
                                <?php if (isset($article['image_path']) && $article['image_path']): ?>
                                <div class="text-center mb-4">
                                    <img src="<?php echo $article['image_path']; ?>" alt="Gambar Artikel" class="img-fluid rounded" style="height: 300px; object-fit: cover; width: 100%;">
                                </div>
                                <?php endif; ?>
                                <h3 class="fw-bold text-primary"><?php echo htmlspecialchars($article['title']); ?></h3>
                                <div class="article-meta mb-3">
                                    <i class="bi bi-person text-primary me-2"></i> 
                                    <?php echo htmlspecialchars($article['author']); ?> | 
                                    <i class="bi bi-calendar text-primary me-2"></i>
                                    <?php echo date('d M Y', strtotime($article['created_at'])); ?>
                                </div>
                                <div class="article-content">
                                    <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="articles_redirect.php" class="btn btn-primary btn-glow"><i class="bi bi-arrow-left me-2"></i>Kembali ke Artikel</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Articles List View -->
                            <?php if (empty($articles)): ?>
                                <div class="text-center py-5">
                                    <i class="bi bi-newspaper" style="font-size: 3rem; color: #667eea;"></i>
                                    <h4 class="mt-3">Belum Ada Artikel</h4>
                                    <p class="text-muted">Artikel akan segera ditambahkan. Silakan kembali nanti.</p>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <?php $counter = 0; ?>
                                    <?php foreach ($articles as $articleItem): ?>
                                        <?php $counter++; ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card article-card h-100 card-float">
                                                <?php if (isset($articleItem['image_path']) && $articleItem['image_path']): ?>
                                                <img src="<?php echo $articleItem['image_path']; ?>" alt="Gambar Artikel" class="card-img-top article-image">
                                                <?php endif; ?>
                                                <div class="card-body d-flex flex-column">
                                                    <h6 class="card-title">
                                                        <i class="bi bi-newspaper text-primary me-1"></i>
                                                        <a href="articles_redirect.php?id=<?php echo $articleItem['id']; ?>" class="text-decoration-none text-dark">
                                                            <?php echo htmlspecialchars(substr($articleItem['title'], 0, 40)); ?><?php if (strlen($articleItem['title']) > 40) echo '...'; ?>
                                                        </a>
                                                    </h6>
                                                    <p class="article-meta small mb-1">
                                                        <i class="bi bi-person text-primary me-1"></i>
                                                        <?php echo htmlspecialchars($articleItem['author']); ?>
                                                    </p>
                                                    <p class="article-meta small mb-2">
                                                        <i class="bi bi-calendar text-primary me-1"></i>
                                                        <?php echo date('d M Y', strtotime($articleItem['created_at'])); ?>
                                                    </p>
                                                    <p class="article-excerpt small flex-grow-1">
                                                        <?php echo htmlspecialchars(substr($articleItem['content'], 0, 100)); ?>
                                                        <?php if (strlen($articleItem['content']) > 100): ?>...<?php endif; ?>
                                                    </p>
                                                    <a href="articles_redirect.php?id=<?php echo $articleItem['id']; ?>" class="btn btn-outline-primary btn-sm mt-auto">
                                                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <div class="text-center mt-4">
                            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>&copy; 2025 Curriculum Vitae - Nena Fernanda. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Visual Effects -->
    <script src="effects.js"></script>
</body>
</html>