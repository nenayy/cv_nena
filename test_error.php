<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Coba include file untuk melihat error
require_once 'articles.php';
echo "File articles.php berhasil di-include tanpa error<br>";

session_start();

// Cek jika user mencoba login
$action = $_POST['action'] ?? '';
if ($action === 'login') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    echo "Action: login<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";
} else {
    echo "No login action detected<br>";
}

echo "Test selesai";
?>