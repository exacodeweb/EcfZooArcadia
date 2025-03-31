document.getElementById('form-avis').addEventListener('submit', function(e) {
  const auteur = document.getElementById('auteur').value.trim();
  const message = document.getElementById('message').value.trim();

  if (!auteur || !message) {
      e.preventDefault();
      alert("Veuillez remplir tous les champs.");
  }
});