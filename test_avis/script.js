document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.querySelector(".carousel");

  function chargerAvis() {
    fetch("avis-api.php")
      .then((response) => response.json())
      .then((avisData) => {
        if (avisData.length === 0) {
          carousel.innerHTML = "<p>Aucun avis disponible pour l'instant.</p>";
          return;
        }

        avisData.forEach((avis) => {
          const avisElement = document.createElement("div");
          avisElement.className = "carousel-item";
          avisElement.innerHTML = `
                            <p>“${avis.message}”</p>
                            <cite>- ${avis.auteur}</cite>
                        `;
          carousel.appendChild(avisElement);
        });
      })
      .catch((error) => {
        console.error("Erreur de chargement des avis :", error);
        carousel.innerHTML = "<p>Erreur lors du chargement des avis.</p>";
      });
  }
  const apiUrl = 'http://localhost/EcfZooArcadia-V.1.0.0/avis-api.php';
  chargerAvis();
});


















/*
document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.querySelector(".carousel");

  function chargerAvis() {
    fetch("avis-api.php")
      .then((response) => response.json())
      .then((avisData) => {
        avisData.forEach((avis) => {
          const avisElement = document.createElement("div");
          avisElement.className = "carousel-item";
          avisElement.innerHTML = `
                            <p>“${avis.message}”</p>
                            <cite>- ${avis.auteur}</cite>
                        `;
          carousel.appendChild(avisElement);
        });
      })
      .catch((error) => {
        console.error("Erreur de chargement des avis :", error);
      });
  }

  chargerAvis();
});
*/





















/*
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
*/