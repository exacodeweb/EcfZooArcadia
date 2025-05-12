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
        <h1>Comptes Rendus veterinaires</h1><!-- Rapports vétérinaires -->
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

<!------------------------------------ version amélioré ------------------------------------>

<!--?php
require_once './config/config_unv.php';

// Récupérer l'ID depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal avec infos supplémentaires
$sql = "SELECT prenom, race, images, sexe, date_naissance, date_arrivee FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compte rendu vétérinaire - <!?= htmlspecialchars($animal['prenom'] ?? 'Animal') ?></title>
  <link rel="stylesheet" href="assets/css/style_detaails_animaux.css">
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">
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
      text-align: center;
      margin-bottom: 30px;
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
      border-radius: 8px;
      border: 2px solid #ddd;
      transition: transform 0.3s ease;
    }
    .animal-images img:hover {
      transform: scale(1.1);
      border-color: #3498db;
    }
    .animal-info {
      background-color: #eef6fa;
      padding: 15px;
      border-left: 5px solid #3498db;
      margin: 25px 0;
      border-radius: 8px;
    }
    .animal-info p {
      margin: 5px 0;
    }
    .reports-section {
      margin-top: 40px;
    }
    .report-card {
      background-color: #f9f9f9;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .report-card h3 {
      margin-top: 0;
      color: #34495e;
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

    <!?php if ($animal): ?>
      <h1>Compte rendu vétérinaire quotidien</h1>

      <div class="animal-images">
        <!?php
        $images = json_decode($animal['images']);
        foreach ($images as $image):
        ?>
          <img src="assets/images/<!?= htmlspecialchars($image) ?>" alt="<!?= htmlspecialchars($animal['prenom']) ?>" onerror="this.src='assets/images/placeholder.jpg';">
        <!?php endforeach; ?>
      </div>

      <div class="animal-info">
        <p><strong>Nom :</strong> <!?= htmlspecialchars($animal['prenom']) ?></p>
        <p><strong>Race :</strong> <!?= htmlspecialchars($animal['race']) ?></p>
        <p><strong>Sexe :</strong> <!?= htmlspecialchars($animal['sexe']) ?></p>
        <p><strong>Date de naissance :</strong> <!?= (new DateTime($animal['date_naissance']))->format('d/m/Y') ?></p>
        <p><strong>Date d'arrivée :</strong> <!?= (new DateTime($animal['date_arrivee']))->format('d/m/Y') ?></p>
      </div>

      <div class="reports-section">
        <!?php
        $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat 
                       FROM rapports_veterinaires 
                       WHERE animal_id = ? 
                       ORDER BY date_visite DESC";
        $stmtReports = $pdo->prepare($sqlReports);
        $stmtReports->execute([$animalId]);
        $hasReports = false;

        while ($report = $stmtReports->fetch()):
          $hasReports = true;
        ?>
          <div class="report-card">
            <h3>🗓️ <!?= (new DateTime($report['date_visite']))->format('d/m/Y') ?></h3>
            <p><strong>État :</strong> <!?= htmlspecialchars($report['etat_animal']) ?></p>
            <p><strong>Nourriture :</strong> <!?= htmlspecialchars($report['nourriture']) ?> (<!?= htmlspecialchars($report['grammage']) ?> kg)</p>
            <!?php if ($report['detail_etat']): ?>
              <p><strong>Notes :</strong> <!?= htmlspecialchars($report['detail_etat']) ?></p>
            <!?php endif; ?>
          </div>
        <!?php endwhile; ?>

        <!?php if (!$hasReports): ?>
          <p class="error">Aucun compte rendu n'a encore été enregistré pour cet animal.</p>
        <!?php endif; ?>
      </div>

    <!?php else: ?>
      <p class="error">Animal non trouvé.</p>
    <!?php endif; ?>

  </div>
</body>
</html>

-->

<!---------------------------------------vresion amelioré html ------------------------------------------>
<!--?php
require_once './config/config_unv.php';

$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $etat = $_POST['etat_animal'] ?? '';
  $nourriture = $_POST['nourriture'] ?? '';
  $grammage = $_POST['grammage'] ?? '';
  $detail = $_POST['detail_etat'] ?? '';
  $date = $_POST['date_visite'] ?? date('Y-m-d');

  // Validation de base
  if ($etat && $nourriture && $grammage && $animalId) {
    $sql = "INSERT INTO rapports_veterinaires (animal_id, etat_animal, nourriture, grammage, detail_etat, date_visite)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$animalId, $etat, $nourriture, $grammage, $detail, $date]);

    header("Location: compte_rendu.php?id=$animalId");
    exit;
  } else {
    $error = "Tous les champs obligatoires doivent être remplis.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un rapport vétérinaire</title>
  <style>
    body {
      font-family: 'Barlow', sans-serif;
      background-color: #f0f4f8;
      padding: 40px;
    }
    .form-container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    textarea {
      height: 100px;
    }
    button {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      cursor: pointer;
    }
    button:hover {
      background-color: #2980b9;
    }
    .error {
      color: red;
      margin-top: 15px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Ajouter un compte rendu vétérinaire</h2>
    
    <!?php if (!empty($error)): ?>
      <p class="error"><!?= htmlspecialchars($error) ?></p>
    <!php endif; ?>

    <form method="POST">
      <label for="etat_animal">État de l'animal *</label>
      <input type="text" name="etat_animal" id="etat_animal" required>

      <label for="nourriture">Nourriture *</label>
      <input type="text" name="nourriture" id="nourriture" required>

      <label for="grammage">Grammage (kg) *</label>
      <input type="number" step="0.01" name="grammage" id="grammage" required>

      <label for="detail_etat">Détails complémentaires</label>
      <textarea name="detail_etat" id="detail_etat"></textarea>

      <label for="date_visite">Date du compte rendu</label>
      <input type="date" name="date_visite" id="date_visite" value="<!?= date('Y-m-d') ?>">

      <button type="submit">Enregistrer le compte rendu</button>
    </form>
  </div>
</body>
</html>



 Ensuite :
Depuis la page compte_rendu.php?id=XX, tu peux ajouter un bouton "Ajouter un compte rendu" qui redirige vers ajouter_rapport.php?id=XX.

php
Copier
Modifier
<a href="ajouter_rapport.php?id=<!?= $animalId ?>" style="text-decoration:none;">
  <button style="margin-top: 20px; padding: 10px 20px; background-color: #27ae60; color:white; border:none; border-radius:6px;">
    ➕ Ajouter un compte rendu
  </button>
</a>