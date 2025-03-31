<!--?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  header("Location: ../config/login.php");
  exit;
}

//require_once('../public/utilise.php'); // Connexion à la base de données
require_once '../config/config_unv.php';

// Récupérer tous les employés
$sql = "SELECT * FROM utilisateurs WHERE role != 'admin'"; // Exclure l'admin
$stmt = $pdo->prepare($sql);
$stmt->execute();
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des employés</title> ----------------->

  <!--<link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">-->

  <!-- Ajoutez les styles de typographie ici -->  <!-------------------
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">  -------------------------->

  <!-- Import des polices -->  <!---------------------
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">  ---------------->

  <!-- <link rel="stylesheet" href="../assets/style.css"> --> <!-- Ajout CSS -->   <!--

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    /* Styles généraux */
    /*body {
      font-family: Arial, sans-serif;
      background-color: #F5F5DC;/*#f8f9fa*/
    /*
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      /*justify-content: center;*/
    /*
      align-items: center;
      /*border: 1px solid red;*/
    /*
    }*/

    body {
      background: beige;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      /* Évite les marges par défaut du body */
    }

    /* Conteneur principal */
    .container {
      display: flex;
      flex-direction: column;
      /*justify-content: center; */
      /*border: 1px solid red;*/
    }

    /*.container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      
        max-width: 100%;
        width: 90%;
        background: #ffffff;
        /*border: 1px solid red;*/
    /*

        padding: 20px; 
      }*/

    .content {
      /*max-width: 1000px;*/
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 100%;
      width: 90%;
      /*border: dashed orange 8px;*/
    }

    /* Titres */
    h2 {
      color: #343a40;
      text-align: center;
      margin-bottom: 20px;
    }

    /* Bouton ajouter */
    .btn-success {
      font-weight: bold;
      border-radius: 5px;
    }

    /* Table */
    .table {
      margin-top: 10px;
      border-collapse: collapse;
      width: 100%;
      background: white;
    }

    .table th {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 10px;
    }

    .table,
    td {
      padding: 2px;
      /*10px*/
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }

    td th {
      border-collapse: collapse !important;
    }

    /* Actions *//*
    .btn-sm {
      margin-right: 5px;
    }*/

    /*-- pour les boutons --*//*
    .action a {
      text-decoration: none;
      padding: 6px 12px;
      margin: 5px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      gap: 8px;


    }*/

    /* aligné les bouton */
    /*.img,*//*
    td .action {
      display: flex;
      flex-direction: row;
      height: 100%;
    }*/


    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }

      .table-responsive {
        overflow-x: auto;
      }

      .btn-sm {
        display: block;
        margin-bottom: 5px;
      }
    }

    table tr td,
    th {
      border: 1px solid black;

    }

    th {
      background: #2A7E50;/*lightgrey*/
      color: white;
      text-align: center;
      height: 40px;
    }

    header {
      background-color: #2A7E50;/*#007bff*/
      color: white;
      padding: 0.5rem 0;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    header h1 {
      font-size: 1.5rem;
    }

    header a {
      background-color: white;
      color: #007bff;
      padding: 0.5rem 1rem;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    header a:hover {
      background-color: #e9ecef;
    }
  </style>

<style>



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
    td .action  {
      display: flex;
      flex-direction: row;
      height: 100%;

     align-items: center ;
     align-content: center;
      justify-content: center !important;
    }


</style>


</head>

<body>
  <section class="content">
    <div class="container">

      <h2>Liste des employés</h2>  ---------------------->

      <!--<header>
        <div class="container">
          <a href="./ajouter.php">Ajouter un employé</a> --> <!-- ➕  --><!--
        </div>
      </header>-->  <!--------------------

      <div class="d-flex justify-content-between mb-3">
        <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
        <a href="./ajouter.php" class="btn btn-success">Ajouter un nouvel employe</a>
      </div>

      <table border-radius="1" class="table-bordered table-hover"> --------------------> <!-- border --> <!-------------
        <tr>  ------------------>
          <!--<th>ID</th>-->   <!------------------------
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Actions</th>
        </tr>
        <!?php foreach ($employes as $employe): ?>
          <tr>        ----------------------->
            <!--<td><!?= $employe['id'] ?></td>--> <!--------------------------
            <td><!?= htmlspecialchars($employe['nom']) ?></td>
            <td><!?= htmlspecialchars($employe['prenom']) ?></td>
            <td><!?= htmlspecialchars($employe['email']) ?></td>
            <td><!?= htmlspecialchars($employe['role']) ?></td>
            <td class="action"> --------------------->
              <!--<a href="modifier.php?id=<!?= $employe['id'] ?>">✏️ Modifier</a>--> <!---------------------
              <a href="./modifier.php?id=<<!?= $employe['id'] ?>" class="btn btn-warning btn-sm">✏️ Modifier</a> ------------>
              <!--<a href="supprimer.php?id=<!?= $employe['id'] ?>" onclick="return confirm('Supprimer cet employé ?');">🗑 Supprimer</a>-->
              <!---------------<a href="./supprimer.php?id=<!?= $employe['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet employé ?');">🗑 Supprimer</a>
            </td>
          </tr>
        <!?php endforeach; ?>
      </table>

    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>-->





























<?php
//include 'config.php';
//include '../config/database.php';
require_once '../config/config_unv.php';

$stmt = $pdo->query("SELECT * FROM utilisateurs");//habitats
$habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Employer</title><!-- Liste des Habitats -->
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
  <h2 class="text-center mb-4">Liste des Employé</h2>

  <!--<div class="d-flex justify-content-end mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
        <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a> 
    </div>-->

  <div class="d-flex justify-content-between mb-3">
    <a href="../pages/admin_dashboard.php" class="btn btn-secondary">⬅ Retour</a>
    <a href="./ajouter.php" class="btn btn-success">Ajouter un nouvel Employé</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered shadow">
      <thead class="table-dark">
        <tr>
          <!--<th>Habitats</th>
          <th>Images</th>
          <th>Description</th>
          <th>Actions</th>-->

          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($habitats as $habitat): ?>
          <tr>
            <td class="titre"><?= htmlspecialchars($habitat["nom"]) ?></td>
            <td class="titre"><?= htmlspecialchars($habitat["prenom"]) ?></td>
            <td class="titre"><?= htmlspecialchars($habitat["email"]) ?></td>
            <td class="titre"><?= htmlspecialchars($habitat["role"]) ?></td>

            <!--<section class="btn-action">-->
            <td class="action">
              <a href="modifier.php?id=<?= $habitat['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
              <a href="supprimer.php?id=<?= $habitat['id'] ?>" onclick="return confirm('Supprimer cet habitat ?')" class="btn btn-danger btn-sm">Supprimer</a>
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


































