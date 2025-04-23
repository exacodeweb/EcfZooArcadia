<?php
// animaux/supprimer.php
//require_once '../includes/config_unv.php'; /*Test*/
//require_once '../config/database.php';
//require_once '../config/config_unv.php'; /*Test*/

require '../service_veterinaire/db.php'; // Inclusion du fichier de connexion


$errors = [];

// Vérifier si l'ID de l'animal est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $animalId = intval($_GET['id']);

    // Vérifier si l'animal existe
    $sql = "SELECT * FROM animaux WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $animalId]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        // Suppression de l'animal
        $sql = "DELETE FROM animaux WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([':id' => $animalId])) {
            // Redirection après succès
            header("Location: index.php");
            exit;
        } else {
            $errors['general'] = "Une erreur est survenue lors de la suppression.";
        }
    } else {
        $errors['general'] = "Animal non trouvé.";
    }
} else {
    $errors['general'] = "ID invalide.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression d'un Animal</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Suppression d'un Animal</h1>
    <?php if (!empty($errors['general'])): ?>
        <p class="error"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>
    <a href="index.php">Retour à la liste des animaux</a>
</body>
</html>
