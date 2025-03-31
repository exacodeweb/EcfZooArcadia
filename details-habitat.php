<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'Habitat</title>
  <link rel="stylesheet" href="x-assets/css/styles.css">
  <link rel="stylesheet" href="x-styles.css">

  <!--=============================================================================================================-->
  <!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" media="screen">-->
  <!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" media="screen"/>-->
  <!--<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
  <!--=============================================================================================================-->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">


  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Global Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1,
    h2,
    p {
      text-align: center;
      color: #2c3e50;
    }

    /* Ajustement du texte dans les sections */
    h1,
    h2 {
      font-size: 1.5em;
    }

    h1 {
      font-size: clamp(24px, 5vw, 48px) !important;
      /* Min 24px, Max 48px */
      text-align: center !important;
      margin: 1rem 0;
      line-height: 1.2;
      /*color: #ffff;*/
      /*font-weight: 500;*/
      /*desactivé */
    }

    /* Habitat Details Section */
    .habitat-details {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .habitat-details p {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
    }

    /* Images Section */
    .images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }

    .images img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-height: 200px;
      /* ajouter par moi */
      height: 200px;
      object-fit: cover;
      width: 30%;
    }

    /* Animal List Section */
    .animal-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .animal-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 200px;
      text-align: center;
      padding: 15px;
    }

    .animal-card img {
      /*width: 100%;*/
      border-radius: 8px;
      /*height: auto;*/
      max-height: 150px;

      /* ajouter par moi */
      height: 150px;
      object-fit: cover;
      /*width: 100%;*/
      max-width: 200px;
      width: 200px;
    }

    .animal-card h3 {
      font-size: 18px;
      margin: 10px 0;
      color: #2c3e50;
    }

    .animal-card .btn {
      display: inline-block;
      padding: 10px 15px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
      font-size: 14px;
    }

    .animal-card .btn:hover {
      background: #2980b9;
    }

    /* Error Message */
    .error {
      text-align: center;
      color: #e74c3c;
      font-size: 18px;
    }

    /*-- Responsive --*/
    @media (max-width: 768px) {
      .images {
        display: flex;
        flex-direction: column;
      }

      .images img {
        max-width: 500px !important;
        width: 100% !important;
      }

      .animal-card {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        width: 100%;
      }

      .img {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        width: 100% !important;
      }
    }
  </style>



  <style>
    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h1,
    h2,
    p {
      text-align: center;
      color: #2c3e50;
    }

    /* Habitat Details Section */
    .habitat-details {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .habitat-details p {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
    }

    /* Images Section */
    .images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-top: 20px;
    }

    .images img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-height: 200px;
      /* ajouter par moi */
      height: 200px;
      object-fit: cover;
      width: 30%;
    }

    /* Animal List Section */
    .animal-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      /*20px*/
      justify-content: center;
    }

    .animal-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 230px;
      text-align: center;
      padding: 15px;
    }

    .animal-card img {
      /*width: 100%;*/
      border-radius: 8px;
      /*height: auto;*/
      max-height: 150px;

      /* ajouter par moi */
      height: 150px;
      object-fit: cover;
      /*width: 100%;*/
      max-width: 200px;
      width: 200px;

    }

    .animal-card h3 {
      font-size: 18px;
      margin: 10px 0;
      color: #2c3e50;
    }

    .animal-card .btn {
      display: inline-block;
      padding: 10px 15px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
      font-size: 14px;
    }

    /*.btn {
    height: 42px;
    width: 140px;
    }*/

    .animal-card .btn:hover {
      background: #2980b9;
    }

    /* Error Message */
    .error {
      text-align: center;
      color: #e74c3c;
      font-size: 18px;
    }

    /*.action {
      display: flex;
      flex-direction: row;
      width: 100%;
      gap: 8px;
      padding: 0px;
    }*/

    /*-- Responsive --*/
    @media (max-width: 768px) {
      .images {
        display: flex;
        flex-direction: column;
      }

      .images img {
        max-width: 500px !important;
        width: 100% !important;
      }

      .animal-card {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        width: 100%;
      }

      .img {
        display: flex;
        flex-direction: column;
        max-width: 500px;
        width: 100% !important;
      }
    }
  </style>

  <!-- NEW STYLE -->
  <style>
    /* Menu toggle */
    @media (max-width: 768px) {

      .nav-links {
        /*position: absolute;*/
        background-color: #2A7E50;
        /*width: 100%;*/
        /*top: 70px;*/
        left: 0;
      }

      .nav-links li {
        margin: 0.5rem 0;
        /*0.5rem*/
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {

      .nav-links.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        color: white;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .nav-links {
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        background-color: rgba(0, 0, 0, 0.8);
        /*background-color: #2A7E50;*/
        position: absolute;
        top: 107px;
        /*70px*/
        /* Ajustez selon la hauteur du header */
        right: 0;
        width: 100%;
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
      }
    }
  </style>

  <style>
    /* Menu toggle */
    @media (max-width: 768px) {

      .nav-links {
        /*position: absolute;*/
        background-color: #2A7E50;
        /*width: 100%;*/
        /*top: 70px;*/
        left: 0;
      }

      .nav-links li {
        margin: 0.5rem 0;
        /*0.5rem*/
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {

      .nav-links.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        color: white;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .nav-links {
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
      }
    }

    /* Navigation responsive */
    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        background-color: rgba(0, 0, 0, 0.8);
        /*background-color: #2A7E50;*/
        position: absolute;
        top: 107px;
        /*70px*/
        /* Ajustez selon la hauteur du header */
        right: 0;
        width: 100%;
        transform: translateY(-100%);
        opacity: 0;
        visibility: hidden;
      }
    }
  </style>

  <style>
    /*-- FIL D'ARIANE --*/
    .breadcrumb-item {
      width: 100%;
      background: none;
      margin-left: 0px;
      margin-top: 0px;
      margin-bottom: 0px;
      /*rajouter en option*/
      display: block;
      flex-direction: row;
      align-content: center;
      align-items: center;
      padding: 5px;
    }
  </style>

</head>

<body>

  <?php include './includes/header.php'; ?>

  <!--FIL D'ARIANE-->
  <div class="breadcrumb-item">
    <a href="../index.php" class="link-rep">Accueil</a> /
    <a href="./liste-habitats.php" class="link-rep">Habitats</a> / Détails
  </div>

  <div class="container">
    <?php
    //include 'includes/db-connection.php';
    require_once './config/config_unv.php';
    //require './config/database.php';

    // Récupérer l'ID depuis l'URL
    $habitatId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Récupérer les détails de l'habitat
    $sql = "SELECT nom, description, images FROM habitats WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$habitatId]);
    $habitat = $stmt->fetch();

    if ($habitat) {
      echo '<div class="habitat-details">';
      echo '<h1>' . htmlspecialchars($habitat['nom']) . '</h1>';
      echo '<p>' . htmlspecialchars($habitat['description']) . '</p>';

      // Afficher les images
      $images = json_decode($habitat['images']);
      echo '<div class="images">';
      foreach ($images as $image) {
        echo '<img src="assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($habitat['nom']) . '">';
      }

      echo '</div>';
      echo '</div>';

      // Afficher les animaux associés
      echo '<h2>Animaux dans cet habitat</h2>';
      $sqlAnimals = "SELECT id, prenom, race, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM animaux WHERE habitat_id = ?";
      $stmtAnimals = $pdo->prepare($sqlAnimals);
      $stmtAnimals->execute([$habitatId]);

      echo '<div class="animal-list">';
      while ($animal = $stmtAnimals->fetch()) {
        echo '<div class="animal-card">';
        echo '<img src="assets/images/' . $animal['image'] . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
        echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';

        echo '<div class="action">';
        echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
        // Test
        echo '<a href="../manage_animaux/details-animal-test.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
        echo '</div>';

        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<p class="error">Habitat non trouvé.</p>';
    }
    ?>
  </div>

  <!-- MENU HAMBURGER -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const menuToggle = document.getElementById('menuToggle');
      const navLinks = document.getElementById('navLinks');

      menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('show');
      });
    });
  </script>

  <section class="footer">
    <?php include './includes/footer.php'; ?>
  </section>

</body>

</html>