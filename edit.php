<?php
require_once 'kdb.php';
$pdo = Database::getInstance()->getConnection();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $genreId = (int) $_POST['genre_id'];
    $studioId = (int) $_POST['studio_id'];
    $rating = (float) $_POST['rating'];
    $jumlahEps = (int) $_POST['jumlah_episode'];
    $idPost = (int) $_POST['id'];

    $sql = "UPDATE daftar_koleksi SET judul = ?, genre_id = ?, studio_id = ?, rating = ?, jumlah_episode = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$judul, $genreId, $studioId, $rating, $jumlahEps, $idPost]);

    header('Location: index.php?msg=diperbarui');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM daftar_koleksi WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    die("Data tidak ditemukan.");
}

$genres = $pdo->query("SELECT * FROM genre ORDER BY nama_genre")->fetchAll();
$studios = $pdo->query("SELECT * FROM studio ORDER BY nama_studio")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Koleksi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Edit Data Koleksi</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <p>
            <label>Judul Seri:</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($item['judul']) ?>" required>
        </p>
        <p>
            <label>Genre:</label>
            <select name="genre_id" required>
                <?php foreach ($genres as $g): ?>
                    <option value="<?= $g['id'] ?>" <?= $item['genre_id'] == $g['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g['nama_genre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Studio/Publisher:</label>
            <select name="studio_id" required>
                <?php foreach ($studios as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $item['studio_id'] == $s['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['nama_studio']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label>Rating:</label>
            <input type="number" step="0.1" name="rating" value="<?= htmlspecialchars($item['rating']) ?>" required>
        </p>
        <p>
            <label>Total Episode/Volume:</label>
            <input type="number" name="jumlah_episode" value="<?= htmlspecialchars($item['jumlah_episode']) ?>" required>
        </p>
        <button type="submit">Update Data</button> 
        <a href="index.php" style="margin-left: 15px;">Batal</a>
    </form>
</body>
</html>