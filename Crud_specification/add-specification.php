<?php 
// Inclusion du fichier de configuration pour la connexion à la base de données
include '../config/config_unv.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $titres = $_POST['titre'];
    $valeurs = $_POST['valeur'];

    if (!empty($titres) && !empty($valeurs)) {
        // Insertion des spécifications dans la base de données
        $sql = "INSERT INTO specifications (service_id, titre, valeur) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        for ($i = 0; $i < count($titres); $i++) {
            $stmt->execute([$service_id, $titres[$i], $valeurs[$i]]);
        }

        $message = "Spécifications ajoutées avec succès !";
        $alertClass = "alert-success";
    } else {
        $message = "Erreur : Veuillez remplir tous les champs.";
        $alertClass = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultat - Ajout de spécifications</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .card {
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <?php if(isset($message)): ?>
          <div class="alert <?php echo $alertClass; ?>">
            <?php echo htmlspecialchars($message); ?>
          </div>
        <?php endif; ?>
        <a href="./ajouter.php" class="btn btn-primary">Retour</a>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle --> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- ancien fichier fonctionnelle -->
<!--?php
include '../includes/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $titres = $_POST['titre'];
    $valeurs = $_POST['valeur'];

    if (!empty($titres) && !empty($valeurs)) {
        $sql = "INSERT INTO specifications (service_id, titre, valeur) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        for ($i = 0; $i < count($titres); $i++) {
            $stmt->execute([$service_id, $titres[$i], $valeurs[$i]]);
        }
        
        $message = "Spécifications ajoutées avec succès !";
        $alertClass = "alert-success";
    } else {
        $message = "Erreur : Veuillez remplir tous les champs.";
        $alertClass = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Résultat - Ajout de spécifications</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> -------------------->
  <!-- Bootstrap CSS --> <!-------------------------------
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .card {
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <!?php if(isset($message)): ?>
          <div class="alert <!?php echo $alertClass; ?>">
            <!?php echo htmlspecialchars($message); ?>
          </div>
        <!?php endif; ?> ----------------------------->
        <!--<a href="your_form_page.php" class="btn btn-primary">Retour</a>--> <!-------------------
        <a href="./ajouter.php" class="btn btn-primary">Retour</a>
      </div>
    </div>
  </div>  --------------------->
  
  <!-- Bootstrap JS Bundle -->  <!-------------------------
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        -->
