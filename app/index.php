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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Événements Outdoor Secours</title>
    <style>
        .event-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
    </style>
</head>
<body class="bg-light">
    <header class="bg-primary text-white text-center py-3">
        <h1>Événements Outdoor Secours</h1>
    </header>

    <main class="container my-5">
        <?php if (!empty($events)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($events as $event): ?>
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($event['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($event['description']) ?></p>
                                <ul class="list-unstyled">
                                    <li><strong>Date :</strong> <?= htmlspecialchars($event['date']) ?></li>
                                    <li><strong>Lieu :</strong> <?= htmlspecialchars($event['location']) ?></li>
                                </ul>
                                <a href="view_event.php?id=<?= $event['id'] ?>" class="btn btn-primary mt-3">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Aucun événement trouvé.
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-primary text-white text-center py-3">
        &copy; 2024 Outdoor Secours. Tous droits réservés.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
