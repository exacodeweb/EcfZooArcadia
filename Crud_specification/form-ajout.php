<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajouter une spécification</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Ajouter une spécification</h3>
      </div>
      <div class="card-body">
        <form action="add-specification.php" method="POST">
          <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select name="service_id" id="service_id" class="form-select" required>
              <?php
              $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
              foreach ($services as $service) {
                  echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre (ex: Horaires)" required>
          </div>
          <div class="mb-3">
            <label for="valeur" class="form-label">Valeur</label>
            <input type="text" name="valeur" id="valeur" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<form action="add-specification.php" method="POST">
    <select name="service_id">
        <?php
        $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
        foreach ($services as $service) {
            echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
        }
        ?>
    </select>
    <input type="text" name="titre" placeholder="Titre (ex: Horaires)" required>
    <input type="text" name="valeur" placeholder="Valeur (ex: 12h - 14h)" required>
    <button type="submit">Ajouter</button>
</form>

