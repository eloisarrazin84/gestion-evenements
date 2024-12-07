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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= htmlspecialchars($event['name']) ?></title>
</head>
<body class="bg-light">
    <header class="bg-primary text-white text-center py-3">
        <h1>Détails de l'événement</h1>
    </header>

    <main class="container my-5">
        <div class="card shadow-sm">
            <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($event['name']) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                <p class="card-text text-muted"><?= htmlspecialchars($event['description']) ?></p>
                <ul class="list-unstyled">
                    <li><strong>Date :</strong> <?= htmlspecialchars($event['date']) ?></li>
                    <li><strong>Lieu :</strong> <?= htmlspecialchars($event['location']) ?></li>
                </ul>
                <a href="index.php" class="btn btn-secondary mt-3">Retour</a>
            </div>
        </div>
    </main>

    <footer class="bg-primary text-white text-center py-3">
        &copy; 2024 Outdoor Secours. Tous droits réservés.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
