<?php
include 'includes/db.php';

try {
    // Récupération des événements depuis la base de données
    $stmt = $pdo->query("SELECT * FROM events ORDER BY date ASC");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Événements Outdoor Secours</h1>
    <div class="events-container">
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <img src="uploads/<?= htmlspecialchars($event['photo']) ?>" alt="<?= htmlspecialchars($event['name']) ?>">
                <h2><?= htmlspecialchars($event['name']) ?></h2>
                <p><?= htmlspecialchars($event['description']) ?></p>
                <p>Date : <?= htmlspecialchars($event['date']) ?></p>
                <p>Lieu : <?= htmlspecialchars($event['location']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
