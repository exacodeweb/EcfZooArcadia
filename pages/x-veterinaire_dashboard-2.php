<?php
require_once '../config/session_verif.php';
require_once '../config/config_unv.php';

// Vérifier que l'utilisateur a le rôle vétérinaire
if ($_SESSION['role'] !== 'veterinaire') {
    header("Location: ../config/login.php");
    exit;
}
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
    body { background-color: #f8f9fa; font-size: 1rem; }
    .card-header { font-size: 1.25rem; }
    .btn { font-size: 0.95rem; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
      <a class="navbar-brand" href="#">Tableau de bord Docteur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="./modifier-mot-de-passe.php">Modifier mon mot de passe</a></li>
          <li class="nav-item"><a class="nav-link" href="../config/logout.php">Déconnexion</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow">
          <div class="card-header bg-info text-white text-center">
            <h3>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?></h3>
          </div>
          <div class="card-body text-center">
            <a href="../service_veterinaire/ajouter_compte_rendu.php" class="btn btn-primary w-100 mb-3">Ajouter un compte rendu</a>
            <a href="../service_veterinaire/historique_comptes_rendus.php" class="btn btn-secondary w-100 mb-3">Historique compte rendu</a>
            <a href="./logout.php" class="btn btn-danger w-100">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>