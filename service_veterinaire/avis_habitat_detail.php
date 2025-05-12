<?php
require_once '../config/config_unv.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Habitat invalide.");
}

$habitat_id = (int) $_GET['id'];

$stmt = $pdo->prepare("
    SELECT a.date_creation, a.commentaire,
           CONCAT(u.prenom, ' ', u.nom) AS veterinaire,
           h.nom AS nom_habitat
    FROM avis_habitats a
    JOIN utilisateurs u ON a.veterinaire_id = u.id
    JOIN habitats h ON a.habitat_id = h.id
    WHERE a.habitat_id = ?
    ORDER BY a.date_creation DESC
");

$stmt->execute([$habitat_id]);
$avis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📄 Avis sur l'habitat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
 .title {
  text-align: center;
 }
</style>

  </head>
<body class="container py-4">

<!--<h2>📄 Avis sur l'habitat : <!?= htmlspecialchars($avis[0]['nom_habitat'] ?? 'Inconnu') ?></h2>-->
<section class="title">
<h2>📄 Avis sur l'habitat : <?= htmlspecialchars($avis[0]['nom_habitat'] ?? 'Inconnu') ?></h2>
</section>

<!--?php
$nom_complet = $avis[0]['nom_habitat'] ?? 'Inconnu';
$nom_court = explode('-', $nom_complet)[0]; // Coupe au niveau du tiret
?>
<h2>📄 Avis sur l'habitat : <!?= htmlspecialchars(trim($nom_court)) ?></h2>-->

<?php if (empty($avis)) : ?>
    <div class="alert alert-warning mt-4">Aucun avis trouvé pour cet habitat.</div>
<?php else: ?>
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>Date</th>
                <th>Commentaire</th>
                <th>Vétérinaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($avis as $a) : ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($a['date_creation'])) ?></td>
                    <td><?= htmlspecialchars($a['commentaire']) ?></td>
                    <td><?= htmlspecialchars($a['veterinaire']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../service_veterinaire/historique_avis_habitat.php" class="btn btn-secondary mt-3">Retour</a><!-- ../pages/veterinaire_dashboard.php -->

</body>
</html> 
