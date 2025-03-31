<?php 
//require '../config/database.php';
require_once '../config/config_unv.php'; // a testé

// Récupération des animaux pour le filtre
$animauxQuery = $pdo->query("SELECT id, prenom FROM animaux ORDER BY prenom");
$animaux = $animauxQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupération des filtres
$animal_id = $_GET['animal_id'] ?? null;
$date_debut = $_GET['date_debut'] ?? null;
$date_fin = $_GET['date_fin'] ?? null;

// Construction dynamique de la requête
$query = "SELECT crv.*, a.prenom AS nom_animal, CONCAT(u.prenom, ' ', u.nom) AS nom_veterinaire
          FROM rapports_veterinaires crv
          JOIN animaux a ON crv.animal_id = a.id
          JOIN utilisateurs u ON crv.veterinaire_id = u.id
          WHERE u.role = 'veterinaire'";
$params = [];

if (!empty($animal_id)) {
    $query .= " AND crv.animal_id = :animal_id";
    $params['animal_id'] = $animal_id;
}

if (!empty($date_debut)) {
    $query .= " AND crv.date_visite >= :date_debut";
    $params['date_debut'] = $date_debut;
}

if (!empty($date_fin)) {
    $query .= " AND crv.date_visite <= :date_fin";
    $params['date_fin'] = $date_fin;
}

$query .= " ORDER BY crv.date_visite DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$comptes_rendus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Comptes Rendus Vétérinaires</title>
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      font-size: 1rem;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    /* Formulaire de filtre */
    form label {
      font-weight: 600;
    }
    /* Tableau classique pour desktop */
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse;}
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #2A7E50; color: #fff; }/*#007bff*/ /* */
    td { font-size: 0.95rem; }
    /* Responsive : transformation du tableau en cartes pour mobile */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.95rem;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #2A7E50;/*#007bff*/
        flex-basis: 40%;
        text-align: left;
      }
    }

    th {
      background: #2A7E50!important;/* #007BFF*//**/
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <h2>Comptes Rendus Vétérinaires</h2>
    <!-- Formulaire de filtre -->
    <form method="GET" class="row g-3 align-items-end mb-4">
      <div class="col-md-4">
        <label for="animal_id" class="form-label">Animal :</label>
        <select name="animal_id" id="animal_id" class="form-select">
          <option value="">-- Tous --</option>
          <?php foreach ($animaux as $animal): ?>
            <option value="<?= $animal['id'] ?>" <?= ($animal['id'] == $animal_id) ? 'selected' : '' ?>>
              <?= htmlspecialchars($animal['prenom']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-3">
        <label for="date_debut" class="form-label">Date début :</label>
        <input type="date" name="date_debut" id="date_debut" value="<?= htmlspecialchars($date_debut) ?>" class="form-control">
      </div>
      <div class="col-md-3">
        <label for="date_fin" class="form-label">Date fin :</label>
        <input type="date" name="date_fin" id="date_fin" value="<?= htmlspecialchars($date_fin) ?>" class="form-control">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-success w-100">Filtrer</button>
      </div>
    </form>
    
    <!-- Tableau responsive --> 
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Date Visite</th>
            <th>Animal</th>
            <th>Vétérinaire</th>
            <th>État</th>
            <th>Nourriture</th>
            <th>Grammage</th>
            <th>Détails</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comptes_rendus as $crv): ?>
            <tr>
              <td data-label="Date Visite"><?= htmlspecialchars($crv['date_visite']) ?></td>
              <td data-label="Animal"><?= htmlspecialchars($crv['nom_animal']) ?></td>
              <td data-label="Vétérinaire"><?= htmlspecialchars($crv['nom_veterinaire']) ?></td>
              <td data-label="État"><?= htmlspecialchars($crv['etat_animal']) ?></td>
              <td data-label="Nourriture"><?= htmlspecialchars($crv['nourriture']) ?></td>
              <td data-label="Grammage"><?= htmlspecialchars($crv['grammage']) ?> kg</td>
              <td data-label="Détails"><?= nl2br(htmlspecialchars($crv['detail_etat'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>    
        </table>   
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
  </body>
  </html>




<!-- Version-2 -->
<!--?php
require './db.php';

// Récupération des animaux pour le filtre
$animauxQuery = $pdo->query("SELECT id, prenom FROM animaux ORDER BY prenom");
$animaux = $animauxQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupération des filtres
$animal_id = $_GET['animal_id'] ?? null;
$date_debut = $_GET['date_debut'] ?? null;
$date_fin = $_GET['date_fin'] ?? null;

// Construction dynamique de la requête
$query = "SELECT crv.*, a.prenom AS nom_animal, CONCAT(u.prenom, ' ', u.nom) AS nom_veterinaire
          FROM rapports_veterinaires crv
          JOIN animaux a ON crv.animal_id = a.id
          JOIN utilisateurs u ON crv.veterinaire_id = u.id
          WHERE u.role = 'veterinaire'";
$params = [];

if (!empty($animal_id)) {
    $query .= " AND crv.animal_id = :animal_id";
    $params['animal_id'] = $animal_id;
}

if (!empty($date_debut)) {
    $query .= " AND crv.date_visite >= :date_debut";
    $params['date_debut'] = $date_debut;
}

if (!empty($date_fin)) {
    $query .= " AND crv.date_visite <= :date_fin";
    $params['date_fin'] = $date_fin;
}

$query .= " ORDER BY crv.date_visite DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$comptes_rendus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptes Rendus Vétérinaires</title>
    <link rel="stylesheet" href="styles.css"> -->

      <!-- Bootstrap CSS -->  <!--
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      font-size: 1rem;
    }
    h2 {
      margin-top: 20px;
      text-align: center;
      color: #343a40;
    }
    /* Formulaire de filtre */
    form label {
      font-weight: 600;
    }
    /* Tableau classique pour desktop */
    .table-responsive { margin-top: 1rem; }
    table { width: 100%; border-collapse: collapse;}
    th, td { padding: 1rem; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: #fff; }
    td { font-size: 0.95rem; }
    /* Responsive : transformation du tableau en cartes pour mobile */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead { display: none; }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.95rem;
      }
      td:last-child { border-bottom: 0; }
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        flex-basis: 40%;
        text-align: left;
      }
    }
    /*thead .table-dark {
      background: #007BFF;/*
    }*/
  </style>
</head>

<body>
<div class="container py-4">
    <h2>Comptes Rendus Vétérinaires</h2>
    <form method="GET" class="row g-3 align-items-end mb-4"> --> <!-- --> <!--

    <div class="col-md-4"> --> <!-- --> <!--
        <label for="animal_id">Animal :</label> -->  <!-- --> <!--
        <select name="animal_id" class="form-select">  --> <!-- --> <!--
            <option value="">-- Tous --</option>
            <!?php foreach ($animaux as $animal): ?>
                <option value="<!?= $animal['id'] ?>" <!?= ($animal['id'] == $animal_id) ? 'selected' : '' ?>>
                    <!?= htmlspecialchars($animal['prenom']) ?>
                </option>
            <!?php endforeach; ?>
        </select>
    </div>

        <div class="col-md-3"> --> <!-- --> <!--
        <label for="date_debut">Date début :</label>
        <input type="date" name="date_debut" value="<!?= htmlspecialchars($date_debut) ?>">
        </div>

        <div class="col-md-3"> --> <!-- --> <!--
        <label for="date_fin">Date fin :</label>
        <input type="date" name="date_fin" value="<!?= htmlspecialchars($date_fin) ?>">
        </div>

        <div class="col-md-2"> --> <!-- --> <!--
        <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div> -->
    <!--</div>--> <!--
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Date Visite</th>
                <th>Animal</th>
                <th>Vétérinaire</th>
                <th>État</th>
                <th>Nourriture</th>
                <th>Grammage</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            <!?php foreach ($comptes_rendus as $crv): ?>
                <tr>
                    <td><!?= htmlspecialchars($crv['date_visite']) ?></td>
                    <td><!?= htmlspecialchars($crv['nom_animal']) ?></td>
                    <td><!?= htmlspecialchars($crv['nom_veterinaire']) ?></td>
                    <td><!?= htmlspecialchars($crv['etat_animal']) ?></td>
                    <td><!?= htmlspecialchars($crv['nourriture']) ?></td>
                    <td><!?= htmlspecialchars($crv['grammage']) ?> kg</td>
                    <td><!?= nl2br(htmlspecialchars($crv['detail_etat'])) ?></td>
                </tr>
            <!?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
</html>
