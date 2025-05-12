<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo Arcadia_Accueil</title>
  <link rel="stylesheet" href="x./assets/css/styles.css">
  <link rel="stylesheet" href="x-----------------------------------------------./styles.css">
  <link rel="stylesheet" href="x./styles/style-avis.css"><!--<<<<<<<<<<<<<<<<-->
  <link rel="stylesheet" href="x./styles/style-avis-caroussel.css">
  <link rel="stylesheet" href="x./avis_system_controls/style.css">
  <!--<link rel="stylesheet" href="./css/style-index.css">-->

  <!-- Lien vers Bootstrap pour le style et la mise en page responsive 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->

  <!--style de police d'ecriture--><!--
  <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">-->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">

  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

  <style>
    /* ================================================*/
    /* Réinitialisation globale et valeurs par défaut */
    /*=================================================*/
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

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
    header {
      background-color: #2a7e50;
      color: white;
      padding: 10px 20px;
      /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
    }

    /* Alignement du logo et du bouton hamburger */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0px;
      /*10px 20px*/
      background-color: #2A7E50;
      /*#333*/
      color: white;
      /*whhite*/
    }

    /* Logo */
    .logo {
      height: 90px;
      /* Ajustez la taille selon votre logo */
      border-radius: 4px;
    }

    .menu-toggle {
      display: none;
      font-size: 1.8rem;
      cursor: pointer;
      /* Masquer par défaut sur les grands écrans */
    }

    /* Styles globaux */
    .nav-links {
      display: flex;
      gap: 10px;
      list-style: none;
      margin: 0px;
      padding: 0px;
      /*transition: transform 0.3s ease;*/
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
      /*#F2A007*/
    }

    /* Bouton de réservation */
    .cta-btn {
      background-color: #F3EDE0;
      color: #2A7E50;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .cta-btn:hover {
      background-color: #F3EDE0;
      color: #fff;
    }

    /* Navigation responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 24px;
        color: white;
      }

      /*------------------*/
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

      /*------------------*/

      .nav-links.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
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

    /*==========================*/
    /* Section Hero Section */
    /*==========================*/

    h1 {
      font-size: clamp(24px, 5vw, 48px) !important;
      text-align: center !important;
      margin: 1rem 0;
      line-height: 1.2;
    }

    #hero {
      background: url('./assets/images/image-resize-(7).jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #fff;
      padding: 0 1rem;
    }

    .hero-content h1 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .hero-content p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }

    .hero-buttons .btn {
      margin: 0 0.5rem;
      background: #F3EDE0;
      color: #2A7E50;
      padding: 0.8rem 1.2rem;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .hero-buttons .btn:hover {
      background: #805D3A;
      color: #fff;
    }

    .hero-content {
      background: rgba(0, 0, 0, 0.5);
      /* Fond semi-transparent */
      padding: clamp(10px, 5vw, 20px);
      /* Min 10px, Max 20px, flexible */
      border-radius: 10px;
      /* Coins arrondis */
      max-width: 90%;
      /* Empêche un débordement horizontal */
      margin: 0 auto;
      /* Centre sur l'écran */
      color: #fff;
      /* Texte lisible sur fond sombre */
    }

    /* Pour les plus petits écrans */
    @media (max-width: 400px) {
      h1 {
        font-size: 20px !important;
        /* Réduction spécifique si besoin */
      }
    }

    /* Ajustement pour les très petits écrans */
    @media (max-width: 400px) {
      .hero-content {
        padding: 10px;
        /* Réduction des marges */
        border-radius: 5px;
        /* Coins moins arrondis */
        font-size: 14px;
        /* Réduction de la taille du texte si nécessaire */
      }
    }

    /*==========================*/
    /* About Section À propos section hero*/
    /*==========================*/
    /* Section À propos */
    #about {
      padding: 2rem;
      text-align: center;
      background: #fff;

      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #about h2 {
      margin-bottom: 1rem;
      color: #2A7E50;
    }

    #about .about-image {
      margin-top: 1rem;
      width: 100%;
      max-width: 600px;
      border-radius: 10px;
    }

    /* Ajustements pour les petits écrans */
    @media (max-width: 768px) {

      #about {
        flex: 1 1 100%;
        /* Chaque carte prend toute la largeur */
        padding: 0px;
      }
    }

    /*==========================*/
    /*Habitats Section Habitats*/
    /*==========================*/
    #habitats {
      padding: 2rem;
      text-align: center;
      background: #F3EDE0;
    }

    #habitats h2 {
      margin-bottom: 2rem;
      color: #2A7E50;
    }

    .habitat-cards {
      display: flex;
      justify-content: space-around;
      gap: 1rem;
      flex-wrap: wrap;
    }

    /*-- carte images ? --*/
    .card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 1rem;
      width: 30%;
      max-width: 300px;
      text-align: center;
    }

    .card img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    .card h3 {
      color: #2A7E50;
    }

    /* Mise à jour */
    /* Uniformisation des images */
    .habitat-cards img,
    .service-card img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }

    .card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    /* Ajustements pour les petits écrans */
    @media (max-width: 768px) {

      .habitat-card,
      .service-card {
        flex: 1 1 100%;
        /* Chaque carte prend toute la largeur */
      }

      #habitats,
      #services {
        padding: 0 0.5rem;
        /* Réduction des marges pour petits écrans */
      }
    }

    /* Gestion spécifique pour les très petits écrans (307px) */
    @media (max-width: 400px) {

      .habitat-card,
      .service-card {
        padding: 0.5rem;
      }

      .habitat-card img,
      .service-card img {
        height: 150px;
        /* Réduction de la hauteur pour s'adapter */
      }
    }

    .mt-3 {
      margin-top: 15px;
    }

    /*==========================*/
    /* Habitats Section Animaux */
    /*==========================*/
    /*


    /*==========================
    /* Section Nos Services */
    /*==========================*/

    #services {
      padding: 2rem;
      background: #F3EDE0;
      text-align: center;
    }

    #services h2 {
      margin-bottom: 1.5rem;
      color: #2A7E50;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
    }

    .service-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      width: 100%;
      /* Largeur ajustée à la largeur des cards dans la section habitats 30% */
    }

    .service-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .service-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .service-card h3 {
      margin: 1rem 0;
      color: #2A7E50;
    }

    .service-card p {
      padding: 0 1rem 1rem;
      color: #555;
      font-size: 0.9rem;
    }

    /*==========================*/
    /*  Section Actualités */
    /*=========================*/

    /*-- Section Actualités */
    #news {
      padding: 2rem;
      background: #fff;
      text-align: center;
    }

    #news h2 {
      margin-bottom: 1.5rem;
      color: #2A7E50;
    }

    /*------------------------*/
    .h2 {
      color: #ffffff !important;

      margin-bottom: 8px;
    }

    /*------------------------*/

    .news-cards {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .news-card {
      background: #F3EDE0;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      padding: 1rem;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .news-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .news-card img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    .news-card,
    .eco-content img {
      opacity: 0;
      animation: fadeInUp 1s forwards;
      animation-delay: 0.3s;
    }

    .news-card:nth-child(2) {
      animation-delay: 0.5s;
    }

    /*===============================*/
    /* Section Engagement écologique */
    /*===============================*/
    #eco {
      padding: 2rem;
      background: #2A7E50;
      color: #fff;
      text-align: center;
    }

    #eco h2 {
      margin-bottom: 1.5rem;
    }

    .eco-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .eco-content img {
      width: 100%;
      max-width: 500px;
      border-radius: 10px;
    }

    .eco-content img {
      animation-delay: 0.7s;
    }

    /*==========================*/
    /* Responsive Design */
    /*==========================*/
    /* Animations au défilement */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Empilement des sections */
    @media (max-width: 768px) {

      #habitats .habitat-cards,
      #services .services-grid {
        flex-direction: column;
        align-items: center;
      }

      .card {
        width: 100%;
      }
    }

    /* Responsive section habitat*/
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

  <!-- Header -->
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

  <br>
  <!-- Section Habitat -->
  <?php
  //include 'includes/db-connection.php';
  require_once './config/config_unv.php';
  //require_once './config/database.php';

  //----------------------------------------------------
  //$config = require 'config/config.php';

  //$pdo = new PDO(
      //"mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
      //$config['db']['username'],
      //$config['db']['password'],
      //[
          //PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      //]
  //);
  //----------------------------------------------------

  // Récupérer tous les habitats
  $sql = "SELECT id, nom, description, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM habitats";
  $stmt = $pdo->query($sql);
  ?>

  <section id="habitats">
    <h2>Plongez dans nos mondes naturels</h2>
    <div class="habitat-cards">
      <?php while ($habitat = $stmt->fetch()): ?>
        <div class="card">

        <a href="./liste-habitats.php?id=<?= htmlspecialchars($habitat['id']) ?>">
          <img src="assets/images/<?= htmlspecialchars($habitat['image']) ?>" alt="<?= htmlspecialchars($habitat['nom']) ?>">
        </a>

          <!--<a href="manage_animaux/details-habita.php?id=<!?= htmlspecialchars($habitat['id']) ?>">
          <img src="assets/images/<!?= htmlspecialchars($habitat['image']) ?>" alt="<!?= htmlspecialchars($habitat['nom']) ?>">
          </a>-->

          <h3><?= htmlspecialchars($habitat['nom']) ?></h3>

          <p><?= htmlspecialchars($habitat['description']) ?></p>
        </div>
      <?php endwhile; ?>
    </div>
    <button onclick="window.location.href='./liste-habitats.php'" class="btn btn-secondary mt-3">Voir les Habitats</button><!-- Découvrir les habitats -->
  </section>

  <!-- Section Service -->
  <?php
  //include './includes/db-connection.php'; pause celui-ce etait utilisé
  //require_once __DIR__ . "/config/db-connection.php";
  //require './config/database.php';
  //require_once './config/config-test.php';

  // Récupérer tous les services
  $sql = "SELECT id, nom, description, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM services";
  $stmt = $pdo->query($sql);
  ?>

  <section id="services">
    <h2>Explorez, Voyagez, Savourez !</h2><!-- Plongez dans nos mondes naturels -->
    <div class="habitat-cards">
      <?php while ($service = $stmt->fetch()): ?>
        <div class="card">

        <a href="services.php?id=<?= htmlspecialchars($service['id']) ?>">
          <img src="./assets/services/<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['nom']) ?>">
        </a>

          <h3><?= htmlspecialchars($service['nom']) ?></h3>
        
          <p><?= htmlspecialchars($service['description']) ?></p>

        </div>
      <?php endwhile; ?>
    </div>

    <button onclick="window.location.href='./services.php'" class="btn btn-secondary mt-3">Voir les services</button>

  </section>

  <!-- Section avis -->
  <br>

  <!-- et pour afficher les avis -->
  <section id="avis">
    <h2 class="h2">Ce que nos visiteurs disent</h2>
    <div class="avis-scroll-container">
      <div class="avis-container">
        <!-- Les avis validés seront insérés ici dynamiquement --> <!-- lien du fichier API get_reviews.php -->
      </div>
    </div>
    <button onclick="window.location.href='./avis_system_test/tous-les-avis.php'" class="btn btn-primary mt-3">Voir tous les avis</button> <!-- avis.html -->
    
    <!--<button onclick="window.location.href='soumettre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>-->

    <button onclick="window.location.href='./avis_system_test/soumetre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>

    <!--<button onclick="window.location.href='./views/soumetre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>-->
   
  </section>

  <!-- Section Actualités -->
  <section id="news">
    <h2>Actualités et Événements</h2>
    <div class="news-cards">
      <div class="news-card">
        <img src="assets/images/image4.jfif" alt="Nouveau pensionnaire">
        <h3>Bienvenue à Kumba !</h3>
        <p>Notre nouvelle girafe est arrivée ! Venez la découvrir dans la savane.</p>
      </div>
      <div class="news-card">
        <img src="event2.jpg" alt="Événement">
        <h3>Événement au Zoo</h3><!-- La Nuit au Zoo -->
        <p>Participez à une visite guidée exceptionnelle. Réservation obligatoire.</p><!-- Participez à une visite guidée nocturne exceptionnelle. Réservation obligatoire. -->
      </div>
    </div>
  </section>
  <!-- Avis clients test -->

  <!-- Section Engagement écologique --> <!--
  <section id="eco">
    <h2>Nos engagements pour la planète</h2>
    <div class="eco-content">
      <p>Arcadia est fier d'être 100% indépendant énergétiquement grâce à l'énergie solaire et éolienne.</p>
      <p>Nous mettons un point d'honneur à réduire notre empreinte carbone et à sensibiliser nos visiteurs.</p>
      <img src="./public/assets/images/image10.jpg" alt="Panneaux solaires"> --> <!-- solar-panels.jpg  --> <!--
    </div>
  </section>-->

  <style>
    /*--------------------------------------------------*/

    /*--------------------------------------------------*/
  </style>

  <!-- C’est un frontend script (côté client) qui consomme une API backend (côté serveur). -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const avisContainer = document.querySelector(".avis-container");
      const avisScrollContainer = document.querySelector(".avis-scroll-container");

      function chargerAvis() {
        fetch("./get_reviews.php") //./avis_system_test // ./avis-api.php
          .then((response) => {
            if (!response.ok) {
              throw new Error("Erreur lors du chargement des avis.");
            }
            return response.json();
          })
          .then((avisData) => {
            // Ajouter dynamiquement les avis
            avisData.forEach((avis) => {
              const avisElement = document.createElement("div");
              avisElement.className = "avis";
              avisElement.innerHTML = `
              <p>“${avis.message}”</p>
              <cite>- ${avis.auteur}</cite>
            `;
              avisContainer.appendChild(avisElement);
            });

            // Dupliquer les avis pour un défilement infini
            const avisElements = Array.from(avisContainer.children);
            avisElements.forEach((avis) => {
              const clone = avis.cloneNode(true);
              avisContainer.appendChild(clone);
            });

            // Lancer le défilement automatique
            defilementAutomatique();
          })
          .catch((error) => {
            console.error(error.message);
            avisContainer.innerHTML = `
            <p>Erreur lors du chargement des avis. Veuillez réessayer plus tard.</p>
          `;
          });
      }

      function defilementAutomatique() {
        let scrollAmount = 0;
        const scrollSpeed = 1;

        function scroll() {
          scrollAmount += scrollSpeed;
          if (scrollAmount >= avisContainer.scrollWidth / 2) {
            scrollAmount = 0; // Réinitialiser pour créer une boucle
          }
          avisScrollContainer.scrollLeft = scrollAmount;
          requestAnimationFrame(scroll);
        }

        scroll();
      }

      chargerAvis();
    });
  </script>

  <!-- PERMET DE FAIRE DEFILE LE CAROUSEL AVIS --->
  <!-- pour centrée le carousel -->
  <style>
    #avis {
      padding: 20px;
      background-color: #f9f9f9;
      background-color: #2A7E50;
      text-align: center;
    }

    .avis-scroll-container {
      display: flex;
      overflow: hidden;
      white-space: nowrap;
      margin-top: 20px;
    }

    .avis-container {
      display: flex;
      gap: 20px;
      transition: transform 0.3s ease;
    }

    .avis {
      min-width: 300px;
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .avis p {
      font-size: 16px;
      line-height: 1.5;
    }

    .avis cite {
      /*display: block;
      margin-top: 10px;*/
      font-style: italic;
      /*color: #555;*/
    }

    /*-----*/
    #avis {
      max-width: 800px;
      margin: 50px auto;
      text-align: center;
    }

    .avis-scroll-container {
      overflow: hidden;
      /* Masquer la scroll-bar */
      white-space: nowrap;
      width: 100%;
      position: relative;
    }

    .avis-container {
      display: inline-flex;
      gap: 20px;
    }

    .avis {
      flex: 0 0 300px;
      /* Largeur fixe de 300px */
      max-width: 300px;
      padding: 15px;
      border: 1px solid #ddd;
      /*#ddd*/
      border-radius: 8px;
      background: #f9f9f9;
      text-align: center;
      /*left*/
      box-sizing: border-box;
    }

    .avis p {
      font-style: italic;
    }

    .avis cite {
      display: block;
      margin-top: 10px;
      font-size: 0.9em;
      color: #555;
    }
  </style>

  <!-- style pour les bouton laisser un avis "en cours de dévelop" -->
  <style>
    .btn {
      display: inline-block;
      padding: 10px 20px;
      text-align: center;
      color: #fff;
      background-color: #007bff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .btn-primary {
      background-color: #28a745;
    }

    .btn-primary:hover {
      background-color: #218838;
    }
  </style>

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

  <style>
    /*-- A retiré test --*/
    /* Responsive Design */
    @media (max-width: 768px) {

      /* Taille du texte réduite pour les petits écrans */
      #presentation h1 {
        font-size: 2rem;
      }

      #presentation p,
      section h2 {
        font-size: 1.5rem;
      }

      /* Ajustement des grilles d'images */
      .images-presentation img,
      .animal-grid img {
        max-width: 120px;
      }
    }

    @media (max-width: 576px) {

      .images-presentation img,
      .animal-grid img {
        max-width: 100px;
      }

      /* Ajustement de la taille des sections de texte */
      #presentation h1 {
        font-size: 1.5rem;
      }

      #presentation p,
      section h2 {
        font-size: 1.2rem;
      }
    }

    /* Flexbox pour aligner les images et sections de présentation */
    .images-presentation,
    .animal-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      text-align: center;
    }

    /* Suppression de l'espace par défaut autour de la page */
    .container-fluid {
      padding: 0 !important;
    }

    /* Style des images de la grille pour qu'elles s'ajustent bien sur mobile */
    .animal-grid img {
      width: 100%;
      max-width: 150px;
      margin: 5px;
    }

    @media (max-width: 576px) {

      /* Ajustement des images de présentation */
      .images-presentation img {
        width: 100%;
        max-width: 120px;
        margin: 5px;
      }

      /* Ajustement du texte dans les sections */
      h1,
      h2 {
        font-size: 1.5em;
      }
    }
  </style>

  <style>
    /* Footer styles */
    footer {
      /*background-color: #2b2b2b;*/
      background: #2c3e50;
      color: white;
      padding: 20px 10px;
      font-size: 14px;
      /*-- Ajouter Test --*/

      max-height: 100%;
      height: 100%;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      /* Pour s'assurer que le contenu se réorganise sur petits écrans */
      gap: 20px; /*espacement 20px*/
      padding: 10px 20px;
      /*-- Ajouter Test --*/
      font-size: 14px;
      /*-- Ajouter Test --*/
    }

    .footer-section {
      flex: 1;
      /* Chaque section prend une proportion égale de l'espace */
      min-width: 200px;
      /* Largeur minimale pour éviter que les sections soient trop étroites */
      padding-left: 20px;
      /*-- Ajouter Test --*/
    }

    .footer-section h4 {
      font-size: 1.2rem;
      margin-top: 0px;
      margin-bottom: 10px;
      text-transform: uppercase;
      text-align: left;
      /*-- Ajouter Test --*/

      font-weight: 500;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
      margin: 0;
      text-align: left;
      /*-- Ajouter Test --*/
    }

    .footer-section ul li {
      margin-bottom: 10px;
    }

    .footer-section ul li a {
      color: white;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
      color: #f2a007;
      /* Couleur au survol */
    }

    /*.text-center {
      padding: 24px 10px;
    }*/

    /* Responsive */
    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        /* Les sections passent en colonne sur petit écran */
        align-items: center;
        text-align: center;
      }
    }
  </style>

  <!-- Footer -->
  <section class="footer">
    <?php include './includes/footer.php'; ?>
  </section><!---->

  <!-- Scripts JavaScript nécessaires, y compris Bootstrap 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
</body>

</html>
