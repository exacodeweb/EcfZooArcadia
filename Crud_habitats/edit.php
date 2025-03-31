<?php
// habitats/edit.php
//include '../config/database.php';
require_once '../config/config_unv.php';

// Récupération de l'ID depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "ID invalide.";
    exit;
}

// Récupérer les données actuelles de l'habitat
$stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
$stmt->execute([$id]);
$habitat = $stmt->fetch();
if (!$habitat) {
    echo "Habitat non trouvé.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    
    // Traitement des nouvelles images uploadées
    $newImagesArray = [];
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            if (!empty($name)) {
                $tmpName = $_FILES['images']['tmp_name'][$key];
                $destination = '../assets/uploads/' . basename($name);
                if (move_uploaded_file($tmpName, $destination)) {
                    $newImagesArray[] = basename($name);
                }
            }
        }
    }
    
    // Fusionner les images existantes avec les nouvelles (optionnel)
    $existingImages = json_decode($habitat['images'], true);
    if (!is_array($existingImages)) {
        $existingImages = [];
    }
    $finalImagesArray = array_merge($existingImages, $newImagesArray);
    $imagesJson = json_encode($finalImagesArray);

    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE habitats SET nom = ?, images = ?, description = ? WHERE id = ?");
    if ($stmt->execute([$nom, $imagesJson, $description, $id])) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Habitat</title>
</head>
<body>
    <h1>Modifier un Habitat</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($habitat['nom']) ?>" required>
        <br><br>
        <label>Ajouter des images :</label>
        <input type="file" name="images[]" multiple accept="image/*">
        <br><br>
        <label>Description :</label>
        <textarea name="description" required><?= htmlspecialchars($habitat['description']) ?></textarea>
        <br><br>
        <button type="submit">Modifier</button>
    </form>
    <h2>Images existantes :</h2>
    <?php
    $existingImages = json_decode($habitat['images'], true);
    if (is_array($existingImages)) {
        foreach ($existingImages as $img) {
            if (!empty($img)) {
                echo '<img src="../assets/uploads/' . htmlspecialchars($img) . '" width="100" alt="Image">';
            }
        }
    }
    ?>
</body>
</html>