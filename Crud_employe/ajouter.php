<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un employé</title>
  <!-- Intégration de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="text-center mb-4">Ajouter un employé</h2>

            <form action="traitement-ajout.php" method="POST">
              <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" name="nom" required>
              </div>

              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" class="form-control" name="prenom" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" required>
              </div>

              <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" name="mot_de_passe" required>
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Rôle :</label>
                <select class="form-select" name="role" required>
                  <option value="employe">Employé</option>
                  <option value="veterinaire">Vétérinaire</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary w-100">Ajouter</button>
            </form>

            <div class="text-center mt-3">
              <a href="liste.php" class="text-decoration-none btn btn-secondary w-100">🔙 Retour à la liste</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>