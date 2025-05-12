<?php
//require '../config/database.php';
require_once '../config/config_unv.php';

// Récupérer la liste des animaux
$animaux = $pdo->query("SELECT id, nom FROM habitats ORDER BY nom")->fetchAll(); // race
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter une consommation</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0">
          <div class="card-header bg-success text-white text-center">
            <h3>Ajouter un Avis Habitat</h3>
          </div>
          <div class="card-body">
            <form action="traiter_consommation.php" method="POST">
              <div class="mb-3">
                <label for="id" class="form-label">Habitat</label>
                <select name="animal_id" class="form-select" required>
                  <option value="">Sélectionner un habitat</option>
                  <?php foreach ($animaux as $animal) : ?>
                    <option value="<?= $animal['id'] ?>">
                      <?= htmlspecialchars($animal['nom']) ?> (<?= htmlspecialchars($animal['nom']) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" required>
              </div>
              <!--
              <div class="mb-3">
                <label for="heure" class="form-label">Heure</label>
                <input type="time" name="heure" class="form-control" required>
              </div>
              
              <div class="mb-3">
                <label for="nourriture" class="form-label">Nourriture</label>
                <input type="text" name="nourriture" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="quantite" class="form-label">Quantité (kg)</label>
                <input type="number" name="quantite" step="0.1" class="form-control" required>
              </div>-->

              <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire :</label>
                <textarea name="commentaire" id="commentaire" class="form-control" rows="4" required></textarea>
              </div>

              <button type="submit" class="btn btn-success w-100">Ajouter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

























<?php
session_start();
if (!isset($_SESSION['utilisateur_role']) || $_SESSION['utilisateur_role'] !== 'veterinaire') {
    die("Accès refusé. Veuillez vous connecter en tant que vétérinaire.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un avis habitat</title>
</head>
<body>
    <h2>Ajouter un avis sur un habitat</h2>
    <form action="traitement_avis.php" method="POST">
        <label for="habitat_id">ID de l'habitat :</label>
        <input type="number" name="habitat_id" required><br><br>

        <label for="commentaire">Commentaire :</label><br>
        <textarea name="commentaire" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Soumettre l'avis">
    </form>
</body>
</html>