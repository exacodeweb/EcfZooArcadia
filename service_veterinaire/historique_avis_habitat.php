<?php
require_once '../config/config_unv.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Requête sur la table "textes_complets"
$requete = $pdo->prepare("
    SELECT 
        tc.id,
        tc.commentaire, 
        tc.date_creation,
        h.nom AS nom_habitat,
        u.prenom, u.nom AS nom_veterinaire,
        h.id AS habitat_id
    FROM avis_habitats tc
    JOIN habitats h ON tc.habitat_id = h.id
    JOIN utilisateurs u ON tc.veterinaire_id = u.id
    WHERE u.role = 'veterinaire'
    ORDER BY tc.date_creation DESC
");
$requete->execute();
$avis = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📋 Avis sur les habitats</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">📋 <!--Tous les--> avis des vétérinaires sur les habitats</h2>

    <?php if (empty($avis)) : ?>
        <div class="alert alert-warning text-center">Aucun avis trouvé.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Habitat</th>
                        <th>Vétérinaire</th>
                        <th>Commentaire</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($avis as $a) : ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($a['date_creation'])) ?></td>
                            <td><?= htmlspecialchars($a['nom_habitat']) ?></td>
                            <td><?= htmlspecialchars($a['prenom'] . ' ' . $a['nom_veterinaire']) ?></td>
                            <td><?= htmlspecialchars($a['commentaire']) ?></td>
                            <td>
                                <a href="avis_habitat_detail.php?id=<?= $a['habitat_id'] ?>" class="btn btn-sm btn-info">Voir les avis</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

<a href="../service_veterinaire/ajouter_avis_habitat.php" class="btn btn-secondary mt-3">Retour</a>

</div>

</body>
</html>









<!-- details par habitats -->
<!--?php
require_once '../config/config_unv.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$habitat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("
    SELECT 
        c.date_creation AS date_visite, 
        c.etat_habitat, 
        c.commentaire, 
        CONCAT(u.prenom, ' ', u.nom) AS veterinaire,
        h.nom AS nom_habitat
    FROM avis_habitats c
    JOIN utilisateurs u ON c.veterinaire_id = u.id
    JOIN habitats h ON c.habitat_id = h.id
    WHERE h.id = :id
    ORDER BY c.date_creation DESC
");
$stmt->execute(['id' => $habitat_id]);
$avis = $stmt->fetchAll();

$nom_habitat = $avis[0]['nom_habitat'] ?? 'Inconnu';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>🧐 Avis sur l'habitat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4 text-center">🧐 Détails des avis pour l'habitat : <strong><!?= htmlspecialchars($nom_habitat) ?></strong></h3>

    <!?php if (empty($avis)) : ?>
        <div class="alert alert-warning text-center">Aucun avis disponible pour cet habitat.</div>
    <!?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>État de l'habitat</th>
                        <th>Commentaire</th>
                        <th>Vétérinaire</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($avis as $a) : ?>
                        <tr>
                            <td><!?= date('d/m/Y', strtotime($a['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($a['etat_habitat']) ?></td>
                            <td><!?= htmlspecialchars($a['commentaire']) ?></td>
                            <td><!?= htmlspecialchars($a['veterinaire']) ?></td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!?php endif; ?>

    <div class="text-center mt-4">
        <a href="avis_habitats_index.php" class="btn btn-secondary">⬅ Retour à la liste</a>
    </div>
</div>

</body>
</html>













<!?php
require_once '../config/config_unv.php'; // Connexion sécurisée

ini_set('display_errors', 1);
error_reporting(E_ALL);

$comptes_rendus = $pdo->prepare("SELECT 
        c.date_creation AS date_visite, 
        c.etat_habitat, 
        c.commentaire, 
        CONCAT(u.prenom, ' ', u.nom) AS veterinaire, 
        h.nom AS nom_habitat,
        h.id AS habitat_id
    FROM avis_habitats c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN habitats h ON c.habitat_id = h.id
    WHERE u.role = 'veterinaire'
    ORDER BY c.date_creation DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📋 Comptes-rendus des habitats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">📋 Historique des Comptes-Rendus des Habitats</h2>

    <!?php if (empty($comptes_rendus)) : ?>
        <div class="alert alert-warning text-center">Aucun compte-rendu trouvé.</div>
    <!?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Habitat</th>
                        <th>État</th>
                        <th>Commentaire</th>
                        <th>Vétérinaire</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($comptes_rendus as $c) : ?>
                        <tr>
                            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                            <td><!?= htmlspecialchars($c['nom_habitat']) ?></td>
                            <td><!?= htmlspecialchars($c['etat_habitat']) ?></td>
                            <td><!?= htmlspecialchars($c['commentaire']) ?></td>
                            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                            <td>
                                <a href="avis_habitat_detail.php?id=<!?= $c['habitat_id'] ?>" class="btn btn-sm btn-info">Voir les avis</a>
                            </td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!?php endif; ?>
</div>

</body>
</html>














<!?php   
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

//$comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_animal, c.nourriture, c.grammage, c.detail_etat, 
$comptes_rendus = $pdo->prepare("SELECT c.date_visite, c.etat_habitat, c.commentaire, 
           /*CONCAT(u.nom, ' ', u.prenom) AS veterinaire, a.prenom AS nom_habitat*/
           CONCAT(u.prenom, ' ', u.nom) AS veterinaire, h.nom AS nom_habitat
    FROM avis_habitats c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN habitats h ON c.habitat_id = h.id  /*animaux*/ /*c.habitat_id*/
    WHERE u.role = 'veterinaire' /**/
    ORDER BY c.date_creation DESC
");

$comptes_rendus->execute();
$comptes_rendus = $comptes_rendus->fetchAll();
?>
-------------------------------->

<!--
$comptes_rendus = $pdo->prepare("
    SELECT 
        c.date_creation AS date_visite, 
        c.etat_habitat, 
        c.commentaire, 
        CONCAT(u.prenom, ' ', u.nom) AS veterinaire, 
        h.nom AS nom_habitat
    FROM avis_habitats c 
    JOIN utilisateurs u ON c.veterinaire_id = u.id 
    JOIN habitats h ON c.habitat_id = h.id
    WHERE u.role = 'veterinaire'
    ORDER BY c.date_creation DESC
");
-->


<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historique des Comptes-Rendus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
--------------->
    <!-- Ajoutez les styles de typographie ici -->  <!--------------------

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

        <!?php if (empty($comptes_rendus)) : ?>
            <div class="alert alert-warning text-center">⚠️ Aucun compte-rendu trouvé.</div>
        <!?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Etat de l'habitat</th>  ---------------> <!-- Nom de l'animal -->  <!----
                            <th>commentaire</th>  -------------> <!-- Détails -->  <!------------
                            <th>Vétérinaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!?php foreach ($comptes_rendus as $c) : ?>
                            <tr>
                                <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
                                <td><!?= htmlspecialchars($c['etat_habitat']) ?></td>-------------><!-- etat_animal --> <!---------------
                                <td><!?= htmlspecialchars($c['commentaire']) ?></td>------------><!-- detail_etat --> <!---------------
                                <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
                            </tr>
                        <!?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <!?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  ------------------------------>

<!--
<tbody>
    <!!?php foreach ($comptes_rendus as $c) : ?>
        <tr>
            <td><!?= date('d/m/Y', strtotime($c['date_visite'])) ?></td>
            <td><!?= htmlspecialchars($c['etat_habitat']) ?></td>
            <td><!?= htmlspecialchars($c['commentaire']) ?></td>
            <td><!?= htmlspecialchars($c['veterinaire']) ?></td>
        </tr>
    <!?php endforeach; ?>
</tbody>-->