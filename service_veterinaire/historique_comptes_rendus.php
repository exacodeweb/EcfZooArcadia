<?php   
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

$comptes_rendus = $pdo->prepare("
    SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
           CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_animal 
    FROM rapports_veterinaires c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN animaux a ON c.animal_id = a.id 
    WHERE u.role = 'veterinaire'
    ORDER BY c.date_visite DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historique des Comptes-Rendus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Ajoutez les styles de typographie ici -->

    <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;/*900px*/
            margin: auto;
            padding: 30px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background: #007bff;
            color: white;
            text-align: center;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <h2 class="text-center mb-4">📋 Historique des Comptes-Rendus</h2>

        <?php if (empty($comptes_rendus)) : ?>
            <div class="alert alert-warning text-center">⚠️ Aucun compte-rendu trouvé.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Nom de l'Animal</th>
                            <th>État</th>
                            <th>Nourriture</th>
                            <th>Grammage (kg)</th>
                            <th>Détails</th>
                            <th>Vétérinaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comptes_rendus as $c) : ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                                <td><?= htmlspecialchars($c['nom_animal']) ?></td>
                                <td><?= htmlspecialchars($c['etat_animal']) ?></td>
                                <td><?= htmlspecialchars($c['nourriture']) ?></td>
                                <td><?= htmlspecialchars($c['grammage']) ?></td>
                                <td><?= htmlspecialchars($c['detail_etat']) ?></td>
                                <td><?= htmlspecialchars($c['veterinaire']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
