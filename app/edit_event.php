<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $photo = $_FILES['photo']['name'];

    if ($photo) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file);

        $stmt = $pdo->prepare("UPDATE events SET name = ?, description = ?, date = ?, location = ?, photo = ? WHERE id = ?");
        $stmt->execute([$name, $description, $date, $location, $photo, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE events SET name = ?, description = ?, date = ?, location = ? WHERE id = ?");
        $stmt->execute([$name, $description, $date, $location, $id]);
    }
    echo "Événement mis à jour avec succès !";
}

// Récupération de l'événement
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un événement</title>
</head>
<body>
    <h1>Modifier un événement</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $event['id'] ?>">
        <label>Nom :</label>
        <input type="text" name="name" value="<?= $event['name'] ?>" required><br>

        <label>Description :</label>
        <textarea name="description" required><?= $event['description'] ?></textarea><br>

        <label>Date :</label>
        <input type="date" name="date" value="<?= $event['date'] ?>" required><br>

        <label>Lieu :</label>
        <input type="text" name="location" value="<?= $event['location'] ?>" required><br>

        <label>Photo :</label>
        <input type="file" name="photo"><br>
        <img src="uploads/<?= $event['photo'] ?>" alt="Photo actuelle" width="200"><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
