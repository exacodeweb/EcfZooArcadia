<?php 
// Inclure le fichier de configuration de la base de données
include '../config/config_unv.php'; // Assurez-vous du bon chemin d'accès

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = intval($_POST['service_id']);
    $titres = $_POST['titre'];
    $valeurs = $_POST['valeur'];

    if (!empty($titres) && !empty($valeurs)) {
        $sql = "INSERT INTO specifications (service_id, titre, valeur) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        for ($i = 0; $i < count($titres); $i++) {
            $stmt->execute([$service_id, $titres[$i], $valeurs[$i]]);
        }
        
        $message = "Spécifications ajoutées avec succès !";
        $alertClass = "alert-success";
    } else {
        $message = "Erreur : Veuillez remplir tous les champs.";
        $alertClass = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajouter une spécification</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .specification {
      margin-bottom: 1rem;
    }
    .specification input {
      margin-bottom: 0.5rem;
    }
    .remove-btn {
      margin-top: 0.5rem;
    }

    .action {
      display: flex;
      flex-direction: row;
      width: 100%;
      align-content: center;
      justify-content: center;
      gap: 8px;
    }

  </style>
</head>
<body>
  <div class="container my-5">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Ajouter une spécification</h3>
      </div>
      <div class="card-body">
        <form action="add-specification.php" method="POST">
          <div class="mb-3">
            <label for="service" class="form-label">Choisir un service :</label>
            <select name="service_id" id="service" class="form-select" required>
              <?php
              // Récupérer les services depuis la base de données
              $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
              foreach ($services as $service) {
                  echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
              }
              ?>
            </select>
          </div>
          <div id="specifications-container" class="mb-3">

            <div class="specification border p-3 rounded mb-3">
              <div class="mb-2">
                <label for="service" class="form-label">Description :</label>
                <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Visite du zoo)" required>
              </div>
              <div class="mb-2">
                <label for="service" class="form-label">Indiqué les horaires</label>
                <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: Durée 12h - 14h)" required>
              </div>
              <!--<button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>-->
            </div>
          </div>
          <div class="action mb-3">

          <button type="button" class="btn btn-danger " onclick="removeSpecification(this)">Supprimer</button><!-- remove-btn -->

            <button type="button" class="btn btn-secondary" onclick="addSpecification()">Ajouter une spécification</button>
            <!-- </div> -->
          <button type="submit" class="btn btn-primary ">Enregistrer</button><!-- w-100 w-50  -->
            </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function addSpecification() {
      let container = document.getElementById("specifications-container");
      let div = document.createElement("div");
      div.classList.add("specification", "border", "p-3", "rounded", "mb-3");
      div.innerHTML = ` 
        <div class="mb-2">
          <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Horaires)" required>
        </div>
        <div class="mb-2">
          <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
        </div>
        <button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>
      `;
      container.appendChild(div);
    }

    function removeSpecification(button) {
      button.parentElement.remove();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>














<!--!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajouter une spécification</title>   -->
  <!-- Bootstrap CSS --> <!----------------
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .specification {
      margin-bottom: 1rem;
    }
    .specification input {
      margin-bottom: 0.5rem;
    }
    .remove-btn {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Ajouter une spécification</h3>
      </div>
      <div class="card-body">
        <form action="add-specification.php" method="POST">
          <div class="mb-3">
            <label for="service" class="form-label">Choisir un service :</label>
            <select name="service_id" id="service" class="form-select" required>
              <!?php
              include '../includes/db-connection.php';
              $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
              foreach ($services as $service) {
                  echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
              }
              ?>
            </select>
          </div>
          <div id="specifications-container" class="mb-3">
            <div class="specification border p-3 rounded mb-3">
              <div class="mb-2">
                <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Horaires)" required>
              </div>
              <div class="mb-2">
                <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
              </div>
              <button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>
            </div>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-secondary" onclick="addSpecification()">Ajouter une spécification</button>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function addSpecification() {
      let container = document.getElementById("specifications-container");
      let div = document.createElement("div");
      div.classList.add("specification", "border", "p-3", "rounded", "mb-3");
      div.innerHTML = `
        <div class="mb-2">
          <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Horaires)" required>
        </div>
        <div class="mb-2">
          <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
        </div>
        <button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>
      `;
      container.appendChild(div);
    }

    function removeSpecification(button) {
      button.parentElement.remove();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

-------------------->

<br>

<!-- Encours de developp -->

<!--!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajouter une spécification</title> ---------------------------->
  <!-- Bootstrap CSS -->     <!------------------------
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Ajouter une spécification</h3>
      </div>
      <div class="card-body">
        <form action="add-specification.php" method="POST">
          <div class="mb-3">
            <label for="service" class="form-label">Choisir un service :</label>
            <select name="service_id" id="service" class="form-select" required>
              <!?php
              require_once '../config/config_unv.php'; // Connexion via fichier centralisé
              $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
              foreach ($services as $service) {
                  echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
              }
              ?>
            </select>
          </div>
          <div id="specifications-container" class="mb-3">
            <div class="specification border p-3 rounded mb-3">
              <div class="mb-2">
                <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Horaires)" required>
              </div>
              <div class="mb-2">
                <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
              </div>
              <button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>
            </div>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-secondary" onclick="addSpecification()">Ajouter une spécification</button>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function addSpecification() {
      let container = document.getElementById("specifications-container");
      let div = document.createElement("div");
      div.classList.add("specification", "border", "p-3", "rounded", "mb-3");
      div.innerHTML = `
        <div class="mb-2">
          <input type="text" name="titre[]" class="form-control" placeholder="Titre (ex: Horaires)" required>
        </div>
        <div class="mb-2">
          <input type="text" name="valeur[]" class="form-control" placeholder="Valeur (ex: 12h - 14h)" required>
        </div>
        <button type="button" class="btn btn-danger remove-btn" onclick="removeSpecification(this)">Supprimer</button>
      `;
      container.appendChild(div);
    }

    function removeSpecification(button) {
      button.parentElement.remove();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

  -->



<!--
<form action="add-specification.php" method="POST">
    <label for="service">Choisir un service :</label>
    <select name="service_id" required>
        <!?php
        include '../includes/db-connection.php';
        $services = $pdo->query("SELECT id, nom FROM services")->fetchAll();
        foreach ($services as $service) {
            echo '<option value="' . $service['id'] . '">' . htmlspecialchars($service['nom']) . '</option>';
        }
        ?>
    </select>

    <div id="specifications-container">
        <div class="specification">
            <input type="text" name="titre[]" placeholder="Titre (ex: Horaires)" required>
            <input type="text" name="valeur[]" placeholder="Valeur (ex: 12h - 14h)" required>
            <button type="button" onclick="removeSpecification(this)">Supprimer</button>
        </div>
    </div>

    <button type="button" onclick="addSpecification()">Ajouter une spécification</button>
    <button type="submit">Enregistrer</button>
</form>

<script>
function addSpecification() {
    let container = document.getElementById("specifications-container");
    let div = document.createElement("div");
    div.classList.add("specification");
    div.innerHTML = `
        <input type="text" name="titre[]" placeholder="Titre (ex: Horaires)" required>
        <input type="text" name="valeur[]" placeholder="Valeur (ex: 12h - 14h)" required>
        <button type="button" onclick="removeSpecification(this)">Supprimer</button>
    `;
    container.appendChild(div);
}

function removeSpecification(button) {
    button.parentElement.remove();
}
</script>


