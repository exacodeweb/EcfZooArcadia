<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garage Vincent Parrot</title>
  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">--------->
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
  <!--<link rel="stylesheet" href="assets/css/style.css">--> <!-- Fichier CSS perso -->

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <!--style de police d'ecriture--><!--
  <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">-->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">

  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">


  <!-- Lien vers le CSS de Bootstrap 5 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
  <style>
    /* En-tête */
    header {
      background-color: #2a7e50;
      color: white;
      padding: 10px 20px;
      /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /*---------------------------- Ajouter
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

    /*---------------------------------*/

    /*.logo {
    max-width: 90px;
    border-radius: 5px;
  }*/

    /* Logo */
    .logo {
      height: 90px;
      /* Ajustez la taille selon votre logo */
      border-radius: 4px;
    }

    .menu-toggle {
      font-size: 1.8rem;
      cursor: pointer;
      display: none;
    }

    .nav-links {
      display: flex;
      gap: 10px;
      /*15px*/
      list-style: none;
      margin: 0px;
      padding: 0px;

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

    /* Bouton de réservation */
    .cta-btn {
      background-color: burlywood;
      /*#F3EDE0*/
      /*#805D3A*/
      /*#007BFF*/
      /**/
      color: #2A7E50;
      /*#fff*/
      /**/
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;

      /*opacity: 0.5;*/
    }

    /*.cta-btn:hover {
    background-color: #F3EDE0;/*#805D3A*/
    /* */
    /*#0056b3*/
    /*#fff*/
    /*color: #fff;*/
    /*
  }*/

    .navbar-toggler-icon .navbar-toggle {
      color: white;
      background-color: #fff;
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

    /* Animations au défilement */
    /*
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
/* Dans mon fichier CSS personnalisé */

    /*ayer components {
  .btn-toggle {
    @apply p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500;
  }
}*/
  </style>

  <style>
    .navbar-toggler-icon {
      color: white;
    }
  </style>

</head>

<body>
  <header>

    <nav class="navbar"><!-- ../public/assets/images/Logo-Arcadia-(9).jpg -->
      <img src="./assets/logos/ZOO_ARCADIA.jpg" alt="Logo Zoo Arcadia" class="logo">
      <!-- Bouton Hamburger -->
      <span class="menu-toggle" id="menuToggle">☰</span><!---->

      <!-- navbar-toggler -->
      <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks" aria-controls="navLinks" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>-->

      <ul class="nav-links" id="navLinks">

        <li><a href="./index.php#hero">Accueil</a></li><!--  href="#hero" ../index.php#index-1 -->
        <!--<li><a href="<!?= dirname($_SERVER['SCRIPT_NAME']) ?>./index.php#hero">Accueil</a></li> -->
        <li><a href="#habitats">Habitats</a></li><!-- # -->
        <!--<li><a href="<!-?= dirname($_SERVER['SCRIPT_NAME']) ?>./index.php#habitats">Habitats</a></li>-->
        <li><a href="#services">Services</a></li><!-- # -->
        <!--<li><a href="<!?= dirname($_SERVER['SCRIPT_NAME']) ?>./index.php#services">Services</a></li>-->
        <li><a href="#about">À propos</a></li><!-- # -->
        <!--<li><a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>./index.php#about">À propos</a></li>-->
        <li><a href="../contact/fom_contact.php">Contact</a></li><!-- #contact #./pubt/contact.html-->

        <!-- Lien pour l'accès administrateur -->
        <!--<div class="Navbar__Link">
            <a class="nav-link nav-admin-link" href="./public/login.php" title="Admin">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="-49 141 512 512" width="16" height="16" aria-hidden="true"
                fill="currentColor" class="bi bi-unlock-fill">
                <path d="M423 638H-9c-13.807 0-25-11.193-25-25 0-53.438 17.131-104.058 49.542-146.388 22.2-28.994 50.961-52.656 83.376-69.006C75.53 371.377 62 337.07 62 301c0-79.953 65.047-145 145-145s145 65.047 145 145c0 36.07-13.53 70.377-36.918 96.606 32.416 16.349 61.177 40.012 83.376 69.005C430.869 508.942 448 559.562 448 613c0 13.807-11.193 25-25 25zM17.657 588h378.687c-9.908-74.383-63.38-137.724-136.792-158.682a25 25 0 0 1-5.533-45.75C283.615 366.669 302 335.03 302 301c0-52.383-42.617-95-95-95s-95 42.617-95 95c0 34.03 18.386 65.668 47.981 82.568a25.003 25.003 0 0 1 12.423 24.712 25.003 25.003 0 0 1-17.956 21.038C81.037 450.276 27.564 513.617 17.657 588z"></path>
              </svg>
            </a>
          </div>-->

        <!--<li><a href="./public/login.php">Connexion</a></li> version fonctionnel -->
        <li><a href="../public/login-2.php">Connexion</a></li><!-- version sécurisé -->
        <li><a href="#reservation" class="cta-btn">Réserver</a></li>
      </ul>
    </nav>
  </header>

  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>------------->
  <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->


</body>

</html>