<?php
// Génère un token CSRF s'il n'existe pas encore (protection contre les attaques CSRF)
session_start();
if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg p-4">
          <h3 class="text-center mb-4">Nous Contacter</h3>
          <!-- Formulaire de contact avec Bootstrap et validation JS -->
          <form id="contactForm" action="soumettre_contact.php" method="POST">
            <!-- Vérification que le token existe pour éviter les erreurs -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="mb-3">
              <label for="nom" class="form-label">Nom :</label>
              <input type="text" id="nom" name="nom" class="form-control" required>
              <div class="invalid-feedback">Veuillez entrer votre nom.</div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email :</label>
              <input type="email" id="email" name="email" class="form-control" required>
              <div class="invalid-feedback">Veuillez entrer un email valide.</div>
            </div>

            <div class="mb-3">
              <label for="message" class="form-label">Votre message :</label>
              <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
              <div class="invalid-feedback">Veuillez écrire un message.</div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Inclusion de la validation côté client avec JavaScript -->
  <script src="./validation-contact.js"></script><!-- assets/js/validation-contact.js -->
</body>

</html>