<?php
require_once 'kdb.php';
$pdo = Database::getInstance()->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $genreId = (int) $_POST['genre_id'];
    $studioId = (int) $_POST['studio_id'];
    $rating = (float) $_POST['rating'];
    $jumlahEps = (int) $_POST['jumlah_episode'];

    $sql = "INSERT INTO daftar_koleksi (judul, genre_id, studio_id, rating, jumlah_episode) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$judul, $genreId, $studioId, $rating, $jumlahEps]);

    header('Location: index.php?msg=ditambahkan');
    exit;
}

$genres = $pdo->query("SELECT * FROM genre ORDER BY nama_genre")->fetchAll();
$studios = $pdo->query("SELECT * FROM studio ORDER BY nama_studio")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Koleksi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Koleksi Baru</h2>
    <form method="POST" action="">
        <p>
            <label>Judul Seri:</label>
            <input type="text" name="judul" required>
        </p>
        <p>
            <label>Genre:</label>
            <select name="genre_id" required>
                <?php foreach ($genres as $g): ?>
                    <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['nama_genre']) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Studio/Publisher:</label>
            <select name="studio_id" required>
                <?php foreach ($studios as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama_studio']) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Rating (Misal: 8.5):</label>
            <input type="number" step="0.1" name="rating" required>
        </p>
        <p>
            <label>Total Episode/Volume:</label>
            <input type="number" name="jumlah_episode" required>
        </p>
        <button type="submit">Simpan Koleksi</button> 
        <a href="index.php" style="margin-left: 15px;">Batal</a>
    </form>
</body>
</html>