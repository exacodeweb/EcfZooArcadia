<?php 
//require '../config/database.php';
require_once '../config/config_unv.php';


$consommations = $pdo->query("
    SELECT c.id, a.prenom, a.race, c.date, c.heure, c.nourriture, c.quantite, u.nom AS employe
    FROM consommations c
    JOIN animaux a ON c.animal_id = a.id
    JOIN utilisateurs u ON c.employe_id = u.id
    ORDER BY c.date DESC, c.heure DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historique des consommations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <h2 class="text-center text-primary mb-4">Historique des consommations alimentaires</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="../pages/employe_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
            <a href="ajouter_consommation.php" class="btn btn-success">+ Ajouter une consommation</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Animal</th>
                        <th>Espece</th><!-- Race -->
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Nourriture</th>
                        <th>Quantité (kg)</th>
                        <th>Employé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consommations as $c) : ?>
                        <tr>
                            <td><?= htmlspecialchars($c['prenom']) ?></td>
                            <td><?= htmlspecialchars($c['race']) ?></td>
                            <td><?= htmlspecialchars($c['date']) ?></td>
                            <td><?= htmlspecialchars($c['heure']) ?></td>
                            <td><?= htmlspecialchars($c['nourriture']) ?></td>
                            <td><?= htmlspecialchars($c['quantite']) ?> kg</td>
                            <td><?= htmlspecialchars($c['employe']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




<!--?php
require '../config/database.php';

$consommations = $pdo->query("
    SELECT c.id, a.prenom, a.race, c.date, c.heure, c.nourriture, c.quantite, u.nom AS employe
    FROM consommations c
    JOIN animaux a ON c.animal_id = a.id
    JOIN utilisateurs u ON c.employe_id = u.id
    ORDER BY c.date DESC, c.heure DESC
")->fetchAll();
?> -->
<!--users  -->
<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des consommations</title>
</head>
<body>
    <h2>Historique des consommations alimentaires</h2>
    <table border="1">
        <tr>
            <th>Animal</th>
            <th>Race</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nourriture</th>
            <th>Quantité (kg)</th>
            <th>Employé</th>
        </tr>
        <!?php foreach ($consommations as $c) : ?>
            <tr>
                <td><!?= $c['prenom'] ?></td>
                <td><!?= $c['race'] ?></td> --> <!-- race en espece --> <!--
                <td><!?= $c['date'] ?></td>
                <td><!?= $c['heure'] ?></td>
                <td><!?= $c['nourriture'] ?></td>
                <td><!?= $c['quantite'] ?> kg</td>
                <td><!?= $c['employe'] ?></td>
            </tr>
        <!?php endforeach; ?>
    </table>
</body>
</html>