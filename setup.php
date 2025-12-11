<?php
// Database setup script

require_once 'config.php';

echo "<h2>CV Application Setup (Database: dbcv_nena)</h2>";

try {
    $pdo = getConnection();
    echo "<p>✓ Database connection successful</p>";
    
    // Check if table exists
    $result = $pdo->query("SHOW TABLES LIKE 'cv_data'");
    if($result->rowCount() == 0) {
        echo "<p>Table 'cv_data' does not exist. Creating table...</p>";
        
        // Create the table
        $sql = "CREATE TABLE cv_data (
            id INT AUTO_INCREMENT PRIMARY KEY,
            section VARCHAR(50) NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            order_position INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);
        echo "<p>✓ Table 'cv_data' created successfully</p>";
        
        // Insert sample data
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
    } else {
        echo "<p>✓ Table 'cv_data' already exists</p>";
    }
    
    // Check data count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM cv_data");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✓ Total records in cv_data: " . $result['count'] . "</p>";
    
    echo "<h3>Setup Complete!</h3>";
    echo "<p>You can now access your CV application at <a href='index.php'>index.php</a></p>";
    echo "<p>Note: This application uses the 'dbcv_nena' database</p>";
    
} catch(Exception $e) {
    echo "<p>✗ Error: " . $e->getMessage() . "</p>";
}
?>