<?php
//include 'config.php';
//include '../config/database.php';
require_once '../config/config_unv.php';

$stmt = $pdo->query("SELECT * FROM habitats");
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Habitats</title>
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

      cursor: pointer;
    }

    .table-dark  th {
      background-color: #2A7E50 !important;
      color: white;
    }

  </style>

</head>

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
          <th>Habitats</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($habitats as $habitat): ?>
          <tr>
            <td class="titre"><?= htmlspecialchars($habitat["nom"]) ?></td>
            <td class="img">
              <?php
              $images = json_decode($habitat["images"], true);
              foreach ($images as $image) {
                echo "<img src='../assets/images/$image' width='60' height='60' class='m-1'>";
              }
              ?>
            </td>
            <!--<td><!?= htmlspecialchars($habitat["description"]) ?></td>-->
            
            <td class="description" title="<?= htmlspecialchars($habitat['description']) ?>">
                <?= mb_substr($habitat['description'], 0, 100) . '...' ?>
            </td>

            <!--<section class="btn-action">-->
            <td class="action">
              <a href="modifier_habitat.php?id=<?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer_habitat.php?id=<?= $habitat['id'] ?>" onclick="return confirm('Supprimer cet habitat ?')" class="btn btn-danger btn-sm">Supprimer</a>
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





<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Habitats</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
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
            table, thead, tbody, th, td, tr {
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
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Liste des Habitats</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Habitats</th>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($habitats as $habitat): ?>
                        <tr>
                            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
                            <td data-label="Images">
                                <!?php
                                $images = json_decode($habitat["images"], true);
                                foreach ($images as $image) {
                                    echo "<img src='../assets/images/$image' class='img-thumbnail'>";
                                }
                                ?>
                            </td>
                            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
                            <td data-label="Actions">
                                <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet habitat ?')">Supprimer</a>
                            </td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Habitats</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
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
            table, thead, tbody, th, td, tr {
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
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Liste des Habitats</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Habitats</th>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!?php foreach ($habitats as $habitat): ?>
                        <tr>
                            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
                            <td data-label="Images">
                                <!?php
                                $images = json_decode($habitat["images"], true);
                                foreach ($images as $image) {
                                    echo "<img src='../assets/images/$image' class='img-thumbnail'>";
                                }
                                ?>
                            </td>
                            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
                            <td data-label="Actions">
                                <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet habitat ?')">Supprimer</a>
                            </td>
                        </tr>
                    <!?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

                    -->


<!----------------------------------------------------------------------->

<!--?php 
include '../config/database.php';
$stmt = $pdo->query("SELECT * FROM habitats");
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Habitats</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    /* Base */
    body {
      font-size: 1rem;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 1rem;
    }
    h2 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }
    /* Tableau classique */
    .table-responsive {
      margin-top: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
      overflow: hidden;
    }
    th, td {
      padding: 1rem;
      text-align: center;
      vertical-align: middle;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #007bff;
      color: #fff;
      font-size: 1rem;
    }
    td {
      font-size: 0.9rem;
    }
    /* Images uniformisées */
    .table img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 0.5rem;
      margin: 0.25rem;
    }
    /* Boutons d'action */
    .actions a {
      text-decoration: none;
      padding: 0.5rem 1rem;/*taille des boutons*/
      margin: 0.25rem;
      border-radius: 0.5rem;
      color: #fff;
      font-weight: 600;
      display: inline-block;
      font-size: 0.9rem;
    }
    .actions a.btn-warning { background-color: #ffc107; }
    .actions a.btn-danger { background-color: #dc3545; }
    .actions a:hover { opacity: 0.8; }
    
    /* Responsive : Mode carte pour les petits écrans */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
      }
      td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
      }
      td:last-child {
        border-bottom: 0;
      }
      /* Ajout du label avant le contenu, à partir de l'attribut data-label */
      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #007bff;
        width: 40%;
        text-align: left;

        display: none;
      }
      /* Boutons en mode mobile, en pleine largeur avec un peu d'espacement */
      .actions a {
        width: 48%;
        margin: 0.25rem 1%;
      }
    }
  </style>
</head>
<body class="container py-4">
  <h2 class="text-center mb-4">Liste des Habitats</h2>
  <div class="d-flex justify-content-end mb-3">
    <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Habitats</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!?php foreach ($habitats as $habitat): ?>
          <tr>
            <td data-label="Habitats"><!?= htmlspecialchars($habitat["nom"]) ?></td>
            <td data-label="Images">
              <!?php
              $images = json_decode($habitat["images"], true);
              foreach ($images as $image) {
                echo "<img src='../assets/images/" . htmlspecialchars($image) . "' alt='Image'>";
              }
              ?>
            </td>
            <td data-label="Description"><!?= htmlspecialchars($habitat["description"]) ?></td>
            <td data-label="Actions" class="actions">
              <a href="modifier_habitat.php?id=<!?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer_habitat.php?id=<!?= $habitat['id'] ?>" onclick="return confirm('Supprimer cet habitat ?')" class="btn btn-danger btn-sm">Supprimer</a>
            </td>
          </tr>
        <!?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
        -->
<!----------------------------------------------------------------------->


