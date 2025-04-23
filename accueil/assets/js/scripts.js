// JavaScript pour charger les données dynamiquement via AJAX.
document.addEventListener("DOMContentLoaded", () => {
  fetch("api/get-habitats.php")
      .then(response => response.json())
      .then(data => {
          const habitatsList = document.querySelector(".habitats-list");
          data.forEach(habitat => {
              const div = document.createElement("div");
              div.className = "habitat";
              div.innerHTML = `
                  <img src="assets/images/${habitat.image}" alt="${habitat.nom}">
                  <h3>${habitat.nom}</h3>
                  <a href="details-habitat.php?id=${habitat.id}">Voir détails</a>
              `;
              habitatsList.appendChild(div);
          });
      });
});