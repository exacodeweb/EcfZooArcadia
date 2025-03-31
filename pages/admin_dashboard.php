<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  //header("Location: login.php");
  header("Location: ../config/login.php");
  exit;
}
?>


<!--?php
require_once '../config/session_verif.php';

// Vérifier le rôle selon la page
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../config/login.php");
    exit;
}
?>-->


  <!--//header("Location: ../config/login.php");
  //header("Location: ../config/config.php");
  //header("Location: ''/config/config_unv.php");-->

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tableau de bord Administrateur</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Ajoutez les styles de typographie ici -->

  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">

  <style>
    body {
      background-color: #f8f9fa;/**/
      font-family: Arial, sans-serif;
    }

    .card-header {
      background-color: #2A7E50;
      padding: 10px;
    }

    .welcome-card h3 {
      font-size: clamp(24px, 5vw, 36px);
    }

    .dashboard-grid .card {
      transition: transform 0.3s ease;
    }

    .dashboard-grid .card:hover {
      transform: scale(1.02);
    }
  </style>
</head>

<body>


  <!-- Carte Bienvenue -->
  <div class="col-lg-12 col-md-6">
    <div class="card-header text-white  shadow"><!--bg-primary-->
      <div class="card-body text-center">
        <h3 class="card-title">Bienvenue, <?= $_SESSION['nom']; ?> 🎉</h3>
        <p class="card-text">Vous êtes connecté en tant qu'Administrateur.</p>
        <!--<a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>-->
        <a href="./logout.php" class="btn btn-danger">Déconnexion</a>
      </div>
    </div>
  </div>

  <!--<div class="container my-4"> -->
    <!-- Carte de bienvenue --> <!--
    <div class="card welcome-card mb-4 shadow">
      <div class="card-body text-center">
        <h3 class="card-title">Bienvenue, <!?= htmlspecialchars($_SESSION['nom'] ?? 'Utilisateur'); ?> 🎉</h3>
        <p class="card-text">Vous êtes connecté en tant qu'Administrateur.</p>
        <a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>
      </div>
    </div>-->
    <!--<div class="container col-mt-12 col-md-12">  -->

    <div class="container my-4"> 

    <!-- Grille de cartes pour les actions -->
    <div class="row g-3 dashboard-grid">

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Sécurité du compte</h5>
            <a href="modifier-mot-de-passe.php" class="btn btn-warning w-100">Modifier mon mot de passe</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Sécurité du compte employé</h5>
            <a href="../password/get_mdp.php" class="btn btn-warning w-100">Modifier Mot de Passe employé</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des employés</h5>
            <a href="../Crud_employe/liste.php" class="btn btn-info w-100">Manager Employés</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des habitats</h5>
            <a href="../Crud_habitats/liste_habitats.php" class="btn btn-secondary w-100">Liste des Habitats</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des services</h5>
            <a href="../Crud_services/liste_services.php" class="btn btn-secondary w-100">Liste des Services</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Spécifications</h5>
            <a href="../Crud_specification/ajouter.php" class="btn btn-secondary w-100 mb-2">Ajouter spécification</a>
            <a href="../Crud_specification/manage-specifications.php" class="btn btn-secondary w-100">Gérer spécifications</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des animaux</h5>
            <a href="../manage_animaux/index.php" class="btn btn-secondary w-100">Liste-A des Animaux</a>
            <a href="../Crud_animaux/liste_animaux.php" class="btn btn-secondary w-100">Liste-B des Animaux</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Comptes-rendus vétérinaires</h5>
            <a href="../service_veterinaire/comptes_rendus.php" class="btn btn-secondary w-100">Voir Comptes-rendus</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Ajouter un service</h5>
            <a href="../crud_services/ajouter_service.php" class="btn btn-outline-primary w-100">Ajouter un service</a>
          </div>
        </div>
      </div>

    </div>
  </div>
 
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

