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

    body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
}

/* En-tête *//*
header {
  background-color: #2a7e50;
  color: white;
  /*padding: 10px 20px;*/
  /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*//*
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

    /* Global Styles *//*
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

h1, h2, p {
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

.animal-card  {
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
        /* Global Styles *//*
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }*/

        /* Header *//*
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

        /* Footer *//*
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
  /* Styles généraux *//*
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
}*/

/* En-tête *//*
header {
  background-color: #2a7e50;
  color: white;
  padding: 10px 20px;
  /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*//*
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
      /* Global Styles *//*
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

h1, h2, p {
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
    gap: 20px;
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

.animal-card  {
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

    /* Bouton hamburger *//*
    .menu-toggle {
      font-size: 28px;
      cursor: pointer;
      display: none;
      /* Masquer par défaut sur les grands écrans *//*
    }*/

    /* Lien de navigation *//*
    .nav-links a {
      text-decoration: none;
      color: white;
      padding: 10px;
      text-align: center;


      transition: color 0.3s ease;
      /* Transition douce pour l'effet de survol *//*
    }*/

    /*----*//*
    .nav-links a:hover {
      color: #F3EDE0;/* #F2A007*/
      /* Couleur au survol */
      /*#007BFF*//*
    }*/

    /*----*/

    /* Bouton de réservation *//*
    .cta-btn {
      background-color: #F3EDE0;/*, #f2a007 , #805D3A*/
      /*#007BFF*/
      /**//*
      color: #2A7E50;
      /*#fff*/
      /**//*
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }*/
/*
    .cta-btn:hover {
      background-color: #805D3A;
      /*#0056b3*/
      /*#fff*//*
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

    <!-- Header --><!--
    <header>
        <div class="container">
            <h1>Parc des Habitats</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="habitats.php">Habitats</a></li>
                    <li><a href="animaux.php">Animaux</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>-->


    <!--<header>
    <nav class="navbar">
      <img src="./assets/logos/ZOO_ARCADIA.jpg" alt="Logo Zoo Arcadia" class="logo">--><!-- ../public/assets/images/Logo-Arcadia-(9).jpg -->
      <!-- Bouton Hamburger --><!--
      <span class="menu-toggle" id="menuToggle">☰</span>

      <ul class="nav-links" id="navLinks">
        <li><a href="#hero">Accueil</a></li>
        <li><a href="#habitats">Habitats</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">À propos</a></li>
        <li><a href="./public/contact/contact.html">Contact</a></li>--><!-- #contact -->

        <!-- Lien pour l'accès administrateur -->
        <!--<div class="Navbar__Link">
            <a class="nav-link nav-admin-link" href="./public/login.php" title="Admin">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="-49 141 512 512" width="16" height="16" aria-hidden="true"
                fill="currentColor" class="bi bi-unlock-fill">
                <path d="M423 638H-9c-13.807 0-25-11.193-25-25 0-53.438 17.131-104.058 49.542-146.388 22.2-28.994 50.961-52.656 83.376-69.006C75.53 371.377 62 337.07 62 301c0-79.953 65.047-145 145-145s145 65.047 145 145c0 36.07-13.53 70.377-36.918 96.606 32.416 16.349 61.177 40.012 83.376 69.005C430.869 508.942 448 559.562 448 613c0 13.807-11.193 25-25 25zM17.657 588h378.687c-9.908-74.383-63.38-137.724-136.792-158.682a25 25 0 0 1-5.533-45.75C283.615 366.669 302 335.03 302 301c0-52.383-42.617-95-95-95s-95 42.617-95 95c0 34.03 18.386 65.668 47.981 82.568a25.003 25.003 0 0 1 12.423 24.712 25.003 25.003 0 0 1-17.956 21.038C81.037 450.276 27.564 513.617 17.657 588z"></path>
              </svg>
            </a>
          </div>--><!--

        <li><a href="./public/login.php">Connexion</a></li>
        <li><a href="#reservation" class="cta-btn">Réserver</a></li>
      </ul>
    </nav>
  </header>-->


    <!-- Main Content --> <!--
    <div class="container">
        <!?php
        include 'includes/db-connection.php';

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
                echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">Habitat non trouvé.</p>';
        }
        ?>
    </div>-->


      <!--------------------------------------------------------------------------------------->
      <div class="container">
        <?php
        //include '../includes/db-connection.php';
        require_once '../config/config_unv.php'; // a testé

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
                echo '<img src="../assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($habitat['nom']) . '">';             
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
                echo '<img src="../assets/images/' . $animal['image'] . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
                echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';
                echo '<a href="./details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">Habitat non trouvé.</p>';
        }
        ?>
    </div>
      <!--------------------------------------------------------------------------------------->


    <!-- Footer --><!--
    <footer>
        <div class="footer-container">
            <div>
                <h4>Contact</h4>
                <ul>
                    <li><a href="mailto:info@parc.com">info@parc.com</a></li>
                    <li>Téléphone : +33 1 23 45 67 89</li>
                    <li>Adresse : 123 Rue de la Nature</li>
                </ul>
            </div>
            <div>
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="habitats.php">Habitats</a></li>
                    <li><a href="animaux.php">Animaux</a></li>
                </ul>
            </div>
        </div>
    </footer>-->

    <!--<style>
  /* Footer styles */
footer {
  /*background-color: #2b2b2b;*/
  background: #2c3e50;
  color: white;
  padding: 20px 10px;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap; /* Pour s'assurer que le contenu se réorganise sur petits écrans */
  gap: 20px;

  padding: 10px 20px;
}

.footer-section {
  flex: 1; /* Chaque section prend une proportion égale de l'espace */
  min-width: 200px; /* Largeur minimale pour éviter que les sections soient trop étroites */

  padding-left: 20px;
}

.footer-section h4 {
  font-size: 1.2rem;
  margin-bottom: 10px;
  text-transform: uppercase;

  text-align: left;
}

.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;

  text-align: left;
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
  color: #f2a007; /* Couleur au survol */
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column; /* Les sections passent en colonne sur petit écran */
    align-items: center;
    text-align: center;
  }
}
</style>-->

   <!-- <footer>
    <div> -->
          <!--<p>&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
        </class=>--> <!--
        <div class="footer-container"> -->

    <!-- Section 1 --> <!--
    <div class="footer-section">
      <h4>Contact</h4>
      <ul>
        <li><a href="tel:+33123456789">Téléphone : +33 1 23 45 67 89</a></li>
        <li><a href="mailto:info@arcadia.com">Email : info@arcadia.com</a></li>
        <li>Adresse : 123 Rue de la Nature, 75000 Paris</li>
      </ul>
    </div> -->

    <!-- Section 2 --> <!--
    <div class="footer-section">
      <h4>Liens rapides</h4>
      <ul>
        <li><a href="#hero">Accueil</a></li>
        <li><a href="#habitats">Habitats</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div> -->

    <!-- Section 3 --> <!--
    <div class="footer-section">
      <h4>Réseaux sociaux</h4>
      <ul>
        <li><a href="https://www.facebook.com">Facebook</a></li>
        <li><a href="https://www.twitter.com">Twitter</a></li>
        <li><a href="https://www.instagram.com">Instagram</a></li>
        <li><a href="https://www.linkedin.com">LinkedIn</a></li>
      </ul>
    </div>
        </div>



  <footer class="text-center py-4">
    <p>&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
  </footer> -->

    <!-- Pied de page --><!--
  <footer class="eco-content">
    <p>© 2024 Zoo Arcadia - Tous droits réservés. | <a href="#">Mentions légales</a></p>
  </footer>
  
    </div>
</footer>-->




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
<?php include '../includes/footer.php';?>
</section>


</body>
</html>












<!--?php
 include 'includes/db-connection.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Habitat non trouvé.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'habitat</title>   -->
<!--<link rel="stylesheet" href="assets/css/styles.css">--> <!--
    <link rel="stylesheet" href="./zoo_system/assets/css/style.css">
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const habitatId = <!?= json_encode($id) ?>;
            //fetch(`api/get-habitat-details.php?id=${habitatId}`)
            fetch('./zoo_system/get-habitat.php?id=${habitatId}')
                .then(response => response.json())
                .then(data => {
                    document.querySelector("h1").textContent = data.nom;
                    document.querySelector(".description").textContent = data.description;

                    const animalsList = document.querySelector(".animals-list");
                    data.animaux.forEach(animal => {
                        const div = document.createElement("div");
                        div.className = "animal";
                        div.innerHTML = `
                            <img src="./assets/images/${animal.image}" alt="${animal.prenom}">
                            <h3>${animal.prenom} (${animal.race})</h3>
                            <a href="details-animal.php?id=${animal.id}">Voir détails</a>
                        `;
                        animalsList.appendChild(div);
                    });
                });
        });
    </script>
</head>
<body>
    <h1>Chargement...</h1>
    <p class="description"></p>
    <div class="animals-list"></div>

</body>
</html> -->

<!-- version 2 -->
<!--?php

include 'includes/db-connection.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Habitat non trouvé.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'habitat</title>  
    <link rel="stylesheet" href="./zoo_system/assets/css/style.css">

    <style>

/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Heading and Description */
h1 {
    text-align: center;
    color: #2c3e50;
    font-size: 2em;
    margin-bottom: 10px;
}

.description {
    text-align: center;
    font-size: 1.2em;
    color: #555;
    margin-bottom: 20px;
}

/* Animals List */
.animals-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

.animal-card {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    text-align: center;
    padding: 15px;
    max-width: 200px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.animal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.animal-card img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.animal-card h3 {
    font-size: 1.1em;
    color: #2c3e50;
    margin-bottom: 10px;
}

.animal-card .btn {
    display: inline-block;
    padding: 8px 12px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 0.9em;
    transition: background 0.2s;
}

.animal-card .btn:hover {
    background: #2980b9;
}

/* Error Message */
.error {
    text-align: center;
    color: #e74c3c;
    font-size: 1.2em;
    margin-top: 20px;
}
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const habitatId = <-?= json_encode($id) ?>;
            fetch('./zoo_system/get-habitat.php?id=' + habitatId)
                .then(response => response.json())
                .then(data => {
                    document.querySelector("h1").textContent = data.nom;
                    document.querySelector(".description").textContent = data.description;

                    const animalsList = document.querySelector(".animals-list");
                    data.animaux.forEach(animal => {
                        const div = document.createElement("div");
                        div.className = "animal-card";
                        div.innerHTML = `
                            <img src="./assets/images/${animal.image}" alt="${animal.prenom}">
                            <h3>${animal.prenom} (${animal.race})</h3>
                            <a href="details-animal.php?id=${animal.id}" class="btn">Voir détails</a>
                        `;
                        animalsList.appendChild(div);
                    });
                })
                .catch(error => {
                    document.querySelector(".error").textContent = "Impossible de charger les données.";
                });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Chargement...</h1>
        <p class="description"></p>
        <div class="animals-list"></div>
        <p class="error"></p>
    </div>
</body>
</html> -->

<!-------------------------------------------------------------------------------- version 3 -->
<!--?php
include 'includes/db-connection.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("Habitat non trouvé.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'habitat</title>
  <link rel="stylesheet" href="./zoo_system/assets/css/style.css">  -->


  <!---------------------------------------------------------->
  <!--------------------------------------------------------------- <style>
    /* Global Styles */ /*
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }*/

    /* Heading and Description *//*
    h1 {
      text-align: center;
      color: #2c3e50;
      font-size: 2em;
      margin-bottom: 10px;
    }

    .description {
      text-align: center;
      font-size: 1.2em;
      color: #555;
      margin-bottom: 20px;
    }*/

    /* Animals List 
    .animals-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-top: 20px;
    }

    .animal-card {
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      text-align: center;
      padding: 15px;
      max-width: 200px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .animal-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .animal-card img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .animal-card h3 {
      font-size: 1.1em;
      color: #2c3e50;
      margin-bottom: 10px;
    }*/
/*------------------------------------------------------------------------------
    .animal-card .btn {
      display: inline-block;
      padding: 8px 12px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-size: 0.9em;
      transition: background 0.2s;
    }

    .animal-card .btn:hover {
      background: #2980b9;
    }

    /* Error Message */
    .error {
      text-align: center;
      color: #e74c3c;
      font-size: 1.2em;
      margin-top: 20px;
    }
  </style> -->
  <!---------------------------------------------------------->

<!--

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const habitatId = <!?= json_encode($id) ?>;

      // Requête pour obtenir les détails de l'habitat
      fetch(`../zoo_system/api/get-habitat-details.php?id=${habitatId}`)
        .then(response => response.json())
        .then(data => {
          if (!data) {
            document.querySelector(".error").textContent = "Habitat non trouvé.";
            return;
          }

          // Affichage des détails de l'habitat
          document.querySelector("h1").textContent = data.nom;
          document.querySelector(".description").textContent = data.description;

          // Affichage des animaux associés
          const animalsList = document.querySelector(".animals-list");
          data.animaux.forEach(animal => {
            const div = document.createElement("div");
            div.className = "animal-card";
            div.innerHTML = `
                            <img src="./assets/images/${animal.image}" alt="${animal.prenom}" onerror="this.src='./assets/images/placeholder.jpg';">
                            <h3>${animal.prenom} (${animal.race})</h3>
                            <a href="details-animal.php?id=${animal.id}" class="btn">Voir détails</a>
                        `;
            animalsList.appendChild(div);
          });
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des données :", error);
          document.querySelector(".error").textContent = "Impossible de charger les données.";
        });
    });
  </script>
</head>

<body>
  <div class="container">
    <h1>Chargement...</h1>
    <p class="description"></p>
    <div class="animals-list"></div>
    <p class="error"></p>
  </div>
</body>

</html>-->






<!--------------------------------------------------- version 3 ok ------------------------------------------------------------->

<!--?php
include './includes/db-connection.php';

$habitat_id = $_GET['id'];
$query = $pdo->prepare("
    SELECT h.nom AS habitat_nom, h.description, h.images AS habitat_images,
           a.id AS animal_id, a.prenom, a.race, a.images AS animal_images
    FROM habitats h
    LEFT JOIN animaux a ON h.id = a.habitat_id
    WHERE h.id = :id
");
$query->execute(['id' => $habitat_id]);
$habitat_details = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Détail Habitat</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1><!?= htmlspecialchars($habitat_details[0]['habitat_nom']) ?></h1>
  <p><!?= htmlspecialchars($habitat_details[0]['description']) ?></p>
  <div class="habitat-images">
    <!?php foreach (json_decode($habitat_details[0]['habitat_images']) as $image): ?>
      <img src="<!?= $image ?>" alt="Image de l'habitat">
    <!?php endforeach; ?>
  </div>
  <h2>Animaux présents :</h2>
  <div class="animals">
    <!?php foreach ($habitat_details as $detail): ?>
      <!?php if ($detail['animal_id']): ?>
        <div class="animal-card">
          <img src="<!?= json_decode($detail['animal_images'])[0] ?>" alt="<!?= htmlspecialchars($detail['prenom']) ?>">
          <h3><!?= htmlspecialchars($detail['prenom']) ?> (<!?= htmlspecialchars($detail['race']) ?>)</h3>
          <a href="details-animal.php?id=<!?= $detail['animal_id'] ?>">Voir les détails</a>
        </div>
      <!?php endif; ?>
    <!?php endforeach; ?>
  </div>

  <script>
    // script.js Chargement des détails d’un habitat
    const urlParams = new URLSearchParams(window.location.search);
    const habitatId = urlParams.get('id');

    if (habitatId) {
      fetch(`api/get-habitat-details.php?id=${habitatId}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('habitat-name').textContent = data.nom;
          document.getElementById('habitat-description').textContent = data.description;

          const animalList = document.getElementById('animal-list');
          data.animaux.forEach(animal => {
            const animalItem = document.createElement('li');
            animalItem.textContent = `${animal.prenom} (${animal.race})`;
            animalItem.addEventListener('click', () => {
              window.location.href = `details-animal.php?id=${animal.id}`;
            });
            animalList.appendChild(animalItem);
          });
        })
        .catch(error => console.error('Erreur lors du chargement des détails de l\'habitat:', error));
    }
  </script>

</body>

</html>

<br> --><!--------------------------------------------------------------------------------------------------------------->
<!--?php
include 'includes/db-connection.php';

// Récupérer l'ID depuis l'URL
$habitatId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les détails de l'habitat
$sql = "SELECT nom, description, images FROM habitats WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$habitatId]);
$habitat = $stmt->fetch();

if ($habitat) {
  echo '<h1>' . htmlspecialchars($habitat['nom']) . '</h1>';
  echo '<p>' . htmlspecialchars($habitat['description']) . '</p>';

  // Afficher les images
  $images = json_decode($habitat['images']);
  foreach ($images as $image) {
    echo '<img src="assets/images/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($habitat['nom']) . '">';
  }

  // Afficher les animaux associés
  echo '<h2>Animaux dans cet habitat</h2>';
  $sqlAnimals = "SELECT id, prenom, race, JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]')) AS image FROM animaux WHERE habitat_id = ?";
  $stmtAnimals = $pdo->prepare($sqlAnimals);
  $stmtAnimals->execute([$habitatId]);

  while ($animal = $stmtAnimals->fetch()) {
    echo '<div class="animal">';
    echo '<img src="assets/images/' . $animal['image'] . '" alt="' . htmlspecialchars($animal['prenom']) . '">';
    echo '<h3>' . htmlspecialchars($animal['prenom']) . ' (' . htmlspecialchars($animal['race']) . ')</h3>';
    echo '<a href="details-animal.php?id=' . $animal['id'] . '">Voir détails</a>';
    echo '</div>';
  }
} else {
  echo '<p>Habitat non trouvé.</p>';
}
?>-->
<!------------------------------------------------------fonctionne ok-------------------------------------------------->
<!--!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'Habitat</title>
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <div class="container">
    <!?php
    include 'includes/db-connection.php';

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
        echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<p class="error">Habitat non trouvé.</p>';
    }
    ?>
  </div>
</body>

</html> -->

<!--------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------->
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Habitat</title>
    <link rel="stylesheet" href="assets/css/styles.css">

  <style>



/*-----------------------------------------------*/
/* Styles généraux */
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
  line-height: 1.6;
}

/* En-tête */
header {
  background-color: #2a7e50;
  color: white;
  /*padding: 10px 20px;*/
  /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
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
}
/*-----------------------------------------------*/

    /* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2, p {
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

.animal-card  {
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

</head>
<body>
    <div class="container"> --><!--
        <!?php
        include 'includes/db-connection.php';

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
                echo '<a href="details-animal.php?id=' . $animal['id'] . '" class="btn">Voir détails</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">Habitat non trouvé.</p>';
        }
        ?>
    </div>
</body>
</html> -->

<!--------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------->


