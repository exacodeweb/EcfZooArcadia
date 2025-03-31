<!DOCTYPE html>
<html lang="fr, en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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

  <!--?php
  $animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;
  echo "ID reçu : " . $animalId;
  ?> -->

  <?php

  include '../includes/db-connection.php';
  //require_once '../config/config_unv.php'; // a testé

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

    // Récupérer les comptes rendus vétérinaires associés à cet animal (table comptes_rendus_veterinaires)
    // $sql = "SELECT * FROM comptes_rendus_veterinaires WHERE animal_id = ? ORDER BY animal_id ASC";
    $sql = "SELECT * FROM rapports_veterinaires WHERE animal_id = ? ORDER BY animal_id ASC";

    $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";/*comptes_rendus_veterinaires*/
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Comptes Rendus Vétérinaires</h2>';/*comptes_rendus_veterinaires*//*(rapports_veterinaires)*/
    echo '<div class="reports-section">';
    while ($report = $stmtReports->fetch()) {
      echo '<div class="report-card">';

      //echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date_visite']) . '</p>';

      $date = new DateTime($report['date_visite']);
      echo '<p><strong>Date de visite :</strong> ' . $date->format('d/m/Y') . '</p>';

      //echo '<p><strong>Date de visite :</strong> ' . date('d/m/Y', strtotime($report['date_visite'])) . '</p>';

      echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat_animal']) . '</p>';
      echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . '</p>';//  (' . htmlspecialchars($report['grammage']) . ' kg)

      //echo '<p><strong>Grammage :</strong> ' . htmlspecialchars($report['grammage']) . ' (' . htmlspecialchars($report['grammage']) . ' kg)</p>';
      echo '<p><strong>Grammage :</strong> ' . htmlspecialchars($report['grammage']) . ' Kg</p>';

      if (!empty($report['detail_etat'])) {
        echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
      }
      echo '</div>';
    }
    echo '</div>';

    // Récupérer les comptes rendus vétérinaires associés à cet animal (table rapports_veterinaires)

    //$sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
    //$stmtReports = $pdo->prepare($sqlReports);
    //$stmtReports->execute([$animalId]);

    //echo '<h2>Comptes Rendus Vétérinaires (rapports_veterinaires)</h2>';
    //echo '<div class="reports-section">';
    //while ($report = $stmtReports->fetch()) {
    //echo '<div class="report-card">';
    //echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date']) . '</p>';
    //echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat']) . '</p>';
    //echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
    //if (!empty($report['detail_etat'])) {
    //echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
    //}
    //echo '</div>';
    //}
    //echo '</div>';
  } else {
    echo '<p class="error">Animal non trouvé.</p>';
  }
  ?>

</body>

</html>













<!---------------------------------------------------------------------------------------------------------------->

<!--?php
include '../includes/db-connection.php';

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

  // Récupérer les comptes rendus vétérinaires associés à cet animal
  $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM rapports_veterinaires WHERE animal_id = ?"; //comptes_rendus_veterinaires
  $stmtReports = $pdo->prepare($sqlReports);
  $stmtReports->execute([$animalId]);

  echo '<h2>Comptes Rendus Vétérinaires (comptes_rendus_veterinaires)</h2>';
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

// Récupérer les comptes rendus vétérinaires associés à cet animal
$sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?"; //comptes_rendus_veterinaires
$stmtReports = $pdo->prepare($sqlReports);
$stmtReports->execute([$animalId]);

echo '<h2>Comptes Rendus Vétérinaires (rapports_veterinaires)</h2>';/*comptes_rendus_veterinaires*/
echo '<div class="reports-section">';
while ($report = $stmtReports->fetch()) {
  echo '<div class="report-card">';
  echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date']) . '</p>';
  echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat']) . '</p>';
  echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
  if (!empty($report['detail_etat'])) {
    echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
  }
  echo '</div>';
}
echo '</div>';
//} /*else {
//echo '<p class="error">Animal non trouvé.</p>';*/
//}*/




/*$query = "SELECT * FROM consommations WHERE animal_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$animal_id]);
$consommations = $stmt->fetchAll();

if ($consommations) {
  foreach ($consommations as $consommation) {
      echo "Nourriture: " . $consommation['nourriture'] . "<br>";
      echo "Quantité: " . $consommation['quantite'] . "<br>";
      // Autres données...
  }
} else {
  echo "Aucune consommation trouvée pour cet animal.";
}*/

?>
-->
<!--------------------------------------------------------------------------------------------------------------->


<!--?php
// Récupérer les comptes rendus vétérinaires associés à cet animal
    $sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";//comptes_rendus_veterinaires
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Comptes Rendus Vétérinaires</h2>';
    echo '<div class="reports-section">';
    while ($report = $stmtReports->fetch()) {
        echo '<div class="report-card">';
        echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date']) . '</p>';
        echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat']) . '</p>';
        echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
        if (!empty($report['detail_etat'])) {
            echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
        }
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="error">Animal non trouvé.</p>';
}
?>
-->













<!--?php
require '../service_veterinaire/db.php'; // Inclusion du fichier de connexion


// Récupération de l'ID de l'animal depuis l'URL
$animal_id = isset($_GET['animal_id']) ? intval($_GET['animal_id']) : null;

//$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$animal_id) {
  die('ID de l\'animal manquant.');
}


// Récupération des détails de l'animal depuis la table 'animaux'
$sql_animal = "SELECT * FROM animaux WHERE id = :animal_id";
$stmt_animal = $pdo->prepare($sql_animal);
$stmt_animal->execute(['animal_id' => $animal_id]);
$animal = $stmt_animal->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
  die('Animal non trouvé.');
}

// Récupération des rapports vétérinaires pour cet animal depuis la table 'rapports_veterinaires'
$sql_rapports = "SELECT * FROM commptes_rendus_veterinaires WHERE animal_id = :animal_id ORDER BY date DESC";
$stmt_rapports = $pdo->prepare($sql_rapports);
$stmt_rapports->execute(['animal_id' => $animal_id]);
$rapports = $stmt_rapports->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détails de l'animal</title>
  <link rel="stylesheet" href="styles.css">




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
  <h1>Détails de l'animal : <!?= htmlspecialchars($animal['nom']) ?></h1>
  <p><strong>Espèce :</strong> <!?= htmlspecialchars($animal['espece'] ?? 'Non défini') ?></p>
  <p><strong>Âge :</strong> <!?= htmlspecialchars($animal['age'] ?? 'Non défini') ?></p>

  <h2>Avis du vétérinaire</h2>
  <!?php if (count($rapports) > 0): ?>
    <table border="1">
      <thead>
        <tr>
          <th>Date</th>
          <th>État de l'animal</th>
          <th>Nourriture</th>
          <th>Grammage</th>
          <th>Détails</th>
        </tr>
      </thead>
      <tbody>
        <!?php foreach ($rapports as $rapport): ?>
          <tr>
            <td><!?= htmlspecialchars($rapport['date']) ?></td>
            <td><!?= htmlspecialchars($rapport['etat']) ?></td>
            <td><!?= htmlspecialchars($rapport['nourriture']) ?></td>
            <td><!?= htmlspecialchars($rapport['grammage']) ?> kg</td>
            <td><!?= nl2br(htmlspecialchars($rapport['detail_etat'])) ?></td>
          </tr>
        <!?php endforeach; ?>
      </tbody>
    </table>
  <!?php else: ?>
    <p>Aucun rapport vétérinaire disponible pour cet animal.</p>
  <!?php endif; ?>
</body>

</html> -->


<!--
id
veterinaire_id
animal_id
date_visite
etat_animal
nourriture
grammage
detail_etat

-->

<!--
L'énoncé du chahier des charges
 L'état de l’animal
 La nourriture proposée
 Le grammage de la nourriture
 Date de passage
 Détail de l’état de l’animal (information facultative)
    
Table : animaux
id
prenom
race
images
habitat_id

Table : comptes_rendus_veterinaires
id
veterinaire_id
animal_id
date_visite
etat_animal
nourriture
grammage
detail_etat

Table : rapports_veterinaires
id
etat
nourriture
grammage
date
detail_etat
animal_id

Table : consommations
id
animal_id
employe_id
date
heure
nourriture
quantite

Les requettes
$sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";

$sqlReports = "SELECT etat, nourriture, grammage, date, detail_etat FROM rapports_veterinaires WHERE animal_id = ?";
    -->