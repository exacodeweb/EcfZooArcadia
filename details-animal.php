<?php
//include 'includes/db-connection.php';
require_once './config/config_unv.php';
//require './config/database.php';

// Récupérer l'ID depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?"; // espece
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'animal</title>
  <link rel="stylesheet" href="assets/css/style_detaails_animaux.css">

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 32px;
      color: #2c3e50;
      margin-bottom: 10px;
      text-align: center;
    }

    .animal-images {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }

    .animal-images img {
      width: 200px;
      height: 150px;
      /*auto*/
      border-radius: 8px;
      border: 2px solid #ddd;
      transition: transform 0.3s ease;
    }

    .animal-images img:hover {
      transform: scale(1.1);
      border-color: #3498db;
    }

    .reports-section {
      margin-top: 40px;
    }

    h2 {
      font-size: 28px;
      color: #34495e;
      margin-bottom: 20px;
      text-align: center;
    }

    .report-card {
      background-color: #f9f9f9;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 15px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .report-card p {
      margin: 5px 0;
    }

    .report-card strong {
      color: #2c3e50;
    }

    .error {
      color: #e74c3c;
      font-weight: bold;
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <div class="container">

    <?php if ($animal): ?>
      <div class="animal-details">
        <h1>Rapports vétérinaires</h1>
        <div class="animal-images">
          <?php
          $images = json_decode($animal['images']);
          foreach ($images as $image):
          ?>
            <img src="assets/images/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($animal['prenom']) ?>" onerror="this.src='assets/images/placeholder.jpg';">
          <?php endforeach; ?>
        </div>
      </div>

      <div class="reports-section">
        <h2><?= htmlspecialchars($animal['prenom']) ?> (<?= htmlspecialchars($animal['race']) ?>)</h2><!-- espece -->
        <?php


        //$sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";-->
        $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";/*comptes_rendus_veterinaires*/

        $stmtReports = $pdo->prepare($sqlReports);
        $stmtReports->execute([$animalId]);

        while ($report = $stmtReports->fetch()):
        ?>
          <div class="report-card">
            <p><strong>État :</strong> <?= htmlspecialchars($report['etat_animal']) ?></p>
            <p><strong>Nourriture :</strong> <?= htmlspecialchars($report['nourriture']) ?> <!--(<!-?= $report['grammage'] ?> g)--></p>
            <p><strong>grammage :</strong> <?= htmlspecialchars($report['grammage']) ?> kg<!--(<!-?= $report['grammage'] ?> g)--></p>
            <!--<p><strong>Date :</strong> <!?= htmlspecialchars($report['date_visite']) ?></p>-->
            <p><strong>Date passage:</strong> <?= (new DateTime($report['date_visite']))->format('d/m/Y') ?></p>
            <?php if ($report['detail_etat']): ?>
              <p><strong>Détails :</strong> <?= htmlspecialchars($report['detail_etat']) ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="error">Animal non trouvé.</p>
    <?php endif; ?>
  </div>
</body>

</html>