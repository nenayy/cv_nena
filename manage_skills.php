<?php
// Include configuration
require_once 'config.php';

// Define function if not exists
if (!function_exists('getCvDataBySection')) {
    function getCvDataBySection($section) {
        $pdo = getConnection();
        $stmt = $pdo->prepare("SELECT * FROM cv_data WHERE section = ? ORDER BY order_position ASC");
        $stmt->execute([$section]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$pdo = getConnection();

// Check if form is submitted for deletion
if (isset($_POST['delete_id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM cv_data WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $message = "Data berhasil dihapus!";
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get all skills data
$skillsData = getCvDataBySection('skills');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Skills - Nena Fernanda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Skills Data</h2>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Section</th>
                    <th>Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($skillsData as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo htmlspecialchars($item['content']); ?></td>
                        <td><?php echo htmlspecialchars($item['section']); ?></td>
                        <td><?php echo $item['order_position']; ?></td>
                        <td>
                            <?php if (stripos($item['content'], 'python') !== false): ?>
                                <form method="post" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini: <?php echo addslashes(htmlspecialchars($item['content'])); ?>?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Tidak bisa dihapus</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <a href="skills.php" class="btn btn-primary">Kembali ke Halaman Keahlian</a>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>