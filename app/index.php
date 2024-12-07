<?php
include 'includes/db.php';

try {
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Événements Outdoor Secours</title>
</head>
<body>
    <header class="header">
        <h1>Événements Outdoor Secours</h1>
    </header>
    <main class="main-container">
        <?php if (!empty($events)): ?>
            <div class="event-grid">
                <?php foreach ($events as $event): ?>
                    <div class="event-card">
                        <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($event['name']) ?>" class="event-image">
                        <div class="event-content">
                            <h2><?= htmlspecialchars($event['name']) ?></h2>
                            <p class="event-description"><?= htmlspecialchars($event['description']) ?></p>
                            <p><strong>Date :</strong> <?= htmlspecialchars($event['date']) ?></p>
                            <p><strong>Lieu :</strong> <?= htmlspecialchars($event['location']) ?></p>
                            <a href="view_event.php?id=<?= $event['id'] ?>" class="event-button">Voir les détails</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Outdoor Secours. Tous droits réservés.</p>
    </footer>
</body>
</html>
