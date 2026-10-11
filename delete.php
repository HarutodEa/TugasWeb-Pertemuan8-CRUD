<?php
require_once 'kdb.php';
$pdo = Database::getInstance()->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    
    $stmt = $pdo->prepare("DELETE FROM daftar_koleksi WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: index.php?msg=dihapus');
    exit;
}
?>