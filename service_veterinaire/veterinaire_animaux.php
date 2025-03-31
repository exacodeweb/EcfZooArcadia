<?php
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

$animaux = $pdo->query("
    SELECT a.id, a.prenom, a.race, h.nom AS habitat
    FROM animaux a
    JOIN habitats h ON a.habitat_id = h.id
    ORDER BY a.prenom ASC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Animaux - Vétérinaire</title>
</head>
<body>
    <h2>Liste des Animaux</h2>
    <table border-radius="1">
        <tr>
            <th>Prénom</th>
            <th>Race</th>
            <th>Habitat</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($animaux as $a) : ?>
            <tr>
                <td><?= $a['prenom'] ?></td>
                <td><?= $a['race'] ?></td>
                <td><?= $a['habitat'] ?></td>
                <td>
                    <a href="ajouter_compte_rendu.php?animal_id=<?= $a['id'] ?>">Remplir Compte Rendu</a> |
                    <a href="historique_comptes_rendus.php?animal_id=<?= $a['id'] ?>">Voir Historique</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>