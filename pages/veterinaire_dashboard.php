<?php
// Vérification si l'utilisateur est connecté et a le rôle d'employé
session_start();
if ($_SESSION['role'] !== 'veterinaire') {
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
      background-color: #2A7E50; 
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
          <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="./logout.php">Déconnexion</a></li><!-- ../config/logout.php --><!-- ../service_veterinaire/logout.php -->
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

          <!-- Contenu principal -->
          <div class="container my-4">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-md-8">
                <div class="card shadow">
                  <!--<div class="card-header text-white text-center">-----><!-- bg-info  --> <!----
                    <h3>Bienvenue, <!?= isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : 'Utilisateur'; ?> (Roux)</h3>
                  </div>-->
                  <div class="card-body text-center">
                    <a href="../service_veterinaire/ajouter_compte_rendu.php" class="btn btn-primary w-100 mb-3">Ajouter un compte rendu</a>
                    <a href="../service_veterinaire/historique_comptes_rendus.php" class="btn btn-secondary w-100 mb-3">Historique compte rendu</a>
                    <a href="#../service_veterinaire/avis_habitat.php" class="btn btn-success w-100 mb-3">Ajouter un commentaire habitat</a>
                    <a href="../service_veterinaire/logout.php" class="btn btn-danger w-100">Déconnexion</a><!--  -->
                  </div><!--  -->
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!--?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'veterinaire') {
    header("Location: ../config/login.php");
    exit;
}

require_once '../config/config_unv.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Docteur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
    }
    .card-header {
      font-size: 1.25rem;
    }
    .btn {
      font-size: 0.95rem;
    }

    .navbar, .card-header {
      background-color: #2A7E50;
    }

  </style>
</head>
<body> -->
  <!-- Navbar responsive --> <!------------------
  <nav class="navbar navbar-expand-lg navbar-dark ">-------------><!-- bg-info ---> <!----------------
    <div class="container">
      <a class="navbar-brand" href="#">Tableau de bord Docteur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="./modifier-mot-de-passe.php">Modifier mon mot de passe</a></li>
          <li class="nav-item"><a class="nav-link" href="../config/logout.php">Déconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav> ---------------->

  <!-- Contenu principal --> <!--------------------
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow">
          <div class="card-header text-white text-center">--------------------><!-- bg-info  --> <!-------------------
            <h3>Bienvenue, <!?= isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : 'Utilisateur'; ?> (Roux)</h3>
          </div>
          <div class="card-body text-center">
            <a href="../service_veterinaire/ajouter_compte_rendu.php" class="btn btn-primary w-100 mb-3">Ajouter un compte rendu</a>
            <a href="../service_veterinaire/historique_comptes_rendus.php" class="btn btn-secondary w-100 mb-3">Historique compte rendu</a>
            <a href="#../service_veterinaire/avis_habitat.php" class="btn btn-success w-100 mb-3">Ajouter un commentaire habitat</a>
            <a href="../config/logout.php" class="btn btn-danger w-100">Déconnexion</a>
          </div>---------------><!--  --> <!-----------------------
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -------------------------->



<!--?php
//require_once '../config/session_verif.php';
require_once '..config/config_unv.php';


// Vérifier le rôle selon la page
//if ($_SESSION['role'] !== 'admin') {
    //header("Location: ./config/login.php");
    //exit;
//}
//?>

<!!?php 
session_start();
if ($_SESSION['role'] !== 'veterinaire') {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Docteur</title>  ----------------->
  <!-- Bootstrap CSS -->  <!--------------------
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --------------->

  <!-- Ajoutez les styles de typographie ici --> <!-----------------------------

  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">

  <style>
    body {
      background-color: #f8f9fa;
      font-size: 1rem;
    }
    .card-header {
      font-size: 1.25rem;
    }
    .btn {
      font-size: 0.95rem;
    }
  </style>
</head>
<body> ---------------------->
  <!-- Navbar responsive --> <!----------------------------
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
      <a class="navbar-brand" href="#">Tableau de bord Docteur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="./modifier-mot-de-passe.php">Modifier mon mot de passe</a></li>
          <li class="nav-item"><a class="nav-link" href="../config/logout.php">Déconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav>  ------------------------->

  <!-- Contenu principal -->  <!--------------------------------
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow">
          <div class="card-header bg-info text-white text-center">
            <h3>Bienvenue, <!?= htmlspecialchars($_SESSION['nom']); ?> (Roux)</h3>
          </div> ------------------------->  <!-----------------
          <div class="card-body text-center"> ------------------>
            <!--<a href="modifier-mot-de-passe.php" class="btn btn-warning w-100 mb-3">Modifier mon mot de passe</a>--> <!--------------
            <a href="../service_veterinaire/ajouter_compte_rendu.php" class="btn btn-primary w-100 mb-3">Ajouter un compte rendu</a>
            <a href="../service_veterinaire/historique_comptes_rendus.php" class="btn btn-secondary w-100 mb-3">Historique compte rendu</a>
            <a href="#" class="btn btn-success w-100 mb-3">Ajouter un commentaire habitat</a> ---------------------->
            <!--<a href="../config/logout.php" class="btn btn-danger w-100">Déconnexion</a>-->  <!------------------
            <a href="./logout.php" class="btn btn-danger w-100">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>
  </div>  ------------------------------>

  <!-- Bootstrap JS Bundle -->   <!----------------------------
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  --------------------------->
