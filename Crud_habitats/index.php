<?php
// habitats/index.php
include '../config/database.php';

// Récupération de tous les habitats
$stmt = $pdo->prepare("SELECT * FROM habitats");
$stmt->execute();
$habitats = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr"> 
<head>
    <meta charset="UTF-8">
    <title>Liste des Habitats</title>
    <style>
      table { border-collapse: collapse; width: 100%; }
      th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
      th { background-color: #f2f2f2; }
      img { max-width: 100px; }
    </style>
</head>
<body>
    <h1>Liste des Habitats</h1>
    <a href="add.php">Ajouter un habitat</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Images</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($habitats as $habitat): ?>
            <tr>
                <td><?= htmlspecialchars($habitat['id']) ?></td>
                <td><?= htmlspecialchars($habitat['nom']) ?></td>
                <td>
                    <?php
                    $images = json_decode($habitat['images'], true);
                    if (is_array($images)) {
                        foreach ($images as $img) {
                            if (!empty($img)) {
                                echo '<img src="../assets/images/' . htmlspecialchars($img) . '" alt="Image">';// choisir la destination ../assets/images/ ou ../assets/uploads/
                            }
                        }
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($habitat['description']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $habitat['id'] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $habitat['id'] ?>" onclick="return confirm('Voulez-vous supprimer cet habitat ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>