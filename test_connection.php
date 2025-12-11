<?php
// Database connection test
require_once 'config.php';

try {
    $pdo = getConnection();
    echo "<h2>Database Connection Test</h2>";
    echo "<p>Connection to database '" . DB_NAME . "' was successful!</p>";
    
    // Test query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM cv_data");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>Total CV data records: " . $result['count'] . "</p>";
    
    // Show sample data
    $stmt = $pdo->query("SELECT * FROM cv_data LIMIT 5");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Sample Data:</h3>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Section</th><th>Title</th><th>Content</th></tr></thead>";
    echo "<tbody>";
    foreach($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['section'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['content'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    
} catch(Exception $e) {
    echo "<h2>Database Connection Error</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>