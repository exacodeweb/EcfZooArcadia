<?php
// Vérification si l'utilisateur est connecté et a le rôle d'employé
session_start();
if ($_SESSION['role'] !== 'employe') {
  //header("Location: login.php");
  header("Location: ../config/login.php");
  exit;
}
?>

<!----------- Ajouter ci dessus----------------> 
<?php
// Connexion à la base de données
require_once '../config/config_unv.php'; // a testé

if (!isset($pdo)) {
  die("Erreur : La connexion à la base de données n'est pas disponible.");
}

if (!isset($_SESSION['user_id'])) {
  header('Location: ../config/login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id, prenom, nom, email FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  die("Erreur : utilisateur introuvable dans la base de données.");
}
?>

<?php
try {
    require_once '../config/config_unv.php';
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

?>

<?php

// Connexion à la base de données
require_once '../config/config_unv.php'; // a testé

if (!isset($pdo)) {
  die("Erreur : La connexion à la base de données n'est pas disponible.");
}

if (!isset($_SESSION['user_id'])) {
  header('Location: ../config/login.php');
  exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT id, prenom, nom, email FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
  die("Erreur : utilisateur introuvable dans la base de données.");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Employé | ZooArcadia</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css"> <!-- Fichier CSS personnalisé -->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .card {
      border-radius: 10px;
    }

    .card-header {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .btn {
      transition: 0.3s ease-in-out;
    }

    .btn:hover {
      opacity: 0.8;
    }

    #img-font {
      background: url('../assets/images/Forest wallpaper midday.jpg') no-repeat center center/cover;
      /* image-resize-(7).jpg */
      height: auto;
    }
  </style>
</head>

<body class="bg-light" id="img-font">

  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
      <a class="navbar-brand" href="#">ZooArcadia - Employé</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="./modifier-mot-de-passe.php">Modifier Mot de Passe</a></li>



          <!--<li class="nav-item"><a class="nav-link" href="../avis_system_test/moderation-avis.php">Modérer Avis</a></li>-->
          <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../config/logout.php">Déconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg border-0">

          <div class="card-header bg-success text-white text-center">
            <h3>Bienvenue, <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></h3>
            <p class="mb-0"><?= htmlspecialchars($user['email']); ?></p>
          </div>


          <!-- Carte Bienvenue --><!----------------
          <div class="col-lg-12 col-md-6">
            <div class="card text-white bg-primary shadow">
              <div class="card-body text-center">
                <h3 class="card-title">Bienvenue, <!?= $_SESSION['nom']; ?> 🎉</h3>
                <p class="card-text">Vous êtes connecté.</p> ---------------> <!--  en tant qu'employe -->
          <!--<a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>--> <!------------------
                <a href="./logout.php" class="btn btn-danger">Déconnexion</a>
              </div>
            </div>
          </div>-->


          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <a href="../avis_system_test/moderation-avis.php" class="btn btn-primary w-100 mb-3">Modérer les Avis</a>

                <!--<a href="modifier-mot-de-passe.php" class="btn btn-warning w-100 mb-3">Modifier Mot de Passe</a>-->

                <!--<a href="../password/modifier-mot-de-passe.php" class="btn btn-warning w-100 mb-3">Modifier Mot de Passe test</a>-->

                <!--<a href="../password/get_mdp.php" class="btn btn-warning w-100 mb-3">Modifier Mot de Passe</a>-->

              </div>
              <div class="col-md-6">
                <a href="../service_employe/liste_consommation.php" class="btn btn-info w-100 mb-3">Historique Consommation</a>
                <a href="../service_employe/ajouter_consommation.php" class="btn btn-secondary w-100 mb-3">Ajouter Consommations</a>
                <!--<a href="../manage_animaux/index.php" class="btn btn-primary w-100 mb-3">Gerer les animaux</a>-->
              </div>

            </div>
            <hr>
            <a href="./logout.php" class="btn btn-danger w-100">Déconnexion</a>
            <!--<a href="../config/logout.php" class="btn btn-danger w-100">Déconnexion</a>-->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>