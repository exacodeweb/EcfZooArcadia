<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  //header("Location: ../public/login.php");
  header("Location: ../config/login.php");
  exit;
}
?>











<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Administrateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Barre latérale -->
      <aside class="col-md-4 bg-light p-3">
        <div class="card mb-3">
          <div class="card-body text-center">
            <h3 class="card-title">Bienvenue, <?= $_SESSION['nom']; ?> 🎉</h3>
            <p class="card-text">Vous êtes connecté en tant qu'Administrateur.</p>
            <a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>
          </div>
        </div>
        <!-- Autres cartes ou sections de la barre latérale -->
        <div class="card mb-3">
          <div class="card-body text-center">
            <h5 class="card-title">Sécurité du compte</h5>
            <a href="modifier-mot-de-passe.php" class="btn btn-warning">Modifier mon mot de passe</a>
          </div>
        </div>
        <!-- Ajoutez d'autres sections ici -->
      </aside>

      <!-- Contenu principal -->
      <main class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Gestion des Habitats</h5>
            <a href="../Crud_habitats/liste_habitats.php" class="btn btn-secondary">Liste des Habitats</a>
            <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
            <a href="../Crud_habitats/modifier_habitat.php" class="btn btn-warning">Mettre à Jour un Habitat</a>
            <a href="../Crud_habitats/supprimer_habitat.php" class="btn btn-danger">Supprimer un Habitat</a>
          </div>
        </div>
        <!-- Ajoutez d'autres sections ou cartes pour le contenu principal ici -->
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!-- Header -->
<!--?php include './includes/header.php'; ?>-->


<!--------------------------------------------------------------------------------------------------------------------->

<!-- version chatgpt pour m'aider à apprendre -->
<!--?php 
session_start();
if ($_SESSION['role'] !== 'admin') {
  header("Location: ../config/login.php");
  exit;
}
?>-->


<!--------------------------------------------------------------------------------------------------------------------->


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Administrateur</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css"> <!-- Fichier CSS pour styles personnalisés -->


  <!--<style>
    .container {
      display: flex;
      flex-direction: row;
      height: auto;
      max-width: 100%;
      width: 100%;

      border: 1px solid green;
      padding: 5px;

      justify-content: center;
    }

    /*.content {
        display: flex;
        flex-direction: row;
        width: 100%;
      }*/


    .main {
      display: flex;
      flex-direction: column;
      justify-content: right;
      height: 100%;
      width: 100%;
      border: 1px solid red;
    }

    aside {
      display: flex;
      flex-direction: column;
      width: 40%;

      height: auto;

      justify-content: center;

      border: 1px solid blue;
    }

    .box {
      height: auto;
      width: 100%;
      background-color: blue;
    }
  </style>-->



  <style>

    /*body {
      background-color: darkslategray;
    }*/

    /* Conteneur principal */
    .container {
      display: flex;
      flex-direction: row;
      /* Aligne les enfants horizontalement */
      width: 100%;
      /* Assure que le conteneur prend toute la largeur disponible */
      max-width: 100%;
      border: 1px solid green;
      padding: 15px;
      justify-content: space-between;/*center*/
      /* Centre les enfants horizontalement */
      background: beige;/*#2C3E50*/

      padding: 15px;
    }

    /* Section principale */
    .main {
      display: flex;
      flex-direction: column;
      /* Aligne les enfants verticalement */
      justify-content: flex-end;
      /* Aligne les enfants en bas de la section */
      width: 70%;
      /* Occupe 60% de la largeur du conteneur principal */
      border: 1px solid red;

      padding: 0 12px;/*-- Ajouter --*/
    }

    /* Barre latérale */
    .aside {
      display: flex;
      flex-direction: column;
      /* Aligne les enfants verticalement */
      width: 30%;
      /* Occupe 40% de la largeur du conteneur principal */
      justify-content: center;
      /* Centre les enfants verticalement */
      border: 1px solid blue;

      gap: 15px;

      padding: 16px;
    }

    /* Boîte */
    .box {
      height: 50px;
      width: 50px;
      /* Prend toute la largeur de son parent */
      height: auto;
      /* Hauteur ajustée en fonction du contenu */
      background-color: blue;
      color: white;
    }




    .card {
      display: flex;
      width: 100%;
    }
  </style>

</head>

<body>
      <!-- Carte Bienvenue -->
      <div class="col-lg-12 col-md-6">
        <div class="card text-white bg-primary shadow">
          <div class="card-body text-center">
            <h3 class="card-title">Bienvenue, <?= $_SESSION['nom']; ?> 🎉</h3>
            <p class="card-text">Vous êtes connecté en tant qu'Administrateur.</p>
            <a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>
          </div>
        </div>
      </div>

  <!--<section class="container">-->

  <div class="container col-mt-12 col-md-12"><!--  -->

    <!--<div class="content">-->

    <main class="main col-md-10"><!--  col-md-8 -->
      <section>
        <div class="box">box 1</div>
      </section>
    </main>

    <aside class="aside col-md-4"><!-- col-md-4 -->
      <!--<div class="row">-->
      <!-- Carte Bienvenue -->
      <div class="col-lg-12 col-md-6">
        <div class="card text-white bg-primary shadow">
          <div class="card-body text-center">
            <h3 class="card-title">Bienvenue, <?= $_SESSION['nom']; ?> 🎉</h3>
            <p class="card-text">Vous êtes connecté en tant qu'Administrateur.</p>
            <a href="../config/logout.php" class="btn btn-danger">Déconnexion</a>
          </div>
        </div>
      </div>
      <!--</div>-->


      <!--<div class="row mt-4">-->

      <!-- Modifier mot de passe -->
      <div class="col-md-12"><!-- col-lg-6  -->
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Sécurité du compte</h5>
            <a href="modifier-mot-de-passe.php" class="btn btn-warning">Modifier mon mot de passe</a>
          </div>
        </div>
      </div>



      <!-- Gestion des employés -->
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des employés</h5>
            <!--<a href="../pages/employé/ajouter-employe.php" class="btn btn-success">Ajouter un Employé</a>-->
            <a href="../Crud_employe/liste.php" class="btn btn-info">Manager Employés</a>
            <!--<a href="../pages/delete_employee.php" class="btn btn-danger">Retirer un Compte</a>-->
          </div>
        </div>
      </div>

      <!-- Gestion des avis -->
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des avis</h5>
            <a href="../avis_system_test/moderation-avis.php" class="btn btn-primary">Modérer les Témoignages</a>
          </div>
        </div>
      </div>


      <!-- Gestion des habitats -->
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-body text-center">
            <h5 class="card-title">Gestion des Habitats</h5>
            <a href="../Crud_habitats/liste_habitats.php" class="btn btn-secondary">Liste des Habitats</a>
          </div>
        </div>
      </div>

      <!--</div>-->



      <!--</section>-->
    </aside>


  </div>
      <!-- Gestion des habitats -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-body text-center">
              <h5 class="card-title">Gestion des Habitats</h5>
              <a href="../Crud_habitats/liste_habitats.php" class="btn btn-secondary">Liste des Habitats</a>
              <a href="../Crud_habitats/ajouter_habitat.php" class="btn btn-success">Ajouter un Habitat</a>
              <a href="../Crud_habitats/modifier_habitat.php" class="btn btn-warning">Mettre à Jour un Habitat</a>
              <a href="../Crud_habitats/supprimer_habitat.php" class="btn btn-danger">Supprimer un Habitat</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Gestion des employer -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-body text-center">
              <h5 class="card-title">Ajouter un employer</h5>
              <a href="../pages/employé/ajouter-employe.php  btn btn-primary"><!--<i class="fas fa-user-plus"></i>--> Ajouter un employer</a>
            </div>
          </div>
        </div>
      </div>
  <!-- Réglage des heures de style --><!--
    <div class="row mt-4">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Réglage des Heures de Style</h5>
            <form id="settings-form">
              <div class="mb-3">
                <label for="day-start" class="form-label">Début du jour (h) :</label>
                <input type="number" class="form-control" id="day-start" name="day_start" min="0" max="23">
              </div>
              <div class="mb-3">
                <label for="night-start" class="form-label">Début de la nuit (h) :</label>
                <input type="number" class="form-control" id="night-start" name="night_start" min="0" max="23">
              </div>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
            <p id="status-message" class="mt-2"></p>
          </div>
        </div>
      </div>
    </div>-->


  <a href="../pages/employé/ajouter-employe.php  btn btn-primary"><i class="fas fa-user-plus"></i> Ajouter un Utiliisateur</a>

  <!--</div>

  </div>-->

  <script>
    // Charger les valeurs existantes
    fetch("get_settings.php")
      .then(response => response.json())
      .then(data => {
        document.getElementById("day-start").value = data.day_start || 6;
        document.getElementById("night-start").value = data.night_start || 18;
      })
      .catch(error => console.error("Erreur de chargement des paramètres :", error));

    // Sauvegarder les nouvelles valeurs
    document.getElementById("settings-form").addEventListener("submit", function(e) {
      e.preventDefault();
      const dayStart = document.getElementById("day-start").value;
      const nightStart = document.getElementById("night-start").value;

      fetch("update_settings.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            day_start: dayStart,
            night_start: nightStart
          })
        })
        .then(response => response.text())
        .then(message => {
          document.getElementById("status-message").textContent = message;
        })
        .catch(error => console.error("Erreur de sauvegarde :", error));
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<!--------------------------------------------------------------------------------------------------------------------->

<!--!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">  -->
<!-- Sidebar --> <!--
        <nav id="sidebar" class="bg-blue-900 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out">
            <div class="flex items-center space-x-3 px-4">
                <i class="fas fa-user-shield text-2xl"></i>
                <span class="text-xl font-semibold">Admin</span>
            </div>
            <hr class="border-gray-600">
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"><i class="fas fa-user-plus mr-2"></i> Ajouter Employé</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"><i class="fas fa-building mr-2"></i> Gérer Habitats</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"><i class="fas fa-comments mr-2"></i> Modérer Avis</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700"><i class="fas fa-chart-line mr-2"></i> Statistiques</a>
            <hr class="border-gray-600">
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-600"><i class="fas fa-sign-out-alt mr-2"></i> Déconnexion</a>
        </nav>  -->

<!-- Contenu principal --> <!--
        <div class="flex-1 flex flex-col">  -->
<!-- Header --> <!--
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <button id="toggleSidebar" class="text-blue-900 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold">Bienvenue, Admin</h1>
                <button class="text-gray-700 hover:text-gray-900 focus:outline-none">
                    <i class="fas fa-moon text-xl"></i>
                </button>
            </header> -->

<!-- Contenu principal --> <!--
            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
                        <i class="fas fa-user-plus text-3xl text-blue-900"></i>
                        <div>
                            <h3 class="text-lg font-semibold">Ajouter un Employé</h3>
                            <p class="text-gray-600">Créer un nouvel employé</p>
                        </div>
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
                        <i class="fas fa-building text-3xl text-blue-900"></i>
                        <div>
                            <h3 class="text-lg font-semibold">Gérer les Habitats</h3>
                            <p class="text-gray-600">Ajouter ou modifier un habitat</p>
                        </div>
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg flex items-center space-x-4">
                        <i class="fas fa-comments text-3xl text-blue-900"></i>
                        <div>
                            <h3 class="text-lg font-semibold">Modérer les Avis</h3>
                            <p class="text-gray-600">Approuver ou supprimer des avis</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>


  -->

<!--------------------------------------------------------------------------------------------------------------------->

<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  //header("Location: ../public/login.php");
  header("Location: ../config/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Administrateur</title>



  <style>
    /* En-tête */
    header {
      background-color: #2a7e50;
      color: white;
      padding: 10px 20px;
      /*box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);*/
    }

    /*.navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }*/

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
      /*75px*/
      /*50px*/
      /* Ajustez la taille selon votre logo */
      border-radius: 4px;
    }

    .menu-toggle {
      display: none;
      font-size: 1.8rem;
      /*28px*/
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
      /*# f2a007  */
      /*#007BFF*/
      /**/
      color: #2A7E50;
      /*#fff*/
      /**/
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .cta-btn:hover {
      background-color: #F3EDE0;
      /*#805D3A*/
      /*#0056b3*/
      /*#fff*/
      color: #fff;
    }

    /* Alignement du logo et du bouton hamburger */
    /*
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0px;
      /*10px 20px*/
    /*
      background-color: #2A7E50;
      /*#333*/
    /*
      color: white;
      /*whhite*/
    /*
    }*/


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
  </style>
</head>

<body>

  <header>
    <nav class="navbar"> <!---------->
      <!--<img src="../public/assets/images/Logo-Arcadia-(9).jpg" alt="Logo Zoo Arcadia" class="logo">--> <!-------->
      <img src="./assets/logos/ZOO_ARCADIA.jpg" alt="Logo Zoo Arcadia" class="logo"> <!------------>
      <!-- Bouton Hamburger --> <!--------------->
      <span class="menu-toggle" id="menuToggle">☰</span>

      <ul class="nav-links" id="navLinks">
        <li><a href="#hero">Accueil</a></li>
        <li><a href="#habitats">Habitats</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">À propos</a></li>
        <li><a href="./public/contact/contact.html">Contact</a></li> <!--------------> <!-- #contact -->

        <!-- Lien pour l'accès administrateur -->
        <!--<div class="Navbar__Link">
            <a class="nav-link nav-admin-link" href="./public/login.php" title="Admin">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="-49 141 512 512" width="16" height="16" aria-hidden="true"
                fill="currentColor" class="bi bi-unlock-fill">
                <path d="M423 638H-9c-13.807 0-25-11.193-25-25 0-53.438 17.131-104.058 49.542-146.388 22.2-28.994 50.961-52.656 83.376-69.006C75.53 371.377 62 337.07 62 301c0-79.953 65.047-145 145-145s145 65.047 145 145c0 36.07-13.53 70.377-36.918 96.606 32.416 16.349 61.177 40.012 83.376 69.005C430.869 508.942 448 559.562 448 613c0 13.807-11.193 25-25 25zM17.657 588h378.687c-9.908-74.383-63.38-137.724-136.792-158.682a25 25 0 0 1-5.533-45.75C283.615 366.669 302 335.03 302 301c0-52.383-42.617-95-95-95s-95 42.617-95 95c0 34.03 18.386 65.668 47.981 82.568a25.003 25.003 0 0 1 12.423 24.712 25.003 25.003 0 0 1-17.956 21.038C81.037 450.276 27.564 513.617 17.657 588z"></path>
              </svg>
            </a>
          </div>--> <!----------------------->

        <li><a href="./public/login.php">Connexion</a></li>
        <li><a href="#reservation" class="cta-btn">Réserver</a></li>
      </ul>
    </nav>
  </header>


  <!-- Section Admin -->
  <div class="col-md-12">
    <div class="card border-primary">
      <h1>Bienvenue, <?php echo $_SESSION['nom']; ?> (Administrateur)</h1>
      <a href="../config/logout.php">Déconnexion</a>
      <div>
        <a href="modifier-mot-de-passe.php" class="btn">Modifier mon mot de passe</a>
      </div>
      <div>
        <a href="../pages/employé/ajouter-employe.php">Ajouter un Employé</a>
      </div>
    </div>
  </div>

  <div> <br></div>

  <!-- Section Admin -->
  <div class="col-md-4">
    <div class="card border-primary">
      <div>
        <a class="nav-link" href="../avis_system_test/moderation-avis.php">Modérer les témoignages</a>
      </div>
    </div>
  </div>

  <div>
    <a href="../Crud_habitats/liste_habitats.php">liste des habitats</a>
    <a href="../Crud_habitats/ajouter_habitat.php">Ajouter un habitat</a>
    <a href="../Crud_habitats/modifier_habitat.php">mettre à jour un habitat</a>
    <a href="../Crud_habitats/supprimer_habitat.php">suppression d'un habitat</a>
  </div>

  <ul>
    <li><a href="../pages/delete_employee.php">retiré uncompte</a></li>
  </ul>

  <ul>
    <li><a href="../Crud_employe/liste.php">manager employé</li>
  </ul>

</body>

</html>

<!-- REGLAGE DES HEURES DE STYLE --->
<h1>Réglage des heures de style</h1>
<form id="settings-form">
  <label for="day-start">Début du jour (h) :</label>
  <input type="number" id="day-start" name="day_start" min="0" max="23">
  <label for="night-start">Début de la nuit (h) :</label>
  <input type="number" id="night-start" name="night_start" min="0" max="23">
  <button type="submit">Enregistrer</button>
</form>

<p id="status-message"></p>

<script>
  // Charger les valeurs existantes
  fetch("get_settings.php")
    .then(response => response.json())
    .then(data => {
      document.getElementById("day-start").value = data.day_start || 6;
      document.getElementById("night-start").value = data.night_start || 18;
    })
    .catch(error => console.error("Erreur de chargement des paramètres :", error));

  // Sauvegarder les nouvelles valeurs
  document.getElementById("settings-form").addEventListener("submit", function(e) {
    e.preventDefault();
    const dayStart = document.getElementById("day-start").value;
    const nightStart = document.getElementById("night-start").value;

    fetch("update_settings.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          day_start: dayStart,
          night_start: nightStart
        })
      })
      .then(response => response.text())
      .then(message => {
        document.getElementById("status-message").textContent = message;
      })
      .catch(error => console.error("Erreur de sauvegarde :", error));
  });
</script>

</body>

</html>





