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
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Événements Outdoor Secours</title>
</head>
<body class="bg-light">
    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="bg-primary text-white sidebar p-3 vh-100">
            <h2 class="text-center">Outdoor Secours</h2>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-white"><i class="bi bi-house-door-fill"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white"><i class="bi bi-person-lines-fill"></i> Mes événements</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white"><i class="bi bi-gear-fill"></i> Paramètres</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-primary">Événements Outdoor Secours</h1>
                <div>
                    <button class="btn btn-primary">Créer un événement</button>
                </div>
            </header>

            <!-- Content Section -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Modifications en attente</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-person-fill"></i> Manon Raggi <button class="btn btn-success btn-sm ms-2">Valider</button></li>
                                <li><i class="bi bi-person-fill"></i> Mme Nadège Desmeale <button class="btn btn-success btn-sm ms-2">Valider</button></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header text-white bg-primary">
                            <h5 class="card-title">Liste des événements</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($events)): ?>
                                <div class="row row-cols-1 row-cols-md-2 g-3">
                                    <?php foreach ($events as $event): ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="uploads/<?= htmlspecialchars($event['photo'] ?? 'default.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($event['name']) ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                                                    <p class="card-text text-muted"><?= htmlspecialchars($event['description']) ?></p>
                                                    <a href="view_event.php?id=<?= $event['id'] ?>" class="btn btn-outline-primary">Voir les détails</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>Aucun événement trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
