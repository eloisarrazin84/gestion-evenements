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
        body {
            background-color: #f9f9f9;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 4px solid #0056b3;
        }
        .event-card img {
            height: 180px;
            object-fit: cover;
        }
        .event-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .event-card .card-body {
            padding: 15px;
        }
        .footer {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1>Événements Outdoor Secours</h1>
    </header>

    <!-- Main content -->
    <main class="container py-5">
        <?php if (!empty($events)): ?>
            <div class="row g-4">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-4">
                        <div class="card event-card">
                            <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($event['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                                <a href="view_event.php?id=<?= $event['id'] ?>" class="btn btn-outline-primary btn-sm">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Aucun événement disponible.
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2024 Outdoor Secours. Tous droits réservés.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
