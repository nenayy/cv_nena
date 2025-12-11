<?php
session_start();

// Simple admin authentication
function isAdmin() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function login($username, $password) {
    // Simple hardcoded credentials for demo - in a real application, use a database
    $valid_username = 'admin';
    $valid_password = 'password123'; // Change this in a real application!
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['admin_logged_in'] = true;
        return true;
    }
    return false;
}

function logout() {
    $_SESSION['admin_logged_in'] = false;
    unset($_SESSION['admin_logged_in']);
    session_destroy();
}

// Check if user is trying to log in
if (($_POST['action'] ?? '') === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (login($username, $password)) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

// If not logged in, show login form
if (!isAdmin()) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - CV Nena</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }
            .login-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                width: 100%;
                max-width: 400px;
            }
            .login-container h2 {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
                font-weight: 600;
            }
            .form-group {
                margin-bottom: 20px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: 500;
                color: #555;
            }
            .btn-login {
                width: 100%;
                padding: 10px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                font-weight: 500;
            }
            .btn-login:hover {
                background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
                transform: translateY(-2px);
            }
            .error {
                color: #dc3545;
                text-align: center;
                margin-bottom: 15px;
            }
            .back-link {
                display: block;
                text-align: center;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
            }
            .back-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h2><i class="bi bi-person-lock me-2"></i>Admin Login</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <label for="username"><i class="bi bi-person me-2"></i>Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="bi bi-lock me-2"></i>Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
            <a href="index.php" class="back-link"><i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Handle logout
if (($_GET['action'] ?? '') === 'logout') {
    logout();
    header('Location: admin.php');
    exit;
}

// Include articles functions
require_once 'articles.php';

// Handle form submissions
$message = '';

// Create new article
if (($_POST['action'] ?? '') === 'create' && isAdmin()) {
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = uploadImage($_FILES['image']);
        if (!$image_path) {
            $message = 'Gagal mengunggah gambar. Pastikan file adalah gambar valid (JPG, PNG, GIF) dengan ukuran maksimal 5MB.';
        }
    }
    
    if (!$message || strpos($message, 'Gagal mengunggah gambar') === false) {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $author = $_POST['author'] ?? '';
        if (createArticle($title, $content, $author, $image_path)) {
            $message = 'Artikel berhasil dibuat!';
        } else {
            $message = 'Gagal membuat artikel.';
        }
    }
}

// Update existing article
if (($_POST['action'] ?? '') === 'update' && isAdmin()) {
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = uploadImage($_FILES['image']);
        if (!$image_path) {
            $message = 'Gagal mengunggah gambar. Pastikan file adalah gambar valid (JPG, PNG, GIF) dengan ukuran maksimal 5MB.';
        }
    }
    
    if (!$message || strpos($message, 'Gagal mengunggah gambar') === false) {
        $id = $_POST['id'] ?? '';
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $author = $_POST['author'] ?? '';
        $status = $_POST['status'] ?? '';
        if (updateArticle($id, $title, $content, $author, $status, $image_path)) {
            $message = 'Artikel berhasil diperbarui!';
        } else {
            $message = 'Gagal memperbarui artikel.';
        }
    }
}

// Delete article
if (($_GET['action'] ?? '') === 'delete' && isAdmin()) {
    $id = $_GET['id'] ?? '';
    if (deleteArticle($id)) {
        $message = 'Artikel berhasil dihapus!';
    } else {
        $message = 'Gagal menghapus artikel.';
    }
}

// Publish article
if (($_GET['action'] ?? '') === 'publish' && isAdmin()) {
    $id = $_GET['id'] ?? '';
    if (publishArticle($id)) {
        $message = 'Artikel berhasil diterbitkan!';
    } else {
        $message = 'Gagal menerbitkan artikel.';
    }
}

// Save as draft
if (($_GET['action'] ?? '') === 'draft' && isAdmin()) {
    $id = $_GET['id'] ?? '';
    if (saveAsDraft($id)) {
        $message = 'Artikel disimpan sebagai draft!';
    } else {
        $message = 'Gagal menyimpan artikel sebagai draft.';
    }
}

// Get all articles
$all_articles = getAllArticles();
$draft_articles = getDraftArticles();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Artikel Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
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
        .article-card {
            transition: transform 0.3s;
            border-left: 4px solid #667eea;
        }
        .article-card:hover {
            transform: translateX(5px);
        }
        .status-draft {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85em;
        }
        .status-published {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85em;
        }
        .btn-custom {
            border-radius: 5px;
            padding: 5px 12px;
            font-size: 0.9em;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .edit-form {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            display: none;
        }
        
        .article-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .edit-image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 5px;
            object-fit: cover;
        }
        
        /* Pulse animation from style.css */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Background pattern untuk halaman admin setelah login */
        body {
            background-image: 
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23667eea' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-color: #f8f9fa;
        }
        
        /* Animasi untuk kartu-kartu artikel */
        .article-card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                    <h1 class="display-4 fw-bold white-text">Admin Panel - Artikel</h1>
                    <p class="lead">Kelola Artikel Anda</p>
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
                        <a class="nav-link" href="articles.php"><i class="bi bi-newspaper me-1"></i> Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i> Kontak</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link active" href="admin.php"><i class="bi bi-person-lock me-1"></i> Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="section-title mb-0">Manajemen Artikel</h2>
                            <a href="admin.php?action=logout" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                        </div>
                        
                        <?php if ($message): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Create Article Form -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Buat Artikel Baru</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="create">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title" class="form-label">Judul:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="author" class="form-label">Penulis:</label>
                                            <input type="text" class="form-control" id="author" name="author" value="Nena Fernanda" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Konten:</label>
                                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar Terkait:</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <div class="form-text">Pilih gambar JPG, PNG, atau GIF (maksimal 5MB)</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status:</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="draft">Draft</option>
                                            <option value="published">Published</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Buat Artikel
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Published Articles Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Artikel Diterbitkan (<?php echo count($all_articles); ?>)
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($all_articles)): ?>
                                    <div class="text-center py-3">
                                        <i class="bi bi-newspaper" style="font-size: 3rem; color: #667eea;"></i>
                                        <p class="mt-2">Belum ada artikel yang diterbitkan</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($all_articles as $article): ?>
                                        <div class="article-card card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                                                        <div class="article-meta mb-2">
                                                            <i class="bi bi-person text-primary me-1"></i>
                                                            <?php echo htmlspecialchars($article['author']); ?> | 
                                                            <i class="bi bi-calendar text-primary me-1"></i>
                                                            <?php echo date('d M Y', strtotime($article['created_at'])); ?> |
                                                            <span class="status-<?php echo $article['status']; ?>">
                                                                <i class="bi bi-circle-fill me-1"></i>
                                                                <?php echo ucfirst($article['status']); ?>
                                                            </span>
                                                        </div>
                                                        <?php if (isset($article['image_path']) && $article['image_path']): ?>
                                                        <div class="mb-2">
                                                            <img src="<?php echo $article['image_path']; ?>" alt="Gambar Artikel" class="article-image">
                                                        </div>
                                                        <?php endif; ?>
                                                        <p class="card-text">
                                                            <?php echo htmlspecialchars(substr($article['content'], 0, 150)); ?>
                                                            <?php if (strlen($article['content']) > 150): ?>...<?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <button class="btn btn-outline-primary btn-custom mb-1" onclick="toggleEdit(<?php echo $article['id']; ?>)">
                                                            <i class="bi bi-pencil me-1"></i>Edit
                                                        </button>
                                                        <a href="admin.php?action=delete&id=<?php echo $article['id']; ?>" 
                                                           class="btn btn-outline-danger btn-custom mb-1" 
                                                           onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                        </a>
                                                        <?php if ($article['status'] === 'published'): ?>
                                                            <a href="admin.php?action=draft&id=<?php echo $article['id']; ?>" 
                                                               class="btn btn-outline-warning btn-custom">
                                                                <i class="bi bi-x-circle me-1"></i>Unpublish
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Draft Articles Section -->
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">
                                    <i class="bi bi-file-earmark-text me-2"></i>
                                    Artikel Draft (<?php echo count($draft_articles); ?>)
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($draft_articles)): ?>
                                    <div class="text-center py-3">
                                        <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #667eea;"></i>
                                        <p class="mt-2">Tidak ada artikel draft</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($draft_articles as $article): ?>
                                        <div class="article-card card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                                                        <div class="article-meta mb-2">
                                                            <i class="bi bi-person text-primary me-1"></i>
                                                            <?php echo htmlspecialchars($article['author']); ?> | 
                                                            <i class="bi bi-calendar text-primary me-1"></i>
                                                            <?php echo date('d M Y', strtotime($article['created_at'])); ?> |
                                                            <span class="status-<?php echo $article['status']; ?>">
                                                                <i class="bi bi-circle-fill me-1"></i>
                                                                <?php echo ucfirst($article['status']); ?>
                                                            </span>
                                                        </div>
                                                        <?php if (isset($article['image_path']) && $article['image_path']): ?>
                                                        <div class="mb-2">
                                                            <img src="<?php echo $article['image_path']; ?>" alt="Gambar Artikel" class="article-image">
                                                        </div>
                                                        <?php endif; ?>
                                                        <p class="card-text">
                                                            <?php echo htmlspecialchars(substr($article['content'], 0, 150)); ?>
                                                            <?php if (strlen($article['content']) > 150): ?>...<?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <button class="btn btn-outline-primary btn-custom mb-1" onclick="toggleEdit(<?php echo $article['id']; ?>)">
                                                            <i class="bi bi-pencil me-1"></i>Edit
                                                        </button>
                                                        <a href="admin.php?action=publish&id=<?php echo $article['id']; ?>" 
                                                           class="btn btn-outline-success btn-custom mb-1">
                                                            <i class="bi bi-check-circle me-1"></i>Terbitkan
                                                        </a>
                                                        <a href="admin.php?action=delete&id=<?php echo $article['id']; ?>" 
                                                           class="btn btn-outline-danger btn-custom" 
                                                           onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                <!-- Edit Form -->
                                                <div id="edit-<?php echo $article['id']; ?>" class="edit-form">
                                                    <h6><i class="bi bi-pencil me-2"></i>Edit Artikel</h6>
                                                    <form method="post" class="mt-3" enctype="multipart/form-data">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_title_<?php echo $article['id']; ?>" class="form-label">Judul:</label>
                                                                <input type="text" class="form-control" id="edit_title_<?php echo $article['id']; ?>" 
                                                                       name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_author_<?php echo $article['id']; ?>" class="form-label">Penulis:</label>
                                                                <input type="text" class="form-control" id="edit_author_<?php echo $article['id']; ?>" 
                                                                       name="author" value="<?php echo htmlspecialchars($article['author']); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_content_<?php echo $article['id']; ?>" class="form-label">Konten:</label>
                                                            <textarea class="form-control" id="edit_content_<?php echo $article['id']; ?>" 
                                                                      name="content" rows="4" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                                                        </div>
                                                        <?php if (isset($article['image_path']) && $article['image_path']): ?>
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar Saat Ini:</label><br>
                                                            <img src="<?php echo $article['image_path']; ?>" alt="Gambar Artikel" style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Ganti Gambar:</label>
                                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                            <div class="form-text">Pilih gambar JPG, PNG, atau GIF (maksimal 5MB)</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_status_<?php echo $article['id']; ?>" class="form-label">Status:</label>
                                                            <select class="form-select" id="edit_status_<?php echo $article['id']; ?>" name="status">
                                                                <option value="draft" <?php echo $article['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                                                <option value="published" <?php echo $article['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-check-circle me-1"></i>Update Artikel
                                                        </button>
                                                        <button type="button" class="btn btn-secondary btn-sm ms-2" onclick="toggleEdit(<?php echo $article['id']; ?>)">
                                                            <i class="bi bi-x me-1"></i>Batal
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        

                        
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
            <p>&copy; 2025 Admin Panel - Nena Fernanda. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleEdit(articleId) {
            const editForm = document.getElementById('edit-' + articleId);
            if (editForm.style.display === 'block' || editForm.style.display === '') {
                editForm.style.display = 'none';
            } else {
                // Hide all other edit forms first
                document.querySelectorAll('.edit-form').forEach(function(form) {
                    form.style.display = 'none';
                });
                editForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>