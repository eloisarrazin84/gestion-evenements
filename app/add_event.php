<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $photo = $_FILES['photo']['name'];

    // Upload de l'image
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
        $stmt = $pdo->prepare("INSERT INTO events (name, description, date, location, photo) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $date, $location, $photo]);
        echo "Événement ajouté avec succès !";
    } else {
        echo "Erreur lors de l'upload de l'image.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
</head>
<body>
    <h1>Ajouter un événement</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="name" required><br>

        <label>Description :</label>
        <textarea name="description" required></textarea><br>

        <label>Date :</label>
        <input type="date" name="date" required><br>

        <label>Lieu :</label>
        <input type="text" name="location" required><br>

        <label>Photo :</label>
        <input type="file" name="photo" required><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
