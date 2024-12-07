<?php
include 'includes/db.php';

try {
    // Récupération des événements depuis la base de données
    $stmt = $pdo->query("SELECT * FROM events ORDER BY date ASC");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements Outdoor Secours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .event-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Événements Outdoor Secours</h1>
    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <h2><?= htmlspecialchars($event['name']) ?></h2>
                <p><strong>Description :</strong> <?= htmlspecialchars($event['description']) ?></p>
                <p><strong>Date :</strong> <?= htmlspecialchars($event['date']) ?></p>
                <p><strong>Lieu :</strong> <?= htmlspecialchars($event['location']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun événement trouvé.</p>
    <?php endif; ?>
</body>
</html>
