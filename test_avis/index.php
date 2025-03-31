<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Avis</title>
  <link rel="stylesheet" href="./assets/style.css">
  <link rel="stylesheet" href=".assets/styles.css">
</head>

<body>
  <h1>Test des Avis</h1>

  <!-- <section id="avis">
        <h3>Ce que nos visiteurs disent</h3>
        <div class="avis-scroll-container">
            <div class="avis-container"> -->
  <!-- Les avis validés seront insérés dynamiquement ici --> <!--
            </div>
        </div>
    </section>-->


  <section id="avis">
    <h3>Ce que nos visiteurs disent</h3>
    <div class="carousel-container">
      <div class="carousel">
        <!-- Les avis validés seront insérés dynamiquement ici -->

      </div>
      <div class="stars">
        ★★★★☆
      </div>

    </div>
  </section>





  <!-------------------------------------------------->
  <!--<section id="avis">
    <h3>Ce que nos visiteurs disent</h3>
    <div class="carousel-container">
        <div class="carousel"> -->
  <!-- Les avis validés seront insérés dynamiquement ici --> <!--
        </div>
    </div>
</section>-->


  <style>
    .carousel-container {
      position: relative;
      max-width: 800px;
      margin: 20px auto;
      overflow: hidden;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .carousel {
      display: flex;
      gap: 20px;
      animation: carouselScroll 20s linear infinite;
    }

    .carousel-item {
      min-width: 300px;
      flex-shrink: 0;
      background-color: #eaeaea;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .carousel-item p {
      font-style: italic;
      color: #555;
    }

    .carousel-item cite {
      display: block;
      margin-top: 10px;
      text-align: right;
      font-weight: bold;
      color: #333;
    }

    @keyframes carouselScroll {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(calc(-300px * 5));
        /* Ajustez selon le nombre d'éléments visibles */
      }
    }
  </style>

  <!-------------------------------------------------->




  <!--<section id="avis">
    <div class="carousel">
        <div class="carousel-item">
            <p>“Service impeccable !”</p>

            <div class="stars">
              ★★★★☆
            </div>

            <cite>- Alice</cite>            
        </div>
        <div class="carousel-item">
            <p>“Très satisfait, je recommande.”</p>

            <div class="stars">
              ★★★★☆
          </div>

            <cite>- Bob</cite>          
        </div>
        <div class="carousel-item">
            <p>“Rapide et efficace !”</p>

            <div class="stars">
              ★★★★☆
            </div>

            <cite>- Claire</cite>            

        </div>
    </div>
    </section>

    <section id="avis">  -->
  <!--<h3>Ce que nos visiteurs disent</h3>--> <!--
        <div class="carousel-container">
            <div class="carousel-item">  -->
  <!-- Les avis validés seront insérés dynamiquement ici --> <!--
            </div>

    <div class="stars">
  ★★★★☆
</div>

        </div>
    </section>-->


  <!--<section id="form-avis" class="text-center my-4">
        <h2>Laisser un Avis</h2>
        <form action="soumettre-avis.php" method="POST" class="avis-form">
            <div>
                <label for="auteur">Votre Nom :</label>
                <input type="text" id="auteur" name="auteur" required>
            </div>
            <div>
                <label for="message">Votre Avis :</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </section>-->

  <!--<script>
        document.addEventListener("DOMContentLoaded", function () {
            const avisContainer = document.querySelector(".avis-container");
            const avisScrollContainer = document.querySelector(".avis-scroll-container");

            function chargerAvis() {
                fetch("avis-api.php")
                    .then((response) => response.json())
                    .then((avisData) => {
                        avisData.forEach((avis) => {
                            const avisElement = document.createElement("div");
                            avisElement.className = "avis";
                            avisElement.innerHTML = `
                                <p>“${avis.message}”</p>
                                <cite>- ${avis.auteur}</cite>
                            `;
                            avisContainer.appendChild(avisElement);
                        });
                        defilementAutomatique();
                    })
                    .catch((error) => {
                        console.error("Erreur de chargement des avis :", error);
                    });
            }

            function defilementAutomatique() {
                let scrollAmount = 0;
                const scrollSpeed = 1;

                function scroll() {
                    scrollAmount += scrollSpeed;
                    if (scrollAmount >= avisContainer.scrollWidth / 2) {
                        scrollAmount = 0; // Réinitialiser
                    }
                    avisScrollContainer.scrollLeft = scrollAmount;
                    requestAnimationFrame(scroll);
                }
                scroll();
            }

            chargerAvis();
        });
    </script>-->



  <!--<section id="avis">
    <h3>Ce que nos visiteurs disent</h3>
    <div class="carousel-container">
        <div class="carousel"> -->
  <!-- Les avis validés seront insérés dynamiquement ici --> <!--
        </div>
    </div>
  </section> -->
  <a href="./get_reviews.php">
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.carousel');

        // Charger les avis depuis l'API
        fetch('./get_reviews.php') // ./avis-api.php
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              carousel.innerHTML = `<p>${data.error}</p>`;
              return;
            }

            // Générer les cartes pour chaque avis
            data.forEach(avis => {
              const avisItem = document.createElement('div');
              avisItem.className = 'carousel-item';

              avisItem.innerHTML = `
                    <p>“${avis.message}”</p>
                    <div class="stars">${'★'.repeat(avis.rating)}${'☆'.repeat(5 - avis.rating)}</div>
                    <cite>- ${avis.auteur}</cite>
                `;

              carousel.appendChild(avisItem);
            });

            // Démarrer l'animation
            initCarousel();
          })
          .catch(error => {
            carousel.innerHTML = '<p>Erreur lors du chargement des avis.</p>';
            console.error(error);
          });

        // Fonction pour démarrer l'animation du carousel
        function initCarousel() {
          let scrollAmount = 0;
          const speed = 2; // Vitesse de défilement
          const container = document.querySelector('.carousel-container');
          const content = carousel.cloneNode(true);

          // Boucle infinie : Ajouter une copie des items à la fin
          content.style.position = 'absolute';
          content.style.left = `${carousel.offsetWidth}px`;
          container.appendChild(content);

          function animate() {
            scrollAmount -= speed;
            carousel.style.transform = `translateX(${scrollAmount}px)`;
            content.style.transform = `translateX(${scrollAmount}px)`;

            // Réinitialiser la position pour un effet de boucle
            if (scrollAmount <= -carousel.offsetWidth) {
              scrollAmount = 0;
            }

            requestAnimationFrame(animate);
          }

          animate();
        }
      });
    </script>


































































    <!--********************************************************************************************--> <!--style.css-->

<style>
  #avis {
    padding: 20px;
    background-color: #f9f9f9;
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
    display: block;
    margin-top: 10px;
    font-style: italic;
    color: #555;
  }
</style>


<style>
    #avis-container {
        margin: 20px auto;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-width: 600px;
        background: #f9f9f9;
    }

    .avis {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .avis:last-child {
        border-bottom: none;
    }

    blockquote {
        font-style: italic;
        color: #555;
    }

    footer {
        text-align: right;
        font-weight: bold;
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

 <!-- pour centrée le carousel -->
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

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


  <!--***************************************************************************************************************-->

  <!-- et pour afficher les avis --> 
  <section id="avis">
    <h3>Ce que nos visiteurs disent</h3>
    <div class="avis-scroll-container">
      <div class="avis-container">
        <!-- Les avis validés seront insérés ici dynamiquement -->
      </div>
    </div>

    <button onclick="window.location.href='tous-les-avis.php'" class="btn btn-primary mt-3">Voir tous les avis</button>  <!-- avis.html -->
    <button onclick="window.location.href='soumettre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>

    <!--<section id="avis">
      <h3>Vos Avis Nous Comptent</h3>
      <p>Partagez votre expérience avec nous !</p>
      <a href="./avis_system_test/soumetre-avis.php" class="btn btn-primary">Laisser un Avis</a>
    </section>-->


    <!--<a href="./avis_system_test/soumetre-avis.html" class="btn btn-primary">
      <i class="fa fa-pencil"></i> Laisser un Avis
    </a>-->

    <!--<button onclick="window.location.href='./avis_system_test/soumetre-avis.html'" class="btn btn-secondary mt-3">Laisser un avis</button>-->

  </section>
  <!--***************************************************************************************************************-->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // URL de l'API
        const apiUrl = './get_reviewws.php'; // avis-api.php

        // Conteneur pour les avis
        const avisContainer = document.getElementById('avis-container');

        // Appel à l'API
        fetch(apiUrl)// apiUrl
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau lors de la récupération des avis.');
                }
                return response.json();
            })
            .then(data => {
                // Vérifier si des avis sont disponibles
                if (data.length === 0) {
                    avisContainer.innerHTML = '<p>Aucun avis disponible pour le moment.</p>';
                    return;
                }

                // Construire les avis
                const avisHtml = data.map(avis => `
                    <div class="avis">
                        <p class="w-100">"${avis.message}"</p>
                        <p>- ${avis.auteur}</p>
                    </div>
                `).join('');

                // Insérer les avis dans la page
                avisContainer.innerHTML = avisHtml;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des avis :', error);
                avisContainer.innerHTML = '<p>Impossible de charger les avis pour le moment.</p>';
            });
    });
</script>

  <!--***************************************************************************************************************-->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const avisContainer = document.querySelector(".avis-container");
    const avisScrollContainer = document.querySelector(".avis-scroll-container");

    function chargerAvis() {
      fetch("./get_reviews.php")//./avis_system_test // ./avis-api.php
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


    <script src="./script.js"></script>
</body>

</html>