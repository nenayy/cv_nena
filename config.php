<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dbcv_nena');

// Connect to database
function getConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to get CV data by section
function getCvDataBySection($section) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM cv_data WHERE section = ? ORDER BY order_position ASC");
    $stmt->execute([$section]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>