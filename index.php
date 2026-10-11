<?php
require_once 'kdb.php';
$pdo = Database::getInstance()->getConnection();

$sql = "SELECT d.id, d.judul, g.nama_genre, s.nama_studio, d.rating, d.jumlah_episode 
        FROM daftar_koleksi d 
        JOIN genre g ON d.genre_id = g.id 
        JOIN studio s ON d.studio_id = s.id 
        ORDER BY d.judul ASC";
$stmt = $pdo->query($sql);
$koleksi = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koleksi Anime & Light Novel</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Daftar Koleksi Anime & Light Novel</h2>
    
    <?php if (isset($_GET['msg'])): ?>
        <p style="color: #03dac6; font-weight: bold;">[Info] Aksi berhasil: <?= htmlspecialchars($_GET['msg']) ?></p>
    <?php endif; ?>

    <a href="create.php"><button style="margin-bottom: 10px;">+ Tambah Koleksi Baru</button></a>
    
    <table>
        <tr>
            <th>Judul</th>
            <th>Genre</th>
            <th>Studio/Publisher</th>
            <th>Rating</th>
            <th>Total Episode</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($koleksi as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['judul']) ?></td>
            <td><?= htmlspecialchars($item['nama_genre']) ?></td>
            <td><?= htmlspecialchars($item['nama_studio']) ?></td>
            <td>⭐ <?= htmlspecialchars($item['rating']) ?></td>
            <td><?= htmlspecialchars($item['jumlah_episode']) ?> Eps</td>
            <td>
                <a href="edit.php?id=<?= $item['id'] ?>">Edit</a> | 
                <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Hapus judul ini dari koleksi?')">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" style="color: red; padding: 5px 10px; font-size: 0.8em;">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>