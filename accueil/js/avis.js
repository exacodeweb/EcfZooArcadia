document.addEventListener('DOMContentLoaded', () => {
  fetch('../get_reviews.php')
    .then(res => res.text())
    .then(data => {
      document.getElementById('avis-container').innerHTML = data;
    })
    .catch(err => {
      console.error("Erreur lors du chargement des avis :", err);
      document.getElementById('avis-container').textContent = "Impossible de charger les avis.";
    });
});











// <!-- API -->
document.addEventListener("DOMContentLoaded", function() {
  const avisContainer = document.querySelector(".avis-container");
  const avisScrollContainer = document.querySelector(".avis-scroll-container");

  function chargerAvis() {
    fetch("../get_reviews.php") //./avis_system_test // ./avis-api.php
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


// MENU HAMBURGER 
  document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });
  });











