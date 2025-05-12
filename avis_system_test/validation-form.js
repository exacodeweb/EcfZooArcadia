document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');

  form.addEventListener('submit', function (e) {
    // Récupère les champs
    const auteur = document.getElementById('auteur').value.trim();
    const message = document.getElementById('message').value.trim();

    // Validation des champs
    if (!auteur || auteur.length < 3) {
      alert("Le pseudo doit comporter au moins 3 caractères.");
      e.preventDefault();
      return;
    }

    if (!message || message.length < 10) {//10
      alert("Le message doit comporter au moins 10 caractères.");
      e.preventDefault();
      return;
    }

    // Validation pour éviter les champs trop longs (facultatif)
    if (auteur.length > 100) {
      alert("Le pseudo ne doit pas dépasser 100 caractères.");
      e.preventDefault();
      return;
    }

    if (message.length > 1000) {
      alert("Le message ne doit pas dépasser 1000 caractères.");
      e.preventDefault();
      return;
    }
  });
});
