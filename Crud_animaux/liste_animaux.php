<?php
// Inclusion du fichier de configuration pour se connecter à la base de données
require_once '../config/config_unv.php';

// Préparer la requête pour récupérer les animaux avec leur habitat associé
$stmt = $pdo->query("SELECT a.id, a.prenom, a.race, a.images, h.nom AS habitat FROM animaux a JOIN habitats h ON a.habitat_id = h.id");
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Animaux</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .animal-image {
      width: 80px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
      margin: 4px;
    }

    .table-container {
      overflow-x: auto;
    }

    .btn-action {
      display: flex;
      gap: 5px;
      height: 100%;
    }

    /* aligné les bouton */
    /*.img,*/
    td .action {
      display: flex;
      flex-direction: row;
      height: auto;
    }

    /*-- pour les boutons --*/
    .action a {
      text-decoration: none;
      padding: 6px 12px;
      margin: 5px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      gap: 8px;
    }

    .table-dark tr th {
      background-color: #2A7E50 !important;
      color: white;
    }
  </style>

  
  <style>
    @media (max-width: 768px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        border: 1px solid #ccc;
        margin-bottom: 10px;
        padding: 10px;
        background: #f8f9fa;
        /**/
      }

      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
      }

      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
      }

      .btn {
        width: 100%;
        margin-top: 5px;
      }

      /*td, .img {
        display: flex;
        flex-direction: column;
      }*/


      .d-flex,
      .action,
      a .btn {
        width: 100%;
        margin-top: 5px;
        display: flex;
        flex-direction: column;
      }

    }
  </style>


</head>

<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Animaux</h2>

  <div class="d-flex justify-content-between mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
    <a href="./ajouter_animal.php" class="btn btn-success">Ajouter un nouvel animal</a>
  </div>

  <div class="table-container">
    <table class="table table-striped table-bordered shadow text-center">
      <thead class="table-dark">
        <tr>
          <th>Prénom</th>
          <th>Espèce</th>
          <th>Images</th>
          <th>Habitat</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($animaux as $animal): ?>
          <tr>
            <td><?= htmlspecialchars($animal["prenom"]) ?></td>
            <td><?= htmlspecialchars($animal["race"]) ?></td>
            <td>
              <?php
              $images = json_decode($animal["images"], true);
              if (is_array($images)) {
                foreach ($images as $image) {
                  echo "<img src='../assets/images/$image' class='animal-image' alt='Animal image'> ";
                }
              }
              ?>
            </td>
            <td><?= htmlspecialchars($animal["habitat"]) ?></td>
            <td class="action">
              <a href="modifier_animal.php?id=<?= $animal['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer_animal.php?id=<?= $animal['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet animal ?')">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<!--?php
// Inclusion du fichier de configuration pour se connecter à la base de données
require_once '../config/config_unv.php';

// Préparer la requête pour récupérer les animaux avec leur habitat associé
$stmt = $pdo->query("SELECT a.id, a.prenom, a.race, a.images, h.nom AS habitat FROM animaux a JOIN habitats h ON a.habitat_id = h.id");
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Animaux</title>
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    .table img {
      border-radius: 8px;
      object-fit: cover;
    }

    .table th,
    .table td {
      text-align: center;
      vertical-align: middle;
    }



    /*-- pour les boutons --*/
    .action a {
      text-decoration: none;
      padding: 6px 12px !important;
      margin: 5px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      gap: 8px;
    }

    /* aligné les bouton */
    /*.img,*/
    td .action {
      display: flex;
      flex-direction: row;
      height: 100%;
    }

    /*-- pour les boutons --*/
    /*
    .action a {
      text-decoration: none;
      padding: 6px 12px !important;
      margin: 5px !important;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      gap: 8px;
    }*/


    /**/

    /*.action,
    a .btn {
      width: 50%;
      margin-top: 5px;
      display: flex;
      flex-direction: row;
    }*/

    /*.edit {
      background: #28a745;
    }
    .delete {
      background: #dc3545;
    }*/
    .actions a:hover {
      opacity: 0.8;
    }

    @media (max-width: 768px) {
      .titre {
        display: flex;
        flex-direction: column;
        width: 100%;
        text-align: center !important;
        align-items: center;
        justify-content: center;
      }

      .action,
      a .btn {
        width: 50%;
        margin-top: 5px;
        display: flex;
        flex-direction: row;

      }

      a .btn {
        justify-content: center !important;
        text-align: center !important;
        align-items: center !important;


        display: flex;
        flex-direction: column;
        width: 30% !important;
      }

      /*.section {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        align-content: center;
        width: 100%;

        border: 1px solid red;
      }*/

    }

    body {
      font-size: 1rem;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background-color: #007bff;
      color: white;
      padding: 1rem;
      text-align: left;
    }

    td {
      padding: 1rem;
      border-bottom: 1px solid #ddd;
    }

    .img-thumbnail {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }

    @media (max-width: 768px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        border: 1px solid #ccc;
        margin-bottom: 10px;
        padding: 10px;
        background: #f8f9fa;
        /**/
      }

      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
      }

      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
      }

      .btn {
        width: 100%;
        margin-top: 5px;
      }

      /*td, .img {
              display: flex;
              flex-direction: column;
            }*/


      .d-flex,
      .action,
      a .btn {
        width: 100%;
        margin-top: 5px;
        display: flex;
        flex-direction: column;
      }

    }

    /*Limité la longueur de la description*/
    /*! retours à la ligne automatiques, utilise white-space: normal; au lieu de nowrap*/
    /*.description {
      max-width: 300px; /* Limite la largeur */
    /*
      white-space: normal; /* Empêche le retour à la ligne */
    /*
      overflow: hidden; /* Cache le texte qui dépasse */
    /*
      text-overflow: ellipsis; /* Ajoute "..." à la fin si le texte est coupé */
    /*
    }*/

    .table-dark tr th {
      background-color: #2A7E50 !important;
      color: white;
    }

    a .btn {
      padding: 6px 12px !important;
      margin: 5px;
    }
  </style>
</head> ------------------------->

<!--<body>
<h2>Liste des Animaux</h2>
<table border-radius="1">--> <!---------------------------

<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Animaux</h2>

  <div class="d-flex justify-content-between mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a> ---------------------->
<!--<a href="../Crud_animaux/ajouter_animal.php" class="btn btn-success">Ajouter un nouvel animal</a> Test --> <!-------------
    <a href="./ajouter_animal.php" class="btn btn-success">Ajouter un nouvel animal</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered shadow"> 
      <thead class="table-dark"> ------------> <!-- table-dark --> <!----------------

        <tr>
          <th>Prénom</th>
          <th>Espèce</th>
          <th>Images</th>
          <th>Habitat</th>
          <th>Actions</th>
        </tr>
      </thead>
      <!?php foreach ($animaux as $animal): ?>
        <tr>
          <td><!?= htmlspecialchars($animal["prenom"]) ?></td>
          <td><!?= htmlspecialchars($animal["race"]) ?></td>
          <td>
            <!?php
            $images = json_decode($animal["images"], true);
            foreach ($images as $image) {
              echo "<img src='../assets/images/$image' width='80' height'50' class='m-1'>";
            }
            ?>
          </td>
          <td><!?= htmlspecialchars($animal["habitat"]) ?></td>
          <td>
            <a href="modifier_animal.php?id=<!?= $animal['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
            <a href="supprimer_animal.php?id=<!?= $animal['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet animal ?')">Supprimer</a>
            --------------> <!--<a href="supprimer.php?id=<!?= $animal['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</a>-->
<!-------------------</td>
        </tr>
      <!?php endforeach; ?>
    </table>  --------------------------->
<!--<a href="ajouter_animal.php">Ajouter un nouvel animal</a>--> <!-----------------
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>-->