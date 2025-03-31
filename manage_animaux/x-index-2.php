<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once '../config/config_unv.php';

// Récupérer tous les animaux
$sql = "SELECT a.id, a.prenom, a.race, a.images, h.nom AS habitat_nom
        FROM animaux a
        JOIN habitats h ON a.habitat_id = h.id";
$stmt = $pdo->query($sql);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Animaux</title>
  <link rel="stylesheet" href="x../assets/css/styles.css pause">

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
      padding: 6px 12px;
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
        background: #f8f9fa;/**/
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

    /*Limité la longueur de la description*/ /*! retours à la ligne automatiques, utilise white-space: normal; au lieu de nowrap*/
    .description {
      max-width: 300px; /* Limite la largeur */
      white-space: normal; /* Empêche le retour à la ligne */
      overflow: hidden; /* Cache le texte qui dépasse */
      text-overflow: ellipsis; /* Ajoute "..." à la fin si le texte est coupé */
    }

  </style>

</head>

<body>

  <body class="container py-4">
    <h2 class="text-center mb-4">Liste des Habitats</h2>

    <!--<div class="d-flex justify-content-end mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
        <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a> 
    </div>-->

    <div class="d-flex justify-content-between mb-3">
      <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
      <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un nouvel Habitat</a>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered shadow">
        <thead class="table-dark">

          <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Race</th>
            <th>Habitat</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($animaux as $animal): ?>
            <tr>
              <td class="titre"><?= htmlspecialchars($animal['id']) ?></td>
              <td class="description"><?= htmlspecialchars($animal['prenom']) ?></td>
              <td class="description"><?= htmlspecialchars($animal['race']) ?></td>
              <td class="description"><?= htmlspecialchars($animal['habitat_nom']) ?></td>
              <td class="action">
                <a href="details.php?id=<?= $animal['id'] ?>" class="btn btn-primary btn-sm">Voir</a>
                <a href="modifier.php?id=<?= $animal['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <a href="supprimer.php?id=<?= $animal['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">Supprimer</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!--</div>-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>


  <!--<style>
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
      padding: 6px 12px;
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
        background: #f8f9fa;/**/
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

    /*Limité la longueur de la description*/ /*! retours à la ligne automatiques, utilise white-space: normal; au lieu de nowrap*/
    .description {
      max-width: 300px; /* Limite la largeur */
      white-space: normal; /* Empêche le retour à la ligne */
      overflow: hidden; /* Cache le texte qui dépasse */
      text-overflow: ellipsis; /* Ajoute "..." à la fin si le texte est coupé */
    }

  </style>

<style>
/* Conteneur principal */
.container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Table responsive */
.table-container {
    width: 100%;
    overflow-x: auto;
}

/* Tableau classique */
.animal-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

/* En-tête du tableau */
.animal-table thead {
    background-color: #333;
    color: white;
}

/* Cellules */
.animal-table th, .animal-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

/* Actions */
.action .btn {
    margin: 2px;
}

/* Boutons d'action */
.info-btn { background: #17a2b8; color: white; }
.edit-btn { background: #ffc107; color: black; }
.delete-btn { background: #dc3545; color: white; }

/* Effet hover */
.btn:hover {
    opacity: 0.8;
}

/* ✅ Mode responsive : transformation du tableau en cartes */
@media (max-width: 600px) {
    .table-container {
        display: block;
    }

    .animal-table,
    .animal-table thead,
    .animal-table tbody,
    .animal-table tr,
    .animal-table td {
        display: block;
        width: 100%;
    }

    /* On cache l'en-tête du tableau */
    .animal-table thead {
        display: none;
    }

    /* Chaque ligne devient une "carte" */
    .animal-table tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 8px;
        background: white;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    /* On affiche chaque cellule en mode bloc */
    .animal-table td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* La dernière cellule ne doit pas avoir de bordure */
    .animal-table td:last-child {
        border-bottom: none;
    }

    /* Ajout d'un pseudo-élément pour afficher le nom des colonnes */
    .animal-table td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #333;
    }

    /* Centrage des boutons */
    .action {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
    }
}

</style>-->

<!--
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
      padding: 6px 12px;
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
    .description {
      max-width: 300px;
      /* Limite la largeur */
      white-space: normal;
      /* Empêche le retour à la ligne */
      overflow: hidden;
      /* Cache le texte qui dépasse */
      text-overflow: ellipsis;
      /* Ajoute "..." à la fin si le texte est coupé */
    }
  </style>
          -->




