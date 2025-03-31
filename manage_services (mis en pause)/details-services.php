<!DOCTYPE html>
<html lang="fr en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    /* En-tête */
    /*
header {
  background-color: #2a7e50;
  color: white;
  /*padding: 10px 20px;*/
    /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
    /*
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  max-width: 120px;
  border-radius: 5px;
}

.menu-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
}

.nav-links {
  display: flex;
  gap: 15px;
  list-style: none;
}

.nav-links a {
  text-decoration: none;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
}

.nav-links a:hover {
  background-color: #f2a007;
  color: white;
}*/
    /*-----------------------------------------------*/

    /* Global Styles */
    /*
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}*/
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

      /*font-weight: 500;*/ /*desactivé */
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
    /* Global Styles */
    /*
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }*/

    /* Header */
    /*
        header {
            background: #2c3e50;
            color: white;
            padding: 10px 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }*/

    /* Footer */
    /*
        footer {
            background: #2c3e50;
            color: white;
            padding: 20px 10px;
        }

        footer .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer ul li a {
            color: white;
            text-decoration: none;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }*/
  </style>



  <style>
    /* Styles généraux */
    /*
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
}*/

    /* En-tête */
    /*
header {
  background-color: #2a7e50;
  color: white;
  padding: 10px 20px;
  /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
    /*
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  max-width: 120px;
  border-radius: 5px;
}

.menu-toggle {
  display: none;
  font-size: 1.8rem;
  cursor: pointer;
}

.nav-links {
  display: flex;
  gap: 15px;
  list-style: none;
}

.nav-links a {
  text-decoration: none;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
}

.nav-links a:hover {
  background-color: #f2a007;
  color: white;
}*/
  </style>



  <!--<style>
/* Responsive */
@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }
}
</style>-->


  <style>
    /* Global Styles */
    /*
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}*/

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
  </style>


  <!-------------------------------------------------------- NEW STYLE -->

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
    /* Bouton hamburger */
    /*
    .menu-toggle {
      font-size: 28px;
      cursor: pointer;
      display: none;
      /* Masquer par défaut sur les grands écrans */
    /*
    }*/

    /* Lien de navigation */
    /*
    .nav-links a {
      text-decoration: none;
      color: white;
      padding: 10px;
      text-align: center;


      transition: color 0.3s ease;
      /* Transition douce pour l'effet de survol */
    /*
    }*/

    /*----*/
    /*
    .nav-links a:hover {
      color: #F3EDE0;/* #F2A007*/
    /* Couleur au survol */
    /*#007BFF*/
    /*
    }*/

    /*----*/

    /* Bouton de réservation */
    /*
    .cta-btn {
      background-color: #F3EDE0;/*, #f2a007 , #805D3A*/
    /*#007BFF*/
    /**/
    /*
      color: #2A7E50;
      /*#fff*/
    /**/
    /*
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }*/
    /*
    .cta-btn:hover {
      background-color: #805D3A;
      /*#0056b3*/
    /*#fff*/
    /*
      color: #fff;
    }*/

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

</head>
<body>

<?php include '../includes/header.php'; ?>


<?php
include '../includes/db-connection.php';

// Récupérer l'ID de l'habitat depuis l'URL
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

    // Afficher les images de l'habitat
    $images = json_decode($habitat['images']);
    echo '<div class="images">';
    foreach ($images as $image) {
        echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($habitat['nom']) . '">';
    }
    echo '</div>';
    echo '</div>';

    // Récupérer les animaux associés à cet habitat
    $sqlAnimals = "SELECT id, prenom, race, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM animaux WHERE habitat_id = ?";
    $stmtAnimals = $pdo->prepare($sqlAnimals);
    $stmtAnimals->execute([$habitatId]);

    echo '<h2>Animaux dans cet habitat</h2>';
    echo '<div class="animal-list">';
    while ($animal = $stmtAnimals->fetch()) {
        echo '<div class="animal-card">';
        echo '<img src="../assets/images/' . htmlspecialchars($animal['image']) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
        echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';
        echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="error">Habitat non trouvé.</p>';
}
?>


</body>

<section class="footer">
<?php include '../includes/footer.php';?>
</section>

</html>


<!-- 2. Modification de details-animal.php :

Ce fichier affiche les détails d'un animal spécifique, y compris ses images et les comptes rendus vétérinaires associés.

php
Copier
Modifier -->

<!--?php
include '../includes/db-connection.php';

// Récupérer l'ID de l'animal depuis l'URL
$animalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'animal
$sql = "SELECT prenom, race, images FROM animaux WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$animalId]);
$animal = $stmt->fetch();

if ($animal) {
    echo '<div class="animal-details">';
    echo '<h1>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h1>';

    // Afficher les images de l'animal
    $images = json_decode($animal['images']);
    echo '<div class="animal-images">';
    foreach ($images as $image) {
        echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
    }
    echo '</div>';
    echo '</div>';

    // Récupérer les comptes rendus vétérinaires associés à cet animal
    $sqlReports = "SELECT etat_animal, nourriture, grammage, date_visite, detail_etat FROM comptes_rendus_veterinaires WHERE animal_id = ?";
    $stmtReports = $pdo->prepare($sqlReports);
    $stmtReports->execute([$animalId]);

    echo '<h2>Comptes Rendus Vétérinaires</h2>';
    echo '<div class="reports-section">';
    while ($report = $stmtReports->fetch()) {
        echo '<div class="report-card">';
        echo '<p><strong>Date de visite :</strong> ' . htmlspecialchars($report['date_visite']) . '</p>';
        echo '<p><strong>État de l\'animal :</strong> ' . htmlspecialchars($report['etat_animal']) . '</p>';
        echo '<p><strong>Nourriture :</strong> ' . htmlspecialchars($report['nourriture']) . ' (' . htmlspecialchars($report['grammage']) . ' g)</p>';
        if (!empty($report['detail_etat'])) {
            echo '<p><strong>Détails supplémentaires :</strong> ' . htmlspecialchars($report['detail_etat']) . '</p>';
        }
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p class="error">Animal non trouvé.</p>';
}
?>