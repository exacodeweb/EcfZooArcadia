/*-- nav --*/
document.addEventListener("DOMContentLoaded", () => {
  // Sélectionnez la balise <nav>
  const nav = document.querySelector("nav");

  // Configuration des heures
  const timeConfig = {
    dayStart: 6, // Début du jour
    nightStart: 14 // Début de la nuit
  };

  // Obtenez l'heure actuelle
  const now = new Date();
  const hour = now.getHours();

  // Appliquez les styles selon l'heure
  if (hour >= timeConfig.nightStart || hour < timeConfig.dayStart) {
    nav.classList.add("night-mode"); // Style nuit
  } else {
    nav.classList.remove("night-mode"); // Style jour
  }
});

/*-- neon --*/
document.addEventListener("DOMContentLoaded", () => {
  // Sélectionnez l'élément avec la classe .neon
  const neonElement = document.querySelector(".neon");

  // Configuration des heures
  const timeConfig = {
    dayStart: 6, // Début du style jour
    nightStart: 19 // Début du style nuit
  };

  // Obtenez l'heure actuelle
  const now = new Date();
  const hour = now.getHours();

  // Appliquez les styles selon l'heure
  if (hour >= timeConfig.nightStart || hour < timeConfig.dayStart) {
    neonElement.classList.add("night-mode"); // Applique le style nuit
  } else {
    neonElement.classList.remove("night-mode"); // Applique le style jour
  }
});


/*</nav><!-- body -->*/
document.addEventListener("DOMContentLoaded", () => {
  const dayInput = document.getElementById("day-start");
  const nightInput = document.getElementById("night-start");
  const saveButton = document.getElementById("save-config");

  // Charger la configuration depuis le LocalStorage
  const loadConfig = () => {
    const config = JSON.parse(localStorage.getItem("timeConfig"));
    if (config) {
      dayInput.value = config.dayStart;
      nightInput.value = config.nightStart;
    }
  };

  const saveConfig = () => {
    const config = {
      dayStart: parseInt(dayInput.value, 10),
      nightStart: parseInt(nightInput.value, 10)
    };
    localStorage.setItem("timeConfig", JSON.stringify(config));
    alert("Configuration sauvegardée !");
    applyStyle(config);
  };

  const applyStyle = (config) => {
    const now = new Date();
    const hour = now.getHours();

    if (hour >= config.nightStart || hour < config.dayStart) {
      document.body.classList.add("night-mode");
    } else {
      document.body.classList.remove("night-mode");
    }
  };

  // Initialiser
  loadConfig();
  saveButton.addEventListener("click", saveConfig);

  // Appliquer les styles au chargement
  const config = JSON.parse(localStorage.getItem("timeConfig")) || {
    dayStart: 6,
    nightStart: 18
  };
  applyStyle(config);
});



document.addEventListener("scroll", function () {
  document.querySelectorAll('.section').forEach(function (el) {
    if (el.getBoundingClientRect().top < script window.innerHeight) {
    el.classList.add('visible');
  }
});
    });
