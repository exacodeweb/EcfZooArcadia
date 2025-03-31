<?php 
//require_once '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Récupérer l'ID de l'animal depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Détails de l'Animal</title>
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      padding: 1rem;
    }
    .animal-details {
      text-align: center;
      margin-bottom: 2rem;
    }
    .animal-details h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    .animal-images {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
    }
    .animal-images img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .reports-section {
      margin-top: 2rem;
    }
    .reports-section h2 {
      text-align: center;
      font-size: 1.75rem;
      margin-bottom: 1.5rem;
    }
    .report-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      padding: 1rem;
      margin-bottom: 1rem;
    }
    .report-card p {
      margin-bottom: 0.5rem;
    }
    @media (max-width: 768px) {
      .animal-images img {
        width: 100px;
        height: 100px;
      }
      .animal-details h1 {
        font-size: 1.5rem;
      }
      .reports-section h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <?php if ($animal): ?>
      <div class="animal-details">
        <h1><?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['race']) ?>)</h1>
        <div class="animal-images">
          <?php 
          $images = json_decode($animal['images']);
          foreach ($images as $image) {
            echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
          }
          ?>
        </div>
      </div>
      
      <?php
      // Inclusion du second bloc : Comptes rendus vétérinaires
      //require_once '../service_veterinaire/db.php';
      require_once '../config/config_unv.php'; // a testé

      // Récupérer les comptes rendus vétérinaires associés à cet animal
      $sqlReports = "SELECT date_visite, etat_animal, nourriture, grammage, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
      $stmtReports = $pdo->prepare($sqlReports);
      $stmtReports->execute([$animalId]);
      ?>
      
      <div class="reports-section">
        <h2>Comptes Rendus Vétérinaires</h2>
        <?php while ($report = $stmtReports->fetch()): ?>
          <div class="report-card">
            <p><strong>Date de visite :</strong> <?= htmlspecialchars($report['date_visite']) ?></p>
            <p><strong>État de l'animal :</strong> <?= htmlspecialchars($report['etat_animal']) ?></p>
            <p><strong>Nourriture :</strong> <?= htmlspecialchars($report['nourriture']) ?> (<?= htmlspecialchars($report['grammage']) ?> kg)</p>
            <?php if (!empty($report['detail_etat'])): ?>
              <p><strong>Détails supplémentaires :</strong> <?= htmlspecialchars($report['detail_etat']) ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-danger">Animal non trouvé.</p>
    <?php endif; ?>
  </div>
  
  <!-- Bootstrap JS Bundle -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>











<!--?php
//include 'includes/db-connection.php';
require_once '../config/database.php';

// Récupérer l'ID de l'animal depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();

if ($animal) {
    echo '<div class="animal-details">';
    echo '<h1>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h1>';

    // Afficher les images de l'animal
    $images = json_decode($animal['images']);
    echo '<div class="animal-images">';
    foreach ($images as $image) {
        echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
    }
    echo '</div>';
    echo '</div>';

    //require_once '../config/database.php';
    // require '../includes/db-connection.php';
    require_once '../service_veterinaire/db.php';

    // Récupérer l'ID de l'animal depuis l'URL
    $animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Récupérer les détails de l'animal
    $sql = "SELECT  date_visite, etat_animal, nourriture, grammage, detail_etat FROM rapports_veterinaires WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animalId]);
    $animal = $stmt->fetch();


    // Récupérer les comptes rendus vétérinaires associés à cet animal
    //$sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";
    $sqlReports = "SELECT date_visite, etat_animal, nourriture, grammage, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";

    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Comptes Rendus Vétérinaires</h2>';
    echo '<div class="reports-section">';
    while ($report = $stmtReports->fetch()) {
        echo '<div class="report-card">';
        echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date_visite']) . '</p>';
        echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat_animal']) . '</p>';
        echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' kg)</p>';
        if (!empty($report['detail_etat'])) {
            echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
        }
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="error">Animal non trouvé.</p>';
}

?> -->

<!--
// Récupérer les comptes rendus vétérinaires associés à cet animal
//$sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";//comptes_rendus_veterinaires
//$stmtReports = $pdo->prepare($sqlReports);
//$stmtReports->execute([$animalId]);

//echo '<h2>Rapports vétérinaires</h2>';//Comptes Rendus Vétérinaires
//echo '<div class="reports-section">';
//while ($report = $stmtReports->fetch()) {
    //echo '<div class="report-card">';
    //echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date']) . '</p>';
    //echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat']) . '</p>';
    //echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
    //if (!empty($report['detail_etat'])) {
       // echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
    //}
    //echo '</div>';
//}
//echo '</div>';
-->




<!--
<div class="reports-section">
<h2><!!?= htmlspecialchars($animal['prenom']) ?> (<!?= htmlspecialchars($animal['race']) ?>)</h2> --> <!-- espece -->
    <!--?php
    $sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);
    
    while ($report = $stmtReports->fetch()):
    ?>
        <div class="report-card">
            <p><strong>État :</strong> <!?= htmlspecialchars($report['etat']) ?></p>
            <p><strong>Nourriture :</strong> <!?= htmlspecialchars($report['nourriture']) ?> (<!?= $report['grammage'] ?> g)</p>
            <p><strong>Date :</strong> <!?= htmlspecialchars($report['date']) ?></p>
            <!?php if ($report['detail_etat']): ?>
                <p><strong>Détails :</strong> <!?= htmlspecialchars($report['detail_etat']) ?></p>
            <!?php endif; ?>
        </div>
    <!?php endwhile; ?>
</div>
<!?php else: ?>
<p class="error">Animal non trouvé.</p>
<!?php endif; ?>
*/