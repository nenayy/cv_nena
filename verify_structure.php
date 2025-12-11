<?php
require_once 'config.php';

try {
    $pdo = getConnection();
    echo "<h2>Database Structure Verification</h2>";
    
    // Show table structure
    $stmt = $pdo->query("DESCRIBE cv_data");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Table Structure for cv_data:</h3>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr></thead>";
    echo "<tbody>";
    foreach($columns as $col) {
        echo "<tr>";
        echo "<td>" . $col['Field'] . "</td>";
        echo "<td>" . $col['Type'] . "</td>";
        echo "<td>" . $col['Null'] . "</td>";
        echo "<td>" . $col['Key'] . "</td>";
        echo "<td>" . $col['Default'] . "</td>";
        echo "<td>" . $col['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    
    // Show sample of data
    echo "<h3>Sample Data:</h3>";
    $stmt = $pdo->query("SELECT * FROM cv_data LIMIT 5");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Section</th><th>Title</th><th>Content</th><th>Order</th></tr></thead>";
    echo "<tbody>";
    foreach($data as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['section'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['content'] . "</td>";
        echo "<td>" . $row['order_position'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    
    // Test the query that was failing
    echo "<h3>Testing Query: SELECT * FROM cv_data WHERE section = 'personal'</h3>";
    try {
        $stmt = $pdo->prepare("SELECT * FROM cv_data WHERE section = ?");
        $stmt->execute(['personal']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) > 0) {
            echo "<p>✓ Query successful! Found " . count($result) . " personal data records.</p>";
        } else {
            echo "<p>✓ Query successful but no personal data records found.</p>";
        }
    } catch(Exception $e) {
        echo "<p>✗ Query failed: " . $e->getMessage() . "</p>";
    }
    
} catch(Exception $e) {
    echo "<h2>Database Connection Error</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>