<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'Habitat</title>
  <link rel="stylesheet" href="x-assets/css/styles.css">
  <link rel="stylesheet" href="x-styles.css">

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

/* Global */
body {
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
  font-family: 'Barlow', sans-serif;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  font-size: 34px !important;
}

h1, h2, p {
  text-align: center;
  color: #2c3e50;
}

/* Habitat Section */
.habitat-details {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

.habitat-details p {
  font-size: 16px;
  color: #555;
}

/* Images */
.images {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  margin-top: 20px;
}

.images img {
  border-radius: 8px;
  object-fit: cover;
  width: 30%;
  max-height: 200px;
  height: 200px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Animals */
.animal-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.animal-card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  overflow: hidden;
  max-width: 230px;
  padding: 15px;
  text-align: center;

  /*width: 230px; /* même largeur partout */
}

.animal-card img {
  border-radius: 8px;

  aspect-ratio: 4 / 3;

  object-fit: cover;
  width: 100%;
  height: 150px;

  /*display: block;*/
}

.animal-card h3 {
  font-size: 18px;
  margin: 10px 0;
  color: #2c3e50;
}

.animal-card .btn {
  display: inline-block;
  padding: 10px 15px;
  background: #2A7E50;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 10px;
  font-size: 14px;
  transition: background 0.3s;
}

.animal-card .btn:hover {
  background: #F2A007;
}

/* Fil d'Ariane */
.breadcrumb-item {
  padding: 5px 0;
  margin: 0 auto 15px auto;
  text-align: center;
}

/* Responsive *//*desktop*/
@media (max-width: 1024px) {
  .images img {
    width: 45%;
  }
}
/* Responsive *//*tablette*/
@media (max-width: 768px) {
  .images img {
    width: 100%;
    height: auto;
  }

  .animal-card {
    max-width: 100%;
    width: 100%;
  }

  .animal-list {
    gap: 15px;
  }
}
/* Responsive *//*mobile*/
@media (max-width: 480px) {
  h1, h2 {
    font-size: 20px;
  }

  .habitat-details p,
  .animal-card h3 {
    font-size: 14px;
  }

  .animal-card .btn {
    font-size: 13px;
    padding: 8px 12px;
  }
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
        //echo '<a href="../manage_animaux/details-animal-test.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
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