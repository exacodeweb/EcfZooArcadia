<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Habitats</title>
  <link rel="stylesheet" href="x-assets/css/styles.css">
  <link rel="stylesheet" href="x-styles.css">

  <!--=============================================================================================================-->
  <!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" media="screen">-->
  <!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" media="screen"/>-->
  <!--<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
  <!--=============================================================================================================-->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">
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

    /* Styles généraux */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    /* Contenu principal */
    h1 {
      text-align: center;
      font-size: 2.5rem;
      color: #2c3e50;
      margin: 20px 0;
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


    .habitats-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    .habitat {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      width: 300px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .habitat:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .habitat img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .habitat h3 {
      font-size: 1.2rem;
      margin: 10px 0;
      color: #333;
    }

    .btn-details {
      display: inline-block;
      margin: 15px 0;
      padding: 10px 20px;
      background-color: #2a7e50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .btn-details:hover {
      background-color: #f2a007;
    }

    /* Pied de page */
    footer {
      text-align: center;
    }

    /* Responsive */
    @media (max-width: 768px) {

      .habitats-list {
        flex-direction: column;
        gap: 15px;
      }

      .habitat {
        width: 90%;
      }
    }

    @media (min-width: 769px) and (max-width: 1200px) {
      .habitats-list {
        gap: 15px;
      }

      .habitat {
        width: 45%;
      }
    }
  </style>

</head>

<body>
  <!-- chemin relatif -->
  <?php include '../includes/header.php'; ?>

  <?php
  //include '../includes/db-connection.php';
  require_once '../config/config_unv.php'; // a testé

  // Récupérer tous les habitats
  $sql = "SELECT id, nom, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM services";
  $stmt = $pdo->query($sql);
  ?>

  <div class="habitats-list"></div>
  <h1>Liste des Services</h1>

  <div class="habitats-list">
    <?php while ($habitat = $stmt->fetch()): ?>
      <div class="habitat">
        <img src="../assets/services/<?= htmlspecialchars($habitat['image']) ?>" alt="<?= htmlspecialchars($habitat['nom']) ?>">
        <h3><?= htmlspecialchars($habitat['nom']) ?></h3>
        <a href="details-habitat.php?id=<?= $habitat['id'] ?>" class="btn-details">Voir détails</a>

        <!--<a href="manage_animaux/details-habitat.php?id=<!?= $habitat['id'] ?>" class="btn-details">Voir détails</a>-->
      </div>
    <?php endwhile; ?>
  </div>

  </section>

  <!-- MENU HAMBURGER --><!-------------------------------------------------------------------------------------------->
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
    <?php include '../includes/footer.php'; ?>
  </section>

  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->
</body>

</html>