<?php
//include 'config.php';
//include '../config/database.php';
require_once '../config/config_unv.php';

$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Services</title>
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
      background-color: #2A7E50 !important;/* #007bff*/
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

      cursor: pointer;
    }

  </style>

</head>

<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Services</h2>

  <!--<div class="d-flex justify-content-end mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
        <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a> 
    </div>-->

  <div class="d-flex justify-content-between mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
    <a href="../Crud_services/ajouter_service.php" class="btn btn-success">Ajouter un nouveau service</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered shadow">
      <thead class="table-dark"><!-- table-dark -->
        <tr>
          <th>Services</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($services as $service): ?>
          <tr>
            <td class="titre"><?= htmlspecialchars($service["nom"]) ?></td>
            <td class="img">
              <?php
              $images = json_decode($service["images"], true);
              foreach ($images as $image) {
                echo "<img src='../assets/services/$image' width='60' height='60' class='m-1'>";
              }
              ?>
            </td>
            <!--<td><!?= htmlspecialchars($service["description"]) ?></td>-->

            <td class="description" title="<?= htmlspecialchars($service['description']) ?>">
                <?= mb_substr($service['description'], 0, 100) . '...' ?>
            </td>

            <!--<section class="btn-action">-->
            <td class="action">
              <a href="modifier_service.php?id=<?= $service['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <!--<a href="./formulaire.php?id=<!?= $service['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>-->
              <!--<a href="../manage_animaux/modifier.php $service['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>-->
              <a href="supprimer_service.php?id=<?= $service['id'] ?>" onclick="return confirm('Supprimer ce service ?')" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
            <!--</section>-->
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>