<?php 
require './config_unv.php'; // Connexion à la base de données

try {
    // Requête pour récupérer les avis avec les noms des habitats et des vétérinaires
    $sql = "SELECT ah.commentaire, ah.date_creation, h.nom AS habitat, u.nom AS veterinaire
            FROM avis_habitats ah
            JOIN habitats h ON ah.habitat_id = h.id
            JOIN utilisateurs u ON ah.veterinaire_id = u.id
            ORDER BY ah.date_creation DESC";

    $stmt = $pdo->query($sql);
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des avis : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des avis sur les habitats</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Liste des avis sur les habitats</h2>

    <?php if (!empty($avis)): ?>
        <table>
            <tr>
                <th>Habitat</th>
                <th>Vétérinaire</th>
                <th>Commentaire</th>
                <th>Date</th>
            </tr>
            <?php foreach ($avis as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['habitat']); ?></td>
                    <td><?= htmlspecialchars($row['veterinaire']); ?></td>
                    <td><?= nl2br(htmlspecialchars($row['commentaire'])); ?></td>
                    <td><?= htmlspecialchars($row['date_creation']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun avis trouvé.</p>
    <?php endif; ?>
</body>
</html>


















<!--?php
require 'config.php'; // Connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des avis sur les habitats</title>
</head>
<body>
    <h2>Liste des avis sur les habitats</h2>

    <table border="1">
        <tr>
            <th>Habitat</th>
            <th>Vétérinaire</th>
            <th>Commentaire</th>
            <th>Date</th>
        </tr>
        
        <!?php
        // Requête pour récupérer les avis avec les noms des habitats et des vétérinaires
        $sql = "SELECT ah.commentaire, ah.date_creation, h.nom AS habitat, u.nom AS veterinaire
                FROM avis_habitats ah
                JOIN habitats h ON ah.habitat_id = h.id
                JOIN utilisateurs u ON ah.veterinaire_id = u.id
                ORDER BY ah.date_creation DESC";
        
        $result = $pdo->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['habitat']}</td>
                    <td>{$row['veterinaire']}</td>
                    <td>{$row['commentaire']}</td>
                    <td>{$row['date_creation']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>-->