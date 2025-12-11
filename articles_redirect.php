<?php
// Redirect to the actual articles page, preserving query parameters
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    header('Location: articles_page.php?id=' . $id);
    exit;
} else {
    header('Location: articles_page.php');
    exit;
}
?>