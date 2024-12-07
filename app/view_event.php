<?php
include 'includes/db.php';

if (!isset($_GET['id'])) {
    die("ID de l'événement manquant.");
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    die("Événement non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['name']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($event['name']) ?></h1>
    <div class="event-detail">
        <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($event['name']) ?>" style="width:100%; height:auto;">
        <p><strong>Description :</strong> <?= htmlspecialchars($event['description']) ?></p>
        <p><strong>Date :</strong> <?= htmlspecialchars($event['date']) ?></p>
        <p><strong>Lieu :</strong> <?= htmlspecialchars($event['location']) ?></p>
    </div>
    <a href="index.php" class="back-button">Retour</a>
</body>
</html>
