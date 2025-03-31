<?php
// habitats/add.php
//include '../config/database.php';
require_once '../config/config_unv.php'; // a testé

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    
    // Traitement des images uploadées
    $imagesArray = [];
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            if (!empty($name)) {
                $tmpName = $_FILES['images']['tmp_name'][$key];
                // Assurez-vous que le dossier ../assets/uploads/ existe et est accessible en écriture
                $destination = '../assets/images/' . basename($name); // choisir la destination ../assets/images/ ou ../assets/uploads/
                if (move_uploaded_file($tmpName, $destination)) {
                    $imagesArray[] = basename($name);
                }
            }
        }
    }
    $imagesJson = json_encode($imagesArray);

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO habitats (nom, images, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $imagesJson, $description])) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Habitat</title>
</head>
<body>
    <h1>Ajouter un Habitat</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nom de l'habitat :</label>
        <input type="text" name="nom" required>
        <br><br>
        <label>Images :</label>
        <input type="file" name="images[]" multiple accept="image/*">
        <br><br>
        <label>Description :</label>
        <textarea name="description" required></textarea>
        <br><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>