<?php
require_once 'config.php';

// Function to get personal data
function getPersonalData() {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM cv_data WHERE section = 'personal' ORDER BY order_position ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$personalData = getPersonalData();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Nena Fernanda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_articles.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .contact-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .contact-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
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
                        <a class="nav-link" href="articles_redirect.php"><i class="bi bi-newspaper me-1"></i> Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact.php"><i class="bi bi-envelope me-1"></i> Kontak</a>
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
                <div class="col-lg-8">
                    <div class="card p-4">
                        <h2 class="section-title text-center">Informasi Kontak</h2>
                        
                        <div class="row">
                            <?php foreach($personalData as $item): ?>
                                <?php if(strpos($item['title'], 'Email') !== false || strpos($item['title'], 'HP') !== false): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="contact-item">
                                            <div class="contact-icon">
                                                <?php if(strpos($item['title'], 'Email') !== false): ?>
                                                    <i class="bi bi-envelope"></i>
                                                <?php elseif(strpos($item['title'], 'HP') !== false): ?>
                                                    <i class="bi bi-telephone"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h5><?php echo htmlspecialchars($item['title']); ?></h5>
                                                <p class="mb-0"><?php echo htmlspecialchars($item['content']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- Additional contact methods -->
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <h5>Alamat</h5>
                                        <p class="mb-0">Karangkemiri RT 01/ RW 03, Wanadadi, Banjarnegara</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-chat-dots"></i>
                                    </div>
                                    <div>
                                        <h5>Pesan</h5>
                                        <p class="mb-0">Silakan hubungi melalui email atau telepon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact form -->
                        <div class="mt-5">
                            <h3 class="mb-4">Kirim Pesan</h3>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="message" rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-glow">Kirim Pesan</button>
                                </div>
                            </form>
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
            <p>&copy; 2025 Curriculum Vitae - Nena Fernanda. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Visual Effects -->
    <script src="effects.js"></script>
    
    <script>
        // Handle contact form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih atas pesan Anda! Dalam aplikasi sebenarnya, pesan akan dikirim ke email saya.');
            this.reset();
        });
    </script>
</body>
</html>