<?php require_once './includes/config_unv.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon site</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/media.css">
</head>
<body>
  <?php include './includes/header.php'; ?>

  <!-- Section Héros -->
  <section id="hero"><!--   id="index-1" -->
    <div class="hero-content">
      <h1>Bienvenue à Arcadia</h1>
      <p>Explorez un lieu où nature et bien-être animal cohabitent en harmonie.</p>
      <div class="hero-buttons">
        <!--<a href="#habitats" class="btn">Découvrir les habitats</a>-->
        <a href="#services" class="btn">Voir les horaires</a>
      </div>
    </div>
  </section>

  <!-- Section À propos -->
  <section id="about">
    <h2>Arcadia, un zoo engagé pour la planète</h2>

    <img src="./assets/images/Forest wallpaper midday.jpg" alt="Forêt de Brocéliande" class="about-image mb-5"><!-- forest.jpg -->
    <p class="mt-5">Depuis 1960, nous nous engageons à protéger la biodiversité et à offrir un habitat naturel à nos animaux.</p>
  </section>

  <?php
    $sql = "SELECT * FROM habitats ORDER BY id DESC LIMIT 3";
    $stmt = $pdo->query($sql);
  ?>
  <!--<section id="habitats">
    <!?php while ($habitat = $stmt->fetch()) : ?>
      <div class="habitat-card">
        <img src="<!?= $habitat['image_path']; ?>" alt="Image"> -->

        <!--<img src="assets/images/<!?= htmlspecialchars($habitat['image']) ?>" alt="<!?= htmlspecialchars($habitat['nom']) ?>">-->
        <!--
        <h3><!?= $habitat['nom']; ?></h3>--><!--Titre--> <!--
        <p><!?= $habitat['description']; ?></p>
      </div>
    <!?php endwhile; ?>
  </section>-->

<?php
require_once './includes/config_unv.php';
  // Récupérer tous les habitats
  $sql = "SELECT id, nom, description, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM habitats";
  $stmt = $pdo->query($sql);
  ?> 

  <section id="habitats">
    <h2>Plongez dans nos mondes naturels</h2>
    <div class="habitat-cards">
      <?php while ($habitat = $stmt->fetch()): ?>
        <div class="card">
        <a href="../liste-habitats.php?id=<?= htmlspecialchars($habitat['id']) ?>">
          <img src="assets/images/<?= htmlspecialchars($habitat['image']) ?>" alt="<?= htmlspecialchars($habitat['nom']) ?>">
        </a>
          <h3><?= htmlspecialchars($habitat['nom']) ?></h3>
          <p><?= htmlspecialchars($habitat['description']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>
    <button onclick="window.location.href='../liste-habitats.php'" class="btn btn-secondary mt-3">Voir les Habitats</button><!-- Découvrir les habitats -->
  </section>


  <?php
    $sql = "SELECT * FROM services ORDER BY id ASC LIMIT 3";
    $stmt = $pdo->query($sql);
  ?>
  <section id="services"> <!--... -->

  <?php
  // Récupérer tous les services
  $sql = "SELECT id, nom, description, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM services";
  $stmt = $pdo->query($sql);
  ?>
  <section id="services">
    <h2>Explorez, Voyagez, Savourez !</h2><!-- Plongez dans nos mondes naturels -->
    <div class="habitat-cards">
      <?php while ($service = $stmt->fetch()): ?>
        <div class="card">
        <a href="../services.php?id=<?= htmlspecialchars($service['id']) ?>">
          <img src="../assets/services/<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['nom']) ?>">
        </a>
          <h3><?= htmlspecialchars($service['nom']) ?></h3>
          <p><?= htmlspecialchars($service['description']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>
    <button onclick="window.location.href='../services.php'" class="btn btn-secondary mt-3">Voir les services</button>
  </section>
  </section>

  <!--<section id="avis">
    <div id="avis-container">Chargement des avis...</div>
  </section>-->
  <!-- et pour afficher les avis -->
  <section id="avis">
    <h2 class="h2">Ce que nos visiteurs disent</h2>
    <div class="avis-scroll-container">
      <div class="avis-container">
      </div>
       <!-- Les avis validés seront insérés ici dynamiquement --> <!-- lien du fichier API get_reviews.php -->
      </div>
    <button onclick="window.location.href='../avis_system_test/tous-les-avis.php'" class="btn btn-primary mt-3">Voir tous les avis</button>
    <button onclick="window.location.href='../avis_system_test/formulaire-avis.php'" class="btn btn-secondary mt-3">Laisser un avis</button>
  </section>


  <!--<section id="news"> ... </section>-->
<!-- Section Actualités -->
<section id="news">
    <h2>Actualités et Événements</h2>
    <div class="news-cards">
      <div class="news-card">
        <img src="./assets/images/image4.jfif" alt="Nouveau pensionnaire">
        <h3>Bienvenue à Kumba !</h3>
        <p>Notre nouvelle girafe est arrivée ! Venez la découvrir dans la savane.</p>
      </div>
      <div class="news-card">
        <img src="./assets/images/event2.jpg" alt="Événement">
        <h3>Événement au Zoo</h3><!-- La Nuit au Zoo -->
        <p>Participez à une visite guidée exceptionnelle. Réservation obligatoire.</p><!-- Participez à une visite guidée nocturne exceptionnelle. Réservation obligatoire. -->
      </div>
    </div>
  </section>

  <?php include './includes/footer.php'; ?>
  <script src="js/avis.js"></script>
</body>
</html>
