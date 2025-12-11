<?php
// Database setup script with corrected table structure

require_once 'config.php';

echo "<h2>CV Application Setup - Corrected (Database: dbcv_nena)</h2>";

try {
    $pdo = getConnection();
    echo "<p>✓ Database connection successful</p>";
    
    // Drop the table if it exists (to fix column issues)
    $pdo->exec("DROP TABLE IF EXISTS cv_data");
    echo "<p>Dropped old cv_data table (if it existed)</p>";
    
    // Create the table with correct structure
    $sql = "CREATE TABLE cv_data (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(50) NOT NULL,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        order_position INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "<p>✓ Table 'cv_data' created successfully with correct structure</p>";
    
    // Insert sample data for personal information
    $sql = "INSERT INTO cv_data (section, title, content, order_position) VALUES
        ('personal', 'Nama', 'Nena Fernanda', 1),
        ('personal', 'Tempat, Tanggal Lahir', 'Banjarnegara, 09-02-2009', 2),
        ('personal', 'Alamat', 'Karangkemiri RT 01/ RW 03, Wanadadi, Banjarnegara', 3),
        ('personal', 'Jenis Kelamin', 'Perempuan', 4),
        ('personal', 'Agama', 'Islam', 5),
        ('personal', 'No. HP', '088670054976', 6),
        ('personal', 'Email', 'nenaf2700@gmail.com', 7),
        ('education', '2015 – 2021', 'SD Negeri 2 Karangkemiri', 1),
        ('education', '2021 – 2024', 'SMP Negeri 1 Wanadadi', 2),
        ('education', '2024 – Sekarang', 'SMK Negeri 1 Bawang', 3),
        ('skills', 'Coding & Pemrograman', 'HTML, CSS, JavaScript (dasar pembuatan website)', 1),
        ('skills', 'Coding & Pemrograman', 'PHP & MySQL (membuat aplikasi berbasis web dan database)', 2),
        ('skills', 'Coding & Pemrograman', 'Python (dasar pemrograman)', 3),
        ('skills', 'Desain Web', 'Bootstrap / Tailwind CSS', 4),
        ('skills', 'Database Management', 'MySQL', 5),
        ('skills', 'Office Tools', 'Microsoft Word, Excel, PowerPoint', 6),
        ('projects', 'Pengalaman / Proyek', 'Membuat website sederhana untuk pemesanan makanan online', 1),
        ('projects', 'Pengalaman / Proyek', 'Membuat sistem login & register berbasis PHP dan MySQL', 2),
        ('projects', 'Pengalaman / Proyek', 'Desain landing page sekolah dengan HTML & CSS', 3)";
    
    $pdo->exec($sql);
    echo "<p>✓ Sample data inserted successfully</p>";
    
    // Check data count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM cv_data");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✓ Total records in cv_data: " . $result['count'] . "</p>";
    
    // Show sample data to verify
    $stmt = $pdo->query("SELECT * FROM cv_data WHERE section = 'personal'");
    $personalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Personal Data Verification:</h3>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Section</th><th>Title</th><th>Content</th></tr></thead>";
    echo "<tbody>";
    foreach($personalData as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['section'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['content'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    
    echo "<h3>Setup Complete!</h3>";
    echo "<p>You can now access your CV application at <a href='index.php'>index.php</a></p>";
    
} catch(Exception $e) {
    echo "<p>✗ Error: " . $e->getMessage() . "</p>";
}
?>